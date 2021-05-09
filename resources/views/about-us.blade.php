@extends('frontend.layout')
@section('title')
About Us
@endsection

@section('contents')

<section id="about-banner" class="clearfix py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mt-md-5 pt-md-5">
          <h1>About Us</h1>
          <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet enim elementum.</h4>
        </div>
        <div class="col-md-6">
          <img src="{{asset('frontend/images/about-header-img.png')}}" class="img-fluid">
        </div>
      </div>
    </div>
  </section>
  <section id="aboout-us" class="grey-bg clearfix py-5">
      <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-lg-6 col-lg-6 text-center text-md-left">
            <img src="{{asset('frontend/images/about-clique.png')}}" class="img-fluid">
          </div>
          <div class="col-lg-6 text-center text-md-left mt-4">
            <h2>About Clique</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit auctor risus id dui sodales.
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit auctor risus id dui sodales.</p>
          </div>
        </div>
      </div>
  </section>
  <section id="our-mission">
    <div class="container">
      <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-left order-md-1 order-2">
        <h2>Our Mission</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit auctor risus id dui sodales.
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit auctor risus id dui sodales.</p>
      </div>
      <div class="col-md-6 order-md-2 order-1">
        <img src="{{asset('frontend/images/our-mission.png')}}" class="img-fluid">
      </div>
    </div>
    </div>
  </section>
  <section id="our-values" class="grey-bg clearfix py-5">
      <div class="container">
        <h2 class="text-center">Our Values</h2>
        <div class="row my-md-5 text-center text-md-left">
          <div class="col-md-3">
            <div class="icon"><img src="{{asset('frontend/images/chat-icon.svg')}}"></div>
            <h4 class="my-3">Nec volutpat.</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
          <div class="col-md-3">
            <div class="icon"><img src="{{asset('frontend/images/chat-icon.svg')}}"></div>
            <h4 class="my-3">Auctor.</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
          <div class="col-md-3">
            <div class="icon"><img src="{{asset('frontend/images/chat-icon.svg')}}"></div>
            <h4 class="my-3">Venenatis ut.</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
          <div class="col-md-3">
            <div class="icon"><img src="{{asset('frontend/images/chat-icon.svg')}}"></div>
            <h4 class="my-3">Id libero.</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>


        </div>
      </div>
  </section>
  <section id="our-team">
    <div class="container">
      <h2 class="text-center mb-5">Our Team</h2>
      <div class="our-team-images">
  <div class="row">
          <div class="col pl-0 pr-0 text-center">
              <a href="#"><img src="{{asset('frontend/images/team-member-1.png')}}" class="img-fluid"></a>
          </div>
          <div class="col pl-0 pr-0 text-center">
               <a href="#" class="img-top-padding"><img src="{{asset('frontend/images/team-member-2.png')}}" class="img-fluid"></a>
          </div>
          <div class="col pl-0 pr-0 text-center">
              <a href="#"><img src="{{asset('frontend/images/team-member-3.png')}}" class="img-fluid"></a>
          </div>
          <div class="col pl-0 pr-0 text-center">
               <a href="#" class="img-top-padding"><img src="{{asset('frontend/images/team-member-4.png')}}" class="img-fluid"></a>
          </div>
          <div class="col pl-0 pr-0 text-center">
              <a href="#"><img src="{{asset('frontend/images/team-member-5.png')}}" class="img-fluid"></a>
          </div>
      </div>
      <div class="row">
          <div class="col pl-0 pr-0 text-center">
              <a href="#"><img src="{{asset('frontend/images/team-member-6.png')}}" class="img-fluid"></a>
          </div>
          <div class="col pl-0 pr-0 text-center">
               <a href="#" class="img-top-padding"><img src="{{asset('frontend/images/team-member-7.png')}}" class="img-fluid"></a>
          </div>
          <div class="col pl-0 pr-0 text-center">
              <a href="#"><img src="{{asset('frontend/images/team-member-8.png')}}" class="img-fluid"></a>
          </div>
          <div class="col pl-0 pr-0 text-center">
               <a href="#" class="img-top-padding"><img src="{{asset('frontend/images/team-member-9.png')}}" class="img-fluid"></a>
          </div>
          <div class="col pl-0 pr-0 text-center">
              <a href="#"><img src="{{asset('frontend/images/team-member-10.png')}}" class="img-fluid"></a>
          </div>
      </div>



      </div>
    </div>
  </section>




@endsection
