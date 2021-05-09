<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\User;
use Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){



        // if($request->type == 'user'){
        //     $request->validate([
        //         'phone' => 'required|numeric|min:10',
        //         'password' => 'required'
        //     ]);

        //     $is_exits = User::wherephone($request->phone)->first();
        //     if(empty($is_exits))
        //     {
        //         return response()->json(['status' => '401', 'message'=>'Your account credential not matched in our records.']);
        //     }else{
        //         $email = $is_exits->email;
        //     }


        // }else{
        //     $request->validate([
        //         'email_or_phone' => 'required',
        //         'password' => 'required'
        //     ]);

        //     $email = $request->email_or_phone;
        // }

             $request->validate([
               'email' => 'required|email',
               'password' => 'required'
          ]);

        $email = $request->email;

        if (Auth::attempt(['email' => $email, 'password' => $request->password])){

         $user = User::whereemail($email)->first();
         
           if($user->roles->first()->type == 1){
               
               $redirect_url = url('admin/dashboard');
            }
            elseif($user->roles->first()->id == 3) {
                    $redirect_url = url('admin/corporate/dashboard');
            }
            else{
                Auth::logout();
                return response()->json(['status' => '401', 'message'=>'Your account credential not matched in our records.']);
                //$redirect_url = url('/login');
            }
            
          
            
            $data = array('redirect_url' => $redirect_url);

            //$data = array('redirect_url' => $redirect_url);
            return response()->json(['status' => '201', 'message' => 'Login Success.', 'data' => $data]);
           // return redirect(route('admin.dashboard'));

        }
        else
        {
            return response()->json(['status' => '401', 'message'=>'Your account credential not matched in our records.']);
        }
    }


    protected function loggedOut(Request $request) {
        return redirect('admin/dashboard');
    }





}
