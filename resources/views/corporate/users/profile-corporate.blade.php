{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Mobile Toggle-->
                <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Mobile Toggle-->
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Profile</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        {{-- <li class="breadcrumb-item"><a href="" class="text-muted">Apps</a></li>
                        <li class="breadcrumb-item"><a href="" class="text-muted">Profile</a></li> --}}
                        <li class="breadcrumb-item"><a href="{{ url('admin/corporate/profile') }}" class="text-muted">Profile</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/corporate/profile') }}" class="text-muted">Personal Information</a></li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
    <!--end::Info-->
        </div>
    </div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container ">
        <!--begin::Profile Personal Information-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                <!--begin::Profile Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::User-->
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                @if($profiledata->avatar == '/user/default.png')
                                <?php  $storage_path = asset('media/users/blank.png'); ?>
                                @else
                                    <?php  $storage_path = asset('storage'.$profiledata->avatar); ?>
                                @endif
                                <div class="symbol-label" style="background-image:url({{$storage_path}})"></div>
                                <i class="symbol-badge bg-success"></i>
                            </div>
                            <div>
                                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                                    {{ $user_data->name }}
                                </a>
                                {{-- <div class="text-muted">
                                    Application Developer
                                </div> --}}

                            </div>
                        </div>
                        <!--end::User-->

                        <!--begin::Contact-->
                        <div class="py-9">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Email:</span>
                                    <a href="mailto:{{ $user_data->email }}" class="text-muted text-hover-primary">{{ $user_data->email }}</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Phone:</span>
                                <span class="text-muted">{{ $user_data->mobile }}</span>
                            </div>
                            <!--<div class="d-flex align-items-center justify-content-between">-->
                            <!--    <span class="font-weight-bold mr-2">Location:</span>-->
                            <!--    <span class="text-muted">Melbourne</span>-->
                            <!--</div>-->
                        </div>
                        <!--end::Contact-->

                        <!--begin::Nav-->
                        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                            <div class="navi-item mb-2">
                            <a  href="{{ url('admin/corporate/profile') }}" class="navi-link py-4 active">
                                    <span class="navi-icon mr-2">
                                        <span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                            </g>
                                            </svg><!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text font-size-lg">
                                            Personal Information
                                    </span>
                                </a>
                            </div>

                            <!--<div class="navi-item mb-2">-->
                            <!--    <a href="custom/apps/profile/profile-1/change-password.html" class="navi-link py-4 ">-->
                            <!--        <span class="navi-icon mr-2">-->
                            <!--            <span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-user.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
                            <!--                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
                            <!--                    <rect x="0" y="0" width="24" height="24"/>-->
                            <!--                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"/>-->
                            <!--                    <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3"/>-->
                            <!--                    <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3"/>-->
                            <!--                </g>-->
                            <!--                </svg><!--end::Svg Icon-->-->
                            <!--            </span>-->
                            <!--        </span>-->
                            <!--        <span  class="navi-text font-size-lg">-->
                            <!--            Change Password-->
                            <!--        </span>-->
                            <!--        <span class="navi-label">-->
                            <!--            {{-- <span class="label label-light-danger label-rounded font-weight-bold">5</span> --}}-->
                            <!--        </span>-->
                            <!--    </a>-->
                            <!--</div>-->
                        </div>
                        <!--end::Nav-->
                </div>
            <!--end::Body-->
            </div>
            <!--end::Profile Card-->
        </div>
<!--end::Aside-->

<!--begin::Content-->

<div class="flex-row-fluid ml-lg-8">
    <form class="form" name="update-user" id="update-user" action="" method="post" enctype="multipart/form-data">
    <!--begin::Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
            </div>
            <div class="card-toolbar">
                <button type="submit" id="update" name="update" class="btn btn-success mr-2">Save Changes</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
                <input type="hidden" name="edit_userid" id="edit_userid" value="{{ $user_data->id }}" />
                <input type="hidden" name="typeuser" id="typeuser" value="3" />
            </div>
        </div>
        <!--end::Header-->

        <!--begin::Form-->

            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mb-6">Company Info</h5>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url({{$storage_path}})">
                                <div class="image-input-wrapper" style="background-image: url({{$storage_path}})"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="profile_avatar_remove"/>
                                    </label>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                            </div>
                            <span class="form-text text-muted">Allowed file types:  png, jpg, jpeg.</span>
                        </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Company Name</label>
                        <div class="col-lg-9 col-xl-6">
                        <input class="form-control form-control-lg form-control-solid" type="text"  id="name" name="name" value="{{$user_data->name}}"/>
                            <span class="form-text text-muted"></span>
                        </div>
                </div>
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mt-10 mb-6">Contact Info</h5>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Company Address</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <textarea class="form-control" id="exampleTextarea" name="address" id="address" rows="3">{{$company->address}}</textarea>
                            </div>
                        </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                <input type="text" class="form-control form-control-lg form-control-solid" value="{{$company->phone}}" id="phone" name="phone" placeholder="Phone" readonly />
                                <span id="mobilevalidate" style="color: red;"></span>
                            </div>
                            <!--<span class="form-text text-muted">We'll never share your email with anyone else.</span>-->
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                <input type="text" class="form-control form-control-lg form-control-solid" value="{{$user_data->email}}" id="emial" name="email" placeholder="Company Email" />
                            </div>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Company Site</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="text" class="form-control form-control-lg form-control-solid" name="website" id="website" placeholder="Company website" value="{{$company->website}}"/>
                            </div>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Facebook</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="text" class="form-control form-control-lg form-control-solid" name="facebook" id="facebook" placeholder="Facebook" value="{{$company->facebook}}"/>
                            </div>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Instagram</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="text" class="form-control form-control-lg form-control-solid" name="instagram" id="instagram" placeholder="Instagram" value="{{$company->instagram}}"/>
                            </div>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Linkedin</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="text" class="form-control form-control-lg form-control-solid" name="linkedin" id="linkedin" placeholder="Linkedin" value="{{$company->linkedin}}"/>
                            </div>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Twitter</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="text" class="form-control form-control-lg form-control-solid" name="twitter" id="twitter" placeholder="Twitter" value="{{$company->twitter}}"/>
                            </div>
                        </div>
                </div>
            </div>
            <!--end::Body-->

    </div>
    </form>
</div>
<!--end::Content-->
</div>
<!--end::Profile Personal Information-->
</div>
<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->

@endsection
{{-- Styles Section --}}
@section('styles')
@endsection
{{-- Scripts Section --}}
@section('scripts')
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    jQuery(document).ready(function () {
        KTAddUser.init();
    });

    var KTAddUser = function () {
        var _avatar;
        var _initAvatar = function () {
            _avatar = new KTImageInput('kt_profile_avatar');
        }
        return {
            init: function () {
                _initAvatar();
            }
        };
    }();

    $( "#update" ).click(function() {

        $("#update-user").validate({
            rules: {
	            name: {  required: true },
	            email: { required: true, email: true },
                phone: {  required: true }

	        },
	        messages: {
	            name: {  required: "Please enter the Company name" },
	            email: { required: "Please enter Company email address", email : "Please enter valid email address" },
	            phone: {  required: "Please enter the Company phone" },
            },
		    submitHandler: function(form,event) {
			    event.preventDefault();
			    var myform = document.getElementById("update-user");
			    var formData = new FormData(myform);
			    $.ajax({
				    url: '{{ url('admin/corporate/profile') }}',
				    type: "POST",
				    data:formData,
				    contentType: false,
            	    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				    cache: false,
				    processData: false,
				    success: function( response ) {
					    if(response.status == "200"){
                            toastr.success('Profile has been updated successfully.', 'Success');

                        }else{
	                	    if(response.status == "403")
                            {
                                $("#mobilevalidate").text(response.message);
                            }
                            else{
                                //toastr.warning(response.message);
                            }

	            	    }
				    }
		    	});
		    }
	    });
    });
</script>
@endsection
