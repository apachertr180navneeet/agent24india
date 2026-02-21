@php
    $cmsModel = new \App\Models\Cms();
    $privacy = $cmsModel->where('id', 3)->first();
    $trem = $cmsModel->where('id', 2)->first();
    $about = $cmsModel->where('id', 1)->first();
@endphp
<header class="header">
  <div class="header-inner">

    <!-- LEFT : Logo -->
    <div class="nav-left">
      <a href="{{route('front.index')}}" class="logo">
        <img src="{{asset('public/front/assets/images/logo/agent-india-logo2.png')}}" alt="Logo">
      </a>
    </div>

    <!-- CENTER : Menu -->
    <ul class="main-menu">
      <li><a href="{{route('front.index')}}">Home</a></li>
      <li>
        @if(\Auth::check())
          <a href="{{ route('front.addListing') }}">Free Listing</a>
        @else
          <a href="javascript:void(0)" class="open-signin">Free Listing</a>
        @endif
      </li>
      <li>
        @if(\Auth::check())
          <a href="{{ route('front.addListing') }}">Banner Ad</a>
        @else
          <a href="javascript:void(0)" class="open-signin">Banner Ad</a>
        @endif
      </li>
      <li class="dropdown">
        <a href="#">Policies ▾</a>
        <ul class="dropdown-menu">
          @if($privacy->status == 1)
            <li><a href="{{route('front.privacyPolicy')}}">Privacy Policy</a></li>
          @endif
          @if($trem->status == 1)
          <li><a href="{{route('front.termsAndConditions')}}">Terms & Conditions</a></li>
          @endif
        </ul>
      </li>
      <li><a href="{{route('front.support')}}">Support & Help</a></li>
    </ul>

    <!-- RIGHT : Sign In + Toggle -->
    <div class="nav-right">
       @if(\Auth::check())
            <a href="{{route('front.logout')}}" class="sign-btn">Logout</a>  
        @else
            <a href="javascript:void(0)" class="sign-btn open-signin">Sign In</a>
        @endif

      <button class="menu-toggle" id="menuToggle">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>

  </div>
</header>

<!-- Overlay -->
<div class="menu-overlay" id="menuOverlay"></div>

<!-- Slide Menu -->
<div class="side-menu" id="sideMenu">
    <button class="close-btn" id="closeMenu">&times;</button>
    <h4>
        @if(\Auth::check())
            <a href="javascript:void(0)">{{auth()->user()->name}}</a>
        @endif
    </h4>
    <ul>
        <li><a href="{{route('front.index')}}">Home</a></li>
        {{--  <li><a href="{{route('front.vendorlist')}}">Vendor List</a></li>  --}}
        @if(\Auth::check())
        <li><a href="{{route('front.profile')}}">My Profile</a></li>
        <li><a href="{{route('front.addListing')}}">My Listing</a></li>
        <li><a href="">My Banner Ad</a></li>
        <li><a href="#">Payment history</a></li>
        @endif
        @if($about->status == 1)
        <li><a href="{{route('front.aboutus')}}">About Us</a></li>
        @endif
        <li><a href="{{route('front.contactus')}}">Contact Us</a></li>
        <li><a href="#">Notice</a></li>
        <li><a href="{{route('front.support')}}">Support & Help</a></li>
        @if($trem->status == 1)
        <li><a href="{{route('front.termsAndConditions')}}">Terms & Conditions</a></li>
        @endif
        @if($privacy->status == 1)
          <li><a href="{{route('front.privacyPolicy')}}">Privacy Policy</a></li>
        @endif
        {{--  @if(\Auth::check())
            <li><a href="{{route('front.logout')}}">Logout</a></li>    
        @else
            <li><a href="javascript:void(0)" class="open-signin">Sign In</a></li>
        @endif  --}}
    </ul>
</div>
