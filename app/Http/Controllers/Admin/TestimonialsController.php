<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Testimonials;
use DataTables;

class TestimonialsController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Testimonials::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                  $btn = "";
                  $redirct_url = url("admin/edit-testimonials?id=".$row->id);
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
                ->addColumn('image', function($row){
                    $btn = "";
                    if($row->image == '/user/default.png'){
                        $storage_path = asset('media/users/blank.png');
                    }else{
                        $storage_path = asset('storage/'.$row->image);
                    }
                    $btn = '<div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                        <img class="" src="'.$storage_path.'" alt="photo">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-dark-75 font-weight-bolder font-size-lg mb-0"></div>
                                        <a href="#" class="text-muted font-weight-bold text-hover-primary"></a>
                                    </div>
                                </div>';
                    return $btn;


                 })
                ->addColumn('name', function($row){
                   return $row->name;
                })
                ->addColumn('tagline', function($row){
                    return $row->tagline;
                 })
              ->rawColumns(['id','image','name','tagline','action'])
              ->make(true);
            }
        $page_title = 'Testimonials List';
        $page_description = '';
        return view('admin.testimonials.testimonialslist', compact('page_title', 'page_description'));
    }
/**************************************** Pages create page redirect ************************************* */
    public function create()
    {
        $page_title = 'Create Testimonials';
        $page_description = '';
        return view('admin.testimonials.create', compact('page_title', 'page_description'));
    }
/**************************************** Pages Store in DB ************************************* */
    public function store(Request $request)
    {

        try {
            $name = trim($request->name);
            $data = new Testimonials;
            $data->name = $name;
            $data->tagline = $request->tagline;
            $data->description = $request->description;
            if(!empty($request['avatar'])){
                $avatarExt = request()->avatar->getClientOriginalExtension();
                    if($avatarExt == "jpg" || $avatarExt == "png" || $avatarExt == "jpeg"){
                    }else{
                        return response()->json(['status' => 401, 'message' => 'The avatar must be a file of type: jpg, png, jpeg.']);
                    }
            }
            if(!empty($request['avatar'])){
                //$avatarName = $user->id.'_avatar'.request()->avatar->getClientOriginalExtension();
                $avatarName = $data->id.'_logo'.time().'.'.request()->avatar->getClientOriginalExtension();
                $request->avatar->storeAs('testimonials',$avatarName);
                $data->image = '/testimonials/'.$avatarName;
            }else{
                $avatarName = $data->image;
            }
            $data->created_by = Auth::id();
            $data->updated_by = Auth::id();
            $data->save();
            return response()->json(['status' => 200, 'message' => 'This testimonials has been saved']);

        } catch (\Exception $exception) {

            return response()->json(['status' => 500, 'message' => 'Ooops....something went wrong. Please try again']);
        }

    }
/**************************************** Company Edit ************************************* */
    public function edit(Request $request)
    {
        $testimonialsdata = Testimonials::find($request->id);
        return view('admin.testimonials.edit',compact('testimonialsdata'));
    }

/**************************************** Testimonial Edit Store ************************************* */
public function updatestore(Request $request)
{
    try {
        $testimonials_id = $request->edit_testimonialsid;
        $testimonials = new Testimonials;
        $testimonials = Testimonials::find($testimonials_id);
        $testimonials->name = $request['name'];
        $testimonials->tagline = $request['email'];
        $testimonials->description = $request['address'];
       if(!empty($request['avatar'])){
            $avatarExt = request()->avatar->getClientOriginalExtension();
                if($avatarExt == "jpg" || $avatarExt == "png" || $avatarExt == "jpeg"){
                }else{
                    return response()->json(['status' => 401, 'message' => 'The avatar must be a file of type: jpg, png, jpeg.']);
                }
        }
        if(!empty($request['avatar'])){
            //$avatarName = $user->id.'_avatar'.request()->avatar->getClientOriginalExtension();
            $avatarName = $testimonials->id.'_logo'.time().'.'.request()->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('testimonials',$avatarName);
            $testimonials->image = '/testimonials/'.$avatarName;
        }else{
            $avatarName = $testimonials->image;
        }
        $testimonials->save();
        return response()->json(['status' => '200', 'message' => 'Testimonials has been updated successfully.']);

    } catch (\Exception $exception) {

        return response()->json(['status' => 500, 'message' => 'Ooops....something went wrong. Please try again']);
    }

}
/**************************************** User Delete ************************************* */
    public function destroy(Request $request)
    {
        $id = $request['id'];
        $res = Testimonials::find($id)->delete();
        return response()->json(['success'=>'Testimonials has been successfully delete.']);
    }




}
