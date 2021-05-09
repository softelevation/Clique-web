<!--
Header Start
-->
<nav class="navbar navbar-lg navbar-expand-lg navbar-transparant navbar-dark navbar-absolute w-100">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('frontend/images/logo.svg')}}"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{url('/')}}">Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link {{ (request()->is('about-us')) ? 'active' : '' }}" href="{{url('/about-us')}}">
              About us
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              Benefits
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('pricing')) ? 'active' : '' }}" href="{{url('/pricing')}}">
              Pricing
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('contact-us')) ? 'active' : '' }}" href="{{url('/contact-us')}}">
              Contact Us
            </a>
          </li>
        </ul>
        <a class="btn btn-outline-primary" href="#" target="_blank">Download app</a>
      </div>
    </div>
  </nav>
