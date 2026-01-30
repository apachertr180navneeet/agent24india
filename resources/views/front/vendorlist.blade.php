@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
@endpush

@section('content')
    <!-- Start Hero Area -->
    <section class="hero-area">
        <div class="hero-slider">
            <div class="slide active">
                <img src="{{asset('public/front/assets/images/hero/banner-1.png')}}" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="{{asset('public/front/assets/images/hero/banner-2.png')}}" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="{{asset('public/front/assets/images/hero/banner-3.jpg')}}" alt="Slide 3">
            </div>
            <div class="slide">
                <img src="{{asset('public/front/assets/images/hero/banner-4.avif')}}" alt="Slide 3">
            </div>
            <div class="slide">
                <img src="{{asset('public/front/assets/images/hero/banner-5.jpg')}}" alt="Slide 3">
            </div>

            <button class="arrow prev">&#10094;</button>
            <button class="arrow next">&#10095;</button>

            <div class="dots"></div>

        </div>
    </section>

    <!-- Category Search -->

    <section class="container select-category">
        <div class="search-form wow " >
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 p-0">
                    <div class="search-input">
                        <label for="category"><i class="lni lni-grid-alt theme-color"></i></label>
                        <select name="category" id="category">
                            <option value="none" selected disabled>Choose Categories</option>
                            <option value="none">Vehicle</option>
                            <option value="none">Electronics</option>
                            <option value="none">Mobiles</option>
                            <option value="none">Furniture</option>
                            <option value="none">Fashion</option>
                            <option value="none">Jobs</option>
                            <option value="none">Real Estate</option>
                            <option value="none">Animals</option>
                            <option value="none">Education</option>
                            <option value="none">Matrimony</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Items Grid Area -->
    <section class="items-grid section custom-padding">
        <div class="container">
            <div class="single-head">
                <div class="row d-flex">
                    <!-- Vendor List -->
                    <div class="vendorlist">

                        <!-- Vendor Item -->
                        @foreach ( $vendoruser as $vendor )
                            <div class="row d-flex vendorlistiner mb-3">
                                <div class="col-lg-3 col-md-6 col-4">
                                    <div class="image">
                                        <img src="{{ asset('public/front/assets/images/items-grid/img1.jpg') }}" alt="#" class="img-fluid">
                                    </div>
                                </div>

                                <div class="col-lg-9 col-md-6 col-8">
                                    <h4>
                                        <a href="#">{{ $vendor->name }}</a>
                                    </h4>
                                    <p>{{ $vendor->business_name }}</p>
                                    <label class="text-dark">
                                        <i class="lni lni-map-marker"></i> {{ $vendor->business_address }}
                                    </label>

                                    <!-- Desktop Actions -->
                                    <div class="row desktop">
                                        <div class="contact-actions col-12 mt-3">
                                            <a href="tel:+002562352589" class="call-btn">
                                                <i class="lni lni-phone"></i> Call Now
                                            </a>
                                            <a href="mailto:info@example.com" class="whatsapp">
                                                <i class="lni lni-whatsapp"></i> WhatsApp
                                            </a>
                                            <a href="mailto:info@example.com" class="call-btn">
                                                <i class="lni lni-envelope"></i> Send Enquiry
                                            </a>
                                        </div>
                                    </div>

                                    <p class="item-position">
                                        <i class="lni lni-bolt"></i> Premium
                                    </p>
                                    <p class="item-position item-position-ai">AI Verified</p>
                                </div>

                                <!-- Mobile Actions -->
                                <div class="row d-lg-none">
                                    <div class="contact-actions col-12 mt-3">
                                        <a href="tel:+002562352589" class="call-btn">
                                            <i class="lni lni-phone"></i> Call Now
                                        </a>
                                        <a href="mailto:info@example.com" class="whatsapp">
                                            <i class="lni lni-whatsapp"></i> WhatsApp
                                        </a>
                                        <a href="mailto:info@example.com" class="call-btn">
                                            <i class="lni lni-envelope"></i> Send Enquiry
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Vendor Item -->
                        @endforeach

                        {{--  <!-- Vendor Item (without call button) -->
                        <div class="row d-flex vendorlistiner mb-3">
                            <div class="col-lg-3 col-md-6 col-4">
                                <div class="image">
                                    <img src="assets/images/items-grid/img1.jpg" alt="#" class="img-fluid">
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-6 col-8">
                                <h4>Rahul Sharma</h4>
                                <p>Travel Agent</p>
                                <label class="text-dark">
                                    <i class="lni lni-map-marker"></i> Power House Road, Jodhpur
                                </label>

                                <div class="row desktop">
                                    <div class="contact-actions col-12 mt-3">
                                        <a href="mailto:info@example.com" class="whatsapp">
                                            <i class="lni lni-whatsapp"></i> WhatsApp
                                        </a>
                                        <a href="mailto:info@example.com" class="call-btn">
                                            <i class="lni lni-envelope"></i> Send Enquiry
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-lg-none">
                                <div class="contact-actions col-12 mt-3">
                                    <a href="mailto:info@example.com" class="whatsapp">
                                        <i class="lni lni-whatsapp"></i> WhatsApp
                                    </a>
                                    <a href="mailto:info@example.com" class="call-btn">
                                        <i class="lni lni-envelope"></i> Send Enquiry
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /Vendor Item -->  --}}

                    </div>
                    <!-- /Vendor List -->

                    <!-- Sidebar -->
                    <div class="col-right">
                        <div class="sidebar-box">
                            <img src="{{ asset('public/front/assets/images/sidebanner/sidebanner1.jpg') }}" alt="">
                        </div>
                        <div class="sidebar-box">
                            <img src="{{ asset('public/front/assets/images/sidebanner/sidebanner2.jpg') }}" alt="">
                        </div>
                        <div class="sidebar-box">
                            <img src="{{ asset('public/front/assets/images/sidebanner/sidebanner3.jpg') }}" alt="">
                        </div>
                        <div class="sidebar-box">
                            <img src="{{ asset('public/front/assets/images/sidebanner/sidebanner1.jpg') }}" alt="">
                        </div>
                    </div>
                    <!-- /Sidebar -->
                </div>
            </div>
        </div>
    </section>
    <!-- /End Items Grid Area -->

    
@endsection

@push('scripts')
<script>
    //========= Category Slider
    if($("body").find(".category-slider").length) {
        tns({
            container: '.category-slider',
            items: 3,
            slideBy: 'page',
            autoplay: false,
            mouseDrag: true,
            gutter: 0,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 2,
                },
                768: {
                    items: 4,
                },
                992: {
                    items: 5,
                },
                1170: {
                    items: 6,
                }
            }
        });
    }
</script>
@endpush