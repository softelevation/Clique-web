<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Orders;
use App\Company;
use App\Countries;
use App\Carditems;
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
        
        if($request->ajax()) {
            //$data = Orders::orderBy('id', 'ASC')->get();
            $data = Orders::select('orders.*','orders.user_id as orderusderid','users.name as u_name','users.email as u_email','users_profile.avatar as u_avtar','role_user.role_id as roleid');
            $data->leftJoin('users', 'users.id', '=', 'orders.user_id');
            $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'orders.user_id');
            $data->leftJoin('role_user', 'role_user.user_id', '=', 'orders.user_id');
            $data = $data->orderBy('orders.id', 'ASC')->get();
            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = "";
                  $redirct_url = url("admin/edit-comapny?id=".$row->id);
                  $btn = '<a href="#" class="btn btn-sm btn-clean btn-icon mr-2 mb-2 vieworders" data-id="'.$row->id.'" data-toggle="modal" data-target="#exampleModalSizeLg" title="Edit details">
                  <i class="icon-2x text-dark-50 flaticon-eye"></i>
                  </a>';
                  $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deleteorders" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete">
                  <i class="icon-1x text-dark-50 flaticon-delete"></i>
                  </a>';
                return $btn;
               })
              /*->addColumn('assign', function($row){
                $btn = "";
                if($row->assign_card)
                {
                    $btn = '<span class="label font-weight-bold label-lg label-light-danger label-inline">Delivered</span>';
                }
                else{
                $redirct_url = url("admin/assign-card-list/".$row->id);
                $btn = '<a href="'.$redirct_url.'" class="mr-2" title="Assign">
                <span class="label label-lg label-light-primary label-inline font-weight-bold py-4">Assign</span>
                </a>';
                }

              return $btn;
             })*/
             ->addColumn('assign', function($row){
                $btn = "";
                if($row->assign_card)
                {
                    $btn = '<span class="label font-weight-bold label-lg label-light-danger label-inline">Delivered</span>';
                }
                else{
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="is_delivered mr-2" title="Mark As Delivered">
                        <span class="label label-lg label-light-primary label-inline font-weight-bold py-4">Mark As Delivered</span>
                    </a>';
                }

              return $btn;
             })

              ->addColumn('id', function($row){
                 return $row->id;
              })
              ->addColumn('order_number', function($row){
                $btn = '<a href="#" class="vieworders" data-id="'.$row->id.'" data-toggle="modal" data-target="#exampleModalSizeLg" title="Edit details">
                  '.$row->order_number.'
                  </a>';
                return $btn;
              })
              ->addColumn('customer_details', function($row){

                $btn = '<div class="d-flex align-items-center">
							<div class="ml-4">
							    <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->firstname.'</div>
                                <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->email.'</a>
                                <div>'.$row->address.'</div>
                                <div>india,'.$row->state.','.$row->zip.'</div>
							</div>
				</div>';
                return $btn;
                })
            ->addColumn('order_from', function($row){
                if($row->orderusderid != "" && $row->roleid == 3) {
                    $camform = "Corporate Admin";
                }
                elseif($row->orderusderid != "" && $row->roleid == 2)
                {
                   $camform = "Individual User"; 
                }
                else { $camform = "Website"; } 
                
                $btn = '<div class="d-flex align-items-center">
							<div class="ml-4">
							    <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->u_name.'</div>
                                <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->u_email.'</a>
                                <div class="text-info font-weight-bold font-size-h7">'.$camform.'</div>
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
                //return $row->created_at;
              })
              ->rawColumns(['id','order_number','customer_details','order_from','amount','payment_type','payment_status','created_at','action','assign'])
              ->make(true);
            }
            $page_title = 'Orders List';
            $page_description = "";
            return view('admin.orders.orderslist', compact('page_title', 'page_description'));
    }
/**************************************** Company Delete ************************************* */
public function destroy(Request $request)
{
    $id = $request['id'];
    $res = Orders::find($id)->delete();
    return response()->json(['success'=>'Order has been successfully delete.']);
}

public function delivered(Request $request)
{
    $id = $request['id'];
    $orders = Orders::find($id);
    $user_id = $orders->user_id;
    $orders->assign_card = $user_id;
    $orders->save();
    return response()->json(['success'=>'Order has been delivered successfully.']);
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
/**************************************** View order details ************************************* */
    public function orderdetail(Request $request)
    {
        $orderid = $request['orderid'];
        $orderdata = Orders::where('id', $orderid)->first();

        $country = Countries::where('id', $orderdata->country_id)->first();

        $carddata = Carditems::select('card_items.*');
        $carddata->leftJoin('orders', 'orders.id', '=', 'card_items.order_id');
        $carddata = $carddata->where('card_items.order_id','=',$orderid);
        $carddata = $carddata->orderBy('card_items.id', 'DESC')->get();
        $cardCount = count($carddata);

        ($country)? $countryName = $country->name : $countryName='';

        $html = '<div class="row">
          <div class="col-md-6">
            <h1>Order Detail</h1>
            </div>
        </div>
        <div class="container">
            <table class="table">
            <thead>
              <tr>
                <th>Order Number</th>
                <th>Qty</th>
                <th>Personal detail</th>
                <th>Order Date</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><b>'.$orderdata->order_number.'</b></td>
                <td><b>'.$orderdata->qty.'</b></td>
                <td>
                    <b>Name:</b> '.$orderdata->firstname.' '.$orderdata->lastname.'<br/>
                    <b>Email:</b> '.$orderdata->email.'<br/>
                    <b>Phone:</b> '.$orderdata->phone.'<br/>
                    <b>Address:</b> '.$orderdata->billing_address.'<br/>'.$orderdata->state.'-'.$orderdata->zip.' , '.$countryName.'<br/>
                  </td>
                <td>'.$orderdata->created_at.'</td>
              </tr>

            </tbody>
          </table>
        </div>';
        if($cardCount > 0){
        $html = $html.'<div class="row">
          <div class="col-md-6">
            <h5>Attached card details</h5>
            </div>
        </div>
        <div class="container">
            <table class="table">
            <thead>
              <tr>
                <th>Card Id</th>
                <th>Reference number</th>
                <th>Updated Date</th>
                </tr>
            </thead>
            <tbody>';
            foreach($carddata as $card){
            $html = $html.'<tr>
                <td><b>'.$card['card_id'].'</b></td>
                <td><b>'.$card['sku_id'].'</b></td>
                <td>'.$card['updated_at'].'</td>
              </tr>';
            }
            $html = $html.'</tbody>
          </table>
        </div>';
        }

        return response()->json([
            'status' => '200',
            'message'=>'Success.',
            'data' => "",
            'html' => $html,
        ]);


    }







}
