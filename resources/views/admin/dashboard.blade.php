{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}

<!--Begin::Row-->
<div class="row">
    <div class="col-xl-3">
        <a href="{{ url('admin/users/list') }}" class="card card-custom bg-radial-gradient-danger card-stretch gutter-b">
    		<div class="card-body">
        		<span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg>
                </span>
				<div class="text-inverse-danger font-weight-bolder font-size-h5 mb-2 mt-5">Clique Users</div>
        		<div class="font-weight-bold text-inverse-danger font-size-h1">{{$user_count}}</div>
    		</div>
    	</a>
    </div>
    <div class="col-xl-3">
        <a href="" class="card card-custom bg-radial-gradient-primary card-stretch gutter-b">
            <div class="card-body">
                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"/>
                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                </span>
                <div class="text-inverse-primary font-weight-bolder font-size-h5 mb-2 mt-5">Corporate Users</div>
                <div class="font-weight-bold text-inverse-primary font-size-h1">{{$corporate_count}}</div>
            </div>
        </a>
    </div>
    <div class="col-xl-3">
        <a href="{{ url('admin/card/list') }}" class="card card-custom bg-radial-gradient-warning card-stretch gutter-b">
            <div class="card-body">
                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"/>
                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"/>
                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"/>
                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"/>
                        </g>
                    </svg>
                </span>
                <div class="text-inverse-success font-weight-bolder font-size-h5 mb-2 mt-5">Active subscription</div>
                <div class="font-weight-bold text-inverse-success font-size-h1">{{$subcription_count}}</div>
            </div>
        </a>
    </div>
    <div class="col-xl-3">
        <a href="{{ url('admin/orders/list') }}" class="card card-custom bg-radial-gradient-info card-stretch card-stretch gutter-b">
            <div class="card-body">
                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000"/>
                        </g>
                    </svg>
                </span>
                <div class="text-inverse-info font-weight-bolder font-size-h5 mb-2 mt-5">Open Order</div>
                <div class="font-weight-bold text-inverse-info font-size-h1">{{$order_count}}</div>
            </div>
        </a>
    </div>
</div>
<!--End::Row-->
@endsection
{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
