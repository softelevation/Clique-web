<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Company;
use App\CorporateRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\corporate_request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**************************************** User Create store ************************************* */
    public function store(Request $request)
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
            $user->save();
            $user_id = $user->id;
            $user->roles()->attach($role); //User role
            if(!empty($user_id)){
                $profile = new Profile;
                $profile->user_id = $user_id;
                $profile->privacy = 0;
                $profile->save();
            }
            if($role == 3)
                        {
                                $company = new Company;
                                $company->user_id = $user_id;
                                $company->name = $request['name'];
                                $company->email = $request['email'];
                                $company->save();
                        }
                return response()->json([
                    'status' => 200,
                    'message' =>'User has been successfully created.']);
        }
        else
        {
            return response()->json(['status' => 401, 'message' => 'That email address are already registered.']);
        }
    }


     //************************ Company Register ********************/\
    public function company_register(Request $request)
    {
        return view('auth.corporate-register');
    }
    //************************ Company Register store or Save ********************/\
    public function company_register_store(Request $request)
    {
        $CorporateRequest = new CorporateRequest;
        $CorporateRequest->corporate_name = $request['corporate_name'];
        $CorporateRequest->contact_person = $request['contact_person'];
        $CorporateRequest->address = $request['address'];
        $CorporateRequest->email = $request['email'];
        $CorporateRequest->phone = $request['phone'];
        $CorporateRequest->save();
        $requestid = $CorporateRequest->id;
        $data = ['request_id' => $requestid];
        Mail::to($request['email'])->send(new corporate_request($data));
        return response()->json([
                'status' => 200,
                'message' =>'Thank You! for your registration! Our team will review your request and contact you soon!']);
    }





}
