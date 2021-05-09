<?php

namespace App\Http\Controllers\Corporate;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\SocialNetwork;
use App\Companyusers;
use App\Company;
use App\Carditems;
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

            $res_company = Company::whereuser_id(Auth::id())->first()->toArray();

            $data = User::select('users.*','users_profile.avatar')->whereHas('roles', function ($query) {
                $query->where('role_id', '=', 4);
            });
            $data->leftJoin('company_users', 'company_users.user_id', '=', 'users.id')->where('company_users.company_id', '=', $res_company['id']);
            $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
            $data = $data->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = "";
                    $redirct_url = url("admin/corporate/edit-user?id=".$row->id);

                    $btn = '<a href="'.$redirct_url.'" class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
                    <i class="icon-xl fas fa-street-view"></i>
                    </a>';
                    $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deleteuser mr-2" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete">
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
        return view('corporate.users.users-datatables', compact('page_title', 'page_description'));
    }

/**************************************** User Delete ************************************* */
    public function destroy(Request $request)
    {
        $id = $request['id'];
        $res = User::find($id)->delete();
        $carditems = Carditems::select("*")->where('assign_user_id', $id)->get();
        $carditems->assign_user_id = NUll;
        $carditems->updated_at = date('Y-m-d H:i:s');
        $carditems->save();

        return response()->json(['success'=>'User has been successfully delete.']);
    }
/**************************************** User Create ************************************* */
    public function create(Request $request)
    {
   	    $page_title = 'Add User';
        $page_description = '';
        return view('corporate.users.create-corporate-user', compact('page_title', 'page_description'));
    }

/**************************************** User Create store ************************************* */
    public function store(Request $request)
    {

        $role = 4;
        $compmayID = Auth::id();
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
                }
                else
                {
                    $avatarName = "/user/default.png";
                    $profile->avatar = $avatarName;
                }
                $profile->save();

                        if($request['typeuser'] == "4" && $compmayID)
                        {
                                $res_company = Company::whereuser_id($compmayID)->first()->toArray();
                                $companyusers = new Companyusers;
                                $companyusers->user_id = $user_id;
                                $companyusers->company_id = $res_company['id'];
                                $companyusers->job_position = $request['jobposition'];
                                $companyusers->save();
                        }

            }
                return response()->json([
                    'status' => 200,
                    'message' =>'User has been successfully created.']);
        }
        else
        {
            return response()->json(['status' => 401, 'message' => 'That email address is already registered.']);
        }
    }
/**************************************** User Edit user************************************* */
    public function edit(Request $request)
    {
        $user_data = User::find($request->id);
        $profiledata = Profile::whereuser_id($request->id)->first();
        $socialdata = SocialNetwork::whereuser_id($request->id)->get()->toArray();
        //dd($socialdata);
        return view('corporate.users.edit',compact('user_data','profiledata','socialdata'));
    }
/**************************************** User update store************************************* */
    public function updateprofile(Request $request)
    {
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
                $user->save();
            }else{
                $avatarName = $profile->avatar;
                $profile->avatar = $avatarName;

            }
            $profile->save();
        }
            $storage_path = asset('storage'.$avatarName);
            // if($request['typeuser'] == 3)
            // {
            //         $company = new Company;
            //         $company->user_id = $user_id;
            //         $company->name = $request['name'];
            //         $company->phone = $request['mobile'];
            //         $company->number = $request['mobile'];
            //         $company->email = $request['email'];
            //         $company->logo = $avatarName;
            //         $company->save();
            // }
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
                if(!empty($request['avatar'])){
                    $avatarExt = request()->avatar->getClientOriginalExtension();
                    if($avatarExt == "jpg" || $avatarExt == "png" || $avatarExt == "jpeg"){
                    }else{
                        return response()->json(['status' => 401, 'message' => 'The avatar must be a file of type: jpg, png, jpeg.']);
                    }
                }
                $user->name = $request['name'];
                $user->save();
                $user = User::find($user_id);
                if(!empty($user_id)){
                    if(!empty($request['avatar'])){
                        $avatarName = $user_id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
                        $request->avatar->storeAs('avatars',$avatarName);
                        $user->avatar = '/avatars/'.$avatarName;
                        $user->save();
                    }else{
                        $avatarName = $user->avatar;
                    }
                }
                    $storage_path = asset('storage'.$avatarName);
                return response()->json(['status' => '200', 'message' => 'User has been updated successfully.', 'avtar' => $storage_path, 'role' => $user->roles()->first()->role_name]);
        }

/**************************************** Profile update ************************************* */
    public function profile(Request $request)
    {
        $compmayID = Auth::id();
        $user_data = User::find($compmayID);
        $profiledata = Profile::whereuser_id($compmayID)->first();
        $socialdata = SocialNetwork::whereuser_id($compmayID)->get()->toArray();
        $company = Company::whereuser_id($compmayID)->first();
        //dd($socialdata);
        return view('corporate.users.profile-corporate',compact('user_data','profiledata','socialdata','company'));
    }

/**************************************** Profile update save ************************************* */
    public function profileupdate(Request $request)
    {
        if($request['typeuser'] == 3){
            $role = 3;
        }
        $user_id = $request->edit_userid;
        $user = User::find($user_id);
        if(!empty($request['profile_avatar'])){
	    	$avatarExt = request()->profile_avatar->getClientOriginalExtension();
            if($avatarExt == "jpg" || $avatarExt == "png" || $avatarExt == "jpeg"){
            }else{
	    		return response()->json(['status' => 401, 'message' => 'The avatar must be a file of type: jpg, png, jpeg.']);
	    	}
	    }
        $user->name = $request['name'];
        $user->save();
        $profile = Profile::whereuser_id($user_id)->first();
        if(!empty($user_id)){
            if(!empty($request['profile_avatar'])){
                $avatarName = $user_id.'_avatar'.time().'.'.request()->profile_avatar->getClientOriginalExtension();
                $request->profile_avatar->storeAs('avatars',$avatarName);
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
                    if($company){
                    }else{ $company = new Company;  }
                    $company->user_id = $user_id;
                    $company->name = $request['name'];
                    $company->phone = $request['phone'];
                    //$company->number = $request['mobile'];
                    $company->email = $request['email'];
                    $company->logo = $avatarName;
                    $company->address = $request['address'];
                    $company->website = $request['website'];
                    $company->facebook = $request['facebook'];
                    $company->instagram = $request['instagram'];
                    $company->linkedin = $request['linkedin'];
                    $company->twitter = $request['twitter'];
                    $company->save();
            }
            return response()->json(['status' => '200', 'message' => 'Profile has been updated successfully.', 'avtar' => $storage_path, 'role' => $user->roles()->first()->role_name]);

    }




}
