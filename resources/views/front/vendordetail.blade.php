@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')

@endpush

@section('content')
 <div class="container my-3">
    <div class="vendorhead">
        <p class="service">{{ $vendoruser->business_category_name }}</p>
        <h2>{{ $vendoruser->name }}</h2>
        <p class="service">{{ $vendoruser->business_name }}</p>
        <p class="location"><i class="lni lni-map-marker"></i>{{ $vendoruser->business_address }}, {{ $vendoruser->city_name }}, {{ $vendoruser->district_name }} ,{{ $vendoruser->state_name }}</p>
    </div>
    <div class="row product-container">
        <div class="col-lg-5 col-12">
            <div class="product-image">
                <img src="{{ $vendoruser->profile_photo }}" alt="{{ $vendoruser->business_name }}" />
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <div class="product-details">
                <ul class="info-list">
                    <li><span>District:</span> {{ $vendoruser->district_name }}</li>
                    <li><span>City:</span> {{ $vendoruser->city_name }}</li>
                    <li><span>State:</span> {{ $vendoruser->state_name }}</li>
                    <li><span>Pin Code:</span> {{ $vendoruser->pincode }}</li>
                    <li><span>Location:</span> {{ $vendoruser->pick_your_location }}</li>
                </ul>

                <div class="contact-actions col-lg-12 col-12 mt-3">
                    <a href="tel:{{ $vendoruser->mobile }}" class="call-btn"> <i class="lni lni-phone"></i>Call Now </a>
                    <a href="https://wa.me/{{ $vendoruser->mobile ?? '' }}" class="whatsapp">
                        <i class="lni lni-whatsapp"></i>WhatsApp
                    </a>
                    <a href="mailto:{{ $vendoruser->email }}" class="call-btn">
                        <i class="lni lni-envelope"></i>Send Enquiry
                    </a>
                </div>
            </div>
            {{--  <p class="item-position"><i class="lni lni-bolt"></i> Premium</p>  --}}
        </div>
    </div>
    <div class="features-box">
        <h4 class="features-title">Tags :</h4>

        <div class="feature-tags">
            <strong>Category :</strong>
            <span>{{ $vendoruser->business_category_name }}</span>
        </div>

        <div class="feature-tags">
            <strong>Sub Category :</strong>
            <span>{{ $vendoruser->business_sub_category_names }}</span>
        </div>
    </div>

    <div class="description-box">
        <h4 class="description-title">Description :</h4>

        <div class="description-content">
            {{ $vendoruser->description }}
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush
