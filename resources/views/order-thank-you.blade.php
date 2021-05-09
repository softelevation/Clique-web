@extends('frontend.layout')
@section('title')
Contact Us
@endsection

@section('contents')

<section id="about-banner" class="clearfix">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mt-md-5 pt-md-5">
          <h1>Order Detail</h1>
          <h4>YOUR ORDER HAS BEEN RECEIVED</h4>
        </div>
      </div>

      <div class="container">
       <p>Thank you for your purchase!</p>
        <table class="table">
          <thead>
            <tr>
              <th>Order Number</th>
              <th>Personal detail</th>
              <th>Order Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$orderdata->order_number}}</td>
              <td>
                  Name: {{$orderdata->order_number}}<br/>
                  Email: {{$orderdata->email}}<br/>
                  Phone: {{$orderdata->phone}}<br/>
                  Address: {{$orderdata->billing_address}}<br/>
                            {{$orderdata->state,$orderdata->zip }}<br/>
                </td>
              <td>{{ $orderdata->created_at }} </td>
            </tr>

          </tbody>
        </table>
      </div>

    <p>You will receive an order confirmation email with detail of order and link to track it’s progress.
    </p>
    </div>
  </section>

  <!-- Accordion wrapper -->
      </div>
  </section>
@endsection

{{-- Scripts Section --}}
@section('script')

<script type="text/javascript">


$("#contactclick" ).click(function() {
	$("#add-contact").validate({
        rules: {
          name: {  required: true },
          email: { required: true, email: true },
          mobile_number: {  required: true },
          subject: {  required: true },
          comment: {  required: true },


	    },
	    messages: {
           name: {  required: "Please enter your name" },
           email: { required: "Please enter email address", email : "Please enter valid email address" },
           mobile_number: {  required: "Please enter Phone" },
           subject: {  required: "Please enter Subject" },
           comment: {  required: "Please enter Comment" },

	      },
		submitHandler: function(form,event) {
			event.preventDefault();
			var myform = document.getElementById("add-contact");
			var formData = new FormData(myform);
			$.ajax({
				url: '{{ url('contact-us') }}',
				type: "POST",
				data:formData,
				contentType: false,
            	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				cache: false,
				processData: false,
				success: function( response ) {

                    if(response.status == "200"){
                        //$("#success-msg").text(response.message).css("color", "green");
                        //$('html, body').animate({ scrollTop: 0 }, 'slow');
                        // $('html, body').animate({
                        //     scrollTop: $("#formcontact").offset().top
                        // }, 2000);
                        $("#getCodeModal").modal('show');
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


