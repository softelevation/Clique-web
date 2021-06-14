<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/************************************************************************************
     * API for individual Users
*************************************************************************************/
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('loginotp', 'Api\Auth\LoginController@loginotp');
Route::post('register', 'Api\Auth\LoginController@register');
Route::post('new-register', 'Api\Auth\LoginController@newRegister');


Route::post('ragisterwithotp', 'Api\Auth\LoginController@ragisterwithotp');
Route::post('profileupdate', 'Api\Auth\LoginController@profileupdate');
Route::post('loginprofileupdate', 'Api\Auth\LoginController@loginprofileupdate');
Route::post('emailcheck', 'Api\Auth\LoginController@emailcheck');
Route::post('nearbyusers', 'Api\Auth\LoginController@nearbyusers');
Route::post('usersdetails', 'Api\Auth\LoginController@usersdetails');
Route::post('testapi', 'Api\Auth\LoginController@testapi');
Route::post('companyadd', 'Api\Auth\LoginController@companyadd');
Route::post('addcontact', 'Api\Auth\LoginController@addcontact');
Route::post('addcontactlist', 'Api\Auth\LoginController@addcontactlist');
Route::post('removecontact', 'Api\Auth\LoginController@removecontact');
Route::post('writecard', 'Api\Auth\LoginController@writecard');
Route::post('socialdelete', 'Api\Auth\LoginController@socialdelete');
Route::post('countrylist', 'Api\Auth\LoginController@countrylist');
Route::post('putorder', 'Api\Auth\LoginController@putorder');

//G
Route::post('tempactiveinactive', 'Api\Auth\LoginController@tempactiveinactive');
Route::post('gettempprofile', 'Api\Auth\LoginController@gettempprofile');
Route::post('tempprofileupdate', 'Api\Auth\LoginController@tempprofileupdate');

Route::post('gettempicone', 'Api\Auth\LoginController@gettempIcone');

Route::post('qrgenerated', 'Api\Auth\LoginController@qrgenerated');
/************************************************************************************
     * API for Corporate Users
*************************************************************************************/
Route::post('corporate/login', 'Api\Auth\CorporateController@login');
Route::post('corporate/loginotp', 'Api\Auth\CorporateController@loginotp');
Route::post('corporate/loginprofileupdate', 'Api\Auth\CorporateController@loginprofileupdate');
Route::post('corporate/emailcheck', 'Api\Auth\CorporateController@emailcheck');
Route::post('corporate/nearbyusers', 'Api\Auth\CorporateController@nearbyusers');
Route::post('corporate/usersdetails', 'Api\Auth\CorporateController@usersdetails');
Route::post('corporate/testapi', 'Api\Auth\CorporateController@testapi');
Route::post('corporate/companyadd', 'Api\Auth\CorporateController@companyadd');
Route::post('corporate/addcontact', 'Api\Auth\CorporateController@addcontact');
Route::post('corporate/addcontactlist', 'Api\Auth\CorporateController@addcontactlist');
Route::post('corporate/removecontact', 'Api\Auth\CorporateController@removecontact');
Route::post('corporate/writecard', 'Api\Auth\CorporateController@writecard');
Route::post('corporate/socialdelete', 'Api\Auth\CorporateController@socialdelete');
Route::post('corporate/countrylist', 'Api\Auth\CorporateController@countrylist');
Route::post('corporate/putorder', 'Api\Auth\CorporateController@putorder');


/************************************************************************************
     * API for Inventory Users
*************************************************************************************/

Route::post('inventory/addcardinventory', 'Api\Auth\LoginController@addCardInventory');


Route::post('register-via-email', 'Api\Auth\LoginController@register_via_email');

Route::post('register-via-email-with-otp', 'Api\Auth\LoginController@register_via_email_with_otp');
Route::post('login-via-email', 'Api\Auth\LoginController@login_via_email');


Route::post('forget-password', 'Api\Auth\LoginController@forget_password');
Route::post('verify-forget-password', 'Api\Auth\LoginController@verify_forget_password');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
