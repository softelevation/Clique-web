<?php

namespace App\Http\Controllers\Corporate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Company;
use App\Orders;
use App\Carditems;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        
        $res_company = Company::whereuser_id(Auth::id())->first()->toArray();
        $user_count = User::select('users.*')->whereHas('roles', function ($query) {
                $query->where('role_id', '=', 4);
        });
        $user_count->leftJoin('company_users', 'company_users.user_id', '=', 'users.id')->where('company_users.company_id', '=', $res_company['id']);
        $user_count = $user_count->count();
        
         
        //$subcription_count = Carditems::where('assign_user_id','!=',null)->count();
        // $subcription_count = User::select('users.*')->whereHas('roles', function ($query) {
        //         $query->where('role_id', '=', 4);
        // });
        // $subcription_count = $subcription_count->count();
        $subcription_count = Carditems::select('card_items.*')->where('card_items.user_id','=',Auth::id())->where('card_items.assign_user_id','!=',"");
        $subcription_count = $subcription_count->orderBy('card_items.id', 'ASC')->count();

        
        
        $data = Orders::whereuser_id(Auth::id())->orderBy('id', 'ASC')->get();
        $order_count = Orders::whereuser_id(Auth::id())->orderBy('id', 'ASC')->count();
        
        
        $avilable_card = Carditems::select('card_items.*')->where('card_items.user_id','=',Auth::id())->where('card_items.assign_user_id','=',NULL)->count();

        
     
        
        
        $page_title = 'Corporate Dashboard';
        $page_description = '';
        return view('corporate.dashboard', compact('page_title', 'page_description','user_count','subcription_count','order_count','avilable_card'));
    }

    /**
     * Demo methods below
     */

    // Datatables
    public function datatables()
    {
        $page_title = 'Datatables';
        $page_description = 'This is datatables test page';

        return view('pages.datatables', compact('page_title', 'page_description'));
    }

    // KTDatatables
    public function ktDatatables()
    {
        $page_title = 'KTDatatables';
        $page_description = 'This is KTdatatables test page';

        return view('pages.ktdatatables', compact('page_title', 'page_description'));
    }

    // Select2
    public function select2()
    {
        $page_title = 'Select 2';
        $page_description = 'This is Select2 test page';

        return view('pages.select2', compact('page_title', 'page_description'));
    }

    // custom-icons
    public function customIcons()
    {
        $page_title = 'customIcons';
        $page_description = 'This is customIcons test page';

        return view('pages.icons.custom-icons', compact('page_title', 'page_description'));
    }

    // flaticon
    public function flaticon()
    {
        $page_title = 'flaticon';
        $page_description = 'This is flaticon test page';

        return view('pages.icons.flaticon', compact('page_title', 'page_description'));
    }

    // fontawesome
    public function fontawesome()
    {
        $page_title = 'fontawesome';
        $page_description = 'This is fontawesome test page';

        return view('pages.icons.fontawesome', compact('page_title', 'page_description'));
    }

    // lineawesome
    public function lineawesome()
    {
        $page_title = 'lineawesome';
        $page_description = 'This is lineawesome test page';

        return view('pages.icons.lineawesome', compact('page_title', 'page_description'));
    }

    // socicons
    public function socicons()
    {
        $page_title = 'socicons';
        $page_description = 'This is socicons test page';

        return view('pages.icons.socicons', compact('page_title', 'page_description'));
    }

    // svg
    public function svg()
    {
        $page_title = 'svg';
        $page_description = 'This is svg test page';

        return view('pages.icons.svg', compact('page_title', 'page_description'));
    }

    // Quicksearch Result
    public function quickSearch()
    {
        return view('layout.partials.extras._quick_search_result');
    }
}
