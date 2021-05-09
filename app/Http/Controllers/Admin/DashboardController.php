<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Carditems;
use App\Orders;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_count = User::select('users.*')->count();
        $corporate_count = User::select('users.*','users_profile.*')->whereHas('roles', function ($query) {
            $query->where('role_id', '=', 3);
        });
       $corporate_count = $corporate_count->count();
       $subcription_count = Carditems::where('assign_user_id','!=',null)->count();
       $order_count = Orders::where('assign_card','=',null)->count();


        $page_title = 'Dashboard';
        $page_description = '';
        return view('admin.dashboard', compact('page_title', 'page_description','user_count','corporate_count','subcription_count','order_count'));
    }


}
