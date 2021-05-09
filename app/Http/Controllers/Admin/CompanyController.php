<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Company;
use DataTables;
use App\Profile;
use App\Companyusers;
use App\SocialNetwork;
use App\RoleUser;
use App\Role;
use DB;



class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
/**************************************** Company Datatable ************************************* */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = "";
                  $redirct_url = url("admin/edit-comapny?id=".$row->id);
                  $btn = '<a href="'.$redirct_url.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                  <i class="icon-xl la la-edit"></i>
                  </a>';
                  $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deletcompany" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete">
                  <i class="icon-1x text-dark-50 flaticon-delete"></i>
                  </a>';
                return $btn;
               })
               ->addColumn('logo', function($row){
                $btn = "";
                if($row->logo == '/user/default.png'){
                    $storage_path = asset('media/users/blank.png');
                }else{
                    $storage_path = asset('storage/'.$row->logo);
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
                // $btn = '<div class="d-flex align-items-center">
                // <span class="symbol symbol-40 symbol-light-info mr-2"">
                //     <span class="symbol-label">
                //         <img src="'.$storage_path.'" class="h-100 align-self-end" alt="">
                //     </span>
                // </span>
                // </div>';
                return $btn;
             })
              ->addColumn('id', function($row){
                 return $row->id;
              })
              ->addColumn('name', function($row){
                  return $row->name;
              })
              ->addColumn('email', function($row){
                  return $row->email;
              })
              ->addColumn('created_at', function($row){
                  return $row->created_at;
              })
              ->rawColumns(['id','logo','name','email','created_at','action'])
              ->make(true);
            }
            $page_title = 'Company List';
            $page_description = "";
            return view('admin.company.companylist', compact('page_title', 'page_description'));
    }
/**************************************** Company Create ************************************* */
    public function create(Request $request)
    {
        $page_title = 'Add company';
        $page_description = '';
        return view('admin.company.create',compact('page_title', 'page_description'))   ;
    }
/**************************************** Company Store in DB ************************************* */
    public function store(Request $request)
    {
        $company = new Company;
        $company->name = $request['name'];
        $company->email = $request['email'];
        $company->address = $request['address'];
        $company->description = $request['description'];
        $company->website = $request['website'];
        $company->number = $request['phone'];
        $company->logo = $request['email'];
        $company->status = 1;
            if(!empty($request['avatar'])){
                $avatarExt = request()->avatar->getClientOriginalExtension();
                if($avatarExt == "jpg" || $avatarExt == "png" || $avatarExt == "jpeg"){
                }else{
                    return response()->json(['status' => 401, 'message' => 'The avatar must be a file of type: jpg, png, jpeg.']);
                }
            }
            if(!empty($request['avatar'])){
                //$avatarName = $user->id.'_avatar'.request()->avatar->getClientOriginalExtension();
                $avatarName = $company->id.'_logo'.time().'.'.request()->avatar->getClientOriginalExtension();
                $request->avatar->storeAs('company',$avatarName);
                $company->logo = '/company/'.$avatarName;
            } else { $avatarName = $company->logo; }
            $company->save();
            return response()->json([
                'status' => 200,
                'message' =>'Comapny has been successfully created.']);
    }
/**************************************** Company Delete ************************************* */
    public function destroy(Request $request)
    {
        $id = $request['id'];
	    $res = Company::find($id)->delete();
	    return response()->json(['success'=>'Company has been successfully delete.']);
    }
/**************************************** Company Edit ************************************* */
    public function edit(Request $request)
    {
        $companydata = Company::find($request->id);
        return view('admin.company.edit',compact('companydata'));
    }
/**************************************** Company Edit Store ************************************* */
    public function updatestore(Request $request)
    {
            $company_id = $request->edit_companyid;
            $company = new Company;
            $company = Company::find($company_id);
            $company->name = $request['name'];
            $company->email = $request['email'];
            $company->address = $request['address'];
            $company->description = $request['description'];
            $company->website = $request['website'];
            $company->phone = $request['phone'];
            $company->logo = $request['email'];
            $company->status = 1;
            if(!empty($request['avatar'])){
                $avatarExt = request()->avatar->getClientOriginalExtension();
                    if($avatarExt == "jpg" || $avatarExt == "png" || $avatarExt == "jpeg"){
                    }else{
                        return response()->json(['status' => 401, 'message' => 'The avatar must be a file of type: jpg, png, jpeg.']);
                    }
            }
            if(!empty($request['avatar'])){
                //$avatarName = $user->id.'_avatar'.request()->avatar->getClientOriginalExtension();
                $avatarName = $company->id.'_logo'.time().'.'.request()->avatar->getClientOriginalExtension();
                $request->avatar->storeAs('company',$avatarName);
                $company->logo = '/company/'.$avatarName;
            }else{
                $avatarName = $company->logo;
            }
            $company->save();
            return response()->json(['status' => '200', 'message' => 'Comapny has been updated successfully.']);
    }

    /**************************************** User Create ************************************* */
    public function createuser(Request $request)
    {
   	    $page_title = 'Add Company User';
        $page_description = '';
        return view('admin.company.companyuser', compact('page_title', 'page_description'));
    }
    /**************************************** User Create store ************************************* */
    public function storeuser(Request $request)
    {
        $role = 3;
        $is_exits = User::whereemail($request->email)->get()->count();
        if($is_exits == 0)
        {
            $user = new User;
            $user->name = $request['name'];
            $user->email = $request['email'];
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
            if(!empty($user_id)){
                $profile = new Profile;
                $profile->user_id = $user_id;
                if(!empty($request['avatar'])){
                    //$avatarName = $user->id.'_avatar'.request()->avatar->getClientOriginalExtension();
                    $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
                    $request->avatar->storeAs('avatars',$avatarName);
                    $profile->avatar = '/avatars/'.$avatarName;
                }
                else
                {
                    $avatarName = $user->avatar;
                }
                $profile->save();
            }
            $user->roles()->attach($role); //User role
            if(!empty($user_id)){
                $company = new Company;
                $company->user_id = $user_id;
                $company->name = $request['companyname'];
                $company->email = $request['companyemail'];
                $company->address = $request['address'];
                $company->website = $request['website'];
                $company->phone = $request['phone'];
                //$company->job_position = $request['jobposition'];
                $company->description = $request['description'];
                $company->facebook = $request['facebook'];
                $company->instagram = $request['instagram'];
                $company->linkedin = $request['linkedin'];
                $company->twitter = $request['twitter'];

                if(!empty($request['logo'])){
                    $avatarExt = request()->logo->getClientOriginalExtension();
                        if($avatarExt == "jpg" || $avatarExt == "png" || $avatarExt == "jpeg"){
                        }else{
                            return response()->json(['status' => 401, 'message' => 'The avatar must be a file of type: jpg, png, jpeg.']);
                        }
                }
                if(!empty($request['logo'])){
                    //$avatarName = $user->id.'_avatar'.request()->avatar->getClientOriginalExtension();
                    $avatarName = $company->id.'_logo'.time().'.'.request()->logo->getClientOriginalExtension();
                    $request->logo->storeAs('company',$avatarName);
                    $company->logo = '/company/'.$avatarName;
                }else{
                    $avatarName = $company->logo;
                }
                $company->save();
                $company_id = $company->id;
                $companyusers = new Companyusers;
                $companyusers->user_id = $user_id;
                $companyusers->company_id = $company_id;
                $companyusers->job_position = $request['jobPosition'];
                $companyusers->save();

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

}
