{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Add Testimonials
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>
    </div>
    <form class="form" name="add-page" id="add-page" action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class=" container ">
			    <div class="row">
	                <div class="col-md-8">
                        <div class="form-group ">
						    <label>Title <span class="text-danger">*</span></label>
						    <input type="text" id="name" name="name" value="" class="form-control"  placeholder="Enter Title"/>
                        </div>
	                </div>
                    <div class="col-md-8">
                        <div class="form-group">
						    <label>Tagline <span class="text-danger">*</span></label>
						    <input type="text" id="tagline" name="tagline" value="" class="form-control"  placeholder="Enter Tagline"/>
					    </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
						    <label>Description <span class="text-danger">*</span></label>
						    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
					    </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-xl-4 col-lg-3 col-form-label text-left">Photo:</label>
                                <div class="col-lg-8 col-xl-9">
                                    <div class="image-input image-input-outline" id="kt_user_add_avatar">
                                        <div class="image-input-wrapper" style="background-image: url({{asset('media/users/blank.png')}})"></div>
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="avatar" id="avatarFile" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="profile_avatar_remove" />
                                            </label>
                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                        <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                    </div>
                                </div>
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
{{-- Styles Section --}}
@section('styles')
@endsection
{{-- Scripts Section --}}
@section('scripts')
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
         $('#add-page')[0].reset();
    });

    if($("#add-page").length > 0) {
	    $("#add-page").validate({
            rules: {
	            name: {  required: true },
                tagline: {  required: true },
	            description: { required: true }
            },
	        messages: {
	            name: {  required: "Please enter the Name" },
                tagline: {  required: "Please enter the Tagline" },
	            description: { required: "Please enter description" },
	        },
		    submitHandler: function(form,event) {
			    event.preventDefault();
			    var myform = document.getElementById("add-page");
			    var formData = new FormData(myform);
			    $.ajax({
				    url: '{{ url('admin/create-testimonials') }}',
				    type: "POST",
				    data:formData,
				    contentType: false,
            	    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				    cache: false,
				    processData: false,
				    success: function( response ) {
					    if(response.status == "200"){
                            window.location.href = "{{ route('testimonials.list')}}";
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
