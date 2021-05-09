<?php

namespace App\Http\Controllers\Corporate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\placeorder;
use Illuminate\Support\Facades\Mail;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Orders;
use App\Countries;
use App\Company;
use DataTables;
use App\Profile;
use App\Companyusers;
use App\SocialNetwork;
use App\RoleUser;
use App\Role;
use DB;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
/**************************************** Order Datatable ************************************* */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            //$data = Orders::orderBy('id', 'DESC')->get();
             $data = Orders::whereuser_id(Auth::id())->orderBy('id', 'ASC')->get();
            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = "";
                  $btn = '<a href="#" class="btn btn-sm btn-clean btn-icon mr-2 vieworders" data-id="'.$row->id.'" data-toggle="modal" data-target="#exampleModalSizeLg" title="Edit details">
                  <i class="icon-2x text-dark-50 flaticon-eye"></i>
                  </a>';
                  $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deleteorders" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete">
                  <i class="icon-1x text-dark-50 flaticon-delete"></i>
                  </a>';
                return $btn;
               })
               ->addColumn('assign', function($row){
                $btn = "";
                if($row->assign_card)
                {
                    $btn = '<span class="label label-lg label-light-success label-inline font-weight-bold py-4">Delivered</span>';
                }
                else{
                //$redirct_url = url("admin/assign-card-list?order_id=".$row->id);
                    $btn = '<span class="label label-lg label-light-primary label-inline font-weight-bold py-4">Pending</span>';
                }

              return $btn;
             })

              ->addColumn('id', function($row){
                 return $row->id;
              })
              ->addColumn('order_number', function($row){
                  return $row->order_number;
              })
              ->addColumn('customer_details', function($row){

                $btn = '<div class="d-flex align-items-center">
							<div class="ml-4">
							    <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->name.'</div>
                                <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->email.'</a>
                                <div>'.$row->address.'</div>
                                <div>india,'.$row->state.','.$row->zip.'</div>
							</div>
				</div>';
                return $btn;
            })
              ->addColumn('amount', function($row){
                  return $row->amount;
              })
              ->addColumn('qry', function($row){
                return $row->amount;
            })
              ->addColumn('payment_type', function($row){
                return $row->qty;
             })
             ->addColumn('payment_status', function($row){
                return $row->payment_status;
            })
              ->addColumn('created_at', function($row){
                 return display_date_format($row->created_at);
              })
              ->rawColumns(['id','order_number','customer_details','amount','payment_type','payment_status','created_at','action','assign'])
              ->make(true);
            }
            $page_title = 'Orders List';
            $page_description = "";
            return view('corporate.orders.orderslist', compact('page_title', 'page_description'));
    }
/**************************************** Company Delete ************************************* */
public function destroy(Request $request)
{
    $id = $request['id'];
    $res = Orders::find($id)->delete();
    return response()->json(['success'=>'Order has been successfully delete.']);
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

/**************************************** Create new order function ************************************* */
public function create_order(Request $request)
{
    $compmayID = Auth::id();
    $user_data = User::find($compmayID);
    $company = Company::whereuser_id($compmayID)->first();
    $page_title = 'Create Order';
    $page_description = '';
    $countries = Countries::get();
    return view('corporate.orders.create-order', compact('page_title', 'page_description','countries','user_data','company'));

}


//*************************Store place order******* */
public function placeorder(Request $request)
{
    $companyID = Auth::id();

    $orders = new Orders;
    $orders->user_id = $companyID;
    $orders->firstname = $request['firstname'];
    $orders->lastname = $request['lastname'];
    $orders->email = $request['email'];
    $orders->phone = $request['phone'];
    $orders->billing_address = $request['address1'];
    //$orders->shipping_address = $request['address2'];
    $orders->order_number = $this->getNextOrderNumber();
    $orders->qty = $request['qty'];
    $orders->amount = $request['amount'];
    $orders->country_id = $request['country'];
    $orders->state = $request['state'];
    $orders->zip = $request['postcode'];
    //$orders->payment_type = $request['paymenttype'];

    $orders->save();
    $orderid = $orders->id;

     $data = ['order_id' => $orderid];
        Mail::to($request['email'])->send(new placeorder($data));

    return response()->json([
            'status' => 200,
            'order_id' => $orderid,
            'message' =>'Order has been successfully created.']);

}





}
