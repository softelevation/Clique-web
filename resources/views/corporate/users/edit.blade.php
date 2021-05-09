{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom user-list-view">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Users List
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>
    </div>
    <div class="card-body">
        <div class="container">
			<div class="row">
	            <div class="col-md-8">

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="text-left"><i class="flaticon2-photo-camera"></i>Photo:</label>
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

                    <div class="form-group">
                        <label><i class="fas fa-user"></i>User</label>
                        <div class="designation user-info"><i class="fas fa-user"></i>{{$user_data->name}}</div>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i>Email</label>
                        <div class="designation user-info"><i class="fas fa-envelope"></i>{{$user_data->email}}</div>
                    </div>

                    <div class="form-group">
						<label><i class="fas fa-briefcase"></i>Job Position</label>
						<div class="designation user-info"><i class="fas fa-briefcase"></i></div>
                    </div>
                    <div class="form-group">
                        <label><i class="flaticon2-file"></i>Resume</label>
                        <div class="designation user-info">
                           <?php  $file_path = asset('storage'.$profiledata->resume_file); ?>
                          @if($file_path) 
                          <a href="{{$file_path}}" target="_blank"><i class="far fa-file-pdf"></i>Download resume</a>
                           @endif
                        </div>
                        <div class="designation user-info">
                         <i class="far fa-file-pdf"></i>{{$profiledata->resume_link}}
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="exampleTextarea"><i class="far fa-file-alt"></i>Bio</label>
                        <textarea class="form-control" id="exampleTextarea" rows="8">{{$profiledata->bio}}</textarea>
                    </div>
                </div>
                <div class="col-md-8">
                     <div class="form-group">
                        <label><i class="socicon-sharethis"></i>Social Networks</label>
                        <?php foreach ($socialdata as $key => $value) { ?>
                        @if($value['media_type'] == "facebook" && $value['media_value'] != "")
                        <div class="designation user-info"><i class="fab fa-facebook"></i>{{$value['media_value']}}</div>
                        @endif
                        @if($value['media_type'] == "linkdin" && $value['media_value'] != "")
                        <div class="designation user-info"><i class="fab fa-linkedin"></i>{{$value['media_value']}}</div>
                        @endif
                        @if($value['media_type'] == "twitter" && $value['media_value'] != "") 
                        <div class="designation user-info"><i class="fab fa-twitter"></i>{{$value['media_value']}}</div>
                        @endif
                        @if($value['media_type'] == "youtube" && $value['media_value'] != "")
                        <div class="designation user-info"><i class="fab fa-youtube"></i>{{$value['media_value']}}</div>
                        @endif
                        
                         @if($value['media_type'] == "instagram" && $value['media_value'] != "")
                        <div class="designation user-info"><i class="fab fa-instagram"></i>{{$value['media_value']}}</div>
                        @endif
                        
                         @if($value['media_type'] == "socialMail" && $value['media_value'] != "")
                        <div class="designation user-info"><i class="fa fa-envelope"></i>{{$value['media_value']}}</div>
                        @endif
                        
                        <?php } ?>
                        
                        <?php foreach ($socialdata as $key => $value) { ?>
                        @if($value['media_type'] == "website" && $value['media_value'] != "")
                        <div class="designation user-info"><i class="fa fa-life-ring"></i>{{$value['media_value']}}</div>
                        @endif
                        <?php } ?>
                        
                        <?php foreach ($socialdata as $key => $value) { ?>
                        @if($value['media_type'] == "homeNumber" && $value['media_value'] != "")
                        <div class="designation user-info">
                            <i class="flaticon-whatsapp"></i>{{$value['media_value']}}
                        </div>
                        @endif
                        @if($value['media_type'] == "workNumber" && $value['media_value'] != "")
                        <div class="designation user-info">
                            <i class="flaticon-whatsapp"></i>{{$value['media_value']}}
                        </div>
                        @endif 
                        @if($value['media_type'] == "otherNumber")
                        <div class="designation user-info">
                            <i class="flaticon-whatsapp"></i>{{$value['media_value']}}
                        </div>
                        @endif 
                         <?php } ?>
                        
                    </div>
                    <div class="form-group">
						<label><i class="fas fa-music"></i>Music</label>
						<?php foreach ($socialdata as $key => $value) { ?>
						 @if($value['media_type'] == "music" && $value['media_value'] != "")
						<div class="designation user-info">
                          <i class="fas fa-music"></i>{{$value['media_value']}}
                        </div>
                         @endif
                         <?php } ?>
                    </div>
                    <div class="form-group">
						<label><i class="fas fa-wallet"></i>Payment</label>
						<?php foreach ($socialdata as $key => $value) { ?>
						 @if($value['media_type'] == "payment" && $value['media_value'] != "")
                        <div class="designation user-info">
                          <i class="fas fa-wallet"></i>{{$value['media_value']}}
                        </div>
                       @endif
                         <?php } ?>
                    </div>
                    <div class="form-group">
						<label><i class="fas fa-link"></i>External Links<span class="text-danger">*</span></label>
							<?php foreach ($socialdata as $key => $value) { ?>
						 @if($value['media_type'] == "externalLink" && $value['media_value'] != "")
						<div class="designation user-info">
                          <i class="fas fa-link"></i>{{$value['media_value']}}
                        </div>
                         @endif
                         <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        $('#update-user')[0].reset();
    });

    if($("#update-user").length > 0) {
	    $("#update-user").validate({
            rules: {
	            name: {  required: true },
                email: { required: true, email: true }
            },
	        messages: {
	            name: {  required: "Please enter the name" },
	            email: { required: "Please enter email address", email : "Please enter valid email address" },
            },
		    submitHandler: function(form,event) {
			    event.preventDefault();
			    var myform = document.getElementById("update-user");
			    var formData = new FormData(myform);
			    $.ajax({
				    url: '{{ url('admin/update-user') }}',
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
