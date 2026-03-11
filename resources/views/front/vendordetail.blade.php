@extends('front.layout.main')
@section('title', $pageTitle)

@section('content')

<div class="container my-3">

    {{-- Vendor Header --}}
    <div class="vendorhead">
        <h2>{{ $vendoruser->business_name }}</h2>

        <p class="service">
            {{ $vendoruser->business_category_name }}
        </p>

        <p class="location">
            <i class="lni lni-map-marker me-2"></i>
            {{ $vendoruser->business_address }},
            {{ $vendoruser->city_name }}
        </p>
    </div>


    <div class="row product-container">

        {{-- LEFT IMAGE --}}
        <div class="col-lg-5 col-12">
            <div class="product-image">
                <img src="{{ $vendoruser->profile_photo }}"
                     alt="{{ $vendoruser->business_name }}" />
            </div>
        </div>


        {{-- RIGHT DETAILS --}}
        <div class="col-lg-6 col-12">
            <div class="product-details">

                <ul class="info-list">

                    {{-- CATEGORY --}}
                    <li>
                        <div class="feature-tags">
                            <strong>Category :</strong>
                            <span>{{ $vendoruser->business_category_name }}</span>
                        </div>
                    </li>

                    {{-- SUB CATEGORY --}}
                    <li>
                        <div class="feature-tags">
                            <strong>Sub Category :</strong>
                            <span>{{ $vendoruser->business_sub_category_names }}</span>
                        </div>
                    </li>


                    {{-- DESCRIPTION --}}
                    <li>
                        <div class="feature-tags">
                            <strong>Description</strong>

                            <div class="description-content">
                                <p>
                                    {{ $vendoruser->description }}
                                </p>
                            </div>
                        </div>
                    </li>

                </ul>


                {{-- CONTACT BUTTONS --}}
                <div class="contact-actions col-lg-12 col-12 mt-3">

                    {{-- CALL --}}
                    @if($vendoruser->vendor_type == 'paid')
                    <a href="tel:{{ $vendoruser->mobile }}" class="call-btn">
                        <i class="lni lni-phone"></i> Call Now
                    </a>
                    @endif


                    {{-- WHATSAPP --}}
                    <a href="https://wa.me/{{ $vendoruser->mobile }}" class="whatsapp">
                        <i class="lni lni-whatsapp"></i> WhatsApp
                    </a>


                    {{-- EMAIL --}}
                    <a href="mailto:{{ $vendoruser->email }}" class="call-btn">
                        <i class="lni lni-envelope"></i> Send Enquiry
                    </a>

                </div>

            </div>

            {{-- PREMIUM TAG --}}
            @if($vendoruser->vendor_type == 'paid')
                <p class="item-position">
                    <i class="lni lni-bolt"></i> Premium
                </p>
            @endif

        </div>

    </div>


    {{-- LOCATION DETAILS --}}
    <div class="row my-5 vendordetails">

        <div class="col-lg-6 col-6 mb-3">
            <strong>City:</strong>
            <span>{{ $vendoruser->city_name }}</span>
        </div>

        <div class="col-lg-6 col-6 mb-3">
            <strong>District:</strong>
            <span>{{ $vendoruser->district_name }}</span>
        </div>

        <div class="col-lg-6 col-6 mb-3">
            <strong>State:</strong>
            <span>{{ $vendoruser->state_name }}</span>
        </div>

        <div class="col-lg-6 col-6 mb-3">
            <strong>Pin Code:</strong>
            <span>{{ $vendoruser->pincode }}</span>
        </div>

        <div class="col-lg-6 col-6 mb-3">
            <strong>Location:</strong>
            <span>{{ $vendoruser->pick_your_location }}</span>
        </div>

    </div>

</div>

@endsection