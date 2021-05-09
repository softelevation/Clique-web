<!DOCTYPE html>
<html lang="en" >
<!--begin::Head-->
    <head>
        <meta charset="utf-8"/>
        <title>Clique | Ragister</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Login page example"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
        <!--end::Fonts-->
        <!--begin::Page Custom Styles(used by this page)-->
        <link href="{{ asset('css/pages/login/classic/login-1.css') }}" rel="stylesheet" type="text/css"/>
        <!--end::Page Custom Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="{{ asset('css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css"/>
        <!--end::Layout Themes-->
        <link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading"  >
    <!--begin::Main-->
	    <div class="d-flex flex-column flex-root">
		    <!--begin::Login-->
            <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
                <!--begin::Aside-->
                <div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10" style="background-image: url({{ asset('media/bg/bg-4.jpg') }});">
                    <!--begin: Aside Container-->
                    <div class="d-flex flex-row-fluid flex-column justify-content-between">
                        <!--begin: Aside header-->
                        <a href="#" class="flex-column-auto text-center">
				            <img src="{{asset('frontend/images/footer-logo.svg')}}" class="" alt=""/>
			            </a>
                        <!--end: Aside header-->
                        <!--begin: Aside content-->
                        <div class="flex-column-fluid d-flex flex-column justify-content-center">
                            <h3 class="font-size-h1 mb-5 text-white">Welcome to Clique!</h3>
                            <p class="font-weight-lighter text-white opacity-80">
                                Try a new way to connect with other people and friends.
                            </p>
                        </div>
                        <!--end: Aside content-->
                    <!--begin: Aside footer for desktop-->
                    <div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
                        <div class="opacity-70 font-weight-bold	text-white">
                            &copy; 2020 Clique
                        </div>
                        {{-- <div class="d-flex">
                            <a href="#" class="text-white">Privacy</a>
                            <a href="#" class="text-white ml-10">Legal</a>
                            <a href="#" class="text-white ml-10">Contact</a>
                        </div> --}}
                    </div>
                    <!--end: Aside footer for desktop-->
                </div>
                <!--end: Aside Container-->
            </div>
            <!--begin::Aside-->

    <!--begin::Content-->
    <div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden">
        <!--begin::Content header-->
        <div class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">

            <a href="{{ url('login') }}" class="font-weight-bold ml-2" id="kt_login_signup123">Login</a>
        </div>
        <!--end::Content header-->

        <!--begin::Content body-->
        <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">


            <!--begin::Signup-->
            <div class="login-form">
                <div class="text-center mb-10 mb-lg-8">
                    <h3 class="font-size-h1">Sign Up</h3>
                    <p class="text-muted font-weight-bold">Enter your detail with the company’s information to register your Corporate account.</p>
                </div>
                <div id="msg_done" class="mb-8" style="color: green;"></div>
                <!--begin::Form-->
                <form class="form" name="add-corporate" id="add-corporate" action="" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input type="text" id="name" name="corporate_name" id="corporate_name" value="" class="form-control"  placeholder="Corporate Name"/>
                    </div>
                    <div class="form-group">
                        <textarea id="address" name="address" class="form-control" placeholder="Address"></textarea>

                    </div>
                    <div class="form-group">
                        <input type="text" id="contact_person" name="contact_person" value="" class="form-control"  placeholder="Contact person"/>
                    </div>
                    <div class="form-group">
                        <input type="text" id="email" name="email" value="" class="form-control"  placeholder="Email"/>
                    </div>

                    <div class="form-group">
                        <input type="text" id="phone" name="phone" value="" class="form-control"  placeholder="Phone Number"/>
                    </div>
                    <div class="form-group d-flex flex-wrap flex-center">
                        <button type="submit" id="save" name="save" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Send Request</button>
                        <button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-4">Cancel</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Signup-->

            <!--begin::Forgot-->
            <div class="login-form login-forgot">
                <div class="text-center mb-10 mb-lg-20">
                    <h3 class="font-size-h1">Forgotten Password ?</h3>
                    <p class="text-muted font-weight-bold">Enter your email to reset your password</p>
                </div>

                <!--begin::Form-->
                <form class="form" novalidate="novalidate" id="kt_login_forgot_form">
                    <div class="form-group">
                        <input class="form-control form-control-solid h-auto py-5 px-6" type="email" placeholder="Email" name="email" autocomplete="off"/>
                    </div>
                    <div class="form-group d-flex flex-wrap flex-center">
                        <button type="button" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Submit</button>
                        <button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-4">Cancel</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Forgot-->
        </div>
        <!--end::Content body-->

		<!--begin::Content footer for mobile-->
		<div class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">
			<div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">
				&copy; 2020 Clique
			</div>
			<div class="d-flex order-1 order-sm-2 my-2">
				<a href="#" class="text-dark-75 text-hover-primary">Privacy</a>
				<a href="#" class="text-dark-75 text-hover-primary ml-4">Legal</a>
				<a href="#" class="text-dark-75 text-hover-primary ml-4">Contact</a>
			</div>
		</div>
		<!--end::Content footer for mobile-->
    </div>
    <!--end::Content-->
</div>
<!--end::Login-->
	</div>
<!--end::Main-->


        <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
        <!--begin::Global Config(global config for global JS scripts)-->
        <script>
            var KTAppSettings = {
    "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1400
    },
    "colors": {
        "theme": {
            "base": {
                "white": "#ffffff",
                "primary": "#3699FF",
                "secondary": "#E5EAEE",
                "success": "#1BC5BD",
                "info": "#8950FC",
                "warning": "#FFA800",
                "danger": "#F64E60",
                "light": "#E4E6EF",
                "dark": "#181C32"
            },
            "light": {
                "white": "#ffffff",
                "primary": "#E1F0FF",
                "secondary": "#EBEDF3",
                "success": "#C9F7F5",
                "info": "#EEE5FF",
                "warning": "#FFF4DE",
                "danger": "#FFE2E5",
                "light": "#F3F6F9",
                "dark": "#D6D6E0"
            },
            "inverse": {
                "white": "#ffffff",
                "primary": "#ffffff",
                "secondary": "#3F4254",
                "success": "#ffffff",
                "info": "#ffffff",
                "warning": "#ffffff",
                "danger": "#ffffff",
                "light": "#464E5F",
                "dark": "#ffffff"
            }
        },
        "gray": {
            "gray-100": "#F3F6F9",
            "gray-200": "#EBEDF3",
            "gray-300": "#E4E6EF",
            "gray-400": "#D1D3E0",
            "gray-500": "#B5B5C3",
            "gray-600": "#7E8299",
            "gray-700": "#5E6278",
            "gray-800": "#3F4254",
            "gray-900": "#181C32"
        }
    },
    "font-family": "Poppins"
};
        </script>
        <!--end::Global Config-->

    	<!--begin::Global Theme Bundle(used by all pages)-->
    	    	   <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
		    	   <script src="{{ asset('plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
		    	   <script src="{{ asset('js/scripts.bundle.js') }}"></script>
				<!--end::Global Theme Bundle-->


                    <!--begin::Page Scripts(used by this page)-->
                            <script src="{{ asset('js/pages/custom/login/login-general.js') }}"></script>
                        <!--end::Page Scripts-->
                    <script src="{{ asset('js/custom.js') }}"></script>
                    <script src="{{asset('frontend/js/jquery.validate.js')}}"></script>

                    <script>

                        $( "#kt_login_signup_cancel" ).click(function() {
                            window.location.href = "{{ url('login')}}";
                        });


                        $(document).ready(function(){
                            $('#add-corporate')[0].reset();
                        });

                        $( "#save" ).click(function() {
                            $("#mobilevalidate").text("");
                            $("#add-corporate").validate({
                                rules: {
                                    corporate_name: {  required: true },
                                    address: {  required: true },
                                    contact_person:{required: true},
                                    email: { required: true, email: true },
                                    phone: { required:true, minlength:10, maxlength:10 },

                                },
                                messages: {
                                    corporate_name: {  required: "Please enter Corporate Name" },
                                    contact_person: {  required: "Please enter Contact Person" },
                                    address: {  required: "Please enter the Address" },
                                    email: { required: "Please enter email address", email : "Please enter valid email address" },
                                    phone: { required: "Please enter contact number", minlength: "Please enter valid contact number", maxlength:"Please enter valid contact number"},
                                },
                                submitHandler: function(form,event) {
                                    event.preventDefault();
                                    var myform = document.getElementById("add-corporate");
                                    var formData = new FormData(myform);
                                    $.ajax({
                                        url: '{{ url('corporate-register') }}',
                                        type: "POST",
                                        data:formData,
                                        contentType: false,
                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                        cache: false,
                                        processData: false,
                                        success: function( response ) {
                                            if(response.status == "200"){
                                               $("#msg_done").text(response.message);
                                               $('#add-corporate')[0].reset();
                                            }
                                        }
                                    });
                                }
                            });
                        });
                    </script>






            </body>
    <!--end::Body-->
</html>




