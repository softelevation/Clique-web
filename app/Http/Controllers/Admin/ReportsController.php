<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Orders;
use App\Profile;
use App\SocialNetwork;
use App\Companyusers;
use App\Company;
use App\Carditems;
use DataTables;
use DB;


class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

/**************************************** New customer Datatable ************************************* */
    public function newcustomer_index(Request $request)
    {

        if ($request->ajax()) {

            $data = User::select('*')->whereRaw('Date(users.created_at) = CURDATE()')->whereHas('roles', function ($query) {
                $query->where('role_id', '=', 2);
            });
            $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
            $data = $data->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = "";
                    $redirct_url = url("admin/edit-user?id=".$row->user_id);
                    $btn = '<a href="'.$redirct_url.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                    <i class="icon-xl fas fa-street-view"></i>
                    </a>';
                  return $btn;
             })
		        ->addColumn('id', function($row){
		           return $row->id;
		        })
		        ->addColumn('name', function($row){
                    $btn = "";
                    if($row->avatar == '/user/default.png'){
                        $storage_path = asset('media/users/blank.png');
                    }else{
                        $storage_path = asset('storage/'.$row->avatar);
                    }
                    $btn = '<div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                        <img class="" src="'.$storage_path.'" alt="photo">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->name.'</div>
                                        <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->email.'</a>
                                    </div>
                                </div>';
                    return $btn;
		            //return $row->name;
                })
                ->addColumn('email', function($row){
		            return $row->email;
                })
                ->addColumn('mobile1', function($row){
		            return $row->mobile;
                })
                ->addColumn('created_at', function($row){
                    return $row->created_at;
                })
                ->rawColumns(['id','name','email','mobile1','created_at','action'])
		        ->make(true);
	   }

        $page_title = 'Manage New Customer';
        $page_description = '';
        return view('admin.reports.newcustomerlist', compact('page_title', 'page_description'));
    }
/**************************************** All customer Datatable ************************************* */
    public function allcustomer_index(Request $request)
    {

        if ($request->ajax()) {

           $data = User::select('*')->whereHas('roles', function ($query) {
                $query->where('role_id', '=', 2);
            });
            $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
            $data = $data->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = "";
                    $redirct_url = url("admin/edit-user?id=".$row->user_id);
                    $btn = '<a href="'.$redirct_url.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                    <i class="icon-xl fas fa-street-view"></i>
                    </a>';
                    return $btn;
                })
                ->addColumn('avatar', function($row){
                    $nameVal = ($row->name == null) ? '' : $row->name;
                    if($row->avatar == '/user/default.png'){
                        $storage_path = asset('storage/'.$row->avatar);
                    }else{
                        $storage_path = asset('storage/'.$row->avatar);
                    }
                    $app_html = "";
                    if($row->avatar == '/user/default.png'){
                        $app_html .= '<div class="d-flex align-items-center">
                            <span class="symbol symbol-40 symbol-light-info mr-2"">
                                <span class="symbol-label font-size-h6 font-weight-bold">'.substr($nameVal, 0, 1).'</span>
                            </span>
                            <div class="d-flex flex-column">
                                <span class="text-dark font-size-lg">'.$nameVal.'</span>
                            </div>
                        </div>';
                    }else{
                        $app_html .= '<div class="d-flex align-items-center">
                            <span class="symbol symbol-40 symbol-light-info mr-2"">
                                <span class="symbol-label">
                                    <img src="'.$storage_path.'" class="h-100 align-self-end" alt="">
                                </span>
                            </span>
                            <div class="d-flex flex-column">
                                <span class="text-dark font-size-lg">'.$nameVal.'</span>
                            </div>
                        </div>';
                    }
                    return $app_html;

                 })
		        ->addColumn('id', function($row){
		           return $row->id;
		        })
		        ->addColumn('name', function($row){
                    $btn = "";
                    if($row->avatar == '/user/default.png'){
                        $storage_path = asset('media/users/blank.png');
                    }else{
                        $storage_path = asset('storage/'.$row->avatar);
                    }
                    $btn = '<div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                        <img class="" src="'.$storage_path.'" alt="photo">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->name.'</div>
                                        <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->email.'</a>
                                    </div>
                                </div>';
                    return $btn;
		            //return $row->name;
                })
                ->addColumn('email', function($row){
		            return $row->email;
                })
                ->addColumn('mobile1', function($row){
		            return $row->mobile;
                })
                ->addColumn('created_at', function($row){
                    return display_date_format($row->created_at);
                })
                ->rawColumns(['id','name','email','mobile1','created_at','action','avatar'])
		        ->make(true);
	    }
            $page_title = 'All Users';
            $page_description = '';
            return view('admin.reports.allcustomerlist', compact('page_title', 'page_description'));
    }

/**************************************** User List Datatable ************************************* */
    public function corporateusers_index(Request $request)
    {

        if($request->ajax()) {
            // $data = User::select('users.*','users_profile.avatar')->whereHas('roles', function ($query) {
            //     $query->where('role_id', '=', 4);
            // });
            // $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
            // $data->leftJoin('company_users', 'company_users.user_id', '=', 'users.id');
            // if($request->has('corporate_id') && $request->filled('corporate_id')){
			// 	$data->where('company_users.company_id', $request->corporate_id);
			// }
            // $data = $data->get();
            $data = User::select('users.*','users_profile.avatar','company.name as companyname')->whereHas('roles', function ($query) {
                $query->where('role_id', '=', 4);
            });
            $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
            $data->leftJoin('company_users', 'company_users.user_id', '=', 'users.id');
            $data->leftJoin('company', 'company.id', '=', 'company_users.company_id');
            if($request->has('corporate_id') && $request->filled('corporate_id')){
                $data->where('company_users.company_id', $request->corporate_id);
            }
            $data = $data->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = "";
                    $redirct_url = url("admin/edit-user?id=".$row->id);
                    $btn = '<a href="'.$redirct_url.'" class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
                    <i class="icon-xl fas fa-street-view"></i>
                    </a>';
                    return $btn;
                })
		        ->addColumn('id', function($row){
		           return $row->id;
		        })
		        ->addColumn('name', function($row){
                    $btn = "";
                    if($row->avatar == '/user/default.png' || $row->avatar == ""){
                        $storage_path = asset('media/users/blank.png');
                    }else{
                        $storage_path = asset('storage/'.$row->avatar);
                    }
                    $btn = '<div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                        <img class="" src="'.$storage_path.'" alt="photo">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->name.'</div>
                                        <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->email.'</a>
                                    </div>
                                </div>';
                    return $btn;
		            //return $row->name;
                })
                ->addColumn('email', function($row){
		            return $row->email;
                })
                ->addColumn('mobile1', function($row){
		            return $row->mobile;
                })
                ->addColumn('corporate_name', function($row){
		            return $row->companyname;
                })
                ->addColumn('roles_name', function($row){
                    return $row->roles()->first()->role_name;
                   //return ($row->roles == null)?'':$row->roles->first()->role_name;
                })
                ->addColumn('created_at', function($row){
                    return display_date_format($row->created_at);
                })
                ->rawColumns(['id','name','email','mobile1','corporate_name','roles_name','created_at','action'])
		        ->make(true);
	    }
        $page_title = 'Corporate Users List';
        $page_description = '';
        return view('admin.reports.corporate-user-list', compact('page_title', 'page_description'));
    }

    public function corporate_admin(Request $request){

		$corporate = User::select('users.*','company.id as compmayid')->whereHas('roles', function ($query) {
                $query->where('role_id', '=', '3');
            });
        $corporate->leftJoin('company', 'company.user_id', '=', 'users.id');
        $corporate = $corporate->orderBy('id', 'DESC')->get();

        $data = "<option value=''>Select Corporate</option>";
        foreach ($corporate as $user){
            // if($user->logo == "/user/default.png") {
            //     $storage_path = asset('media/users/blank.png');
            //   }
            //   else{
            //       $storage_path = asset('storage'.$user->logo);
            //   }
            $data .= "<option value=".$user->compmayid.">".$user->name."</option>";
            //$data .= "<option value=".$user->compmayid."><img src=".$storage_path."></option>";
        }

	    return response()->json(['status'=> 201,'message'=>'Success' ,'data' => $data]);
    }

/**************************************** Order reports Datatable ************************************* */
public function orders_index(Request $request){

    if ($request->ajax()) {
        $data = Orders::orderBy('id', 'ASC')->get();
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function($row){
              $btn = "";
              $redirct_url = url("admin/edit-comapny?id=".$row->id);
              $btn = '<a href="#" class="btn btn-sm btn-clean btn-icon mr-2 vieworders" data-id="'.$row->id.'" data-toggle="modal" data-target="#exampleModalSizeLg" title="Edit details">
              <i class="icon-2x text-dark-50 flaticon-eye"></i>
              </a>';
            //   $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deleteorders" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete">
            //   <i class="icon-1x text-dark-50 flaticon-delete"></i>
            //   </a>';
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
            $redirct_url = url("admin/assign-card-list/".$row->id);
            $btn = '<a href="'.$redirct_url.'" class="mr-2" title="Assign">
            <span class="label label-lg label-light-primary label-inline font-weight-bold py-4">Assign</span>
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
            //return $row->created_at;
          })
          ->rawColumns(['id','order_number','customer_details','amount','payment_type','payment_status','created_at','action','assign'])
          ->make(true);
        }
        $page_title = 'Orders List';
        $page_description = "";
        return view('admin.reports.orderslist', compact('page_title', 'page_description'));

}

/**************************************** Subscriber Users reports Datatable ************************************* */
    public function subscriberusers_index(Request $request)
    {



        if ($request->ajax()) {

            $data = User::select('users.*','card_items.card_id as cardid','users_profile.*','orders.order_number as ordernumber');
            $data->leftJoin('users_profile', 'users_profile.user_id', '=', 'users.id');
            $data->leftJoin('card_items', 'card_items.assign_user_id', '=', 'users.id');
            $data->leftJoin('orders', 'orders.id', '=', 'card_items.order_id');
            $data->where('card_items.assign_user_id','!=',null);
            $data = $data->get();

             return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
                     $btn = "";
                     $redirct_url = url("admin/edit-user?id=".$row->user_id);
                     $btn = '<a href="'.$redirct_url.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                     <i class="icon-xl fas fa-street-view"></i>
                     </a>';
                     return $btn;
                 })
                 ->addColumn('avatar', function($row){
                     $nameVal = ($row->name == null) ? '' : $row->name;
                     if($row->avatar == '/user/default.png'){
                         $storage_path = asset('storage/'.$row->avatar);
                     }else{
                         $storage_path = asset('storage/'.$row->avatar);
                     }
                     $app_html = "";
                     if($row->avatar == '/user/default.png'){
                         $app_html .= '<div class="d-flex align-items-center">
                             <span class="symbol symbol-40 symbol-light-info mr-2"">
                                 <span class="symbol-label font-size-h6 font-weight-bold">'.substr($nameVal, 0, 1).'</span>
                             </span>
                             <div class="d-flex flex-column">
                                 <span class="text-dark font-size-lg">'.$nameVal.'</span>
                             </div>
                         </div>';
                     }else{
                         $app_html .= '<div class="d-flex align-items-center">
                             <span class="symbol symbol-40 symbol-light-info mr-2"">
                                 <span class="symbol-label">
                                     <img src="'.$storage_path.'" class="h-100 align-self-end" alt="">
                                 </span>
                             </span>
                             <div class="d-flex flex-column">
                                 <span class="text-dark font-size-lg">'.$nameVal.'</span>
                             </div>
                         </div>';
                     }
                     return $app_html;

                  })
                 ->addColumn('id', function($row){
                    return $row->id;
                 })
                 ->addColumn('name', function($row){
                     $btn = "";
                     if($row->avatar == '/user/default.png'){
                         $storage_path = asset('media/users/blank.png');
                     }else{
                         $storage_path = asset('storage/'.$row->avatar);
                     }
                     $btn = '<div class="d-flex align-items-center">
                                     <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                         <img class="" src="'.$storage_path.'" alt="photo">
                                     </div>
                                     <div class="ml-4">
                                         <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">'.$row->name.'</div>
                                         <a href="#" class="text-muted font-weight-bold text-hover-primary">'.$row->email.'</a>
                                     </div>
                                 </div>';
                     return $btn;
                     //return $row->name;
                 })
                 ->addColumn('email', function($row){
                     return $row->email;
                 })
                 ->addColumn('card_id', function($row){
                    return $row->cardid;
                })
                ->addColumn('order_id', function($row){
                    return $row->ordernumber;
                })
                 ->addColumn('mobile1', function($row){
                     return $row->mobile;
                 })
                 ->addColumn('created_at', function($row){
                     return display_date_format($row->created_at);
                 })
                 ->rawColumns(['id','name','email','card_id','order_id','mobile1','created_at','action','avatar'])
                 ->make(true);
         }
             $page_title = 'Subscriber User List';
             $page_description = '';
             return view('admin.reports.subscriberuserlist', compact('page_title', 'page_description'));

    }



}
