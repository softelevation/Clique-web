@extends('frontend.layout')
@section('title')
Home
@endsection

@section('contents')

<section id="intro" class="clearfix">
    <div class="white-bg py-3 py-md-0">
    <div class="container">
        <h1>Welcome to Clique</h1>
        <h4>Try a new way to connect with other <br>people and friends.</h4>
        <button class="btn btn-primary btn-lg">Get started</button>
    </div>
    </div>
  </section>
  <section id="new-business-card-area" class="grey-bg clearfix py-5">
      <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-md-6 col-lg-6 text-center text-md-left">
            <img src="{{asset('frontend/images/business-card.png')}}" class="img-fluid">
          </div>
          <div class="col-md-6 text-center text-md-left">
            <h2>Your new <br>business card</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit auctor risus id dui sodales.
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit auctor risus id dui sodales.</p>
          </div>
        </div>
      </div>
  </section>
  <section id="benefits-of-clique-card" class="clearfix py-5">
      <div class="container">
        <h2 class="text-center">Benefits of  the Clique card</h2>
        <div class="row my-md-5 text-center text-md-left">
          <div class="col-md-4">
            <div class="icon"><img src="{{asset('frontend/images/chat-icon.svg')}}"></div>
            <h4 class="my-3">Instant contact</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales.</p>
          </div>
          <div class="col-md-4">
            <div class="icon"><img src="{{asset('frontend/images/tech-icon.svg')}}"></div>
            <h4 class="my-3">Revolutionary tech</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales.</p>
          </div>
           <div class="col-md-4">
            <div class="icon"><img src="{{asset('frontend/images/time-icon.svg')}}"></div>
            <h4 class="my-3">Real time updates</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales.</p>
          </div>
          <div class="col-md-4">
            <div class="icon"><img src="{{asset('frontend/images/share-icon.svg')}}"></div>
            <h4 class="my-3">Share information</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales.</p>
          </div>
          <div class="col-md-4">
            <div class="icon"><img src="{{asset('frontend/images/new-connection-icon.svg')}}"></div>
            <h4 class="my-3">New connections</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales.</p>
          </div>
           <div class="col-md-4">
            <div class="icon"><img src="{{asset('frontend/images/all-in-one-icon.svg')}}"></div>
            <h4 class="my-3">All in one</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales.</p>
          </div>
        </div>
      </div>
  </section>
  <section id="create-account" class="py-5">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-7 text-center">
          <img src="{{asset('frontend/images/login-screen-mobile.png')}}" class="img-fluid">
        </div>
        <div class="col-md-5 text-center text-md-left">
          <h2>Create an account</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br>auctor risus id dui sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <a href="#" class="download-link">Download the App <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>

    </div>
  </section>
  <section id="grow-your-networking" class="grey-bg clearfix py-5">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-6 order-md-1 order-2">
         <div class="row justify-content-md-center py-md-5 my-md-5 py-2">
           <div class="col-md-7 text-center text-md-left py-4 py-md-0">
              <h2>Grow your networking</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales. Lorem ipsum dolor sit amet, consectetur.</p>
              <a href="#" class="download-link">Download the App <i class="fas fa-arrow-right"></i></a>
           </div>
         </div>
        </div>
        <div class="col-md-6 order-md-2 order-1">
          <img src="{{asset('frontend/images/grow-network.png')}}" class="img-fluid">
        </div>
      </div>
    </div>
   </section>
   <section id="real-time-updates" class="align-items-center">
     <div class="container">
       <div class="row">
         <div class="col-md-6 justify-content-md-center align-items-center">
           <div class="login-screen-mobile-img">
             <img src="{{asset('frontend/images/real-time-update.png')}}" class="img-fluid">
           </div>
         </div>
         <div class="col-md-6">
            <div class="right-side-content py-5 mt-md-5 text-center text-md-left">
              <h2>Real time updates</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. auctor risus id dui sodales. Lorem ipsum dolor sit amet.</p>
              <a href="#" class="download-link">Download the App <i class="fas fa-arrow-right"></i></a>
            </div>
         </div>
       </div>
     </div>
   </section>
   <section id="testimonial">
    <h2 class="text-center">What people are saying</h2>
    <div class="testimonial-bg">
      <div class="owl-carousel testimonials-carousel">

        <div class="testimonial-item">
          <div class="testimonial-box">
                                  <div class="testimonial-pic">
                                    <img src="{{asset('frontend/images/testimonial-profile-img.png')}}">
                                  </div>
                                  <div class="testimonial-quote-icon">
                                    <img src="{{asset('frontend/images/testimonial-quote-icon.svg')}}">
                                  </div>
                                        <p>”Lorem ipsum dolor sit amet, con
                                        sectetur adipiscing elit. auctor risus id dui sodales. Lorem ipsum dolor sit amet, consectetu".”</p>
                                        <div class="testimonial-people-name">
                                         Jane Doe
                                        </div>
                                        <div class="testimonial-desgination">
                                          Deisgner at atom6
                                        </div>
                                </div>

        </div>

        <div class="testimonial-item">
          <div class="testimonial-box">
                                  <div class="testimonial-pic">
                                    <img src="{{asset('frontend/images/testimonial-profile-img.png')}}">
                                  </div>
                                  <div class="testimonial-quote-icon">
                                    <img src="{{asset('frontend/images/testimonial-quote-icon.svg')}}">
                                  </div>
                                        <p>”Lorem ipsum dolor sit amet, con
                                        sectetur adipiscing elit. auctor risus id dui sodales. Lorem ipsum dolor sit amet, consectetu".”</p>
                                        <div class="testimonial-people-name">
                                         Jane Doe
                                        </div>
                                        <div class="testimonial-desgination">
                                          Deisgner at atom6
                                        </div>
                                </div>

        </div>
        <div class="testimonial-item">
          <div class="testimonial-box">
                                  <div class="testimonial-pic">
                                    <img src="{{asset('frontend/images/testimonial-profile-img.png')}}">
                                  </div>
                                  <div class="testimonial-quote-icon">
                                    <img src="{{asset('frontend/images/testimonial-quote-icon.svg')}}">
                                  </div>
                                        <p>”Lorem ipsum dolor sit amet, con
                                        sectetur adipiscing elit. auctor risus id dui sodales. Lorem ipsum dolor sit amet, consectetu".”</p>
                                        <div class="testimonial-people-name">
                                         Jane Doe
                                        </div>
                                        <div class="testimonial-desgination">
                                          Deisgner at atom6
                                        </div>
                                </div>

        </div>
      </div>
     </div>
   </section>
   <section id="user" class="text-center">
    <div class="container">
     <img src="{{asset('frontend/images/users.png')}}" class="img-fluid">
   </div>
   </section>
   <section id="pricing">
    <div class="container">
     <div class="row align-items-center">
      <div class="col-md-6">
      <div class="row justify-content-md-center">
          <div class="col-md-6 text-center text-md-left">
        <h2>Pricing</h2>
        <p>Lorem ipsum dolor sit amet,<br> consectetur adipiscing elit.</p>
      </div></div></div>
      <div class="col-md-5">
        <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Buy now!</h5>
          <p class="card-text display-3">$ 50,00</p>
          <ul class="mt-5 mb-4">
            <li>Lorem ipsum dolor</li>
            <li>Consectetur adipiscing</li>
            <li>Auctor risus id dui</li>
            <li>Sit amet, consectetur</li>
            <li>Auctor risus id dui</li>
            <li>Lorem ipsum </li>
          </ul>
        <a href="{{ url('/place-order')}}" class="btn btn-primary">Buy Now</a>
        </div>
      </div>
      </div>
     </div>
   </div>
   </section>

@endsection
