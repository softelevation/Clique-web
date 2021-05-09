{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Edit Company
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>

    </div>
    <form class="form" name="edit-company" id="edit-company" action="" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <div class=" container ">
			<div class="row">
	            <div class="col-md-6">
                    <div class="form-group ">
						<label>Title <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" value="{{$companydata->name}}" class="form-control"  placeholder="Enter Comapny name"/>
                    </div>
	            </div>
                <div class="col-md-6">
                    <div class="form-group">
						<label>Email <span class="text-danger">*</span></label>
						<input type="email" name="email" id="email" value="{{$companydata->email}}" class="form-control"  placeholder="Enter Email"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
						<label for="exampleTextarea">Description <span class="text-danger"></span></label>
						<textarea class="form-control" id="description" name="description" rows="3">{{$companydata->description}}</textarea>
					</div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
						<label for="exampleTextarea">Address <span class="text-danger"></span></label>
						<textarea class="form-control" id="address" name="address" rows="3">{{$companydata->address}}</textarea>
					</div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
						<label>Website <span class="text-danger"></span></label>
						<input type="text" id="website" name="website" value="{{$companydata->website}}" class="form-control"  placeholder="Enter Website"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
						<label>Phone <span class="text-danger"></span></label>
						<input type="text" id="phone" name="phone" value="{{$companydata->phone}}" class="form-control"  placeholder="Enter Phone"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label class="col-xl-4 col-lg-3 col-form-label text-left">Photo:</label>
                            <div class="col-lg-8 col-xl-9">
                                <div class="image-input image-input-outline" id="kt_user_add_avatar">
                                    @if($companydata->logo == '/user/default.png')
                                    <?php  $storage_path = asset('media/users/blank.png'); ?>
                                    @else
                                    <?php  $storage_path = asset('storage'.$companydata->logo) ?>
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
                            <!--<input type="file" class="form-control-file form-control" style="padding: 5px;" name="avatar" id="avatarFile" aria-describedby="fileHelp">-->
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="card-footer">
        <input type="hidden" id="edit_companyid" name="edit_companyid" value="{{$companydata->id}}">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
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
        // Private Variables
        var _avatar;

        var _initAvatar = function () {
            _avatar = new KTImageInput('kt_user_add_avatar');
        }

        return {
            // public functions
            init: function () {
                _initAvatar();
            }
        };
    }();

    jQuery(document).ready(function () {
        KTAddUser.init();
    });


    $(document).ready(function(){
  $('#edit-company')[0].reset();
});

if($("#edit-company").length > 0) {
	$("#edit-company").validate({

	    rules: {
	       name: {  required: true },
	       email: { required: true, email: true }

	    },
	    messages: {
	       name: {  required: "Please enter the title" },
	       email: { required: "Please enter email address", email : "Please enter valid email address" },
	      },
		submitHandler: function(form,event) {
			event.preventDefault();
			var myform = document.getElementById("edit-company");
			var formData = new FormData(myform);
			$.ajax({
				url: '{{ url('admin/update-comapny') }}',
				type: "POST",
				data:formData,
				contentType: false,
            	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				cache: false,
				processData: false,
				success: function( response ) {
					if(response.status == "200"){

                        //var url = $('#reset-password-close').data('redirect-url');
                    window.location.href = "{{ route('company.list')}}";

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
