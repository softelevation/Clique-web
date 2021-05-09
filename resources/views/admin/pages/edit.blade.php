{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Edit Page<div class="text-muted pt-2 font-size-sm"></div></h3>
        </div>
    </div>
    <form class="form" name="edit-page" id="edit-page" action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class=" container ">
			    <div class="row">
	                <div class="col-md-8">
                        <div class="form-group ">
						    <label>Title <span class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" value="{{$pagedata->title}}" class="form-control"  placeholder="Enter Title"/>
                        </div>
	                </div>
                    <div class="col-md-8">
                        <div class="form-group">
						    <label for="exampleTextarea">Description <span class="text-danger"></span></label>
						    <textarea id="description" class="summernote" name="description" required>{{$pagedata->description}}</textarea>
					    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
        </div>
    </form>
</div>
@endsection
@section('styles')
@endsection
@section('scripts')<script>
	$(document).ready(function(){
		$('.summernote').summernote({
			height: 230,
			minHeight: null,
			maxHeight: null,
			focus: false
		});
	});
</script>
<script>
    var KTAddUser = function () {
       var _avatar;
        var _initAvatar = function () {
            _avatar = new KTImageInput('kt_user_add_avatar');
        }
        return {
           init: function () {
                _initAvatar();
            }
        };
    }();
    jQuery(document).ready(function () {
        KTAddUser.init();
    });
    $(document).ready(function(){
        $('#edit-page')[0].reset();
    });

    if($("#edit-page").length > 0) {
	    $("#edit-page").validate({
            rules: {
	            title: {  required: true },
	            description: { required: true }
            },
	        messages: {
	            name: {  required: "Please enter the title" },
	            description: { required: "Please enter description" },
	        },
		    submitHandler: function(form,event) {
			    event.preventDefault();
			    var myform = document.getElementById("edit-page");
			    var formData = new FormData(myform);
			    $.ajax({
				    url: '{{ url('admin/create-pages') }}',
				    type: "POST",
				    data:formData,
				    contentType: false,
            	    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				    cache: false,
				    processData: false,
				    success: function( response ) {
					    if(response.status == "200"){
                            window.location.href = "{{ route('pages.list')}}";
                        }else{
                            toastr.warning(response.message);
                        }
				    }
			    });
		    }
	    });
    }
</script>
@endsection
