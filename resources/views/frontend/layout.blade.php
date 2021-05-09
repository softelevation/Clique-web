<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Clique - @yield('title')</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link href="{{asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">
    <script>
        var frontUrl = '{{url('/')}}';
    </script>

	@yield('style')
</head>
<body>
    <!--************************************
			Wrapper Start
	*************************************-->
	    @include('frontend.partials.header')

		@yield('contents')

		@include('frontend.partials.footer')


    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.validate.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('frontend/js/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>


@yield('script')

</body>

</html>





