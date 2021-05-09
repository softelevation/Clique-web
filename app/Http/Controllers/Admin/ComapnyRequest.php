<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\CorporateRequest;
use DataTables;
use DB;


class ComapnyRequest extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
/**************************************** Corporate Request List ************************************* */
    public function index(Request $request)
    {

        if($request->ajax()) {
            //$data = Orders::orderBy('id', 'ASC')->get();
            $data = CorporateRequest::select('corporate_request.*');
            $data = $data->orderBy('corporate_request.id', 'ASC')->get();

        return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = "";
                  $redirct_url = url("admin/edit-comapny?id=".$row->id);
                    $btn = '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deleterequest" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete">
                  <i class="icon-1x text-dark-50 flaticon-delete"></i>
                  </a>';
                return $btn;
               })
               ->addColumn('id', function($row){
                return $row->id;
             })
               ->addColumn('corporate_name', function($row){
                  return $row->corporate_name;
              })
              ->addColumn('contact_person', function($row){
                return $row->contact_person;
            })
              ->addColumn('address', function($row){
                return $row->address;
             })
             ->addColumn('email', function($row){
                return $row->email;
            })
            ->addColumn('phone', function($row){
                return $row->phone;
            })
              ->addColumn('created_at', function($row){
                return display_date_format($row->created_at);
                //return $row->created_at;
              })
              ->rawColumns(['id','corporate_name','contact_person','address','email','phone','created_at','action'])
              ->make(true);
            }
            $page_title = 'Corporate Request List';
            $page_description = "";
            return view('admin.corporaterequest.corporaterequestlist', compact('page_title', 'page_description'));

    }

    /**************************************** Corporate Request ************************************* */
    public function destroy(Request $request)
    {

        $id = $request['id'];
        $res = CorporateRequest::find($id)->delete();
        return response()->json(['success'=>'Request has been successfully delete.']);
    }
}
