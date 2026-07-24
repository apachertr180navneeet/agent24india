@extends('front.layout.main')
@section('title', $pageTitle)

@section('content')

<style>
.contact-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    align-items: center;
}

.contact-actions .btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    color: #fff !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: 0.3s;
}

.contact-actions .call-btn {
    background: #007bff;
}

.contact-actions .whatsapp-btn {
    background: #25D366;
}

.contact-actions .enquiry-btn {
    background: #0d6efd;
}

.contact-actions .btn:hover {
    opacity: 0.9;
    color: #fff !important;
}
</style>

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
                    @php
                        $cleanMobile = !empty($vendoruser->mobile) ? preg_replace('/[^0-9+]/', '', $vendoruser->mobile) : (!empty($vendoruser->whats_app) ? preg_replace('/[^0-9+]/', '', $vendoruser->whats_app) : '');
                    @endphp
                    @if(!empty($cleanMobile))
                    <a href="tel:{{ $cleanMobile }}" class="btn call-btn" title="Call {{ $cleanMobile }}" onclick="if(!/Android|iPhone|iPad|iPod/i.test(navigator.userAgent)){ event.preventDefault(); alert('Phone Number: {{ $cleanMobile }}'); }">
                        <i class="lni lni-phone"></i> Call Now
                    </a>
                    @endif


                    {{-- WHATSAPP --}}
                    @if($vendoruser->vendor_type == 'paid' && !empty($vendoruser->whats_app))
                    @php
                        $waNum = preg_replace('/[^0-9]/', '', $vendoruser->whats_app);
                        if (strlen($waNum) == 10) {
                            $waNum = '91' . $waNum;
                        }
                    @endphp
                    <a href="https://wa.me/{{ $waNum }}" class="btn whatsapp-btn" target="_blank">
                        <i class="lni lni-whatsapp"></i> WhatsApp
                    </a>
                    @endif


                    {{-- EMAIL --}}
                    @if(!empty($vendoruser->email))
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $vendoruser->email }}" class="btn enquiry-btn" target="_blank" title="Email: {{ $vendoruser->email }}">
                        <i class="lni lni-envelope"></i> Send Enquiry
                    </a>
                    @endif

                </div>

                <div class="contact-actions col-lg-12 col-12 mt-3">
                    <!-- AddToAny BEGIN -->
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                    <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                    <a class="a2a_button_facebook"></a>
                    <a class="a2a_button_mastodon"></a>
                    <a class="a2a_button_email"></a>
                    </div>
                    <script defer src="https://static.addtoany.com/menu/page.js"></script>
                    <!-- AddToAny END -->
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


    <div class="row my-5 vendordetails">

        

    </div>

</div>

@endsection