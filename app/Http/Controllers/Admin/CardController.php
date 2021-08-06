<?php

namespace App\Http\Controllers\Admin;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Carditems;
use App\Orders;
use App\User;
use App\Profile;
use DataTables;



class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
/**************************************** Card Datatable ************************************* */
    public function index(Request $request)
    {
        if($request->ajax()) {
            
            $data = Carditems::select('card_items.*','orders.id as orderid','orders.order_number','users.name as u_name','users.email as u_email','users_profile.avatar as u_avtar');
            $data->leftJoin('orders', 'orders.id', '=', 'card_items.order_id');
            $data->leftJoin('users', 'users.id', '=', 'card_items.assign_user_id');
            $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'card_items.assign_user_id');
            $data = $data->orderBy('card_items.id', 'ASC')->get();
            
            // $data = Carditems::select('card_items.*','orders.id as orderid','orders.order_number');
            // $data->leftJoin('orders', 'orders.id', '=', 'card_items.order_id');
            // $data = $data->orderBy('card_items.id', 'ASC')->get();

            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = "";
                 if($row->orderid != NULL && $row->user_id == NULL){
                   if($row->assign_user_id == "" || $row->assign_user_id == NULL){
                        $btn = $btn.'<a href="javascript:void(0)" data-toggle="modal" data-target="#addmember" title="Assign To" data-orderid="' . $row->orderid . '" data-id="' . $row->id . '" data-original-title="assign-to" class="btn btn-success assign_to pt-2 pb-2 pl-2 pr-2 mr-1"><i class="fa fa-user-tag"></i> Assign</a>';
                    }else{
                        $btn = $btn.'<a href="javascript:void(0)" data-toggle="modal" data-target="#removemember" title="Tevoke To" data-orderid="' . $row->orderid . '" data-id="' . $row->id . '" data-original-title="revoke_to" class="btn btn-warning active revoke_to pt-2 pb-2 pl-2 pr-2 mr-1"><i class="fa fa-user-tag"></i> Revoke</a>';
                    }
                }
                  $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deletcard float-right" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete">
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
              ->addColumn('assign_to', function($row){
                $btn = "";
              if($row->assign_user_id){
                        if($row->u_avtar == '/user/default.png'){
                            $storage_path = asset('media/users/blank.png');
                        }else{
                            $storage_path = asset($row->u_avtar);
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
              ->rawColumns(['id','card_id','sku_id','assign_to','is_purchase','is_sell','purchase_date','action'])
              ->make(true);
            }
            $page_title = 'Card Item List';
            $page_description = "";
            return view('admin.card.cardlist', compact('page_title', 'page_description'));

    }
/**************************************** Pages create card ************************************* */
    public function create()
    {
        $page_title = 'Create Card';
        $page_description = '';
        return view('admin.card.create', compact('page_title', 'page_description'));
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
        //$card->user_id = 1;
        $card->is_purchase = $purchase;
        $card->is_sell =  $sell;
        $card->purchase_date = now();
        $card->save();
        return response()->json([
                     'status' => 200,
                    'message' =>'Card has been successfully created.']);
    }

/**************************************** Import Card ************************************* */
    public function import(Request $request)
    {
        if($request->hasFile('importfile')){
            $file = $request->file('importfile');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
            $valid_extension = array("csv");
            // 2MB in Bytes
            $maxFileSize = 2097152;
            if(in_array(strtolower($extension),$valid_extension)){
                 if($fileSize <= $maxFileSize){
                    $location = 'card';
                    $file->move($location,$filename);
                    $filepath = public_path($location."/".$filename);
                    $file = fopen($filepath,"r");
                    $importData_arr = array();
                    $i = 0;
                        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE)
                            {
                                $num = count($filedata );
                                // Skip first row (Remove below comment if you want to skip the first row)
                                if($i == 0){
                                        $i++;
                                        continue;
                                }
                                for ($c=0; $c < $num; $c++) {
                                    $importData_arr[$i][] = $filedata [$c];
                                }
                                $i++;
                            }
                            // Insert to MySQL database

                            foreach($importData_arr as $importData){
                                $card = new Carditems;
                                $card->card_id = $importData[0];
                                $card->sku_id = $this->generateRandomNumber();
                                $card->user_id = 1;
                                $purchase = 1;
                                $sell = 0;
                                // if($importData[1] == "purchase")
                                // {
                                //     $purchase = 1;
                                // } else { $purchase = 0; }
                                // if($importData[2] == "sell")
                                // {
                                //     $sell = 1;
                                // }else { $sell = 0; }
                                $card->is_purchase = $purchase;
                                $card->is_sell = $sell;
                                $card->purchase_date = now();
                                $card->save();
                                }
                                return response()->json([
                                    'status' => 200,
                                   'message' =>'Card has been successfully created.']);
                    }else{
                            return response()->json([
                                    'status' => 201,
                                    'message' =>'File too large. File must be less than 2MB.']);
                    }

            }else{
                return response()->json([
                'status' => 201,
                'message' =>'Invalid File Extension.']);
            }

        }
    }
/**************************************** User Delete ************************************* */
    public function destroy(Request $request)
    {
        $id = $request['id'];
        $res = Carditems::find($id)->delete();
        return response()->json(['success'=>'User has been successfully delete.']);
    }

/**************************************** Dynamic create card number ************************************* */
    public function generateRandomNumber($length = 8)
    {
            // $random = "";
            // srand((double) microtime() * 1000000);
            // $data = "123456123456789071234567890890";
            // // $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; // if you need alphabatic also
            // for ($i = 0; $i < $length; $i++) {
            //         $random .= substr($data, (rand() % (strlen($data))), 1);
            // }
            // return $random;

            // $digits_needed=8;
            // $random_number=''; // set up a blank string
            // $count=0;
            // while ( $count < $digits_needed ) {
            //     $random_digit = mt_rand(0, 9);
            //     $random_number .= $random_digit;
            //     $count++;
            // }
            // return $random_number;
            $lastOrder = Carditems::orderBy('id', 'desc')->first();

            if (!$lastOrder){
	            $number = 0;
            }else{
                //$number = $lastOrder->sku_id;
                $number = substr($lastOrder->sku_id, 6);
            }
            $kk = sprintf('%06d', intval($number) + 1);
            $year = date("Y");
            $kk = $year.$kk;
            return $kk;

    }
/**************************************** Assign card ************************************* */
    public function assigncardlist($order_id="",Request $request)
    {

        if($order_id != "")
        {
            $order_id = $order_id;
            $orderdata =  Orders::select('id','qty')->where('id', $order_id)->first();
            if($orderdata){
            $orderdata->toArray(); }
            $qty = $orderdata['qty'];
        }


        if ($request->ajax()) {

            $data = Carditems::where('order_id','=',null)->orderBy('id', 'ASC')->offset(0)->limit($qty)->get();
            // $data = Carditems::select('card_items.*')->where('order_id','=',null)->orderBy('id', 'ASC');
            // $data = $data->where('orders.assign_card','!=',1);
            // $data->leftJoin('orders', 'orders.id', '=', 'card_items.order_id');
            // $data = $data->offset(0)->limit($qty)->get();

            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = "";
                  $redirct_url = url("admin/edit-comapny?id=".$row->id);
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
            return view('admin.card.assigncard', compact('page_title', 'page_description','qty','order_id'));

    }

 /**************************************** Assign card SAVE ************************************* */
 public function assign_card_save(Request $request)
 {
    $order_id = $_REQUEST['order_id'];
    $orderdata =  Orders::select('*')->where('id', $order_id)->first()->toArray();
    $qty = $orderdata['qty'];
    try {
      
       $data = Carditems::where('order_id','=',null)->orderBy('id', 'ASC')->offset(0)->limit($qty)->get()->toArray();
       $countRow =  count($data);
       if($countRow == $qty)
       {
          foreach ($data as $key => $value) {
                $carditems = Carditems::select("*")->where('id', $value['id'])->first();
                $carditems->order_id = $order_id;
                $carditems->user_id = $orderdata['user_id'];
                $carditems->sell_date = date('Y-m-d H:i:s');
                $carditems->save();
            } 
       }else{
             return response()->json(['status' => 404, 'message' => 'your card count are not same like Qty']); 
       }
      
    } catch (Throwable $e) {
        report($e);
         return false;
     }
     
    $order = Orders::find($order_id);
    if($orderdata['user_id'])
    {
        $order->assign_card = $orderdata['user_id'];
    } else {
        $order->assign_card = 1;
    }

    $order->save();

    return response()->json(['status' => 200, 'message' => 'Card Assigned Successfully']);


 }

 public function singlecardstore(Request $request)
 {
        $card = Carditems::where('card_id','LIKE','%'.$request['addcard'].'%')->first();
        if(isset($card))
        {
            return response()->json(['status' => 404,'message' =>'Card allready added.']);
        }
        $card = new Carditems;
        $card->card_id = $request['addcard'];
        $card->sku_id = $this->generateRandomNumber();
        $card->user_id = 1;
        $card->is_purchase = 1;
        $card->is_sell =  0;
        $card->purchase_date = now();
        $card->save();
        return response()->json(['status' => 200,'message' =>'Card has been successfully created.']);

 }

 public function fetch(Request $request) {
    if ($request->ajax()) {

      $title = array();
      $full_name = "";
      $query = $request->post('keyword');

            $data = User::select('users.*','users_profile.avatar')->whereHas('roles', function ($query) {
                $query->where('role_id', '=', 2);
            });
            $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
            $data = $data->where('users.name', 'LIKE', "%{$query}%")->get();
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
                //return response()->json(['status' => '404', 'success' => 'Card allready assigned to other.']);
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
