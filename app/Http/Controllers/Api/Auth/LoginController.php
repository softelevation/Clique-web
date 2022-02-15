<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Crypt;
use Carbon\Carbon;

use App\Traits\PaymentTrait;
use App\Traits\PushNotificationTrait;
use App\User;
use App\Profile;
use App\TempProfile;
use App\SocialNetwork;
use App\TempSocialNetwork;
use App\UserOtp;
use App\Company;
use App\Companyusers;
use App\Usercontact;
use App\Carditems;
use App\Countries;
use App\ProfileIcone;
use App\ProfileHospital;
use App\Orders;
use App\Icone;
use App\DataAnalyst;
use App\UserPaymentHistory;

use DB;


use App\Mail\OtpRequest;


class LoginController extends Controller
{
	use PaymentTrait, PushNotificationTrait;
    /************************************************************************************
     * Login API
    *************************************************************************************/
    public function login(Request $request)
        {
                $errors = "";
                $data = [];
                $message = "";
                $status = true;

                $validator = Validator::make($request->all(), [
                    'mobile' => ['required'],
                ]);
                if($validator->fails()){
                    $status = false;
                    $errorCode = $status ? 200 : 422;
                    $errors = "";
                    $result = [
                        "message" => "The mobile must be a number.",
                        "status" => false,
                        "otp" => 0,
                        "errors" => $errors
                    ];
                    return response()->json($result,$errorCode);

                }else{

                    $user = User::where('mobile','=',$request['mobile'])->first();
                    if($user)
                    {
                        $mob = explode('-',$request['mobile']);
                        $mobile = $mob[1];
                        $otp = rand(1000,9999);
                        $mobile1 = UserOtp::where('mobile', $mobile)->first();
                        if($mobile1){
                            UserOtp::where('mobile','=',$mobile)->update(['otp' => $otp]);
                        }
                        else{

                               $userotp = new UserOtp;
                                $userotp->mobile = $mobile;
                                $userotp->otp = $otp;
                                $userotp->save();
                        }

                        $status = true;
                        $errorCode = $status ? 200 : 422;
                        $errors = "";
                        $result = [
                            "message" => "Mobile added",
                            "status" => true,
                            "otp" => $otp,
                            "errors" => $errors
                        ];

                        return response()->json($result,$errorCode);
                    }
                    else{


                            $errorCode = $status ? 200 : 422;
                            $errors = "";
                            $result = [
                                "message" => "Mobile number not found",
                                "status" => false,
                                "otp" => 0,
                                "errors" => $errors
                            ];

                            return response()->json($result,$errorCode);
                    }
                }
        }

    public function loginotp(Request $request){
            $mob = explode('-',$request['mobile']);
            $mobile = $mob[1];
            $otp = $request['otp'];
            $current_lat = $request['current_lat'];
            $current_long = $request['current_long'];

                    $results = UserOtp::where('mobile','=',$mobile)->where('otp', '=', $otp)->first();
                    if($results){

                                $user = User::where('mobile','=',$request['mobile'])->first();
                                $result1 = $user->toArray();
                                $token = JWTAuth::fromUser($user);
                                $userid = $result1['id'];
                                $profile = new Profile;
                                $profile = Profile::whereuser_id($userid)->first();

                                    if(!is_null($profile)) {
                                        $profile->current_lat = $current_lat;
                                        $profile->current_long = $current_long;
                                        $profile->save();
                                        $result2 = Profile::whereuser_id($userid)->first()->toArray();
                                        $res = array_merge($result1, $result2);
                                        $result3 = SocialNetwork::whereuser_id($userid)->get()->toArray();
                                        $arr3 = array("social_data" => $result3);
                                        $res2 = array_merge($res, $arr3);
                                        //$result4 = Company::whereuser_id($userid)->get()->toArray();
                                        $company_data = Company::select('company.*','company_users.job_position');
                                        $company_data->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
                                        $company_data->where('company_users.user_id', $userid);
                                        $company_data = $company_data->orderBy('company.id', 'ASC')->get()->toArray();
                                        $arr4 = array("company_data" => $company_data);
                                        $res3 = array_merge($res2, $arr4);
                                        $message = "Login Successfull";
                                        $errors= "";
                                        $status = true;
                                        $data = [
                                            'access_token' => $token,
                                            'token_type' => 'bearer',
                                            'asset_url' => url()->to('/public/storage'),
                                            'user' => $res3,
                                        ];
                                        UserOtp::where('mobile','=',$mobile)->update(['otp' => null]);
                                        return $this->sendResult($message,$data,$errors,$status);
                                    }

                    }else{

                        $message = "Your otp are wrong";
                        $status = false;
                        $errors = true;
                        $data = (object)[];
                        return $this->sendResult($message,$data,$errors,$status);

                    }
        }

    protected function sendResult($message,$data,$errors = [],$status = true)
        {
            $errorCode = $status ? 200 : 422;
            $result = [
                "message" => $message,
                "status" => $status,
                "data" => $data,
                "errors" => $errors
            ];
            return response()->json($result,$errorCode);
        }
    /************************************************************************************
     * Ragister API
    *************************************************************************************/
    public function register(Request $request)
        {
            $mob = explode('-',$request['mobile']);
            $mobile = $mob[1];
            $validator = Validator::make($request->all(), [
              'mobile' => 'required|string|max:255',

            ]);
            if($validator->fails()){
                    return response()->json($validator->errors(), 400);
            }
            $user = User::where('mobile', $request['mobile'])->first();


            if(isset($user))
            {
                $status = false;
                $errorCode = $status ? 200 : 422;
                $errors = "";
                $result = [
                    "message" => "Mobile already registerd",
                    "status" => false,
                    "otp" => 0,
                    "errors" => $errors
                ];
                return response()->json($result,$errorCode);
            }
            else
            {
                $otp = rand(1000,9999);


                $mobile1 = UserOtp::where('mobile', $mobile)->first();
                if($mobile1){
                    //dd($mobile);
                    UserOtp::where('mobile','=',$mobile)->update(['otp' => $otp]);
                }
                else{

                        $userotp = new UserOtp;
                        $userotp->mobile = $mobile;
                        $userotp->otp = $otp;
                        $userotp->save();
                }
                //Log::info("otp = ".$otp);
                // send otp to mobile no using sms api
                $status = true;
                $errorCode = $status ? 200 : 422;
                $errors = "";
                $result = [
                    "message" => "Mobile added",
                    "status" => true,
                    "otp" => $otp,
                    "errors" => $errors
                ];

                return response()->json($result,$errorCode);
            }
    }

    public function newRegister(Request $request){
		$errors = "";
		$is_exits = User::whereemail($request->email)->get()->count();
		if($is_exits == 0)
        {
			$role = 4;
			$user = new User;
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
            $user->email_verified_at = Hash::make($request['password']);
            $user->status = 1;
            $user->save();
			$token = JWTAuth::fromUser($user);
            $user_id = $user->id;
			$user->roles()->attach($role); //User role
			if(!empty($user_id)){
                $profile = new Profile;
                $profile->user_id = $user_id;
                $profile->bio = ($request['bio']) ? $request['bio'] : '';
				if($request->gender){
					$profile->gender = $request->gender;
				}
				if($request->date_of_birth){
					$profile->date_of_birth = $request->date_of_birth;
				}
				if($request->current_lat){
					$profile->current_lat = $request->current_lat;
				}
				if($request->current_long){
					$profile->current_long = $request->current_long;
				}
                $profile->privacy = 0;
				if(!empty($request['avatar'])){
					$image = $request['avatar'];  // your base64 encoded
					$image = str_replace('data:image/png;base64,', '', $image);
					$image = str_replace(' ', '+', $image);
					$companylogo = '/user/'.$user_id.'_avatar'.time().'.'.'png';
					// Storage::disk('public')->put($companylogo, base64_decode($image));
					file_put_contents(public_path($companylogo), base64_decode($image));
				}else{
					$companylogo = '/user/default.png';
				}
				$profile->avatar = $companylogo;
                $profile->save();
				$res3 = array_merge($user->toArray(),$profile->toArray());
				$res3['custom_id'] = base64_encode($res3['user_id']);
                        if($request['typeuser'] == 4)
                        {
                                $res_company = Company::whereuser_id($request['companyid'])->first()->toArray();
                                $companyusers = new Companyusers;
                                $companyusers->user_id = $user_id;
                                $companyusers->company_id = $res_company['id'];
                                $companyusers->job_position = $request['jobposition'];
                                $companyusers->save();
								$res3 = array_merge($res3,$companyusers->toArray());
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
								$res3 = array_merge($res3,$company->toArray());
                        }
            }
			$data = [
                'access_token' => $token,
                'token_type' => 'bearer',
                'asset_url' => url()->to('/public/storage'),
                'user' => $res3
                ];
				
                return response()->json([
                    'status' => 200,
                    'message' =>'User has been successfully created.',
					'data' => $data]);
		}else{
            $message = "This is invalid email";
            $status = false;
            $data = (object)[];
            return $this->sendResult($message,$data,$errors,$status);
        }
		
	}
	
	
    public function ragisterwithotp(Request $request){
        //Log::info($request);
        $mob = explode('-',$request['mobile']);
        $mobile = $mob[1];
        $otp = $request['otp'];
        $name = $request['name'];
        $role = 2;
        $emailotp = rand(1000,9999);
        $newemail = 'test'.$emailotp.'@gmail.com';
        $pass = 'clique'.$emailotp;
        $errors = "";
        $data = [];
        $message = "";
        $results = UserOtp::where('mobile','=',$mobile)->where('otp', '=', $otp)->first();
        if($results){
            $user = User::where('mobile', $request['mobile'])->first();
            if(isset($user))
            {
                $status = false;
                $errorCode = $status ? 200 : 422;
                $errors = "";
                $result = [
                    "message" => "Mobile already registerd",
                    "status" => false,
                    "errors" => $errors
                ];
                return response()->json($result,$errorCode);
            }else{
                $user = new User;
                $user->name = $name;
                $user->email = $newemail;
                $user->password = Hash::make($pass);
                $user->mobile = $request['mobile'];
                $user->save();
                $result1 = $user->toArray();
                $user_id = $result1['id'];
                $user->roles()->attach($role); //User role
                if(!empty($user_id)){
                            $profile = new Profile;
                            $profile->user_id = $user_id;
                            $profile->current_lat = $request['current_lat'];
                            $profile->current_long = $request['current_long'];
                            $profile->created_at = date('Y-m-d H:i:s');
                            $profile->save();
                        $token = JWTAuth::fromUser($user);
                        $result2 = Profile::whereuser_id($user_id)->first()->toArray(); //Profile::find($user_id);
                        $res = array_merge($result1, $result2);
                        //$result3 = SocialNetwork::whereuser_id($user_id)->get()->toArray();
                        //$arr3 = array("social_data" => $result3);
                        //$res2 = array_merge($res, $arr3);
                        $message = "Register Successfull";
                        $status = true;
                        $data = [
                            'access_token' => $token,
                            'token_type' => 'bearer',
                            'asset_url' => url()->to('/public/storage'),
                            'user' => $res,
                        ];
                        UserOtp::where('mobile','=',$mobile)->update(['otp' => null]);
                        return $this->sendResult($message,$data,$errors,$status);

                    }
            }

        }
        else{

            $message = "Your otp are wrong";
            $status = false;
            $data = (object)[];
            return $this->sendResult($message,$data,$errors,$status);
        }
    }

    public function userprofileupdate(Request $request){
		$errors = "";
        $data = [];
        $message = "";
        $user_id = $request['user_id'];
		$user = User::find($user_id);
		$token = JWTAuth::fromUser($user);
		if($request->name){
			$user->name = $request->name;
            $user->save();
		}
		$profile = Profile::whereuser_id($user_id)->first();
		// if($request->bio){
		$profile->bio = $request->bio;
		// }
		// if($request->gender){
		$profile->gender = $request->gender;
		// }
		// if($request->date_of_birth){
		$profile->date_of_birth = $request->date_of_birth;
		// }
		if($request->avatar){
			// $profile->avatar = $request->avatar;
			$image = $request->avatar;
			$image = str_replace('data:image/png;base64,', '', $image);
			$image = str_replace(' ', '+', $image);
			$companylogo = '/user/'.$user_id.'_avatar'.time().'.'.'png';
			file_put_contents(public_path($companylogo), base64_decode($image));
			$profile->avatar = $companylogo;
		}
		$profile->save();
		$res3 = array_merge($user->toArray(), $profile->toArray());
		$message = "Profile update successfully";
        $status = true;
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'asset_url' => url()->to('/public/storage'),
            'user' => $res3,
        ];
        return $this->sendResult($message,$data,$errors,$status);
	}
	
	
    public function profileupdate(Request $request){
        $errors = "";
        $data = [];
        $message = "";
        $user_id = $request['user_id'];
            
        if(!empty($user_id)){

            /*
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255|unique:users',
            ]);
            
            if($validator->fails()){
                $message = "The email has already been taken.";
                $status = false;
                $data = (object)[];
                $errors = "";
                return $this->sendResult($message,$data,$errors,$status);
            }else{
                $user = User::where('id', $user_id)->update([
                    'email' => $request['email'],
                ]);
            }*/
            
            $user = User::where('id', $user_id)->update([
                'mobile' => ($request->filled('mobile')) ? $request->mobile : '',
            ]);
            
            

            //Profile Code Start
            $profile = new Profile;
            $profile = Profile::whereuser_id($user_id)->first();
            
            //Delete Data In Temp Profile Start
            $TempProfileDelete = TempProfile::where('user_id', $user_id)->delete();
            $TempSocialNetworkDelete = TempSocialNetwork::where('user_id', $user_id)->delete();
            //dd($TempProfileDelete);
            //Delete Data In Temp Profile End
            
            if(!empty($request['avatar'])){
                $image = $request['avatar'];  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $image_name = '/avatars/'.$user_id.'_avatar'.time().'.'.'png';
                Storage::disk('public')->put($image_name, base64_decode($image));
            }else{
                $image_name = '/user/default.png';
            }
            
            $tempprofiledata = TempProfile::whereuser_id($user_id)->first();
            
            //Temp Profile Code Start
            if($tempprofiledata == ''){
                
                //Insert TempProfile Start
                $tempprofile = new TempProfile;
                //$image_name = '/user/default.png';
                $tempprofile->user_id = $user_id;
                $tempprofile->bio = $request['bio'];
                $tempprofile->privacy = ($request['privacy'] == null) ? 0 : $request['privacy'];
                $tempprofile->avatar = $image_name;
                $tempprofile->current_lat = $request['current_lat'];
                $tempprofile->current_long = $request['current_long'];
                $tempprofile->created_at = date('Y-m-d H:i:s');
                $tempprofile->save();
                //Insert TempProfile End
                
                //Insert TempSocialNetwork Start
                $socialdata = json_decode($request['socialdata'], true);
                $user_id_val = $request['user_id'];
                // foreach ($socialdata as $keys => $values) {
                    // $keytexts = $keys;
                    // foreach ($values as $keys => $value1s) {
                        // if($value1s['id'] == "" ||  empty($value1s['id'])){
                            // $tempsocialnetwork_new = new TempSocialNetwork;
                            // $tempsocialnetwork_new->user_id = $user_id_val;
                            // $tempsocialnetwork_new->media_type = $keytexts;
                            // $tempsocialnetwork_new->media_value = $value1s['mediaValue'];
                            // $tempsocialnetwork_new->status = 0;
                            // $tempsocialnetwork_new->save();
                        // }else{
                            // $tempsocialnetwork_update = TempSocialNetwork::select("*")
                            // ->where('user_id', $user_id_val)
                            // ->Where('id', $value1s['id'])
                            // ->first();
                            
                            // if($tempsocialnetwork_update == null){
                            
                            // }else{
                                // $tempsocialnetwork_update->media_value = $value1s['mediaValue'];
                                // $tempsocialnetwork_update->status = 0;
                                // $tempsocialnetwork_update->save();
                            // }
                        // }
                    // }
                // }
                //Insert TempSocialNetwork End
            }
            //Temp Profile Code End
            
            
            
            $profile->bio = $request['bio'];
            $profile->privacy = ($request['privacy'] == null) ? 0 : $request['privacy'];
			$profile->date_of_birth = $request->date_of_birth;
			$profile->gender = $request->gender;
            $profile->avatar = $image_name;
            $profile->current_lat = $request['current_lat'];
            $profile->current_long = $request['current_long'];
            $profile->created_at = date('Y-m-d H:i:s');
            $profile->save();

            $data = json_decode($request['socialdata'], true);
            $user_id_new = $request['user_id'];
            // foreach ($data as $key => $value) {
                // $keytext = $key;
                // foreach ($value as $key => $value1) {
                    // if($value1['id'] == "" ||  empty($value1['id'])){
                        // $socialnetwork_new = new SocialNetwork;
                        // $socialnetwork_new->user_id = $user_id_new;
                        // $socialnetwork_new->media_type = $keytext;
                        // $socialnetwork_new->media_value = $value1['mediaValue'];
                        // $socialnetwork_new->status = $value1['status'];
                        // $socialnetwork_new->save();
                    // }else{
                        // $socialnetwork_update = SocialNetwork::select("*")
                        // ->where('user_id', $user_id_new)
                        // ->Where('id', $value1['id'])
                        // ->first();
                        
                        // if($socialnetwork_update == null){
                            
                        // }else{
                            // $socialnetwork_update->media_value = $value1['mediaValue'];
                            // $socialnetwork_update->status = $value1['status'];
                            // $socialnetwork_update->save();
                        // }
                    // }
                // }
            // }
            
            //Profile Code End
            
            
        }

        $user1 = User::where('id','=',$user_id)->first();
        $token = JWTAuth::fromUser($user1);
        $result1 = $user1->toArray();

        $result2 = Profile::whereuser_id($user_id)->first()->toArray(); //Profile::find($user_id);
        $res = array_merge($result1, $result2);
        $result3 = SocialNetwork::whereuser_id($user_id)->get()->toArray();
        $arr3 = array("social_data" => $result3);
        $res2 = array_merge($res, $arr3);
        //$result4 = Company::whereuser_id($user_id)->get()->toArray();
        $company_data = Company::select('company.*','company_users.job_position');
        $company_data->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
        $company_data->where('company_users.user_id', $user_id);
        $company_data = $company_data->orderBy('company.id', 'ASC')->get()->toArray();
        $arr4 = array("company_data" => $company_data);
        $res3 = array_merge($res2, $arr4);
        $message = "Profile create Successfully";
        $status = true;
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'asset_url' => url()->to('/public/storage'),
            'user' => $res3,
        ];
        return $this->sendResult($message,$data,$errors,$status);
    }
    /************************************************************************************
     * Email check Dublicate API
    *************************************************************************************/

    public function emailcheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        $message = "";
        if($validator->fails()){
            $status = false;
            return response()->json(['status' => $status, 'message' => 'The email has already been taken.']);
        }
        else
        {
            $status = true;
            return response()->json(['status' => $status, 'message' => 'The email has not already been taken.']);
        }

    }


    /************************************************************************************
     * Login Profile Update
    *************************************************************************************/
    public function loginprofileupdate(Request $request){
        $errors = "";
        $data = [];
        $message = "";
        $user_id = $request['user_id'];
    if(!empty($user_id)){
        $profile = new Profile;
        $profile = Profile::whereuser_id($user_id)->first();
        if(!empty($request['avatar'])){
            $image = $request['avatar'];  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $image_name = '/avatars/'.$user_id.'_avatar'.time().'.'.'png';
            Storage::disk('public')->put($image_name, base64_decode($image));
        }
        else
        {
             $image_name = $profile->avatar;
        }
        $profile->bio = $request['bio'];
		$profile->privacy = ($request['privacy'] == null) ? 0 : $request['privacy'];
        $profile->avatar = $image_name;
        $profile->current_lat = $request['current_lat'];
        $profile->current_long = $request['current_long'];
        $profile->resume_file_status = $request['resume_file_status'];
        $profile->resume_link = $request['resume_link'];
        $profile->resume_link_status = $request['resume_link_status'];
        $profile->created_at = date('Y-m-d H:i:s');
                if(!empty($request['resume_file'])){
                $avatarExt = request()->resume_file->getClientOriginalExtension();
                // if($avatarExt == "txt" || $avatarExt == "pdf" || $avatarExt == "doc" || $avatarExt == "docx" ||  $avatarExt == xlsx){

        //                 }else{
        //                     return response()->json(['status' => 401, 'message' => 'The file must be a file of type: txt, pdf, doc.']);
        //                 }
                }
                if(!empty($request['resume_file'])){
                    $avatarName = 'resume'.time().'.'.request()->resume_file->getClientOriginalExtension();
                    $request->resume_file->storeAs('resume',$avatarName);
                    $profile->resume_file = '/resume/'.$avatarName;
                }else{
                  $avatarName = $profile->resume_file;
                }



                //$company->save();
                $profile->save();
        
            //Profile Code Start
            //Delete Data In Temp Profile Start
            $TempProfileDelete = TempProfile::where('user_id', $user_id)->delete();
            $TempSocialNetworkDelete = TempSocialNetwork::where('user_id', $user_id)->delete();
            //dd($TempProfileDelete);
            //Delete Data In Temp Profile End
            
            $tempprofiledata = TempProfile::whereuser_id($user_id)->first();
            
            //Temp Profile Code Start
            //if($tempprofiledata == ''){
                
                //Insert TempProfile Start
                $tempprofile = new TempProfile;
                //$image_name = $avatarName;
                $tempprofile->user_id = $user_id;
                $tempprofile->bio = $request['bio'];
                $tempprofile->privacy = ($request['privacy'] == null) ? 0 : $request['privacy'];
                $tempprofile->avatar = $image_name;
                $tempprofile->current_lat = $request['current_lat'];
                $tempprofile->current_long = $request['current_long'];
                $tempprofile->created_at = date('Y-m-d H:i:s');
                $tempprofile->save();
                //Insert TempProfile End
                
                //Insert TempSocialNetwork Start
                $socialdata = json_decode($request['socialdata'], true);
                $user_id_val = $request['user_id'];
                foreach ($socialdata as $keys => $values) {
                    $keytexts = $keys;
                    foreach ($values as $keys => $value1s) {
                        
                        $tempsocialnetwork_new = new TempSocialNetwork;
                        $tempsocialnetwork_new->user_id = $user_id_val;
                        $tempsocialnetwork_new->media_type = $keytexts;
                        $tempsocialnetwork_new->media_value = $value1s['mediaValue'];
                        $tempsocialnetwork_new->status = $value1s['status'];
                        $tempsocialnetwork_new->save();
                    }
                }
                //Insert TempSocialNetwork End
            //}
            //Temp Profile Code End

        $data = json_decode($request['socialdata'], true);
                $user_id_new = $request['user_id'];
                foreach ($data as $key => $value) {

                            $keytext = $key;
                            foreach ($value as $key => $value1) {
                                if($value1['id'] == "" ||  empty($value1['id'])){
                                    $socialnetwork_new = new SocialNetwork;
                                    $socialnetwork_new->user_id = $user_id_new;
                                    $socialnetwork_new->media_type = $keytext;
                                    $socialnetwork_new->media_value = $value1['mediaValue'];
                                    $socialnetwork_new->status = $value1['status'];
                                    $socialnetwork_new->save();
                                }else{
                                    $socialnetwork_update = SocialNetwork::select("*")
                                    ->where('user_id', $user_id_new)
                                    ->Where('id', $value1['id'])
                                    ->first();
                                    $socialnetwork_update->media_value = $value1['mediaValue'];
                                    $socialnetwork_update->status = $value1['status'];
                                    $socialnetwork_update->save();
                                }
                            }

                }

    }

        $user1 = User::where('id','=',$user_id)->first();
        $token = JWTAuth::fromUser($user1);
        $result1 = $user1->toArray();
        $result2 = Profile::whereuser_id($user_id)->first()->toArray(); //Profile::find($user_id);
        $res = array_merge($result1, $result2);
        $result3 = SocialNetwork::whereuser_id($user_id)->get()->toArray();
        $arr3 = array("social_data" => $result3);
        $res2 = array_merge($res, $arr3);
        //$result4 = Company::whereuser_id($user_id)->get()->toArray();
        $company_data = Company::select('company.*','company_users.job_position');
        $company_data->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
        $company_data->where('company_users.user_id', $user_id);
        $company_data = $company_data->orderBy('company.id', 'ASC')->get()->toArray();
        $arr4 = array("company_data" => $company_data);
        $res3 = array_merge($res2, $arr4);
        $message = "Profile update Successfully";
        $status = true;
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'asset_url' => url()->to('/public/storage'),
            'user' => $res3,
        ];

    return $this->sendResult($message,$data,$errors,$status);

    }
    /************************************************************************************
     * Near by user API
    *************************************************************************************/
    public function nearbyusers(Request $request)
    {
         $lat = $request['lat'];  //23.010228;
         $long = $request['long']; //72.587105;
         $userId =  $request['user_id'];
         $km=1000;
         $errors = "";
         $status = true;
         $message = "";
		 if($request->action && $request->action == 'map'){
			 $getUsers = Profile::where('current_lat','!=','')->get();
		 }else{
			 $getUsers = Profile::where('current_lat','!=','')->select(DB::raw("*, 111.111 *
						DEGREES(ACOS(LEAST(1.0, COS(RADIANS(".$lat."))
						* COS(RADIANS(current_lat))
						* COS(RADIANS(".$long." - current_long))
						+ SIN(RADIANS(".$lat."))
						* SIN(RADIANS(current_lat))))) AS distance_in_km"))->having('distance_in_km', '<', $km)->get();
			if(!$getUsers->toArray()){
				$getUsers = Profile::where('current_lat','!=','')->get();
			}
		 }
         $data = array();
         if(!empty($getUsers) || isset($getUsers))
         {
            foreach ($getUsers as $key => $value) {
                $user_data = User::find($value->user_id);
                if($value->privacy == 0 && $value->user_id != $userId){
                    $data[] =[
                        'user_id' => $user_data->id,
                        'name' => $user_data->name,
                        'avatar' => $value->avatar,
						'current_lat' => $value->current_lat,
						'current_long' => $value->current_long
                    ];
                }
            }
         }
         else{
            $data = (object)[];
         }

            $message = "Near by user Successfully";
            $status = true;
            return $this->sendResult($message,$data,$errors,$status);
        //dd($getUsers)->toArray();
        // $udata = Profile::select(DB::raw('*, ( 6367 * acos( cos( radians(23.010228) ) * cos( radians( current_lat ) ) * cos( radians( current_long ) - radians(72.587105) ) + sin( radians(23.010228) ) * sin( radians( current_lat ) ) ) ) AS distance'))
        // ->having('distance', '<', 5)
        // ->orderBy('distance')
        // ->get();
        // dd($udata);
    }

	
	 /************************************************************************************
     * Near by user API Details
    *************************************************************************************/
	
	public function addMemberUplodFile(Request $request){
		$errors= "";
		$data = (object)[];
		if ($request->hasFile('image')) {
			// DB::table('api_response_test')->insert(array('get_values'=>"1"));
			$file = $request->file('image');
			// $file = $files[0];
			$avatarName = 'member'.time().'.'.$file->getClientOriginalExtension();
			$file->move('member/', $avatarName);
			$data = array('uplod_file'=>'/member/'.$avatarName);
		}
		return response()->json($data);
	}
	
	public function deleteMember(Request $request){
		$errors= "";
		$data = (object)[];
		$user = JWTAuth::toUser();
		// $inputData = $request->all();
		if($request->action && $request->action == 'default'){
			// $myProfileHospital = ProfileHospital::where('id',$request->id)->first();
			// if($myProfileHospital->by_default == 1){
				// $by_default = array('by_default'=>0);
				// $message = "Member set as default";
			// }else{
				// $by_default = array('by_default'=>1);
				ProfileHospital::where('profile_id',$user->profile->id)->update(array('by_default'=>0));
				$message = "Member set as default";
			// }
			ProfileHospital::where('id',$request->id)->update(array('by_default'=>1));
		}else{
			ProfileHospital::where('id',$request->id)->delete();
			$message = "Member flag delete successfully";
		}
		$status = true;
		return $this->sendResult($message,$data,$errors,$status);
	}
	
	
	public function updateMember($id, Request $request){
		$errors= "";
		$data = (object)[];
		$user = JWTAuth::toUser();
		$profile_id = $user->profile->id;
		$inputData = $request->all();
		if($request->uplod_file){
				$my_uplod_file = $request->uplod_file;
				$inputData['uplod_file'] = implode(",",$my_uplod_file);
			}
		if($request->photo && strlen($request->photo) > 80 && !empty($request->photo)){
			$image = $request->photo;  // your base64 encoded
			// $image = substr($image, strpos($image, ',') + 1);
			$image = str_replace('data:image/png;base64,', '', $image);
			$image = str_replace(' ', '+', $image);
			$image_name = 'member_photo/member_'.$profile_id.time().'.'.'png';
			file_put_contents(public_path($image_name), base64_decode($image));
			$inputData['photo'] = $image_name;
		}
		ProfileHospital::where('id',$id)->update($inputData);
		$message = "Member flag update successfully";
		$status = true;
		return $this->sendResult($message,$data,$errors,$status);
	}
	
	public function addMember(Request $request){
			$errors= "";
			$data = (object)[];
			$user = JWTAuth::toUser();
			$inputData = $request->all();
			$inputData['profile_id'] = $user->profile->id;
			if($request->uplod_file){
				$my_uplod_file = $request->uplod_file;
				$inputData['uplod_file'] = implode(",",$my_uplod_file);
			}
			if(!empty($request['photo'])){
                    $image = $request['photo'];  // your base64 encoded
					// $image = substr($image, strpos($image, ',') + 1);
					$image = str_replace('data:image/png;base64,', '', $image);
					$image = str_replace(' ', '+', $image);
                    $image_name = 'member_photo/member_'.$inputData['profile_id'].time().'.'.'png';
					file_put_contents(public_path($image_name), base64_decode($image));
					$inputData['photo'] = $image_name;
                }
			$checkHospital = ProfileHospital::where('profile_id',$inputData['profile_id'])->first();
			if(!$checkHospital){
				$inputData['by_default'] = 1;
			}
			$insertData = ProfileHospital::insertGetId($inputData);
			$data = $inputData;
			$data['id'] = $insertData;
            $message = "Member flag add successfully";
			$status = true;
			return $this->sendResult($message,$data,$errors,$status);
	}
	
    /************************************************************************************
     * Near by user accountFlag
    *************************************************************************************/
	
	public function accountFlag(Request $request){
		// print_r($request->all());
			$errors= "";
			$data = (object)[];
			$user = JWTAuth::toUser();
			Profile::where('id',$user->profile->id)->update(array('account_flag'=>$request->flag));
            $message = "Your profile is set to ".$request->flag;
			$status = true;
			return $this->sendResult($message,$data,$errors,$status);
	}
	
    public function usersdetails(Request $request)
    {
        $errors = "";
        $status = true;
        $message = "";
        $is_contact = "";
        $user_id =  $request['user_id'];
        $user_contact = new Usercontact;
        if(!empty($request['login_id'])){
            $contact_res = Usercontact::select("*")
                    ->where('user_id', $request['login_id'])
                    ->where('contact_id', $user_id)
                    ->get();
                if($contact_res->count() > 0){
                    $is_contact = 1;
                }else { $is_contact = 0; }
        }


        $result1 = User::select("*")->where('id', $user_id)->first()->toArray();
        $result2 = Profile::whereuser_id($user_id)->first()->toArray(); //Profile::find($user_id);
		DataAnalyst::insert(array('profile_id'=>$result2['id'],'type'=>'is_view','save_date'=>Carbon::today()->format('Y-m-d'),'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()));
		DataAnalyst::insert(array('profile_id'=>$result2['id'],'type'=>'is_click','save_date'=>Carbon::today()->format('Y-m-d'),'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()));
        $res = array_merge($result1, $result2);
        
        if($result1['is_temp'] == 1){
            $result3 = TempSocialNetwork::whereuser_id($user_id)->where('status', 1)->get()->toArray();
        }else{
            $result3 = SocialNetwork::whereuser_id($user_id)->where('status', 1)->get()->toArray();
        }
        
        
        $arr3 = array("social_data" => $result3);
        $res2 = array_merge($res, $arr3);
        $company_data = Company::select('company.*','company_users.job_position');
        $company_data->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
        $company_data->where('company_users.user_id', $user_id);
        $company_data = $company_data->orderBy('company.id', 'ASC')->get()->toArray();
        $arr4 = array("company_data" => $company_data);
        $res3 = array_merge($res2, $arr4);
		$profile_icones = ProfileIcone::with('icone')->where('profile_id',$result2['id'])->get();
		$social_profile_icones = array();
		$business_profile_icones = array();
		foreach($profile_icones as $profile_icone){
			if($profile_icone->type == 'social'){
				$social_profile_icones[] = $profile_icone;
			}else{
				$business_profile_icones[] = $profile_icone;
			}
		}
		
		$my_connection_type = ($result2['privacy']) ? $result2['privacy']:'public';
		$my_connection_status = 'request';
		$jwt_user_id = JWTAuth::toUser()->id;
		$my_connection_contact = Usercontact::select('*')->where('user_id',$jwt_user_id)->where('contact_id',$user_id)->first();
		if($my_connection_contact){
			$my_connection_status = $my_connection_contact->status;
		}
		
		$res3['my_connection'] = array('type'=>$my_connection_type,'status'=>$my_connection_status);
		$res3['social'] = $social_profile_icones;
		$res3['business'] = $business_profile_icones;
		// print_r($res3['social']);
		// die;
        $message = "Profile detail Successfully";
        $status = true;
            $data = [
                'asset_url' => url()->to('/public/storage'),
                'user' => $res3,
                'is_contact' => $is_contact,
            ];

        return $this->sendResult($message,$data,$errors,$status);

    }
	
	
	/************************************************************************************
     * data analyst
    *************************************************************************************/
    public function dataAnalyst(Request $request){
		$errors = "";
		$message = "";
		$status = true;
		// $user_id = JWTAuth::toUser()->id;
		$profile_id = JWTAuth::toUser()->profile->id;
		// $user1 = User::find($user_id);
		// $token = JWTAuth::fromUser($user1);
		
		$db_query = "SELECT (SELECT COUNT(`id`) FROM `data_analysts` WHERE `profile_id` = ".$profile_id." AND `type` = 'is_view') AS 'is_view', (SELECT COUNT(`id`) FROM `data_analysts` WHERE `profile_id` = ".$profile_id." AND `type` = 'is_click') AS 'is_click', (SELECT COUNT(`id`) FROM `data_analysts` WHERE `profile_id` = ".$profile_id." AND `type` = 'is_share') AS 'is_share' FROM `data_analysts` GROUP BY `type` LIMIT 1";
		$dataAnalyst = DB::select($db_query);
        $data = array(
					"is_view"=>$dataAnalyst ? $dataAnalyst[0]->is_view : 0,
					"is_click"=>$dataAnalyst ? $dataAnalyst[0]->is_click : 0,
					"is_share"=>$dataAnalyst ? $dataAnalyst[0]->is_share : 0,
					"new_connections"=>2,
					"already_connections"=>2,
					"total_connections"=>2
			);
		$date_array = array();
		$date_count = array();
		$i = 0;
		while ($i < 7) {
			$today = Carbon::today();
			$for_while_date = $today->subDays($i)->format('Y-m-d');
			array_push( $date_array, array(
						'for_date'=>$for_while_date,
						'for_day'=>strtolower(date('D',strtotime($for_while_date)))
					));
			$i++;
		}
		if(! empty( $date_array ) ){
			foreach($date_array as $date){
				$for_day = $date['for_day'];
				$date_count[$for_day][] = DataAnalyst::where('profile_id',$profile_id)->where('save_date',$date['for_date'])->count();
			}
		}
		$data['Analyst'] = array('labels'=>['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],'datasets'=>array(array('data'=>[$date_count['mon'][0], $date_count['tue'][0], $date_count['wed'][0], $date_count['thu'][0], $date_count['fri'][0], $date_count['sat'][0], $date_count['sun'][0]])));
		return $this->sendResult($message,$data,$errors,$status);
	}
	
	
	
   /************************************************************************************
     * Add company
    *************************************************************************************/
    public function companyadd(Request $request)
    {

        $errors = "";
        $data = [];
        $message = "";
        $user_id = $request['user_id'];
        if(!empty($user_id)){

          if(!empty($request['company_id']))
          {
                 $company = Company::select("*")
                                    ->where('id', $request['company_id'])
                                    ->Where('user_id', $user_id)
                                    ->first();
          }
          else{
                $company = new Company;
          }


            $company->user_id = $user_id;
            $company->name = $request['name'];
            $company->email = $request['email'];
            $company->address = $request['address'];
            $company->website = $request['website'];
            $company->number = $request['number'];
            $company->facebook = $request['facebook'];
            $company->instagram = $request['instagram'];
            $company->linkedin = $request['linkedin'];
            $company->twitter = $request['twitter'];
            $company->status = 1;
                if(!empty($request['logo'])){
                    $image = $request['logo'];  // your base64 encoded
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $image_name = '/company/'.$user_id.'_logo'.time().'.'.'png';
                    Storage::disk('public')->put($image_name, base64_decode($image));
                }
                else
                {
                    if(!empty($request['company_id'])){
                         $image_name = $company->logo;
                    }else {  $image_name = '/user/default.png'; }

                }
                $company->logo = $image_name;
                $company->save();
                $company_id = $company->id;



                if(!empty($request['company_id']))
                {
                    $companyusers = Companyusers::select("*")
                                    ->where('company_id', $request['company_id'])
                                    ->Where('user_id', $user_id)
                                    ->first();
                }
                else {
                    $companyusers = new Companyusers;
                 }
                    $companyusers->user_id = $user_id;
                    $companyusers->company_id = $company_id;
                    $companyusers->job_position = $request['jobPosition'];
                    $companyusers->save();





                //$result1 = Company::whereuser_id($user_id)->get()->toArray();
                $result1 = Company::select('company.*','company_users.job_position');
                $result1->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
                $result1->where('company_users.user_id', $user_id);
                $result1 = $result1->orderBy('company.id', 'ASC')->get()->toArray();

                $message = "Company added Successfully";
                $errors= "";
                $status = true;
                $data = [

                    'user_id' => $user_id,
                    'asset_url' => url()->to('/public/storage'),
                    'company' => $result1,
                ];
                return $this->sendResult($message,$data,$errors,$status);

        }

    }
    /************************************************************************************
     * Add contact
    *************************************************************************************/
    public function addcontact(Request $request)
    {
		$errors= "";
		$data = (object)[];
        if(!empty($request['contact_id']))
        {
			$user = JWTAuth::toUser();
			$checkUsercontact = Usercontact::where('user_id',$user->id)->where('contact_id',$request['contact_id'])->first();
			$profile = Profile::whereuser_id($request['contact_id'])->first();
            if(!$checkUsercontact){
			$data = $this->send_PushNotificat($profile->device_token,'Request for connection','You have received a new connection request.');
			$user_contact = new Usercontact;
            $user_contact->user_id = $user->id;
            $user_contact->contact_id = $request['contact_id'];
            $user_contact->status = 'pending';
            $user_contact->save();
            $message = "Contact added Successfully";
                
                $status = true;
                
                return $this->sendResult($message,$data,$errors,$status);
			}else{
				$message = "This contact is aleardy added";
				$status = false;
				return $this->sendResult($message,$data,$errors,$status);
			}
        }
    }
    /************************************************************************************
     * Add contact
    *************************************************************************************/
    public function addcontactlist(Request $request)
    {
			$user = JWTAuth::toUser();
			$private = User::select('*')->join('users_profile','users_profile.user_id','users.id')->where('users_profile.privacy','private')->first();
			$result1_default = array(array('id'=>$private->user_id,'name'=>$private->name,'user_id'=>$user->id,'uid'=>0,'contact_id'=>$private->user_id,'status'=>'approve','created_at'=>$private->created_at,'updated_at'=>$private->updated_at,'deleted_at'=>'','avatar'=>$private->avatar,'bio'=>$private->bio));
            
			$result1 = Usercontact::select('users.id','users.name','user_contact.id as uid','user_contact.*','users_profile.avatar','users_profile.bio')
					   ->leftJoin('users', 'users.id', '=', 'user_contact.contact_id')
					   ->leftJoin('users_profile', 'users_profile.user_id', '=', 'user_contact.contact_id')
					   ->where('user_contact.user_id', $user->id)->where('users.id','!=',null);
			$my_connection = $result1->orderBy('user_contact.id', 'DESC')->get()->toArray();

            $message = "Contact List Successfully";
            $errors= "";
            $status = true;
            $data = array_merge($result1_default,$my_connection);
            return $this->sendResult($message,$data,$errors,$status);
    }
	
	/************************************************************************************
     * Add contact
    *************************************************************************************/
    public function mycontactlist(Request $request)
    {
			$user = JWTAuth::toUser();
			// $private = User::select('*')->join('users_profile','users_profile.user_id','users.id')->where('users_profile.privacy','private')->first();
			// $result1_default = array(array('id'=>$private->user_id,'name'=>$private->name,'user_id'=>$user->id,'contact_id'=>$private->user_id,'status'=>'approve','created_at'=>$private->created_at,'updated_at'=>$private->updated_at,'deleted_at'=>'','avatar'=>$private->avatar,'bio'=>$private->bio));
            
			$result1 = Usercontact::select('users.id','users.name','user_contact.id as uid','user_contact.*','users_profile.avatar','users_profile.bio')
					   ->leftJoin('users', 'users.id', '=', 'user_contact.user_id')
					   ->leftJoin('users_profile', 'users_profile.user_id', '=', 'user_contact.user_id')
					   ->where('user_contact.contact_id', $user->id)->where('user_contact.status', 'pending')->where('users.id','!=',null);
			$my_connection = $result1->orderBy('user_contact.id', 'DESC')->get()->toArray();

            $message = "Contact List Successfully";
            $errors= "";
            $status = true;
            $data = $my_connection;
            return $this->sendResult($message,$data,$errors,$status);
    }
     /************************************************************************************
     * Remove contact
    *************************************************************************************/
    public function removecontact(Request $request)
    {
		$errors= "";
		$status = true;
		$data = (object)[];
        if($request['uid'])
        {
			$user = JWTAuth::toUser();
			$checkUcontact = Usercontact::where('id',$request->uid)->first();
			$profile = Profile::whereuser_id($checkUcontact->user_id)->first();
			if($request->action && $request->action == 'approve'){
				$data = $this->send_PushNotificat($profile->device_token,'Request connection','Your request has been accepted.');
				Usercontact::insert(array('user_id'=>$checkUcontact->contact_id,'contact_id'=>$checkUcontact->user_id,'status'=>'approve','created_at'=>$checkUcontact->created_at,'updated_at'=>$checkUcontact->updated_at));
				Usercontact::where('id',$request->uid)->update(array('status'=>'approve'));
				$message = "Contact approved Successfully";
			}else{
				Usercontact::where('user_id',$checkUcontact->contact_id)->where('contact_id',$checkUcontact->user_id)->delete();
				$res=Usercontact::where('id',$request->uid)->delete();
				$message = "Contact Remove Successfully";
			}
            return $this->sendResult($message,$data,$errors,$status);

        }
    }
	
	 /************************************************************************************
     * validatecard card check
    *************************************************************************************/
    public function validatecard(Request $request)
    {
				$errors = "";
                $data = [];
                $message = "";
                $status = true;
				
				// if(!$request->tag_id){
                $validator = Validator::make($request->all(), [
                    'card_id' => 'required',
                ]);
                if(!$request->tag_id && $validator->fails()){
                    $status = false;
                    $errorCode = $status ? 200 : 422;
                    $errors = "";
                    $result = [
                        "message" => "The card_id is required.",
                        "status" => false,
                        "errors" => $errors
                    ];
                    return response()->json($result,$errorCode);

                }else{
					if($request->tag_id){
						$request['card_id'] = $request->tag_id;
					}
					$carddata = Carditems::select("*")
                                    ->where('card_id', $request['card_id'])
                                    ->first();
					if($carddata){
						if($carddata->assign_user_id){
							$errors= "";
							$status=false;
							$message = "Card id is already use";
							$data = (object)[];
							return $this->sendResult($message,$data,$errors,$status);
						}else{
							$errors= "";
							$status = true;// if($carddata['order_id'] == NULL){
							$message = "This card is valid";
							$data = (object)[];
							return $this->sendResult($message,$data,$errors,$status);
						}
					}else{
							$errors= "";
							$status=false;
							$message = "Card id not registered";
							$data = (object)[];
							return $this->sendResult($message,$data,$errors,$status);
					}
                }
	}
	
	
     /************************************************************************************
     * Write in card check
    *************************************************************************************/
    public function writecard(Request $request)
    {
        if(!empty($request['card_id']) and !empty($request['user_id']))
        {

            $carddata = Carditems::select("*")
                                    ->where('card_id', $request['card_id'])
                                    ->first();

            if($carddata){
                    //if($carddata['assign_user_id'] == 0 && $carddata['assign_user_id'] == "" && $carddata['order_id'] != null)
                    if($carddata['assign_user_id'] == 0 && $carddata['assign_user_id'] == "")
                    {
                        // $carddatanew = Carditems::select("*")
                                    // ->where('assign_user_id', $request['user_id'])
                                    // ->get();
                        // $wordCount = $carddatanew->count();
                        // if($wordCount > 0){
                            // $errors= "";
                            // $status = false;
                            // $message = "This user already assigned another card Id";

                        // }
                        // else{
                            $current_date = date('Y-m-d H:i:s');
                            $carddata->assign_user_id = $request['user_id'];
                            $carddata->user_id = $request['user_id'];
                            $carddata->is_sell = 1;
                            $carddata->sell_date = $current_date;
							$carddata->active_date = Carbon::now();
                            $carddata->save();
                            $errors= "";
                            $status = true;
                            $message = "Card Assign to User";
                        // }

                    }elseif($carddata['assign_user_id'] == $request['user_id']){

                        $errors= "";
                        $status = true;
                        $message = "Card Assign to User";
                    }
                    else{
                        $errors= "";
                        $status = false;
                        if($carddata['order_id'] == NULL){
                            $message = "This card is not registered";
                        }else{
                            $message = "Card already assigned to other user";
                        }

                    }
                    $data = (object)[];
                    return $this->sendResult($message,$data,$errors,$status);
            }else{
                    $errors= "";
                    $status=false;
                    $message = "Card id not registered";
                    $data = (object)[];
                    return $this->sendResult($message,$data,$errors,$status);
            }
        }
        else{

                    $errors= "";
                    $status=false;
                    $message = "card id OR Used Id might be NULL";
                    $data = (object)[];
                    return $this->sendResult($message,$data,$errors,$status);



        }

    }

    /************************************************************************************
     * Remove social data
    *************************************************************************************/
    public function socialdelete(Request $request)
    {
        // $socialId = $request['social_id'];
        // $user_id = $request['user_id'];
        // SocialNetwork::find($socialId)->delete();
        // $user1 = User::where('id','=',$user_id)->first();
        // $result1 = $user1->toArray();
        // $result2 = Profile::whereuser_id($user_id)->first()->toArray(); //Profile::find($user_id);
        // $res = array_merge($result1, $result2);
        // $result3 = SocialNetwork::whereuser_id($user_id)->get()->toArray();
        // $arr3 = array("social_data" => $result3);
        // $res2 = array_merge($res, $arr3);
        // $company_data = Company::select('company.*','company_users.job_position');
        // $company_data->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
        // $company_data->where('company_users.user_id', $user_id);
        // $company_data = $company_data->orderBy('company.id', 'ASC')->get()->toArray();
        // $arr4 = array("company_data" => $company_data);
        // $res3 = array_merge($res2, $arr4);
		$data = JWTAuth::toUser()->profile->id;
		ProfileIcone::where('profile_id',$data)->delete();
		ProfileHospital::where('profile_id',$data)->delete();
        $errors = "";
        $message = "Data has been successfully delete.";
        $status = true;
        // $data = (object)array();
        return $this->sendResult($message,$data,$errors,$status);

    }

    /************************************************************************************
     * Country List
    *************************************************************************************/
    public function countrylist(Request $request)
    {
        $result = Countries::select("*")->get()->toArray();
        $message = "Country List Successfully";
        $errors = "";
        $status = true;
            $data = [
                'countrylist' => $result,
            ];
        return $this->sendResult($message,$data,$errors,$status);
    }

    /************************************************************************************
     * Order Entry
    *************************************************************************************/
    public function putorder(Request $request)
    {
        
        $user_id = $request['user_id'];
        if(!empty($user_id)){
                $orders = new Orders;
                $orders->firstname = $request['firstname'];
                $orders->user_id = $user_id;
                $orders->lastname = $request['lastname'];
                $orders->email = $request['email'];
                $orders->phone = $request['phone'];
                $orders->billing_address = $request['address1'];
                $orders->shipping_address = $request['address2'];
                $orders->order_number = $this->getNextOrderNumber();
                $orders->qty = $request['qty'];
                $orders->amount = $request['amount'];
                $orders->country_id = $request['country'];
                $orders->state = $request['state'];
                $orders->zip = $request['postcode'];
                $orders->save();
                $orderid = $orders->id;
                $result = Orders::select("*")->where('id', $orderid)->first()->toArray();
                $message = "Order has been successfully created.";
                $errors = "";
                $status = true;
                    $data = [
                        'orderdetails' => $result,
                    ];
                return $this->sendResult($message,$data,$errors,$status);
        }

    }

    /**************************************** Generate dynamic Number ************************************* */
    public function getNextOrderNumber()
	{
	    $lastOrder = Orders::orderBy('created_at', 'desc')->first();

	    if (!$lastOrder)
	        $number = 0;
	    else
	        $number = substr($lastOrder->order_number, 3);

	    return 'ORD' . sprintf('%06d', intval($number) + 1);
    }


    /************************************************************************************
     * Test api
    *************************************************************************************/
    public function testapi(Request $request)
    {
        //$result4 = Company::whereuser_id(78)->get()->toArray();
        $company_data = Company::select('company.*','company_users.job_position');
        $company_data->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
        $company_data->where('company_users.user_id', 78);
        $company_data = $company_data->orderBy('company.id', 'ASC')->get();
        print_r($company_data);
        die();
        // if(!empty($request['file'])){
        //     $avatarExt = request()->file->getClientOriginalExtension();
        //         if($avatarExt == "txt" || $avatarExt == "pdf" || $avatarExt == "doc"){
        //         }else{
        //             return response()->json(['status' => 401, 'message' => 'The file must be a file of type: txt, pdf, doc.']);
        //         }
        // }
        // if(!empty($request['file'])){
        //     $avatarName = 'logo'.time().'.'.request()->file->getClientOriginalExtension();
        //     $request->file->storeAs('resume',$avatarName);
        //     //$company->file = '/resume/'.$avatarName;
        // }else{
        //    // $avatarName = $company->logo;
        // }
        // //$company->save();
        // dd($avatarName);
        // die();



        // $data = json_decode($request['socialdata'], true);
        // $user_id_new = $request['user_id'];
        // foreach ($data as $key => $value) {
        //        if($key == 'website' || $key == 'socialMail' || $key == 'instagram' || $key == 'facebook' || $key == 'twitter' || $key == 'youtube' || $key == 'linkdin' || $key == 'homeNumber' || $key == 'workNumber' || $key == 'otherNumber')
        //         {
        //             $keytext = $key;
        //             foreach ($value as $key => $value1) {
        //                 if($value1['id'] == "" ||  empty($value1['id'])){
        //                     $socialnetwork_new = new SocialNetwork;
        //                     $socialnetwork_new->user_id = $user_id_new;
        //                     $socialnetwork_new->media_type = $keytext;
        //                     $socialnetwork_new->media_value = $value1['mediaValue'];
        //                     $socialnetwork_new->status = $value1['status'];
        //                     $socialnetwork_new->save();
        //                 }else{
        //                     $socialnetwork_update = SocialNetwork::select("*")
        //                     ->where('user_id', $user_id_new)
        //                     ->Where('id', $value1['id'])
        //                     ->first();
        //                     $socialnetwork_update->media_value = $value1['mediaValue'];
        //                     $socialnetwork_update->status = $value1['status'];
        //                     $socialnetwork_update->save();
        //                 }
        //             }
        //         }
        //    }
    }
    
    
    
    
    /************************************************************************************
     * OR Code generated G
    *************************************************************************************/
    public function qrgenerated(Request $request)
    {
        if(!empty($request['user_name']))
        {
            
            $user_name = $request['user_name'];
            $upi_id = $request['upi_id'];
            
            $message = "record found";
            $errors= "";
            $status = true;
            $data = (object)[];
            
            //API Code Start
            $request_url1 = "https://dev.thewebtual.com/clique/orcodeapi/index.php";
            $content1 =  'user_name='.rawurlencode($user_name).'&upi_id='.rawurlencode($upi_id);
                    
            $ch1 = curl_init($request_url1);
            curl_setopt($ch1, CURLOPT_POST, true);
            curl_setopt($ch1, CURLOPT_POSTFIELDS, $content1);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            $output1 = curl_exec ($ch1);
            curl_close ($ch1);
        	
            //$response_data1 = json_decode($output1);
        
            //dd($response_data1);
            
            $qr_image_url = $output1;
            $data->user_name = $user_name;
            $data->upi_id = $upi_id;
            $data->qr_image_url = $qr_image_url;
            //$data = $user_data;
            return $this->sendResult($message,$data,$errors,$status);

        }
    }
    
    /************************************************************************************
     * temp profile active inactive G
    *************************************************************************************/
    public function tempactiveinactive(Request $request)
    {
        if(!empty($request['user_id']))
        {
            $user = User::where('id', $request['user_id'])->update(['is_temp' => $request['is_temp'],]);
            
            if($request['is_temp'] == 1){
                $message = "Temporary Profile Active Successfully";
            }else{
                $message = "Temporary Profile Inactive Successfully";
            }
            
            $errors= "";
            $status = true;
            $user_data = User::select('is_temp')->where('id','=',$request['user_id'])->first();
            //$data = (object)[];
            $data = $user_data;
            return $this->sendResult($message,$data,$errors,$status);

        }
    }
	
	 /************************************************************************************
     * get temp profile G
    *************************************************************************************/
	
	public function updatePassword(Request $request){
			$errors= "";
            $status = true;
			$message = "Your password has been change Successfully";
			$data = $request->all();
			if($request->new_password == $request->confirm_password){
				// $data = $request->user()->id;
				// Profile::whereuser_id($user_id)->first();
				// Hash::make($request->new_password);
				$user = $request->user();
				$user->password = Hash::make($request->new_password);
				$user->save();
			}else{
				$status = false;
				$message = "Your new_password and confirm_password does not match";
			}
            return $this->sendResult($message,$data,$errors,$status);
	}
	
	
    
    /************************************************************************************
     * get temp profile G
    *************************************************************************************/
    public function gettempprofile(Request $request){
        $errors = "";
        $data = [];
        $message = "";
        $user_id = $request['user_id'];

        $user1 = User::where('id','=',$user_id)->first();
		
        $token = JWTAuth::fromUser($user1);
        $result1 = $user1->toArray();

        $result2 = Profile::whereuser_id($user_id)->first();
		if($result2){
			$res = array_merge($result1, $result2->toArray());
		}else{
			$res = array_merge($result1, array("user_id"=>$result1['id'],"bio"=>"","avatar"=>"","gender"=>"","is_read"=>"","is_view"=>"",
							"is_sharing"=>"","is_card_active"=>"","current_lat"=>"","current_long"=>"","privacy"=>"","resume_file"=>"",
							"resume_file_status"=>"","resume_link"=>"","resume_link_status"=>"","deleted_at"=>""
			));
		}
        
        //$result3 = TempSocialNetwork::whereuser_id($user_id)->where('status', 1)->where('media_value', '!=', '')->get()->toArray();
        $result3 = TempSocialNetwork::whereuser_id($user_id)->where('media_value', '!=', '')->get()->toArray();
        $arr3 = array("social_data" => $result3);
        $res2 = array_merge($res, $arr3);
        $company_data = Company::select('company.*','company_users.job_position');
        $company_data->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
        $company_data->where('company_users.user_id', $user_id);
        $company_data = $company_data->orderBy('company.id', 'ASC')->get()->toArray();
        $arr4 = array("company_data" => $company_data);
        $res3 = array_merge($res2, $arr4);
		$res3['custom_id'] = base64_encode($res3['user_id']);
		$my_connections = Usercontact::where('user_id',$user_id)->where('status','approve')->count();
		$res3['my_connections'] = $my_connections + 1;
		$res3['is_card_assign'] = Carditems::where('assign_user_id',$user_id)->count();
		
		$profile_icones = ProfileIcone::with('icone')->where('profile_id',$result2->id)->orderBy('fade_out', 'desc')->get();
		$activeAccountfor0 = ProfileIcone::with('icone')->where('profile_id',$result2->id)->where('fade_out',0)->first();
		if($activeAccountfor0){
			$activeAccount = ProfileIcone::with('icone')->where('profile_id',$result2->id)->where('fade_out',1)->first();
		}else{
			$activeAccount = (object)array();
		}
		
		$social_icone = array();
		$business_icone = array();
		foreach($profile_icones as $profile_icone){
			if($profile_icone->type == 'social'){
				$social_icone[] = $profile_icone;
			}
			if($profile_icone->type == 'business'){
				$business_icone[] = $profile_icone;
			}
		}
		$myProfileHospitalArray = array();
		$myProfileHospitaluplod_fileArray = array();
		$myProfileHospitals = ProfileHospital::where('profile_id',$result2->id)->orderBy('id', 'desc')->get();
		foreach($myProfileHospitals as $myProfileHospital){
			if($myProfileHospital->uplod_file){
				$myProfileHospital_s = explode(',',$myProfileHospital->uplod_file);
			}else{
				$myProfileHospital_s = array();
			}
			$myProfileHospitaluplod_fileArray = array();
			foreach($myProfileHospital_s as $myProfileHospital_ss){
				$myProfileHospital_ss_explode = explode(".",$myProfileHospital_ss);
				$myProfileHospitaluplod_fileArray[] = array('name'=>rtrim(ltrim($myProfileHospital_ss,'/member'),'.jpg'),'type'=>strtolower(end($myProfileHospital_ss_explode)),'url'=>$myProfileHospital_ss);
			}
			$myProfileHospital->uplod_file = $myProfileHospitaluplod_fileArray;
			$myProfileHospitalArray[] = $myProfileHospital;
		}
		
		$res3['hospital'] = $myProfileHospitalArray;
		
		$res3['social'] = $social_icone;
		$res3['business'] = $business_icone;
		$res3['activeAccount'] = $activeAccount;
        $message = "Get Profile Successfully";
        $status = true;
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'asset_url' => url()->to('/public/storage'),
            'user' => $res3,
        ];
        return $this->sendResult($message,$data,$errors,$status);
    }
	
	
	public function activeSocialAccount(Request $request){
		
		$errors = "";
        $data = [];
		$status = true;
        $message = "Your social account is activated on your social profile";
		try{
			$input = JWTAuth::toUser();
			$profileIcone = ProfileIcone::find($request->id);
				// $ProfileIconeCheck = ProfileIcone::where('profile_id',$profileIcone->profile_id)->where('type',$profileIcone->type)->where('fade_out',0)->first();
				// if($ProfileIconeCheck){
					if($profileIcone->fade_out){
						ProfileIcone::where('profile_id',$profileIcone->profile_id)->where('type',$profileIcone->type)->update(array('fade_out'=>0,'opacity'=>1));
					}else{
						ProfileIcone::where('id',$request->id)->update(array('fade_out'=>1,'opacity'=>1));
						ProfileIcone::where('id','!=',$request->id)->where('profile_id',$profileIcone->profile_id)->where('type',$profileIcone->type)->update(array('fade_out'=>0,'opacity'=>0));
					}
					
				// }else{
						// ProfileIcone::where('id','!=',$request->id)->where('type',$profileIcone->type)->where('profile_id',$profileIcone->profile_id)->update(array('fade_out'=>0));
				// }
				return $this->sendResult($message,$data,$errors,$status);
		}catch(\Exception $e){
			$status = false;
			$message = $e->getMessage();
            return $this->sendResult($message,$data,$errors,$status);
        }
	}
	
	public function assignedCards(Request $request){
		
		$errors = "";
        $data = [];
		$status = true;
        $message = "My all card";
		try{
			$user = JWTAuth::toUser();
			$data = Carditems::select("*")->where('assign_user_id', $user->id)->get();
			return $this->sendResult($message,$data,$errors,$status);
		}catch(\Exception $e){
			$status = false;
			$message = $e->getMessage();
            return $this->sendResult($message,$data,$errors,$status);
        }
	}
	
	public function activeCard(Request $request){
		$errors = "";
        $data = [];
		$status = true;
        $message = "Card active successfully";
		try{
			$user = JWTAuth::toUser();
			$myCard = Carditems::find($request->id);
			if($myCard->active_date){
				$message = "Card deactive successfully";
				$myCard->update(array('active_date'=>null));
			}else{
				$myCard->update(array('active_date'=>Carbon::now()));
			}
			return $this->sendResult($message,$data,$errors,$status);
		}catch(\Exception $e){
			$status = false;
			$message = $e->getMessage();
            return $this->sendResult($message,$data,$errors,$status);
        }
	}
	
	
	public function makepayment(Request $request){
		
		$errors = "";
        $data = [];
		$status = true;
        $message = "Payment successfully";
		try{
			$user_id = $request['user_id'];
			$userdata = User::find($user_id);
			if($request->payment_type == 'S'){
				$data = $this->createCharge(array(
									'card_no'=>$request['card_no'],'exp_month'=>$request['exp_month']
									,'exp_year'=>$request['exp_year'],'cvc'=>$request['cvc'],
									'name'=>$request['name'],'email'=>$userdata->email,'amount'=>$request['amount'],
						));
				if(isset($data->status) && $data->status == 'succeeded'){
					Profile::where('user_id',$user_id)->update(array('is_pro'=>'1'));
					UserPaymentHistory::insert(array(
										'user_id'=>$user_id,'charge_id'=>$data->id,
										'amount'=>$data->amount,'status'=>$data->status,
										'is_refund'=>0,'subscription'=>$request->subscription
					));
				}
			}else if($request->payment_type == 'A'){
				$data = $this->subscription_curl($request->transactionReceipt);
				if($data->status == 21007){
					Profile::where('user_id',$user_id)->update(array('is_pro'=>'1'));
					UserPaymentHistory::insert(array(
										'user_id'=>$user_id,'charge_id'=>$request->transactionId,
										'amount'=>$request['amount'],'status'=>'succeeded',
										'is_refund'=>0,'subscription'=>$request->subscription
					));
				}else{
					$status = false;
					$message = "Your transaction Receipt is incorrect";
				}
			}
			$errors= "";
			return $this->sendResult($message,$data,$errors,$status);
		}catch(\Exception $e){
			$status = false;
			$message = $e->getMessage();
            return $this->sendResult($message,$data,$errors,$status);
        }
	}
	
	
	public function gettempIcone(Request $request){
		$errors = "";
        $data = [];
        $message = "";
        $user_id = $request['user_id'];
		$data = User::where('id','=',$user_id)->first();
		$data_is_pro = $data->profile->is_pro;
		if(count($request->all()) == 3 && $request->action != 'delete'){
			if($request->type == 'social'){
				// $profileIcone = ProfileIcone::where('profile_id',$data->profile->id)->where('type','social')->pluck('icone_id');
				// $data = Icone::whereNotIn('id',$profileIcone->toArray())->get();
				$data = Icone::all();
			}else{
				// $profileIcone = ProfileIcone::where('profile_id',$data->profile->id)->where('type','business')->pluck('icone_id');
				// $data = Icone::whereNotIn('id',$profileIcone->toArray())->get();
				$data = Icone::all();
			}
			$data_array = array();
			$data_array_music['title'] = 'music'; 
			$data_array_social_media['title'] = 'social media'; 
			$data_array_contact['title'] = 'contact'; 
			$data_array_payment['title'] = 'payment'; 
			$data_array_nft['title'] = "crypto currency's and nft";
			$data_array_more['title'] = 'more';
			
			foreach($data as $dat){
				if($data_is_pro || $request->deviceType == 'I'){
					$dat->is_pro = 0;
				}
				if($dat->category == 'social_media'){
					$data_array_social_media['data'][] = $dat;
				}
				if($dat->category == 'contact'){
					$data_array_contact['data'][] = $dat;
				}
				if($dat->category == 'music'){
					$data_array_music['data'][] = $dat;
				}
				if($dat->category == 'payment'){
					$data_array_payment['data'][] = $dat;
				}
				if($dat->category == 'nft'){
					$data_array_nft['data'][] = $dat;
				}
				if($dat->category == 'more'){
					$data_array_more['data'][] = $dat;
				}	
			}
			if(isset($data_array_contact['data'])){
				array_push($data_array,$data_array_contact);
			}
			if(isset($data_array_social_media['data'])){
				array_push($data_array,$data_array_social_media);
			}
			if(isset($data_array_music['data'])){
				array_push($data_array,$data_array_music);
			}
			if(isset($data_array_payment['data'])){
				array_push($data_array,$data_array_payment);
			}
			if(isset($data_array_more['data'])){
				array_push($data_array,$data_array_more);
			}
			if(isset($data_array_nft['data'])){
				array_push($data_array,$data_array_nft);
			}
			$data = $data_array;
			
			$message = "Icon list";
		}else{
			if($request->action && $request->action == 'delete'){
				$check_profileIcone = ProfileIcone::find($request->id);
				if($check_profileIcone){
					$check_profileIcone->delete();
				}
				$message = "Icon delete successfully";
			}else{
				$Profile_icone = ProfileIcone::where('profile_id',$data->profile->id)->where('icone_id',$request->id)->where('type',$request->type)->first();
				$contact_link = $request->link;
				if (filter_var($request->link, FILTER_VALIDATE_URL) === FALSE) {
					if($request->id == 1){
						$contact_link = $request->link;
						if(substr_count($request->link, 'tel')){
							$link_url = $request->link;
						}else{
							if(strpos($request->link, '+') !== false){
								$link_url = 'tel:'.$request->link;
							}else{
								$link_url = 'tel:+91'.$request->link;
							}
						}
					}else if($request->id == 2){
						if(substr_count($request->link, 'mailto')){
							$link_url = $request->link;
						}else{
							$link_url = 'mailto:'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 3){
						if(substr_count($request->link, 'story.snapchat.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://story.snapchat.com/u/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 4){
						if(substr_count($request->link, 'primevideo.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://www.primevideo.com/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 5){
						if(substr_count($request->link, 'paypal://')){
							$link_url = $request->link;
						}else{
							$link_url = 'paypal://'.$request->link;
						}
						$contact_link = 'https://www.paypal.com/myaccount/settings/'.ltrim($link_url,'paypal://');
					}else if($request->id == 6){
						if(substr_count($request->link, 'p-y.tm/')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://p-y.tm/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 7){
						if(substr_count($request->link, 'google.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'http://google.com/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 8){
						if(substr_count($request->link, 'venmo.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://venmo.com/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 11){
						if(substr_count($request->link, 'zomato.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://zoma.to/u/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 12){
						if(substr_count($request->link, 'https://youtube.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://youtube.com/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 13){
						if(substr_count($request->link, 'instagram://')){
							$link_url = $request->link;
						}else{
							$link_url = 'instagram://user?username='.$request->link;
						}
						$contact_link = 'https://www.instagram.com/'.ltrim($link_url,'instagram://user?username=');
					}else if($request->id == 14){
						if(substr_count($request->link, 'linkedin://')){
							$link_url = $request->link;
						}else{
							$link_url = 'linkedin://profile/'.$request->link;
						}
						$contact_link = 'https://www.linkedin.com/in/'.ltrim($link_url,'linkedin://profile/');
					}else if($request->id == 15){
						if(substr_count($request->link, 'spotify')){
							$link_url = $request->link;
						}else{
							$link_url = 'spotify:'.$request->link;
						}
						$contact_link = 'https://open.spotify.com/playlist/'.ltrim($link_url,'spotify:');
					}else if($request->id == 16){
						if(substr_count($request->link, 'fb:')){
							$link_url = $request->link;
						}else{
							$link_url = 'fb://profile?app_scoped_user_id='.$request->link;
						}
						$contact_link = 'https://www.facebook.com/'.ltrim($link_url,'fb://profile?app_scoped_user_id=');
					}else if($request->id == 17){
						if(substr_count($request->link, 'https')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://www.twitter.com/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 19){
						if(substr_count($request->link, 'musics')){
							$link_url = $request->link;
						}else{
							$link_url = 'musics://'.$request->link;
						}
						$contact_link = 'http://musics.com/search_caf.php?src='.ltrim($link_url,'musics://');
					}else if($request->id == 20){
						if(substr_count($request->link, 'cash.app/')){
							$link_url = $request->link;
						}else{
							$link_url = 'cash.app/'.$request->link;
						}
						$contact_link = 'https://cash.app/careers';
					}else if($request->id == 21){
						if(substr_count($request->link, 'joinclubhouse.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://www.joinclubhouse.com/@'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 22){
						if(substr_count($request->link, 'facetime:')){
							$link_url = $request->link;
						}else{
							$link_url = 'facetime:'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 23){
						if(substr_count($request->link, 'deezer.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://www.deezer.com/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 24){
						if(substr_count($request->link, 'deezer.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://www.deezer.com/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 25){
						if(substr_count($request->link, 'files.google.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://files.google.com/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 26){
						if(substr_count($request->link, 'pinterest')){
							$link_url = $request->link;
						}else{
							$link_url = 'pinterest://'.$request->link;
						}
						$contact_link = 'https://in.pinterest.com/pin/'.ltrim($link_url,'pinterest://');
					}else if($request->id == 27){
						if(substr_count($request->link, 'podcasts.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://www.podcasts.com/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 28){
						if(substr_count($request->link, 'soundcloud.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://soundcloud.com/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 29){
						if(substr_count($request->link, 'tiktok.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://www.tiktok.com/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 30){
						if(substr_count($request->link, 'https')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 31){
						if(substr_count($request->link, 'bitclout.com')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://bitclout.com/u/'.$request->link;
						}
						$contact_link = $link_url;
					}else if($request->id == 32){
						if(substr_count($request->link, 'wa.me')){
							$link_url = $request->link;
						}else{
							$link_url = 'https://wa.me/'.$request->link;
						}
						$contact_link = $link_url;
					}else{
						$link_url = $request->link;
					}
				}else{
						$link_url = $request->link;
				}
				if($request->action == 'update'){
					$message = "Icon update successfully";
					$profile_icone_data = array('link'=>$link_url,'username'=>$request->link,'contact_link'=>$contact_link);
					if($request->file_path){
						$profile_icone_data['file_path'] = $request->file_path;
					}
					ProfileIcone::where('id',$request->socialId)->update($profile_icone_data);
					// $Profile_icone->update($profile_icone_data);
				}else{
					$message = "Icon add successfully";
					$profile_icone_data = array('profile_id'=>$data->profile->id,'icone_id'=>$request->id,'type'=>$request->type,'link'=>$link_url,'username'=>$request->link,'contact_link'=>$contact_link);
					if($request->file_path){
						$profile_icone_data['file_path'] = $request->file_path;
					}
					ProfileIcone::insert($profile_icone_data);
				}
			}
				// $profileIcone = ProfileIcone::where('profile_id',$data->profile->id)->where('type',$request->type)->pluck('icone_id');
				// $data = Icone::whereNotIn('id',$profileIcone->toArray())->get();
				$data = Icone::all();
		}
		$errors= "";
		$status = true;
        return $this->sendResult($message,$data,$errors,$status);
	}
	

    /************************************************************************************
     * get temp profile update G
    *************************************************************************************/
    public function tempprofileupdate(Request $request){
        $errors = "";
        $data = [];
        $message = "";
        $user_id = $request['user_id'];
            
        if(!empty($user_id)){
            $tempprofile = TempProfile::whereuser_id($user_id)->first();
            
            if($tempprofile->avatar == null){
                $image_name = '/user/default.png';
            }else{
                $image_name = $tempprofile->avatar;
            }
            
            $tempprofile->bio = $request['bio'];
            $tempprofile->privacy = ($request['privacy'] == null) ? 0 : $request['privacy'];
            $tempprofile->avatar = $image_name;
            $tempprofile->current_lat = $request['current_lat'];
            $tempprofile->current_long = $request['current_long'];
            $tempprofile->created_at = date('Y-m-d H:i:s');
            $tempprofile->save();

            $data = json_decode($request['socialdata'], true);
            $user_id_new = $request['user_id'];
            foreach ($data as $key => $value) {
                $keytext = $key;
                foreach ($value as $key => $value1) {
                    
                    if($value1['id'] == "" ||  empty($value1['id'])){
                        $socialnetwork_new = new TempSocialNetwork;
                        $socialnetwork_new->user_id = $user_id_new;
                        $socialnetwork_new->media_type = $keytext;
                        $socialnetwork_new->media_value = $value1['mediaValue'];
                        $socialnetwork_new->status = $value1['status'];
                        $socialnetwork_new->save();
                       
                    }else{
                        
                        $socialnetwork_update = TempSocialNetwork::select("*")
                        ->where('user_id', $user_id_new)
                        ->Where('id', $value1['id'])
                        ->first();
                        
                        if($socialnetwork_update == null){
                            
                        }else{
                            $socialnetwork_update->media_value = $value1['mediaValue'];
                            $socialnetwork_update->status = $value1['status'];
                            $socialnetwork_update->save();    
                        }
                        
                    }
                }
            }
        }

        $user1 = User::where('id','=',$user_id)->first();
        $token = JWTAuth::fromUser($user1);
        $result1 = $user1->toArray();

        $result2 = TempProfile::whereuser_id($user_id)->first()->toArray();
        $res = array_merge($result1, $result2);
        $result3 = TempSocialNetwork::whereuser_id($user_id)->get()->toArray();
        $arr3 = array("social_data" => $result3);
        $res2 = array_merge($res, $arr3);
        $company_data = Company::select('company.*','company_users.job_position');
        $company_data->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
        $company_data->where('company_users.user_id', $user_id);
        $company_data = $company_data->orderBy('company.id', 'ASC')->get()->toArray();
        $arr4 = array("company_data" => $company_data);
        $res3 = array_merge($res2, $arr4);
        $message = "Profile Updated Successfully";
        $status = true;
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'asset_url' => url()->to('/public/storage'),
            'user' => $res3,
        ];
        return $this->sendResult($message,$data,$errors,$status);
    }
    
    
    /**************************************** Dynamic create card number ************************************* */
    public function generateRandomNumber($length = 8)
    {
        $lastOrder = Carditems::orderBy('id', 'desc')->first();

        if (!$lastOrder){
	        $number = 0;
        }else{
            $number = substr($lastOrder->sku_id, 6);
        }
        $kk = sprintf('%06d', intval($number) + 1);
        $year = date("Y");
        $kk = $year.$kk;
        return $kk;
    }
    
    /**************************************** add Card In Inventory ************************************* */
    public function addCardInventory(Request $request)
    {
        if(!empty($request['card_number']))
        {
            $is_card = Carditems::where('card_id',$request['card_number'])->first();
            if(isset($is_card))
            {
                $message = "Card already added";
                $errors= "";
                $status = false;
                $data = (object)[];
                
            }else{
                $carditems = new Carditems;
                $carditems->card_id = $request['card_number'];
                $carditems->sku_id = $this->generateRandomNumber();
                $carditems->is_purchase = 1;
                $carditems->is_sell =  0;
                $carditems->purchase_date = now();
                $carditems->active_date = now();
                $carditems->save();
                
                $message = "Card added Successfully";
                $errors= "";
                $status = true;
                $data = (object)[]; 
            }
            
            return $this->sendResult($message,$data,$errors,$status);
        }
    }
    
    
    
    
    
    //Auth via email
    
    public function register_via_email(Request $request)
    {
            $email = $request->email;
            $validator = Validator::make($request->all(), [
              'email' => 'required|email|max:255',
            ]);
            
            
            if($validator->fails()){
               
                $status = false;
                $errorCode = $status ? 200 : 422;
                $errors = "";
                $result = [
                    "message" => $validator->errors()->first(),
                    "status" => false,
                    "data" => (object)[],
                    "errors" => $errors
                ];
                return response()->json($result,$errorCode);
               
            }
            $user = User::where('email', $request->email)->first();
            if(isset($user))
            {
                $status = false;
                $errorCode = $status ? 200 : 422;
                $errors = "";
                $result = [
                    "message" => "Member is already registerd",
                    "status" => false,
                    "otp" => 0,
                    "errors" => $errors
                ];
                return response()->json($result,$errorCode);
            }
            else
            {
                $otp = rand(1000,9999);
                $email_otp = UserOtp::where('email', $email)->first();
                if($email_otp){
                    UserOtp::where('email','=',$email)->update(['otp' => $otp]);
                }
                else{
                    $userotp = new UserOtp;
                    $userotp->email = $email;
                    $userotp->otp = $otp;
                    $userotp->save();
                }
                
                Mail::to($email)->send(new OtpRequest($otp));
               
                $status = true;
                $errorCode = $status ? 200 : 422;
                $errors = "";
                $result = [
                    "message" => "Email added",
                    "status" => true,
                    "otp" => $otp,
                    "errors" => $errors
                ];

                return response()->json($result,$errorCode);
            }
    }
    
    
    public function register_via_email_with_otp(Request $request){
        
        $validator = Validator::make($request->all(), [
          'email' => 'required|email|max:255',
          'password' => 'required|min:8|max:255',
          'otp' => 'required',
          'name' => 'required',
        ]);
        if($validator->fails()){
            
            $status = false;
            $errorCode = $status ? 200 : 422;
            $errors = "";
            $result = [
                "message" => $validator->errors()->first(),
                "status" => false,
                "data" => (object)[],
                "errors" => $errors
            ];
            return response()->json($result,$errorCode);
            
        }
        
        $current_lat = $request['current_lat'];
        $current_long = $request['current_long'];
            
        $email = $request['email'];
        $password = $request['password'];
        $otp = $request['otp'];
        $name = $request['name'];
        $role = 2;
        //$emailotp = rand(1000,9999);
        //$newemail = 'test'.$emailotp.'@gmail.com';
        //$pass = 'clique'.$emailotp;
        $errors = "";
        $data = [];
        $message = "";
        $results = UserOtp::where('email','=',$email)->where('otp', '=', $otp)->first();
        if($results){
            $user = User::where('email', $request['email'])->first();
            if(isset($user))
            {
                $status = false;
                $errorCode = $status ? 200 : 422;
                $errors = "";
                $result = [
                    "message" => "Member is already registerd",
                    "status" => false,
                    "errors" => $errors
                ];
                return response()->json($result,$errorCode);
            }else{
                $user = new User;
                $user->name = $name;
                $user->email = $email;
                $user->password = Hash::make($password);
                //$user->mobile = $request['mobile'];
                $user->save();
                $result1 = $user->toArray();
                $user_id = $result1['id'];
                $user->roles()->attach($role); //User role
                if(!empty($user_id)){
                            $profile = new Profile;
                            $profile->user_id = $user_id;
                            $profile->current_lat = $request['current_lat'];
                            $profile->current_long = $request['current_long'];
							if($request->device_token){
								$profile->device_token = $request->device_token;
							}
                            $profile->created_at = date('Y-m-d H:i:s');
                            $profile->save();
                        $token = JWTAuth::fromUser($user);
                        $result2 = Profile::whereuser_id($user_id)->first()->toArray(); //Profile::find($user_id);
                        $res = array_merge($result1, $result2);
                        //$result3 = SocialNetwork::whereuser_id($user_id)->get()->toArray();
                        //$arr3 = array("social_data" => $result3);
                        //$res2 = array_merge($res, $arr3);
                        $message = "Register Successfull";
                        $status = true;
                        $data = [
                            'access_token' => $token,
                            'token_type' => 'bearer',
                            'asset_url' => url()->to('/public/storage'),
                            'user' => $res,
                        ];
                        UserOtp::where('email','=',$email)->update(['otp' => null]);
                        return $this->sendResult($message,$data,$errors,$status);

                    }
            }

        }
        else{

            $message = "Your otp are wrong";
            $status = false;
            $data = (object)[];
            return $this->sendResult($message,$data,$errors,$status);
        }
    }
    
    
    public function login_via_email(Request $request){
        
        $validator = Validator::make($request->all(), [
          'email' => 'required|email|max:255',
          'password' => 'required|min:8|max:255',
        ]);
        if($validator->fails()){
            $status = false;
            $errorCode = $status ? 200 : 422;
            $errors = "";
            $result = [
                "message" => $validator->errors()->first(),
                "status" => false,
                "data" => (object)[],
                "errors" => $errors
            ];
            return response()->json($result,$errorCode);
        }
        
        $current_lat = $request['current_lat'];
        $current_long = $request['current_long'];
        
        $email = $request['email'];
		if($request['social_type'] == 'N'){
			$user = User::where('email',$email)->first();
			if($user == null){
				$status = false;
				$errorCode = $status ? 200 : 422;
				$errors = "";
				$result = [
					"message" => "Member not found.",
					"status" => false,
					"errors" => $errors
				];
				return response()->json($result,$errorCode);   
			}else{
				$status = Hash::check($request['password'], $user->password);
				if($status == true){
					
					$errors = "";
					$result1 = $user->toArray();
					$user_id = $result1['id'];
					
					$profile = Profile::whereuser_id($user_id)->first();
					$profile->current_lat = $current_lat;
					$profile->current_long = $current_long;
					if($request->device_token){
						$profile->device_token = $request->device_token;
					}
					$profile->save();
											
					
					$token = JWTAuth::fromUser($user);
					$result2 = Profile::whereuser_id($user_id)->first()->toArray(); //Profile::find($user_id);
					$res = array_merge($result1, $result2);
					
					
					
					
					
					$result3 = SocialNetwork::whereuser_id($user_id)->get()->toArray();
					$arr3 = array("social_data" => $result3);
					$res2 = array_merge($res, $arr3);
					$company_data = Company::select('company.*','company_users.job_position');
					$company_data->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
					$company_data->where('company_users.user_id', $user_id);
					$company_data = $company_data->orderBy('company.id', 'ASC')->get()->toArray();
					$arr4 = array("company_data" => $company_data);
					$res3 = array_merge($res2, $arr4);
					$res3['custom_id'] = base64_encode($res3['user_id']);
			
					
					
					$message = "Login Successfull";
					$status = true;
					$data = [
					'access_token' => $token,
					'token_type' => 'bearer',
					'asset_url' => url()->to('/public/storage'),
					'user' => $res3,
					];
					
					return $this->sendResult($message,$data,$errors,$status);

					
				}else{
					$status = false;
					$errorCode = $status ? 200 : 422;
					$errors = "";
					$result = [
						"message" => "Your email & password not match.",
						"status" => false,
						"errors" => $errors
					];
					return response()->json($result,$errorCode);   
				}
			}
		}else if($request['social_type'] == 'F' || $request['social_type'] == 'G' || $request['social_type'] == 'I'){
			$user = User::where('email',$email)->first();
			if(!$user){
				$role = 2;
				$user = new User;
				$user->name = $request['name'];
				$user->email = $email;
				$user->password = '';
				$user->save();
				$user->roles()->attach($role); //User role
				
				$profile = new Profile;
				$profile->user_id = $user->id;
				
				if($request->avatar){
					$content = file_get_contents($request->avatar);
					$user_image = '/user/img_'.$user->id.time().'.png';
					file_put_contents(public_path($user_image), $content);
					$profile->avatar = $user_image;
				}
				if($request->social_type == 'G'){
					$profile->icone_social = 7;
				}else if($request->social_type == 'F'){
					$profile->icone_social = 16;
				}
				if($request->device_token){
						$profile->device_token = $request->device_token;
					}
				$profile->save();
				SocialNetwork::insert(array('user_id'=>$user->id,'media_type'=>'google','media_value'=>$email,'status'=>1));
			}
			if($user){
					$errors = "";
					$result1 = $user->toArray();
					$user_id = $result1['id'];
					
					// if($request['social_type'] == 'g'){
					// $profile->icone_social = 7;
				// }else if($request['social_type'] == 'f'){
					// $profile->icone_social = 16;
				// }
					$icone_social = 7;
					$social_link = null;
					if($request->social_type == 'G'){
						$icone_social = 7;
					}else if($request->social_type == 'F'){
						$icone_social = 16;
						$social_link = 'fb://'.$request->name;
					}
					
					$profile = Profile::whereuser_id($user_id)->first();
					// $profile->icone_social = $icone_social;
					$profile->current_lat = $current_lat;
					$profile->current_long = $current_long;
					if($request->device_token){
						$profile->device_token = $request->device_token;
					}
					$profile->save();
					
					// ProfileIcone::insert(array('profile_id'=>$profile->id,'icone_id'=>$icone_social,'link'=>$social_link,'type'=>'social'));
					ProfileIcone::updateOrCreate(array('profile_id'=>$profile->id,'icone_id'=>$icone_social),array('profile_id'=>$profile->id,'icone_id'=>$icone_social,'link'=>$social_link,'type'=>'social'));
											
					
					$token = JWTAuth::fromUser($user);
					$result2 = Profile::whereuser_id($user_id)->first()->toArray(); //Profile::find($user_id);
					$res = array_merge($result1, $result2);
					
					
					
					
					
					$result3 = SocialNetwork::whereuser_id($user_id)->get()->toArray();
					$arr3 = array("social_data" => $result3);
					$res2 = array_merge($res, $arr3);
					$company_data = Company::select('company.*','company_users.job_position');
					$company_data->leftJoin('company_users', 'company_users.company_id', '=', 'company.id');
					$company_data->where('company_users.user_id', $user_id);
					$company_data = $company_data->orderBy('company.id', 'ASC')->get()->toArray();
					$arr4 = array("company_data" => $company_data);
					$res3 = array_merge($res2, $arr4);
					$res3['custom_id'] = base64_encode($res3['user_id']);
					$message = "Login Successfull";
					$status = true;
					$data = [
					'access_token' => $token,
					'token_type' => 'bearer',
					'asset_url' => url()->to('/public/storage'),
					'user' => $res3,
					];
					return $this->sendResult($message,$data,$errors,$status);
			}
		}else{
				$status = false;
				$errorCode = $status ? 200 : 422;
				$errors = "";
				$result = [
					"message" => "Member not found.",
					"status" => false,
					"errors" => $errors
				];
				return response()->json($result,$errorCode); 
		}

    }
    
    
    public function forget_password(Request $request){
        $validator = Validator::make($request->all(), [
          'email' => 'required|email|max:255',
        ]);
        
        
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $user = User::where('email', $request->email)->first();
        if($user == null)
        {
            $status = false;
            $errorCode = $status ? 200 : 422;
            $errors = "";
            $result = [
                "message" => "Member is not registerd in our app.",
                "status" => false,
                "otp" => 0,
                "errors" => $errors
            ];
            return response()->json($result,$errorCode);
        }
        else
        {
            $email = $request->email;
            $otp = rand(1000,9999);
            $email_otp = UserOtp::where('email', $email)->first();
            if($email_otp){
                UserOtp::where('email','=',$email)->update(['otp' => $otp]);
            }
            else{
                $userotp = new UserOtp;
                $userotp->email = $email;
                $userotp->otp = $otp;
                $userotp->save();
            }
            
            Mail::to($email)->send(new OtpRequest($otp));
           
            $status = true;
            $errorCode = $status ? 200 : 422;
            $errors = "";
            $result = [
                "message" => "Forget Password OTP has been send successfully",
                "status" => true,
                "otp" => $otp,
                "errors" => $errors
            ];

            return response()->json($result,$errorCode);
        }
    }
    
    
     public function verify_forget_password(Request $request)
     {
        $validator = Validator::make($request->all(), [
          'email' => 'required|email|max:255',
          'new_password' => 'required|min:8|max:255',
          'otp' => 'required',
        ]);
        
        
        if($validator->fails()){
            
            $status = false;
            $errorCode = $status ? 200 : 422;
            $errors = "";
            $result = [
                "message" => $validator->errors()->first(),
                "status" => false,
                "data" => (object)[],
                "errors" => $errors
            ];
            return response()->json($result,$errorCode);
            
            
            //return response()->json($validator->errors(), 400);
        }
        $user = UserOtp::where('email', $request->email)->first();
        
        if($user == null)
        {
            $status = false;
            $errorCode = $status ? 200 : 422;
            $errors = "";
            $result = [
                "message" => "Member is not registerd in our app.",
                "status" => false,
                "data" => (object)[],
                "errors" => $errors
            ];
            return response()->json($result,$errorCode);
        }
        else
        {
            $email = $request->email;
            $results = UserOtp::where('email','=',$email)->orderBy('id', 'DESC')->first();
            if($results->otp == $request->otp){
                
                $user = User::where('email', $request->email)->first();
                $user->password = Hash::make($request->new_password);
                $user->save();
                
                $errors = "";
                $result = [
                    "message" => "Your password has been successfully updated.",
                    "status" => true,
                    "data" => (object)[],
                    "errors" => $errors
                ];
                return response()->json($result,200);
                
            }else{
    
                $errors = "";
                $message = "Your otp are wrong";
                $status = false;
                $data = (object)[];
                return $this->sendResult($message,$data,$errors,$status);
            }
            
        }
    
    }
	
	
	public function testingApiGet(Request $request)
     {
			$status = true;
            $errorCode = $status ? 200 : 422;
            $errors = "";
            $result = [
                "message" => "testing-api-get",
                "status" => true,
                "input" => $request->all(),
                "errors" => $errors
            ];
            return response()->json($result,$errorCode);
		 
	 }
	 
	
	public function testingApiSecond(Request $request)
     {
			$status = true;
            $errorCode = $status ? 200 : 422;
            $errors = "";
            $result = [
                "message" => "testingApiSecond",
                "status" => true,
                "input" => $request->all(),
                "errors" => $errors
            ];
            return response()->json($result,$errorCode);
		 
	 }
	 
	 
	public function testingApi(Request $request)
     {
			$status = true;
            $errorCode = $status ? 200 : 422;
            $errors = "";
			$idss = base64_encode($request->id);
			// $input = JWTAuth::toUser();
            $result = [
                "message" => "testingApi",
                "status" => true,
                "input" => $idss,
                "errors" => $errors
            ];
            return response()->json($result,$errorCode);
		 
	 }
	 
	 
	
	
    
    
    
    
}
