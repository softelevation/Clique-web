@extends('frontend.layout')
@section('title')
Contact Us
@endsection

@section('contents')

<section id="about-banner" class="clearfix">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mt-md-5 pt-md-5">
          <h1>Contact Us</h1>
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
          <div class="col-md-6" id="formcontact">
            <form class="form" name="add-contact" id="add-contact" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <span id="success-msg"></span>
                    </div>
                <div class="form-group">
                <label for="yourName">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
              </div>
               <div class="form-group">
                <label for="yourEmail1">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
              </div>
              <div class="form-group">
                <label for="yourEmail1">Phone</label>
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Phone">
              </div>
               <div class="form-group">
                  <label for="exampleFormControlSelect1">Subject</label>
                  <input type="text" id="subject" class="form-control" name="subject" value="" placeholder="Subject"/>
                </div>
                 <div class="form-group mt-5">
                    <textarea class="form-control" id="comment" name="comment" rows="6" placeholder="Write here your message"></textarea>
                  </div>
                  <input type="submit" id="contactclick" name="contactclick" class="btn btn-primary btn-lg pl-5 pr-5" value="Submit"/>
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
      <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
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
                        $("#success-msg").text(response.message).css("color", "green");
                        //$('html, body').animate({ scrollTop: 0 }, 'slow');
                        $('html, body').animate({
                            scrollTop: $("#formcontact").offset().top
                        }, 2000);
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


