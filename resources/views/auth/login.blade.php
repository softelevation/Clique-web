<!DOCTYPE html>
<html lang="en" >
<!--begin::Head-->
    <head>
        <meta charset="utf-8"/>
        <title>Clique | Login</title>
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
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
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


                        <div class="flex-column-fluid d-flex flex-column justify-content-center">
                            <img src="{{asset('frontend/images/grow-your-network.png')}}" class="" style="width: 310px;height: 230px;" alt=""/>
                        </div>


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
            <span class="font-weight-bold text-dark-50">Dont have an account yet?</span>
            <a href="{{ route('company-register') }}" class="font-weight-bold ml-2" id="kt_login_signup123">Sign Up!</a>
        </div>
        <!--end::Content header-->

        <!--begin::Content body-->
        <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
            <!--begin::Signin-->
            <div class="login-form login-signin">
                <div class="text-center mb-10 mb-lg-20">
                    <h3 class="font-size-h1">Sign In</h3>
                    <p class="text-muted font-weight-bold">Enter your Email and password</p>
                </div>

                <!--begin::Form-->
                <form class="login-form-new" action="{{ route('login') }}"  onsubmit="return false;"  method="POST" name="contact-form" id="kt_login_signin_form">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form-control-solid h-auto py-5 px-6 @error('email') is-invalid @enderror" type="text" placeholder="Email" name="email" id="email" value="{{ old('email') }}" autocomplete="off"/>
                        @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-solid h-auto py-5 px-6 @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" autocomplete="off"/>
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                    </div>
                    <div class="form-group error-message">
                    </div>
                    <!--begin::Action-->
                    <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                         @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-dark-50 text-hover-primary my-3 mr-2" id="">
    						Forgot Password ?
                        </a>
                        @endif
                        <input type="hidden" name="type" id="type" value="user">
                        <button type="button"  name="login" id="login" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Sign In</button>
                    </div>
                    <!--end::Action-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Signin-->

            <!--begin::Signup-->
            <div class="login-form login-signup">
                <div class="text-center mb-10 mb-lg-20">
                    <h3 class="font-size-h1">Sign Up</h3>
                    <p class="text-muted font-weight-bold">Enter your details to create your account</p>
                </div>

                <!--begin::Form-->
                <form method="POST" action="{{ route('register') }}" class="form" novalidate="novalidate" id="kt_login_signup_form">
                    @csrf

                    <div class="form-group">
                        <input class="form-control form-control-solid h-auto py-5 px-6 @error('name') is-invalid @enderror" type="text" placeholder="Name" name="name" id="name" value="{{ old('name') }}" autocomplete="off"/>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-solid h-auto py-5 px-6 @error('email') is-invalid @enderror" type="email" placeholder="Email Addaress" id="email" name="email" value="{{ old('email') }}" autocomplete="off"/>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-solid h-auto py-5 px-6 @error('password') is-invalid @enderror" type="password" placeholder="Password" id="password" name="password" autocomplete="off"/>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-solid h-auto py-5 px-6" type="password" placeholder="Confirm password" name="cpassword" autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label class="checkbox mb-0">
                            <input type="checkbox" name="agree"/>
                            <span></span>
                            I Agree the <a href="#">terms and conditions</a>
                        </label>
                    </div>
                    <div class="form-group d-flex flex-wrap flex-center">
                        <button type="button" id="kt_login_signup_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Submit</button>
                        <button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-4">Cancel</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Signup-->

           
        </div>
        <!--end::Content body-->

		<!--begin::Content footer for mobile-->
		<div class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">
			<div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">
				&copy; 2020 Metronic
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
            </body>
    <!--end::Body-->
</html>
