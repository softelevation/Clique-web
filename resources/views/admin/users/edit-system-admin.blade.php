{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Edit System Admin
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>
    </div>
    <form class="form" name="update-user" id="update-user" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class=" container ">
			    <div class="row">
	                <div class="col-md-6">
                        <div class="form-group">
						    <label>Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" value="{{ $user_data->name }}" class="form-control"  placeholder="Enter Name"/>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-xl-6 col-lg-3 col-form-label text-left">Photo:</label>
                                <div class="col-lg-8 col-xl-9">
                                    <div class="image-input image-input-outline" id="kt_user_add_avatar">
                                        @if($profiledata->avatar == '/user/default.png')
                                        <?php  $storage_path = asset('media/users/blank.png'); ?>
                                        @else
                                            <?php  $storage_path = asset('storage'.$profiledata->avatar); ?>
                                        @endif
                                        <div class="image-input-wrapper" style="background-image: url({{$storage_path}})"></div>
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
                    <div class="col-md-6">
                        <div class="form-group">
						    <label>Email address <span class="text-danger">*</span></label>
						    <input type="text" name="email" id="email" value="{{ $user_data->email }}" class="form-control"  placeholder="Enter email"/>
                        </div>

                        <div class="form-group">
                            <label>Mobile <span class="text-danger">*</span></label>
                            <?php
                                if($user_data->mobile != "" || $user_data->mobile != null)
                                {
                                    $mobile1 = explode('-',$user_data->mobile);
                                    $mobile = $mobile1[1];
                                    $mobilecode = $mobile1[1];
                                }else{
                                    $mobile = "";
                                    $mobilecode = 91;
                                }
                            ?>
                            <input type="text" id="mobile" value="{{ $mobile }}"  class="form-control" data-toggle="input-mask" data-mask-format="0000 000 000" maxlength="12" name="mobile"  placeholder="Enter Mobile"/>
						    {{-- <input type="text" id="mobile" name="mobile" value="" class="form-control"  placeholder="Enter Mobile"/> --}}
                            <span style="color: red;" id="mobilevalidate"></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="hidden" name="countrycode" id="countrycode" value="" />
            <input type="hidden" name="edit_userid" id="edit_userid" value="{{ $user_data->id }}" />
            <button type="submit" name="save" id="save" class="btn btn-primary mr-2">Submit</button>
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
    $( document ).ready(function() {
        // Initialize InputMask
        $('input').inputmask();
        $('#mobile').mask('0000 000 000');
        $("#mobile").CcPicker();

        $("#mobile").CcPicker("setCountryByPhoneCode","{{ $mobilecode }}");
        //$("#mobile").CcPicker("setCountryByCode","in");
        $("#mobile").on("countrySelect", function(e, i){
                $("#countrycode").val(i.phoneCode);
                //alert(i.countryName + " " + i.phoneCode);
        });
        var dval = $(".cc-picker-code").text();
        $("#countrycode").val(dval);

    });
</script>
<script>
    jQuery(document).ready(function () {
        KTAddUser.init();
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



    $( "#save" ).click(function() {
	    $("#update-user").validate({
            rules: {
	            name: {  required: true },
	            email: { required: true, email: true },
                mobile: { required:true, minlength:12, maxlength:12 },

	        },
	        messages: {
	            name: {  required: "Please enter the name" },
	            email: { required: "Please enter email address", email : "Please enter valid email address" },
                mobile: { required: "Please enter contact number", minlength: "Please enter valid contact number", maxlength:"Please enter valid contact number"}
	        },
		    submitHandler: function(form,event) {
			    event.preventDefault();
			    var myform = document.getElementById("update-user");
			    var formData = new FormData(myform);
			    $.ajax({
				    url: '{{ url('admin/edit/corporate-admin') }}',
				    type: "POST",
				    data:formData,
				    contentType: false,
            	    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				    cache: false,
				    processData: false,
				    success: function( response ) {
					    if(response.status == "200"){
                            //var url = $('#reset-password-close').data('redirect-url');
                            window.location.href = "{{ route('systemadmin.list')}}";
                        }else{
	                	    toastr.warning(response.message);
	            	    }
				    }
		    	});
		    }
	    });
    });
</script>
@endsection
