@extends('frontend.layout')
@section('title')
Place order
@endsection

@section('contents')
<section id="about-banner" class="clearfix">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mt-md-5 pt-md-5">
          <h1>Place Order</h1>
          <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet enim elementum.</h4>
        </div>
        <div class="col-md-6">
          <img src="{{asset('frontend/images/contact-us.png')}}" class="img-fluid">
        </div>
      </div>
    </div>
</section>

<section id="How-can-we-help" class="grey-bg clearfix py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="how-can-help-bg">
                    <div class="lets-talk mb-2">Let’s Talk!</div>
                    <h3 class="mb-3">How can we help you?</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Velit in aliquet felis at ullamcorper in eu pellentesque.</p>
                </div>
            </div>
            <div class="col-md-6" id="formorder">
                <form class="form" name="add-order" id="add-order" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                            <span id="success-msg"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="yourName">Full Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Full Name">
                            </div>
                        </div>
                        <!--<div class="col-md-6">-->
                        <!--    <div class="form-group">-->
                        <!--        <label for="yourName">Last Name</label>-->
                        <!--        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="yourEmail1">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="yourEmail1">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="amount" name="amount" value="100" />
                    <div class="form-group">
                        <label for="yourEmail1">Qty</label>
                        <input type="text" class="form-control" id="qty" name="qty" value="1" placeholder="Qty">
                    </div>
                    <div class="form-group">
                        <label for="yourEmail1">Delivery address</label>
                        <textarea class="form-control" id="address1" name="address1" rows="3" placeholder="Delivery address"></textarea>
                    </div>
                    <!--<div class="form-group">-->
                    <!--    <label for="yourEmail1">Shipping Address</label>-->
                    <!--    <textarea class="form-control" id="address2" name="address2" rows="3" placeholder="Write here your message"></textarea>-->
                    <!--</div>-->
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Country</label>
                        <select class="form-control" id="country" name="country">
                                <option value="">Choose...</option>
	                           @foreach($countries as $c)
	                           <option value="{{ $c->id }}">{{ $c->name }}</option>
	                           @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="yourEmail1">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="State">
                    </div>
                    <div class="form-group">
                        <label for="yourEmail1">Pin Code</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Pincode">
                    </div>
                    <input type="submit" id="orderclick" name="orderclick" class="btn btn-primary btn-lg pl-5 pr-5" value="Submit"/>
                </form>
            </div>
        </div>
    </div>
</section>

<section id="benefits-of-clique-card" class="clearfix py-5 mb-5">
    <div class="container">
        <h2 class="text-center">Frequently Asked Questions</h2>
        <!--Accordion wrapper-->
        <div class="accordion md-accordion mt-md-5" id="accordionEx" role="tablist" aria-multiselectable="true">
        <!-- Accordion card -->
        <div class="card">
        <!-- Card header -->
            <div class="card-header" role="tab" id="headingOne1">
                <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
          aria-controls="collapseOne1">
                    <h5 class="mb-0">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit? <i class="fas fa-plus rotate-icon"></i>
                    </h5>
                </a>
            </div>
            <!-- Card body -->
            <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget molestie sed orci, facilisis quis. Vel tortor nibh posuere phasellus dui. Sit dolor sagittis aliquam luctus vitae quam lorem et magnis. In elementum sed proin lobortis vestibulum risus id fringilla pulvinar. Sit sagittis ipsum iaculis sapien ultricies.
                </div>
            </div>
        </div>
    <!-- Accordion card -->

    <!-- Accordion card -->
    <div class="card">

      <!-- Card header -->
      <div class="card-header" role="tab" id="headingTwo2">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
          aria-expanded="false" aria-controls="collapseTwo2">
          <h5 class="mb-0">
           Lorem ipsum dolor sit amet, consectetur adipiscing elit?<i class="fas fa-plus rotate-icon"></i>
          </h5>
        </a>
      </div>

      <!-- Card body -->
      <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
        data-parent="#accordionEx">
        <div class="card-body">
           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget molestie sed orci, facilisis quis. Vel tortor nibh posuere phasellus dui. Sit dolor sagittis aliquam luctus vitae quam lorem et magnis. In elementum sed proin lobortis vestibulum risus id fringilla pulvinar. Sit sagittis ipsum iaculis sapien ultricies.
        </div>
      </div>

    </div>
    <!-- Accordion card -->

    <!-- Accordion card -->
    <div class="card">

      <!-- Card header -->
      <div class="card-header" role="tab" id="headingThree3">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
          aria-expanded="false" aria-controls="collapseThree3">
          <h5 class="mb-0">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit? <i class="fas fa-plus rotate-icon"></i>
          </h5>
        </a>
      </div>

      <!-- Card body -->
      <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
        data-parent="#accordionEx">
        <div class="card-body">
           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget molestie sed orci, facilisis quis. Vel tortor nibh posuere phasellus dui. Sit dolor sagittis aliquam luctus vitae quam lorem et magnis. In elementum sed proin lobortis vestibulum risus id fringilla pulvinar. Sit sagittis ipsum iaculis sapien ultricies.
        </div>
      </div>

    </div>
    <!-- Accordion card -->

    <!-- Accordion card -->
    <div class="card">

      <!-- Card header -->
      <div class="card-header" role="tab" id="headingThree4">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree4"
          aria-expanded="false" aria-controls="collapseThree3">
          <h5 class="mb-0">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit? <i class="fas fa-plus rotate-icon"></i>
          </h5>
        </a>
      </div>

      <!-- Card body -->
      <div id="collapseThree4" class="collapse" role="tabpanel" aria-labelledby="headingThree4"
        data-parent="#accordionEx">
        <div class="card-body">
           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget molestie sed orci, facilisis quis. Vel tortor nibh posuere phasellus dui. Sit dolor sagittis aliquam luctus vitae quam lorem et magnis. In elementum sed proin lobortis vestibulum risus id fringilla pulvinar. Sit sagittis ipsum iaculis sapien ultricies.
        </div>
      </div>

    </div>
    <!-- Accordion card -->

    <!-- Accordion card -->
    <div class="card">

      <!-- Card header -->
      <div class="card-header" role="tab" id="headingThree5">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree5"
          aria-expanded="false" aria-controls="collapseThree3">
          <h5 class="mb-0">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit? <i class="fas fa-plus rotate-icon"></i>
          </h5>
        </a>
      </div>

      <!-- Card body -->
      <div id="collapseThree5" class="collapse" role="tabpanel" aria-labelledby="headingThree5"
        data-parent="#accordionEx">
        <div class="card-body">
           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget molestie sed orci, facilisis quis. Vel tortor nibh posuere phasellus dui. Sit dolor sagittis aliquam luctus vitae quam lorem et magnis. In elementum sed proin lobortis vestibulum risus id fringilla pulvinar. Sit sagittis ipsum iaculis sapien ultricies.
        </div>
      </div>

    </div>
    <!-- Accordion card -->

  </div>
  <!-- Accordion wrapper -->
      </div>
  </section>

  {{-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ordersuccess">Open Modal</button> --}}

 <!-- Modal -->
 <div class="modal fade" id="ordersuccess" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-content">
        {{-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div> --}}
        <div class="modal-body" style="margin-top: 38px;">
          <center><h3>Your Order placed Successfully </h3></center>
          <center><img class="ordersuccessModel" src="{{asset('media/svg/icons/Navigation/Check.svg')}}"/></center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <input type="hidden" id="odid" name="odid" value="" />


 


@endsection

{{-- Scripts Section --}}
@section('script')

<script type="text/javascript">
$("#orderclick" ).click(function() {
	$("#add-order").validate({
        rules: {
          firstname: {  required: true },
          email: { required: true, email: true },
          phone: { required: true, number: true, minlength:10, maxlength:10},
          amount: {  required: true },
          qty: {  required: true },
          address1: {  required: true },
          //address2: {  required: true },
          country: {  required: true },
          state: {  required: true },
          postcode: {  required: true }

	    },
	    messages: {
           firstname: {  required: "Please enter full name" },
           email: { required: "Please enter email address", email : "Please enter valid email address" },
           phone: {  required: "Please enter phone number" },
           amount: {  required: "Please enter amount" },
           address1: {  required: "Please enter delivery address" },
          // address2: {  required: "Please select Shipping address" },
           qty: {  required: "Please enter qty" },
           country: {  required: "Please select country" },
           state: {  required: "Please enter state" },
           postcode: {  required: "Please enter pincode" },
	      },
		submitHandler: function(form,event) {
			event.preventDefault();
			var myform = document.getElementById("add-order");
			var formData = new FormData(myform);
			$.ajax({
				url: '{{ url('place-order') }}',
				type: "POST",
				data:formData,
				contentType: false,
            	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				cache: false,
				processData: false,
				success: function( response ) {
                    if(response.status == "200"){
                        $("#ordersuccess").modal('show');
                        $("#odid").val(response.order_id);
                    }else{
	                	//toastr.warning(response.message);
	            	}
				}
			});
		}
	});
});

$("#ordersuccess").on("hidden.bs.modal", function () {
    $orderid = $("#odid").val();
    var url = '{{ url('order/thank-you/') }}'+ '/' + $orderid;
    window.location = url;
});
</script>
@endsection

