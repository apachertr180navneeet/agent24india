@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
@endpush

@section('content')

<!-- Start Hero Area -->
<section class="hero-area">
    <div class="hero-slider">
        @foreach ($topadvertisments as $topadvertisment)
            <div class="slide active">
                <img src="{{ $topadvertisment->image }}" alt="{{ $topadvertisment->image_alt }}">
            </div>
        @endforeach
        <button class="arrow prev">&#10094;</button>
        <button class="arrow next">&#10095;</button>
        <div class="dots"></div>
    </div>
</section>
<!-- End Hero Area -->
<!-- Category Search -->
<section class="container select-category">
    <div class="search-form">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 p-0">
                <div class="search-input">
                    <label for="category">
                        <i class="lni lni-grid-alt theme-color"></i>
                    </label>
                    <select name="category" id="category">
                        <option value="none">Choose Categories</option>
                        @foreach($category as $value)
                            <option value="{{ $value->id }}"
                                {{ request()->route('category') == $value->id ? 'selected' : '' }}>
                                {{ $value->name }}
                            </option>
                        @endforeach
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
                <div class="vendorlist col-lg-9 col-md-12">

                    @forelse ($vendoruser as $vendor)
                        <div class="row d-flex vendorlistiner mb-3">
                            <div class="col-lg-3 col-md-4 col-4">
                                <div class="image">
                                    <img src="{{ asset('public/front/assets/images/items-grid/img1.jpg') }}" 
                                         alt="Vendor Image" class="img-fluid">
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-8 col-8">
                                <h4>
                                    <a href="#">{{ $vendor->name }}</a>
                                </h4>
                                <p>{{ $vendor->business_name }}</p>
                                <label class="text-dark">
                                    <i class="lni lni-map-marker"></i>
                                    {{ $vendor->business_address }}
                                </label>

                                <!-- Desktop Actions -->
                                <div class="row desktop">
                                    <div class="contact-actions col-12 mt-3">
                                        <a href="tel:{{ $vendor->phone ?? '0000000000' }}" class="call-btn">
                                            <i class="lni lni-phone"></i> Call Now
                                        </a>
                                        <a href="https://wa.me/{{ $vendor->phone ?? '' }}" class="whatsapp">
                                            <i class="lni lni-whatsapp"></i> WhatsApp
                                        </a>
                                        <a href="mailto:{{ $vendor->email ?? 'info@example.com' }}" class="call-btn">
                                            <i class="lni lni-envelope"></i> Send Enquiry
                                        </a>
                                    </div>
                                </div>

                                <p class="item-position">
                                    <i class="lni lni-bolt"></i> Premium
                                </p>
                                <p class="item-position item-position-ai">AI Verified</p>
                            </div>
                        </div>
                    @empty
                        <!-- No Record Found -->
                        <div class="text-center py-5 w-100">
                            <h4 class="text-muted">No record found</h4>
                            <p class="text-muted">Try searching with a different category.</p>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if($vendoruser->hasPages())
                        <div class="d-flex justify-content-center mt-5">
                            {{ $vendoruser->links() }}
                        </div>
                    @endif

                </div>
                <!-- /Vendor List -->

                <!-- Sidebar -->
                <div class="col-lg-3 col-md-12 col-right">
                    @foreach($sideadvertisments as $sideadvertisment)
                        <div class="sidebar-box mb-3">
                            <img src="{{ $sideadvertisment->image }}" alt="{{ $sideadvertisment->image_alt }}">
                        </div>
                    @endforeach
                </div>
                <!-- /Sidebar -->

            </div>
        </div>
    </div>
</section>
<!-- End Items Grid Area -->

@endsection

@push('scripts')
<script>
    if ($("body").find(".category-slider").length) {
        tns({
            container: '.category-slider',
            items: 3,
            slideBy: 'page',
            autoplay: false,
            mouseDrag: true,
            nav: false,
            controls: true,
            controlsText: [
                '<i class="lni lni-chevron-left"></i>',
                '<i class="lni lni-chevron-right"></i>'
            ],
            responsive: {
                0: { items: 1 },
                540: { items: 2 },
                768: { items: 4 },
                992: { items: 5 },
                1170: { items: 6 }
            }
        });
    }
</script>
@endpush
