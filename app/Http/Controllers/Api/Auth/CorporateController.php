<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Profile;
use App\SocialNetwork;
use App\UserOtp;
use App\Company;
use App\ProfileIcone;
use App\Companyusers;
use App\Usercontact;
use App\Carditems;
use App\Countries;
use App\Orders;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CorporateController extends Controller
{

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

                if(!empty($user) || $user != NULL && $user->roles->first()->id == 4)
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
                }else{

                    $errorCode = $status ? 200 : 422;
                        $errors = "";
                        $result = [
                            "message" => "Your Mobile number is not Valid",
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
    public function loginprofileupdate(Request $request)
    {
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
         $getUsers = DB::select('CALL GetNearByUsers(?,?,?)',array($lat,$long,$km));
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
		$profile_icones = ProfileIcone::with('icone')->where('profile_id',$result2['id'])->get();
		$res3['social'] = $profile_icones;
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
        if(!empty($request['contact_id']))
        {

            $user_contact = new Usercontact;
            $user_contact->user_id = $request['user_id'];
            $user_contact->contact_id = $request['contact_id'];
            $user_contact->save();
            $message = "Contact added Successfully";
                $errors= "";
                $status = true;
                $data = (object)[];
                return $this->sendResult($message,$data,$errors,$status);

        }
    }
    /************************************************************************************
     * Add contact
    *************************************************************************************/
    public function addcontactlist(Request $request)
    {
        if(!empty($request['user_id']))
        {
            $result1 = Usercontact::select('users.id','users.name','user_contact.*','users_profile.avatar');
            $result1->leftJoin('users', 'users.id', '=', 'user_contact.contact_id');
            $result1->leftJoin('users_profile', 'users_profile.user_id', '=', 'user_contact.contact_id');
            $result1->where('user_contact.user_id', $request['user_id']);
            $result1->where('users.id','!=',null);
            $result1 = $result1->orderBy('user_contact.id', 'ASC')->get()->toArray();
            foreach ($result1 as $key => $value1) {
                $data1 = Companyusers::where('user_id','=',$value1['contact_id'])->first();
                if($data1){
                    $data1 = $data1->toArray();
                    $result1[$key]['job_position'] = $data1['job_position'];
                } else {  $result1[$key]['job_position'] = ''; }
            }

            $message = "Contact List Successfully";
            $errors= "";
            $status = true;
            $data = $result1;
            return $this->sendResult($message,$data,$errors,$status);


        }
    }
     /************************************************************************************
     * Remove contact
    *************************************************************************************/
    public function removecontact(Request $request)
    {
        if(!empty($request['user_id']) and !empty($request['contact_id']))
        {
            $res=Usercontact::where('user_id',$request['user_id'])->where('contact_id',$request['contact_id'])->delete();
            $message = "Contact Delete Successfully";
            $errors= "";
            $status = true;
            $data = (object)[];
            return $this->sendResult($message,$data,$errors,$status);

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
                    if($carddata['assign_user_id'] == 0 && $carddata['assign_user_id'] == "" && $carddata['order_id'] != null)
                    {

                        $carddatanew = Carditems::select("*")
                                    ->where('assign_user_id', $request['user_id'])
                                    ->get();
                        $wordCount = $carddatanew->count();
                        if($wordCount > 0){
                            $errors= "";
                            $status = false;
                            $message = "This user Allready assigned another card Id";

                        }
                        else{
                            $carddata->assign_user_id = $request['user_id'];
                            //$carddata->user_id = $request['user_id'];
                            $carddata->save();
                            $errors= "";
                            $status = true;
                            $message = "Card Assign to User";
                        }

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
                            $message = "Card allready assigned to other user";
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
        $socialId = $request['social_id'];
        $user_id = $request['user_id'];
        SocialNetwork::find($socialId)->delete();
        $user1 = User::where('id','=',$user_id)->first();
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
        $errors = "";
        $message = "Data has been successfully delete.";
        $status = true;
        $data = [
            'asset_url' => url()->to('/public/storage'),
            'user' => $res3,
        ];
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



}
