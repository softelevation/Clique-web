<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pages;
use DataTables;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Pages::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = "";
                  $redirct_url = url("admin/edit-pages?id=".$row->id);
                  $btn = '<a href="'.$redirct_url.'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                  <i class="icon-xl la la-edit"></i>
                  </a>';
                  $btn = $btn.'<a href="javascript:;" class="btn btn-sm btn-clean btn-icon deletepage" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete">
                  <i class="icon-1x text-dark-50 flaticon-delete"></i>
                  </a>';
                return $btn;
               })
               ->addColumn('id', function($row){
                return $row->id;
                })
                ->addColumn('title', function($row){
                   return $row->title;
                })
              ->rawColumns(['id','title','action'])
              ->make(true);
            }
        $page_title = 'Pages List';
        $page_description = '';
        return view('admin.pages.pageslist', compact('page_title', 'page_description'));
    }
/**************************************** Pages create page redirect ************************************* */
    public function create()
    {
        $page_title = 'Create Page';
        $page_description = '';
        return view('admin.pages.create', compact('page_title', 'page_description'));
    }
/**************************************** Pages Store in DB ************************************* */
    public function store(Request $request)
    {

        try {
            $title = trim($request->title);
            $data = new Pages;
            $data->title = $title;
            $slug_new = slugify($title);
            $data->slug = $slug_new;
            $data->description = $request->description;
            $data->created_by = Auth::id();
            $data->updated_by = Auth::id();
            $data->save();
            return response()->json(['status' => 200, 'message' => 'This information has been saved']);

        } catch (\Exception $exception) {

            return response()->json(['status' => 500, 'message' => 'Ooops....something went wrong. Please try again']);
        }

    }
/**************************************** Pages edit ************************************* */
    public function edit(Request $request)
    {
        try {
            $pagedata = Pages::find($request->id);
            $page_title = 'Edit Page';
            $page_description = '';
            return view('admin.pages.edit', compact('page_title', 'page_description','pagedata'));
        } catch (\Exception $exception) {

            return response()->json(['status' => 500, 'message' => 'Ooops....something went wrong. Please try again']);
        }
    }
/**************************************** Company Delete ************************************* */
    public function destroy(Request $request)
    {
        $id = $request['id'];
        $res = Pages::find($id)->delete();
        return response()->json(['success'=>'Company has been successfully delete.']);
    }


}
