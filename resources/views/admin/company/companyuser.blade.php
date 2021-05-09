{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Add Users
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>
    </div>
    <form class="form" name="add-user" id="add-user" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class=" container ">
			    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Name <span class="text-danger">*</span></label>
						    <input type="text" id="name" name="name" value="" class="form-control"  placeholder="Enter Name"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Email address <span class="text-danger">*</span></label>
						    <input type="text" name="email" id="email" class="form-control"  placeholder="Enter email"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Password <span class="text-danger">*</span></label>
						    <input type="password" name="password" id="password" value="" class="form-control"  placeholder="Enter Password"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Confirm Password <span class="text-danger">*</span></label>
						    <input type="password" name="confirm_password" id="confirm_password" value="" class="form-control"  placeholder="Enter Confirm Password"/>
					    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Mobile <span class="text-danger">*</span></label>
						    <input type="text" name="mobile" id="mobile" value="" class="form-control"  placeholder="Enter Confirm Password"/>
					    </div>
                    </div>
                    <div class="col-md-6">
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
                    <div class="col-md-12"><div class="separator separator-dashed my-5">&nbsp;&nbsp;</div></div>
                    <div class="col-lg-12 col-xl-12">
                        <h5 class="font-weight-bold mb-6">company Detail:</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
						    <label>Title <span class="text-danger">*</span></label>
						    <input type="text" id="companyname" name="companyname" value="" class="form-control"  placeholder="Enter Comapny name"/>
                        </div>
	                </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Email <span class="text-danger">*</span></label>
						    <input type="text" name="companyemail" id="companyemail" value="" class="form-control"  placeholder="Enter Email"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label for="exampleTextarea">Description <span class="text-danger"></span></label>
						    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
					    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label for="exampleTextarea">Address <span class="text-danger"></span></label>
						    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
					    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Website <span class="text-danger"></span></label>
						    <input type="text" id="website" name="website" value="" class="form-control"  placeholder="Enter Website"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Phone <span class="text-danger"></span></label>
						    <input type="text" id="phone" name="phone" value="" class="form-control"  placeholder="Enter Phone"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Job Position <span class="text-danger"></span></label>
                            <input type="text" id="jobposition" name="jobposition" value="" class="form-control"  placeholder="Enter jobposition"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Facebook <span class="text-danger"></span></label>
						    <input type="text" id="facebook" name="facebook" value="" class="form-control"  placeholder="Enter facebook"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Instagram <span class="text-danger"></span></label>
						    <input type="text" id="instagram" name="instagram" value="" class="form-control"  placeholder="Enter instagram"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Linkedin <span class="text-danger"></span></label>
						    <input type="text" id="linkedin" name="linkedin" value="" class="form-control"  placeholder="Enter linkedin"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Twitter <span class="text-danger"></span></label>
						    <input type="text" id="twitter" name="twitter" value="" class="form-control"  placeholder="Enter twitter"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-xl-4 col-lg-3 col-form-label text-left">Photo:</label>
                                <div class="col-lg-8 col-xl-9">
                                    <div class="image-input image-input-outline" id="kt_company_add_avatar">
                                        <div class="image-input-wrapper" style="background-image: url({{asset('media/users/blank.png')}})"></div>
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="logo" id="logo" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="company_avatar_remove" />
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
@section('styles')
@endsection
@section('scripts')
<script>
    jQuery(document).ready(function () {
            KTAddUser.init();
            KTAddUser1.init();
        });

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

    var KTAddUser1 = function () {
        var _avatar;
        var _initAvatar = function () {
            _avatar = new KTImageInput('kt_company_add_avatar');
        }
        return {
            init: function () {
                _initAvatar();
            }
        };
    }();

        $(document).ready(function(){
            $('#add-user')[0].reset();
        });

if($("#add-user").length > 0) {
	$("#add-user").validate({
        rules: {
	    name: {  required: true },
	    email: { required: true, email: true },
	    password: { required: true, minlength: 8 },
	    confirm_password: {
	            required: true,
	            equalTo: "#password"
	    },
        mobile: { required: true },
	    },
	    messages: {
	       name: {  required: "Please enter the name" },
	       email: { required: "Please enter email address", email : "Please enter valid email address" },
	       password: { required: "Please enter password", minlength: "Please enter password minimum 8 length."  },
	       confirm_password: { required: "Please enter confirm password" },
           mobile: {  required: "Please enter Mobile number" },
	    },
		submitHandler: function(form,event) {
			event.preventDefault();
			var myform = document.getElementById("add-user");
			var formData = new FormData(myform);
			$.ajax({
				url: '{{ url('admin/create-company-user') }}',
				type: "POST",
				data:formData,
				contentType: false,
            	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				cache: false,
				processData: false,
				success: function( response ) {
					if(response.status == "200"){
                        window.location.href = "{{ route('users.list')}}";
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
