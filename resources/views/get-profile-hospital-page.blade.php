<!DOCTYPE html>
<html lang="en" >
<!--begin::Head-->
    <head>
        <meta charset="utf-8"/>
        <title>Clique | Hospital</title>
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
		<style>
		.row{margin-top: 2px;}
		</style>
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
                       
						<a href="#" class="flex-column-auto text-center">
				            <img src="{{asset('frontend/images/footer-logo.svg')}}" class="" alt=""/>
                        </a>
                        <div class="flex-column-fluid d-flex flex-column justify-content-center">
                            <img src="{{asset($user_image)}}" class="hospital-user-image" style="width: 310px;height: 230px;border-radius: 20px;" alt=""/>
                        </div>
						
                    <!--end: Aside footer for desktop-->
                </div>
                <!--end: Aside Container-->
            </div>
            <!--begin::Aside-->

    <!--begin::Content-->
    <div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden">
        <!--begin::Content body-->
        <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
            <!--begin::Signin-->
            <div class="login-form login-signin">
                <div class="text-center mb-10 mb-lg-20">
                    <h3 class="font-size-h1">Hospital</h3>
                    <!--p class="text-muted font-weight-bold">This is hospital</p-->
                </div>

                <!--begin::Form-->
					<div class="row">
						<div class="col-md-3">
							Name: 
						</div>
						<div class="col-md-9">
							<span class="form-control">{{$icone_socials->start_name.' '.$icone_socials->first_name.' '.$icone_socials->last_name}}</span>
						</div>
                    </div>
					<div class="row">
						<div class="col-md-3">
							Mobile no: 
						</div>
						<div class="col-md-9">
							<span class="form-control">{{$icone_socials->mobile_no}}</span>
						</div>
                    </div>
					<div class="row">
						<div class="col-md-3">
							Landline: 
						</div>
						<div class="col-md-9">
							<span class="form-control">{{$icone_socials->landline}}</span>
						</div>
                    </div>
					<div class="row">
						<div class="col-md-3">
							Personal id: 
						</div>
						<div class="col-md-9">
							<span class="form-control">{{$icone_socials->personal_id}}</span>
						</div>
                    </div>
					<div class="row">
						<div class="col-md-3">
							Age: 
						</div>
						<div class="col-md-9">
							<span class="form-control">{{$icone_socials->age}}</span>
						</div>
                    </div>
					<div class="row">
						<div class="col-md-3">
							Date of birth:
						</div>
						<div class="col-md-9">
							<span class="form-control">{{$icone_socials->date_of_birth}}</span>
						</div>
                    </div>
					<div class="row">
						<div class="col-md-3">
							Sex: 
						</div>
						<div class="col-md-9">
							<span class="form-control">{{$icone_socials->sex}}</span>
						</div>
                    </div>
					<div class="row">
						<div class="col-md-3">
							Marital status: 
						</div>
						<div class="col-md-9">
							<span class="form-control">{{$icone_socials->marital_status}}</span>
						</div>
                    </div>
					<div class="row">
						<div class="col-md-3">
							Email id: 
						</div>
						<div class="col-md-9">
							<span class="form-control">{{$icone_socials->email_id}}</span>
						</div>
                    </div>
					<div class="row">
						<div class="col-md-3">
							Address: 
						</div>
						<div class="col-md-9">
							<span class="form-control">{{$icone_socials->address}}</span>
						</div>
                    </div>
                    
                <!--end::Form-->
            </div>
            <!--end::Signin-->

        </div>
        <!--end::Content body-->
    </div>
    <!--end::Content-->
</div>
<!--end::Login-->
	</div>
<!--end::Main-->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!--begin::Global Config(global config for global JS scripts)-->
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
