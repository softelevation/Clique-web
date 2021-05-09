{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Create Order
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>
    </div>
    <form class="form" name="add-order" id="add-order" action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class=" container ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" id="firstname" name="firstname" value="" class="form-control"  placeholder="First Name"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" id="lastname" name="lastname" value="" class="form-control"  placeholder="Last Name"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" value="" class="form-control"  placeholder="Enter Email"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>phone <span class="text-danger">*</span></label>
                            <input type="text" id="phone" name="phone" value="" class="form-control"  placeholder="Phone"/>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleTextarea">Billing Address <span class="text-danger"></span></label>
                            <textarea class="form-control" id="address1" name="address1" rows="3" placeholder="Billing Address"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleTextarea">Shipping Address <span class="text-danger"></span></label>
                            <textarea class="form-control" id="address2" name="address2" rows="3" placeholder="Shipping Address"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>Qty <span class="text-danger">*</span></label>
                            <input type="text" id="qty" name="qty" value="" class="form-control"  placeholder="Enter Qty"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Country</label>
                            <select class="form-control" id="country" name="country">
                                    <option value="">Choose...</option>
                                   @foreach($countries as $c)
                                   <option value="{{ $c->id }}">{{ $c->name }}</option>
                                   @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>State <span class="text-danger"></span></label>
                            <input type="text" id="state" name="state" value="" class="form-control"  placeholder="State"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Zip Code <span class="text-danger"></span></label>
                            <input type="text" id="postcode" name="postcode" value="" class="form-control"  placeholder="Zip Code"/>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" id="orderclick" class="btn btn-primary mr-2">Submit</button>
        </div>
    </form>
</div>

<button type="button" class="btn btn-light-primary font-weight-bold" id="kt_sweetalert_demo_new">Show me</button>

@endsection
{{-- Styles Section --}}
@section('styles')
@endsection
{{-- Scripts Section --}}
@section('scripts')
<script src="{{asset('js/pages/features/miscellaneous/sweetalert2.js')}}"></script> --}}
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

    // $(document).ready(function(){
    //      $('#add-page')[0].reset();
    // });

    $("#orderclick" ).click(function() {
	$("#add-order").validate({
        rules: {
          firstname: {  required: true },
          lastname: {  required: true },
          email: { required: true, email: true },
          phone: { required: true },
          amount: {  required: true },
          qty: {  required: true },
          address1: {  required: true },
          address2: {  required: true },
          country: {  required: true },
          state: {  required: true },
          postcode: {  required: true }

	    },
	    messages: {
           firstname: {  required: "Please enter First name" },
           lastname: {  required: "Please enter Last name" },
           email: { required: "Please enter email address", email : "Please enter valid email address" },
           phone: {  required: "Please enter Phone number" },
           amount: {  required: "Please enter Amount" },
           address1: {  required: "Please select Billing address" },
           address2: {  required: "Please select Shipping address" },
           qty: {  required: "Please select Qty" },
           country: {  required: "Please select country" },
           state: {  required: "Please select State" },
           postcode: {  required: "Please enter postcode" },
	      },
		submitHandler: function(form,event) {
			event.preventDefault();
			var myform = document.getElementById("add-order");
			var formData = new FormData(myform);
			$.ajax({
				url: '{{ url('admin/corporate/placeorder') }}',
				type: "POST",
				data:formData,
				contentType: false,
            	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				cache: false,
				processData: false,
				success: function( response ) {
                    if(response.status == "200"){
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Order has been successfully created.",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.location.href = "{{ route('admin/corporate/orders/list')}}";
                    }else{
	                	//toastr.warning(response.message);
	            	}
				}
			});
		}
	});
});
</script>
@endsection
