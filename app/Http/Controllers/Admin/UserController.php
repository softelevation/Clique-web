<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Profile;
use App\SocialNetwork;
use App\Companyusers;
use App\Company;
use App\Carditems;
use App\RoleUser;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
/**************************************** User List Datatable ************************************* */
    public function user_index(Request $request)
    {

    if($request->ajax()) {
            $data = User::select('users.*','users_profile.avatar')->whereHas('roles', function ($query) {
                $query->where('role_id', '=', 2)->orwhere('role_id', '=', 4);
            });
            $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
            $data = $data->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = "";
                    $redirct_url = url("admin/edit-user?id=".$row->id);
                    $btn = '<a href="'.$redirct_url.'" class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
                    <i class="icon-xl fas fa-street-view"></i>
                    </a>';
                    $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deleteuser mr-2" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete">
                    <i class="icon-1x text-dark-50 flaticon-delete"></i>
                    </a>';
                    $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon resetpassword" data-toggle="tooltip"  data-email="'.$row->email.'"  data-id="'.$row->id.'" title="Reset Password">
                                <img src="'.asset('media/svg/icons/Home/Key.svg').'"/>
                            </a>';

                    return $btn;
                })
		        ->addColumn('id', function($row){
		           return $row->id;
		        })
		        ->addColumn('name', function($row){
                    $btn = "";
                    if($row->avatar == '/user/default.png'){
                        $storage_path = asset('media/users/blank.png');
                    }else{
                        $storage_path = asset('storage/'.$row->avatar);
                    }
                    $btn = '<div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                        <img class="" src="'.$storage_path.'" alt="photo">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->name.'</div>
                                        <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->email.'</a>
                                    </div>
                                </div>';
                    return $btn;
		            //return $row->name;
                })
                ->addColumn('email', function($row){
		            return $row->email;
                })
                ->addColumn('mobile1', function($row){
		            return $row->mobile;
                })
                ->addColumn('roles_name', function($row){
                    return $row->roles()->first()->role_name;
                   //return ($row->roles == null)?'':$row->roles->first()->role_name;
                })
                ->addColumn('created_at', function($row){
                    return display_date_format($row->created_at);
                })
                ->rawColumns(['id','name','email','mobile1','roles_name','created_at','action'])
		        ->make(true);
	    }
        $page_title = 'Users List';
        $page_description = '';
        return view('admin.users.users-datatables', compact('page_title', 'page_description'));
    }

/**************************************** System Admin List Datatable ************************************* */
public function systemadminindex(Request $request)
{

    if ($request->ajax()) {

        $data = User::select('users.*','users_profile.*')->whereHas('roles', function ($query) {
            $query->where('role_id', '=', 1);
        });
        $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
        $data = $data->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = "";
                $redirct_url = url("admin/edit/system-admin?id=".$row->user_id);
                $btn = '<a href="'.$redirct_url.'" class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
                <i class="icon-xl la la-edit"></i>
                </a>';
                $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deleteuser mr-2" data-toggle="tooltip"  data-id="'.$row->user_id.'" title="Delete">
                <i class="icon-1x text-dark-50 flaticon-delete"></i>
                </a>';
                $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon resetpassword" data-toggle="tooltip"  data-email="'.$row->email.'"  data-id="'.$row->user_id.'" title="Reset Password">
                            <img src="'.asset('media/svg/icons/Home/Key.svg').'"/>
                        </a>';

                return $btn;
            })
            ->addColumn('id', function($row){
               return $row->id;
            })
            ->addColumn('name', function($row){
                $btn = "";
                if($row->avatar == '/user/default.png'){
                    $storage_path = asset('media/users/blank.png');
                }else{
                    $storage_path = asset('storage/'.$row->avatar);
                }
                $btn = '<div class="d-flex align-items-center">
                                <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                    <img class="" src="'.$storage_path.'" alt="photo">
                                </div>
                                <div class="ml-4">
                                    <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->name.'</div>
                                    <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->email.'</a>
                                </div>
                            </div>';

                return $btn;
            })
            ->addColumn('email', function($row){
                return $row->email;
            })
            ->addColumn('mobile1', function($row){
                return $row->mobile;
            })
            ->addColumn('created_at', function($row){
                return display_date_format($row->created_at);
            })
            ->rawColumns(['id','name','email','mobile1','created_at','action'])
            ->make(true);
    }
    $page_title = 'System Admin List';
    $page_description = '';
    return view('admin.users.system-admin-datatable', compact('page_title', 'page_description'));
}

/**************************************** Corporate Admin List Datatable ************************************* */
public function corporateadminindex(Request $request)
{
    if ($request->ajax()) {
        $data = User::select('users.*','users_profile.*')->whereHas('roles', function ($query) {
            $query->where('role_id', '=', 3);
        });
        $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
        $data = $data->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = "";
                $redirct_url = url("admin/edit/corporate-admin?id=".$row->user_id);
                $btn = '<a href="'.$redirct_url.'" class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
                <i class="icon-xl la la-edit"></i>
                </a>';
                $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deleteuser mr-2" data-toggle="tooltip"  data-id="'.$row->user_id.'" title="Delete">
                <i class="icon-1x text-dark-50 flaticon-delete"></i>
                </a>';
                $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon resetpassword" data-toggle="tooltip"  data-email="'.$row->email.'"  data-id="'.$row->user_id.'" title="Reset Password">
                            <img src="'.asset('media/svg/icons/Home/Key.svg').'"/>
                        </a>';

                return $btn;
            })
            ->addColumn('id', function($row){
               return $row->id;
            })
            ->addColumn('name', function($row){
                $btn = "";
                if($row->avatar == '/user/default.png'){
                    $storage_path = asset('media/users/blank.png');
                }else{
                    $storage_path = asset('storage/'.$row->avatar);
                }
                $btn = '<div class="d-flex align-items-center">
                                <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                    <img class="" src="'.$storage_path.'" alt="photo">
                                </div>
                                <div class="ml-4">
                                    <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->name.'</div>
                                    <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->email.'</a>
                                </div>
                            </div>';
                return $btn;
                //return $row->name;
            })
            ->addColumn('email', function($row){
                return $row->email;
            })
            ->addColumn('mobile1', function($row){
                return $row->mobile;
            })
            ->addColumn('created_at', function($row){
                return display_date_format($row->created_at);
            })
            ->rawColumns(['id','name','email','mobile1','created_at','action'])
            ->make(true);
    }
    $page_title = 'Corporate Admin List';
    $page_description = '';
    return view('admin.users.corporate-admin-datatable', compact('page_title', 'page_description'));
}

/**************************************** User Delete ************************************* */
    public function destroy(Request $request)
    {
        $id = $request['id'];
        $res = User::find($id)->delete();
       
         $carditems = Carditems::select("*")->where('assign_user_id', $id)->get();
        foreach ($carditems as $val){
            $carddata = Carditems::where('assign_user_id', $id)->first();
            $carddata->assign_user_id = NUll;
            $carddata->updated_at = date('Y-m-d H:i:s');
            $carddata->save();
        }  
        // $userimage = Profile::whereuser_id($id);
        // $image_name = $userimage->avatar;
        // if(file_exists(public_path($image_name))){
        //     unlink(public_path($image_name));
        //     $userimage = Profile::whereuser_id($id);
        //     $userimage->avatar = '/user/default.png';
        //     $userimage->save();
        // }else{
        //     //dd('File does not exists.');
        // }
        
        
        return response()->json(['success'=>'User has been successfully delete.']);
    }
/**************************************** User Create ************************************* */
    public function create(Request $request)
    {
   	    $page_title = 'Add User';
        $page_description = '';
        return view('admin.users.create', compact('page_title', 'page_description'));
    }
    public function createsystemadmin(Request $request)
    {
   	    $page_title = 'Add System Admin';
        $page_description = '';
        return view('admin.users.create-system-admin', compact('page_title', 'page_description'));
    }
    public function createcorporateadmin(Request $request)
    {

        $page_title = 'Add Corporate Admin';
        $page_description = '';
        return view('admin.users.create-corporate-admin', compact('page_title', 'page_description'));
    }
    public function createcorporateuser(Request $request)
    {
        $c_users = User::select('users.*')->whereHas('roles', function ($query) {
            $query->where('role_id', '=', 3);
        });
        $c_users = $c_users->get();
        $c_users = $c_users->toArray();

        $page_title = 'Add Corporate User';
        $page_description = '';
        return view('admin.users.create-corporate-user', compact('page_title', 'page_description','c_users'));
    }
    public function createindividualuser(Request $request)
    {
   	    $page_title = 'Add Individual User';
        $page_description = '';
        return view('admin.users.create-individual-user', compact('page_title', 'page_description'));
    }


/**************************************** User Create store ************************************* */
    public function store(Request $request)
    {
        if($request['typeuser'] == 1){
            $role = 1;
        }elseif($request['typeuser'] == 3){
            $role = 3;
        }elseif($request['typeuser'] == 4){
            $role = 4;
        }else{
            $role = 2;
        }

        $is_exits = User::whereemail($request->email)->get()->count();
        if($is_exits == 0)
        {
            $mobile_new = $request['countrycode'].'-'. str_replace(' ', '', $request['mobile']);
            $mobile = User::where('mobile', $mobile_new)->first();
            if(isset($mobile))
            {
                return response()->json(['status' => 403, 'message' => 'mobile  no is already registered.']);
            }
            $user = new User;
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->mobile = $mobile_new;
            $user->password = Hash::make($request['password']);
            $user->email_verified_at = Hash::make($request['password']);
            $user->status = 1;
            if(!empty($request['avatar'])){
                $avatarExt = request()->avatar->getClientOriginalExtension();
                if($avatarExt == "jpg" || $avatarExt == "png" || $avatarExt == "jpeg"){
                }else{
	    		    return response()->json(['status' => 401, 'message' => 'The avatar must be a file of type: jpg, png, jpeg.']);
	    	    }
            }
            $user->save();
            $user_id = $user->id;
            $user->roles()->attach($role); //User role
            if(!empty($user_id)){
                $profile = new Profile;
                $profile->user_id = $user_id;
                $profile->privacy = 0;
                if(!empty($request['avatar'])){
                    //$avatarName = $user->id.'_avatar'.request()->avatar->getClientOriginalExtension();
                    $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
                    $request->avatar->storeAs('avatars',$avatarName);
                    $profile->avatar = '/avatars/'.$avatarName;
                    $companylogo = '/avatars/'.$avatarName;
                }
                else
                {
                    $companylogo = $profile->avatar;
                }
                $profile->save();

                        if($request['typeuser'] == 4)
                        {
                                $res_company = Company::whereuser_id($request['companyid'])->first()->toArray();
                                $companyusers = new Companyusers;
                                $companyusers->user_id = $user_id;
                                $companyusers->company_id = $res_company['id'];
                                $companyusers->job_position = $request['jobposition'];
                                $companyusers->save();
                        }
                        if($request['typeuser'] == 3)
                        {
                                $company = new Company;
                                $company->user_id = $user_id;
                                $company->name = $request['name'];
                                $company->phone = $mobile_new;
                                $company->number = $mobile_new;
                                $company->email = $request['email'];
                                $company->logo = $companylogo;
                                $company->save();
                        }

            }
                return response()->json([
                    'status' => 200,
                    'message' =>'User has been successfully created.']);
        }
        else
        {
            return response()->json(['status' => 401, 'message' => 'That email address or mobile  no is already registered.']);
        }
    }
/**************************************** User Edit user************************************* */
    public function edit(Request $request)
    {
        $c_data = array();
        $company_name = '';
        $jobposition = '';
        $user_data = User::find($request->id);
        $profiledata = Profile::whereuser_id($request->id)->first();
        $socialdata = SocialNetwork::whereuser_id($request->id)->get()->toArray();
        
        
         $roled_id =  RoleUser::whereuser_id($request->id)->first();
         $roled_id = $roled_id['role_id'];
         if($roled_id == 2)
         {
            $companydata = Company::select('company.*','company_users.job_position as jobposition');
            $companydata->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
            $companydata =  $companydata->where('company.user_id','=',$request->id)->get()->toArray();
            if($companydata){ 
                $company_name = $companydata[count($companydata) - 1]['name'];
                $jobposition = $companydata[count($companydata) - 1]['jobposition'];
            } else {
                $company_name = '';
                $jobposition = '';
            }
           
            $c_data['companyname'] = ($company_name)? $company_name : $company_name = "";
            $c_data['jobposition'] = ($jobposition)? $jobposition : $jobposition = '';
            
         }
         if($roled_id == 4)
         {
            
            $last_company = Companyusers::select('company_users.*','company.name as companyname')->where('company_users.user_id','=',$request->id);
            $last_company->leftJoin('company', 'company.id', '=', 'company_users.company_id');
            $last_company =  $last_company->get()->toArray();
            if($last_company){ 
                $company_name =  ($last_company[0]['companyname'])?$last_company[0]['companyname']:'';
                $jobposition = ($last_company[0]['job_position'])? $last_company[0]['job_position']:'';
            } else {
                $company_name = '';
                $jobposition = '';
            }
            $c_data['companyname'] = $company_name;
            $c_data['jobposition'] = $jobposition;
            
         }
        //dd($socialdata);
        return view('admin.users.edit',compact('user_data','profiledata','socialdata','c_data'));
    }
/**************************************** User update store************************************* */
    public function updatestore(Request $request)
    {

        if($request['typeuser'] == 3){
            $role = 3;
        }


        $user_id = $request->edit_userid;
        $pass = Hash::make($request['password']);
        $user = User::find($user_id);
        if(!empty($request['avatar'])){
	    	$avatarExt = request()->avatar->getClientOriginalExtension();
            if($avatarExt == "jpg" || $avatarExt == "png" || $avatarExt == "jpeg"){
            }else{
	    		return response()->json(['status' => 401, 'message' => 'The avatar must be a file of type: jpg, png, jpeg.']);
	    	}
	    }
        $user->name = $request['name'];
        if($request['password'] != "")
        {
            $user->password = $pass;
        }
        $user->email_verified_at = $pass;
        $user->save();
        $profile = Profile::whereuser_id($user_id)->first();
            if(!empty($user_id)){
                if(!empty($request['avatar'])){
                        $avatarName = $user_id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
                        $request->avatar->storeAs('avatars',$avatarName);
                        $profile->avatar = '/avatars/'.$avatarName;

                }else{
                        $avatarName = $profile->avatar;
                        $profile->avatar = $avatarName;
                }
                $profile->save();
            }
            $storage_path = asset('storage'.$avatarName);

            if($request['typeuser'] == 3)
            {

                    $company = Company::whereuser_id($user_id)->first();
                    $company->user_id = $user_id;
                    $company->name = $request['name'];
                    $company->phone = $request['mobile'];
                    $company->number = $request['mobile'];
                    $company->email = $request['email'];
                    $company->logo = $avatarName;
                    $company->save();
            }



            return response()->json(['status' => '200', 'message' => 'User has been updated successfully.', 'avtar' => $storage_path, 'role' => $user->roles()->first()->role_name]);
    }
/**************************************** User Password Update ************************************* */
    public function update_user_password(Request $request){
        $user_id = $request->user_id;
        $password = $request->password;
        $email =  $request->email;
        if($password != ""){
            $password = Hash::make($password);
            $user = User::find($user_id);
            $user->password = $password;
            $user->save();
            return response()->json(['status' => '200','email' => $email,'password' => $password,'message' => 'Reset Password Update successfully']);
        }else{
            return response()->json(['status' => '404','message' => 'Error in update password']);
        }
    }
/**************************************** Edit corporation user************************************* */
        public function editcorporateadmin(Request $request)
        {
            $user_data = User::find($request->id);
            $profiledata = Profile::whereuser_id($request->id)->first();
            $socialdata = SocialNetwork::whereuser_id($request->id)->get()->toArray();
            $page_title = 'Edit Corporate Admin';
            $page_description = '';
            //dd($socialdata);
            return view('admin.users.edit-corporate-admin',compact('user_data','profiledata','socialdata','page_title','page_description'));
        }



        public function update_corporateAdmin_user(Request $request)
        {
                $user_id = $request->edit_userid;
                $user = User::find($user_id);

                //$is_exits = User::whereemail($request->email)->get()->count();
                //if($is_exits == 0)
                //{
                    // $mobile_new = $request['countrycode'].'-'. str_replace(' ', '', $request['mobile']);
                    // $mobile = User::where('mobile', $mobile_new)->first();
                    // if(isset($mobile))
                    // {
                    //     return response()->json(['status' => 403, 'message' => 'mobile  no is already registered.']);
                    // }
                    if(!empty($request['avatar'])){
                        $avatarExt = request()->avatar->getClientOriginalExtension();
                        if($avatarExt == "jpg" || $avatarExt == "png" || $avatarExt == "jpeg"){
                        }else{
                            return response()->json(['status' => 401, 'message' => 'The avatar must be a file of type: jpg, png, jpeg.']);
                        }
                    }
                    $user->name = $request['name'];
                    //$user->mobile = $mobile_new;
                    $user->save();
                    $profile = Profile::whereuser_id($user_id)->first();
                    if(!empty($user_id)){
                        if(!empty($request['avatar'])){
                            $avatarName = $user_id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
                            $request->avatar->storeAs('avatars',$avatarName);
                            $profile->avatar = '/avatars/'.$avatarName;

                        }else{
                            $avatarName = $profile->avatar;
                            $profile->avatar = $avatarName;
                        }
                        $profile->save();
                    }
                    $storage_path = asset('storage'.$avatarName);
                    return response()->json(['status' => '200', 'message' => 'User has been updated successfully.', 'avtar' => $storage_path, 'role' => $user->roles()->first()->role_name]);
                //}
                // else
                // {
                //     return response()->json(['status' => 403, 'message' => 'That email address or mobile  no is already registered.']);
                // }

        }

/**************************************** Edit System user************************************* */
        public function editsystemadmin(Request $request)
        {
            $user_data = User::find($request->id);
            $profiledata = Profile::whereuser_id($request->id)->first();
            $socialdata = SocialNetwork::whereuser_id($request->id)->get()->toArray();
            $page_title = 'Edit Sytem Admin';
            $page_description = '';
            //dd($socialdata);
            return view('admin.users.edit-system-admin',compact('user_data','profiledata','socialdata','page_title','page_description'));
        }



        public function logout () {
            //logout user
            auth()->logout();
            // redirect to homepage
            return redirect('/admin');
        }
        
    //************************Get the user image path ********************/\
        public function profilepath(Request $request)
        {
            $user_id = Auth::id();
            if($request['is_flag'] == 1)
            {
                $profiledata = Profile::whereuser_id($user_id)->first();
                if($profiledata->avatar == "/user/default.png"  || $profiledata->avatar == "/user/default.png"){
                    $imagepath = url('media/users/blank.png');
                }else{
                    $imagepath = url($profiledata->avatar);
                }
                echo $imagepath;
                die();

            }
        }
    
        



}
