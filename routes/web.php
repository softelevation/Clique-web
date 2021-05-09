<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$admin_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'admin_routes' . DIRECTORY_SEPARATOR;
$front_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'front_routes' . DIRECTORY_SEPARATOR;


//*************************************Front Routs********************************* */
    include_once($front_path . 'front_routes.php');
//******************************Front routes ***************************************/

Route::get('/admin', 'Auth\LoginController@showLoginForm')->name('admin.login');

//*************************************Admin Routs********************************* */
//Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function() {

    include_once($admin_path . 'main_admin_routes.php');
    include_once($admin_path . 'corporate_admin.php');
    include_once($admin_path . 'company_routes.php');
    include_once($admin_path . 'reports_routes.php');
    include_once($admin_path . 'pages_routes.php');
    include_once($admin_path . 'testimonials_routes.php');
    include_once($admin_path . 'card_routes.php');
    include_once($admin_path . 'order_routes.php');
//}
//******************************End of admin routes ********************************/

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('kn-clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('storage:link');
    return "Cleared!";
});

