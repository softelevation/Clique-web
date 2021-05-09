<?php

namespace App\Http\Controllers\Corporate;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Carditems;
use App\Orders;
use App\Company;
use DataTables;

use App\User;
use App\Profile;



class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
/**************************************** Card Datatable ************************************* */
    public function index(Request $request)
    {

        //$six_digit_random_number = mt_rand(100000, 999999);
        //$uniq = round(microtime(true));
        if ($request->ajax()) {
            $data = Carditems::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = "";
                  $redirct_url = url("admin/edit-comapny?id=".$row->id);
                //   $btn = '<a href="'.$redirct_url.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                //   <i class="icon-xl la la-edit"></i>
                //   </a>';
                  $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deletcard" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete">
                  <i class="icon-1x text-dark-50 flaticon-delete"></i>
                  </a>';
                return $btn;
               })
             ->addColumn('id', function($row){
                 return $row->id;
              })
              ->addColumn('card_id', function($row){
                  return $row->card_id;
              })
              ->addColumn('sku_id', function($row){
                return $row->sku_id;
              })
              ->addColumn('is_purchase', function($row){
                if($row->is_purchase == 1) { $purchase = "Purchase"; } else { $purchase = ""; }
                  return $purchase;
              })
              ->addColumn('is_sell', function($row){
                  if($row->is_sell == 1) { $issell = "sell"; } else { $issell = ""; }
                  return $issell;
              })
              ->addColumn('purchase_date', function($row){
                return $row->purchase_date;
            })
              ->rawColumns(['id','card_id','sku_id','is_purchase','is_sell','purchase_date','action'])
              ->make(true);
            }
            $page_title = 'Card Item List';
            $page_description = "";
            return view('admin.card.cardlist', compact('page_title', 'page_description'));

    }

/**************************************** Company Store in DB ************************************* */
    public function store(Request $request)
    {

         if($request['radios2'] == "purchase")
         {
            $purchase = 1;
         } else { $purchase = 0; }
         if($request['radios2'] == "sell")
         {
            $sell = 1;
         }else { $sell = 0; }

        $card = new Carditems;
        $card->card_id = $request['cardnumber'];
        $card->sku_id = $this->generateRandomNumber();
        $card->user_id = 1;
        $card->is_purchase = $purchase;
        $card->is_sell =  $sell;
        $card->purchase_date = now();
        $card->save();
        return response()->json([
                     'status' => 200,
                    'message' =>'Card has been successfully created.']);
    }





/**************************************** Assign card ************************************* */
    public function assigncardlist(Request $request)
    {
            if($request->ajax()) {

                $data = Carditems::select('card_items.*','orders.id as orderid','orders.order_number','users.name as u_name','users.email as u_email','users_profile.avatar as u_avtar')->where('card_items.user_id','=',Auth::id());
                $data->leftJoin('orders', 'orders.id', '=', 'card_items.order_id');
                $data->leftJoin('users', 'users.id', '=', 'card_items.assign_user_id');
                $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'card_items.assign_user_id');
                $data = $data->orderBy('card_items.id', 'ASC')->get();

            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = "";
                  if($row->assign_user_id == "" || $row->assign_user_id == NULL){
                        $btn = $btn.'<a href="javascript:void(0)" data-toggle="modal" data-target="#addmember" title="Assign To" data-orderid="' . $row->orderid . '" data-id="' . $row->id . '" data-original-title="assign-to" class="btn btn-success assign_to pt-2 pb-2 pl-2 pr-2 mr-5"><i class="fa fa-user-tag"></i> Assign</a>';
                    }else{
                        $btn = $btn.'<a href="javascript:void(0)" data-toggle="modal" data-target="#removemember" title="Tevoke To" data-orderid="' . $row->orderid . '" data-id="' . $row->id . '" data-original-title="revoke_to" class="btn btn-warning active revoke_to pt-2 pb-2 pl-2 pr-2 mr-5"><i class="fa fa-user-tag"></i> Revoke</a>';
                    }

                return $btn;
               })
             ->addColumn('id', function($row){
                 return $row->id;
              })
              ->addColumn('card_id', function($row){
                  return $row->card_id;
              })
              ->addColumn('order_id', function($row){
                return $row->order_number;
            })
              ->addColumn('sku_id', function($row){
                return $row->sku_id;
              })
              ->addColumn('assign_to', function($row){
                $btn = "";
              if($row->assign_user_id){
                        if($row->u_avtar == '/user/default.png'){
                            $storage_path = asset('media/users/blank.png');
                        }else{
                            $storage_path = asset('storage/'.$row->u_avtar);
                        }
                        $btn = '<div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                            <img class="" src="'.$storage_path.'" alt="photo">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->u_name.'</div>
                                            <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->u_email.'</a>
                                        </div>
                                    </div>';
                }else { $btn = ""; }
                return $btn;
              })
              ->addColumn('is_purchase', function($row){
                if($row->is_purchase == 1) { $purchase = "Purchase"; } else { $purchase = ""; }
                  return $purchase;
              })
              ->addColumn('is_sell', function($row){
                  if($row->is_sell == 1) { $issell = "sell"; } else { $issell = ""; }
                  return $issell;
              })
              ->addColumn('purchase_date', function($row){
                return $row->purchase_date;
            })
              ->rawColumns(['id','card_id','order_id','sku_id','assign_to','is_purchase','is_sell','purchase_date','action'])
              ->make(true);
            }
            $page_title = 'Card Item List';
            $page_description = "";
            return view('corporate.card.assigncard', compact('page_title', 'page_description'));

    }

 /**************************************** Assign card SAVE ************************************* */
 public function assign_card_save(Request $request)
 {
    $order_id = $_REQUEST['order_id'];
    $orderdata =  Orders::select('*')->where('id', $order_id)->first()->toArray();
    $qty = $orderdata['qty'];
    $data = Carditems::where('order_id','=',null)->orderBy('id', 'ASC')->offset(0)->limit($qty)->get()->toArray();

    foreach ($data as $key => $value) {
        $carditems = Carditems::select("*")->where('id', $value['id'])->first();
        $carditems->order_id = $order_id;
        $carditems->sell_date = date('Y-m-d H:i:s');
        $carditems->save();
    }
    $user = Orders::find($order_id);


    if($orderdata['user_id'])
    {
        $user->assign_card = $orderdata['user_id'];
    } else {
        $user->assign_card = 1;
    }

    $user->save();

    return response()->json(['status' => 200, 'message' => 'Card Assigned Successfully']);


 }

 public function singlecardstore(Request $request)
 {
        $card = new Carditems;
        $card->card_id = $request['addcard'];
        $card->sku_id = $this->generateRandomNumber();
        $card->user_id = 1;
        $card->is_purchase = 1;
        $card->is_sell =  0;
        $card->purchase_date = now();
        $card->save();
        return response()->json([
                     'status' => 200,
                    'message' =>'Card has been successfully created.']);

 }


 public function fetch(Request $request) {
    if ($request->ajax()) {

      $title = array();
      $full_name = "";
      $query = $request->post('keyword');

            $res_company = Company::whereuser_id(Auth::id())->first()->toArray();

            $data = User::select('users.*','users_profile.avatar')->whereHas('roles', function ($query) {
                $query->where('role_id', '=', 4);
            });
            $data->leftJoin('company_users', 'company_users.user_id', '=', 'users.id')->where('company_users.company_id', '=', $res_company['id']);
            $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
            $data = $data->where('users.name', 'LIKE', "%{$query}%")->get();

        // $data = User::select('users.*','users_profile.avatar')->whereHas('roles', function ($query) {
        // $query->where('role_id', '=', 4);
        // });
        // $data = $data->where('users.id', '!=', 'card_items.assign_user_id');
        // $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
        // $data->leftJoin('card_items', 'card_items.assign_user_id', '=', 'users.id');
        // $data = $data->where('users.name', 'LIKE', "%{$query}%")->get();

        //$data = User::where('name', 'LIKE', "%{$query}%")->get();
        foreach($data as $row) {


          if($row->avatar == "/user/default.png") {
            $storage_path = asset('media/users/blank.png');
          }
          else{
              $storage_path = asset('storage'.$row->avatar);
          }

          if(!empty($row->name))
          {
              $full_name = $row->name;
          }
          $title[] = array('title' => $full_name, 'icon' => $storage_path,'id'=>$row->id);
      }
      return response()->json($title);
  }
}



public function assigncard(Request $request)
    {

        if(isset($request->id))
        {
            $carditems = new Carditems;
            $carditems = Carditems::where('id','=',$request->id)->where('assign_user_id','=',null)->first();
            if($carditems)
            {
                $carditems->assign_user_id = $request->assign_to;
                $carditems->updated_at = date('Y-m-d H:i:s');
                $carditems->save();
                return response()->json(['status' => '200', 'success' => 'Card has been assign successfully.']);
            }else{
                return response()->json(['status' => '404', 'success' => 'Card allready assigned to other.']);
            }

        }
    }

public function revokecard(Request $request)
    {

        if(isset($request->card_id))
        {
            $carditems = Carditems::find($request->card_id);
            $carditems->assign_user_id = NULL;
            $carditems->updated_at = date('Y-m-d H:i:s');
            $carditems->save();
            return response()->json(['status' => '200', 'success' => 'Card has been Revoke successfully.']);
        }
}



}
