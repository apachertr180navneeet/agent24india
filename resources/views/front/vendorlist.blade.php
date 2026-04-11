@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
<link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
<style>
    .search-results {
        position: absolute;
        width: 100%;
        background: #fff;
        border: 1px solid #ddd;
        max-height: 200px;
        overflow-y: auto;
        z-index: 9999;
        border-radius: 6px;
    }

    .location-selector-row > div {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .result-item {
        padding: 10px;
        cursor: pointer;
    }

    .result-item:hover {
        background: #f2f2f2;
    }

    .search-form .search-input .select2-container {
        display: block;
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
    }

    #city_search + .select2,
    #city_search + .select2-container {
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
    }

    #category + .select2,
    #category + .select2-container {
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
    }

    #subcategory + .select2,
    #subcategory + .select2-container {
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
    }

    .location-selector-row .search-input {
        width: 100%;
    }

    .search-form .search-input .select2-container .select2-selection--single {
        width: 100%;
        background: #fff;
        border-radius: 6px;
        border: 1px solid #ddd;
        padding: 0 12px;
        padding-right: 36px;
        height: 50px;
        font-size: 14px;
        display: flex;
        align-items: center;
    }

    .search-form .search-input .select2-container .select2-selection--single:focus {
        outline: none !important;
    }

    .search-form .search-input .select2-container .select2-selection__rendered {
        line-height: 48px;
        color: #081828;
        padding-left: 0;
        padding-right: 24px;
    }

    .search-form .search-input .select2-container .select2-selection__placeholder {
        color: #6c757d;
    }

    .search-form .search-input .select2-container .select2-selection__arrow {
        height: 48px;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #f2f2f2;
        color: #333;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #f8f9fa;
        color: #333;
    }

    .search-form .search-input #location_search.form-control {
        height: 50px;
        padding: 0 15px;
        padding-right: 36px;
        border-radius: 6px;
        border: 1px solid #aaaaaa;
    }

    .search-form .search-input select.form-control {
        border: 1px solid #ddd;
    }

    .select2-dropdown {
        border: 1px solid #ddd;
    }

    @media (max-width: 991.98px) {
        .location-selector-row {
            display: flex;
            flex-wrap: wrap;
        }

        .location-selector-row > .location-col-half {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .location-selector-row > .location-col-full {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {
        .search-form .search-input .select2-container .select2-selection--single {
            height: 40px;
            padding: 0 8px;
            padding-right: 30px;
            font-size: 12px;
        }

        .search-form .search-input .select2-container .select2-selection__rendered {
            line-height: 38px;
            padding-right: 22px;
        }

        .search-form .search-input .select2-container .select2-selection__arrow {
            height: 38px;
        }

        .search-form .search-input #location_search.form-control {
            height: 40px;
            font-size: 12px;
            padding: 0 8px;
        }
    }
    /* Category Section */
    .categories-section {
        padding: 40px 0;
    }

    /* Grid layout */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr); /* 6 per row */
        gap: 20px;
    }

    /* Card style */
    .category-link {
        text-decoration: none;
    }

    .row.location-selector-row {
        margin-top: 5px;
    }

    .category-card {
        background: #fff;
        border-radius: 10px;
        padding: 15px 10px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        transition: 0.3s;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .category-card img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        margin-bottom: 8px;
    }

    .category-card span {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #333;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .categories-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 768px) {
        .categories-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 480px) {
        .categories-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .hero-slider {
        position: relative;
        width: 100%;
        overflow: hidden;
        border-radius: 12px;
        aspect-ratio: 16 / 6;
        background: #f5f5f5;
    }

    .hero-slider .slide {
        width: 100%;
        height: 100%;
    }

    .hero-slider .slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        border-radius: 12px;
    }

    .sideadvertismentimage {
        width: 100%;
    }

    @media (max-width: 992px) {
        .hero-slider {
            aspect-ratio: 16 / 7;
        }
    }

    @media (max-width: 768px) {
        .hero-slider {
            aspect-ratio: 16 / 8;
        }

    }

    @media (max-width: 480px) {
        .hero-slider {
            aspect-ratio: 16 / 9;
        }

    }

    .locations-section1 .adsbygoogle {
        display: block;
        width: 100%;
        min-height: 250px;
    }

    /* Default */
    .desktop {
        display: block;
    }

    /* Mobile fix */
    @media (max-width: 768px) {
        .desktop {
            display: block !important;
        }

        .contact-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .contact-actions a {
            flex: 1 1 48%;
            text-align: center;
            font-size: 12px;
            padding: 8px;
        }
    }

    /* Buttons Base */
.contact-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* Buttons Style */
.contact-actions .btn {
    padding: 10px 14px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: 0.3s;
}

/* Colors */
.call-btn {
    background: #007bff;
}

.whatsapp-btn {
    background: #25D366;
}

.enquiry-btn {
    background: #0d6efd;
}

/* Hover */
.contact-actions .btn:hover {
    opacity: 0.9;
}

/* 🔴 MOBILE / DESKTOP CONTROL */
.desktop {
    display: flex;
}

.mobile {
    display: none;
}

/* 📱 MOBILE VIEW FIX */
@media (max-width: 768px) {

    .desktop {
        display: none !important;
    }

    .mobile {
        display: flex;
    }

    .mobile .btn {
        flex: 1;
        font-size: 16px;
        padding: 10px;
    }

    .mobile .btn i {
        font-size: 18px;
    }
}

@media (max-width: 767px) {
    .vendorlist h4 {
        font-size: 15px;
    }
}

@media (max-width: 767px) {
    .vendorlist p {
        font-size: 7px;
    }
}

/* ================= UNIFIED UI (MATCH INDEX) ================= */
.location-selector-row {
    display: flex;
    flex-wrap: wrap;
    margin-left: -5px;
    margin-right: -5px;
}

.location-selector-row > div {
    padding-left: 5px;
    padding-right: 5px;
    margin-bottom: 10px;
}

.location-selector-row > .location-col-half,
.location-selector-row > .location-col-full {
    padding-left: 5px;
    padding-right: 5px;
    margin-bottom: 10px;
}

.search-form .search-input input.form-control,
.search-form .search-input select.form-control {
    width: 100%;
    height: 50px;
    border-radius: 6px;
    border: 1px solid #ddd;
    padding: 0 15px;
    font-size: 14px;
}

#location_search.form-control {
    border-color: #aaaaaa;
}

.select2-container {
    width: 100% !important;
}

.select2-selection--single {
    height: 50px !important;
    padding: 0 12px !important;
    border-radius: 6px !important;
    display: flex !important;
    align-items: center !important;
}

.select2-selection__rendered {
    line-height: 48px !important;
    padding-left: 0 !important;
    padding-right: 24px !important;
}

.select2-selection__arrow {
    height: 48px !important;
}

.search-form .search-input .select2-container {
    width: 100% !important;
}

.search-form .search-input .select2-container .select2-selection--single {
    width: 100% !important;
    height: 50px !important;
    padding: 0 12px !important;
    border-radius: 6px !important;
    border: 1px solid #ddd !important;
    display: flex !important;
    align-items: center !important;
}

.search-form .search-input .select2-container .select2-selection__rendered {
    line-height: 48px !important;
    padding-left: 0 !important;
    padding-right: 24px !important;
}

.search-form .search-input .select2-container .select2-selection__arrow {
    height: 48px !important;
}

.categories-grid {
    grid-template-columns: repeat(6, 1fr);
    gap: 15px;
}

.category-card img {
    width: 50px;
    height: 50px;
    object-fit: contain;
}

@media (min-width: 992px) {
    .location-selector-row {
        flex-wrap: nowrap;
    }

    .location-selector-row > .location-col-half,
    .location-selector-row > .location-col-full {
        width: 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
}

@media (max-width: 992px) {
    .categories-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-width: 768px) {
    .location-selector-row {
        margin-left: -4px;
        margin-right: -4px;
    }

    .location-selector-row > div {
        padding-left: 4px;
        padding-right: 4px;
        margin-bottom: 8px;
    }

    .location-selector-row > .location-col-half,
    .location-selector-row > .location-col-full {
        padding-left: 4px;
        padding-right: 4px;
        margin-bottom: 8px;
    }

    .location-col-half {
        width: 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }

    .location-col-full {
        width: 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }

    .search-form .search-input input.form-control,
    .search-form .search-input select.form-control {
        height: 40px;
        font-size: 12px;
        padding: 0 8px;
    }

    .select2-selection--single {
        height: 40px !important;
        padding: 0 8px !important;
    }

    .select2-selection__rendered {
        line-height: 38px !important;
        padding-right: 22px !important;
    }

    .select2-selection__arrow {
        height: 38px !important;
    }

    .search-form .search-input .select2-container .select2-selection--single {
        height: 40px !important;
        padding: 0 8px !important;
    }

    .search-form .search-input .select2-container .select2-selection__rendered {
        line-height: 38px !important;
        padding-right: 22px !important;
    }

    .search-form .search-input .select2-container .select2-selection__arrow {
        height: 38px !important;
    }

    .categories-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .category-card {
        padding: 10px 5px;
    }

    .category-card img {
        width: 40px;
        height: 40px;
    }

    .category-card span {
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    .location-selector-row {
        margin-left: -3px;
        margin-right: -3px;
    }

    .location-selector-row > div {
        padding-left: 3px;
        padding-right: 3px;
    }

    .location-selector-row > .location-col-half,
    .location-selector-row > .location-col-full {
        padding-left: 3px;
        padding-right: 3px;
    }

    .categories-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }

    .category-card span {
        font-size: 12px;
    }
}
</style>
@endpush
 @php
    $categoryModel = new \App\Models\Category();
    $districtModel = new \App\Models\District();
    $businessCategory = $categoryModel->select('id', 'name')->whereNull('parent_id')->where('status', 1)->get();
    $districtList = $districtModel->select('id', 'name')->where('status', 1)->get();
@endphp
@section('content')
<!-- Location Selector -->
<section class="container">
    <div class="search-form">
        <div class="row location-selector-row mt-2">
            <div class="col-lg-4 col-md-4 col-6 location-col-half">

                <div class="search-input position-relative">
                    <label>
                    </label>

                    <input type="text"
                        id="location_search"
                        class="form-control"
                        placeholder="Search district"
                        autocomplete="off"
                        value="{{ $selectedDistrict ? $selectedDistrict->name : '' }}">

                    <input type="hidden"
                        name="location"
                        id="location_id"
                        value="{{ $location ?? '' }}">

                    <div id="searchResults" class="search-results" style="display:none;">
                        @foreach($districtList as $value)
                            <div class="result-item"
                                data-id="{{ $value->id }}"
                                data-name="{{ strtolower($value->name) }}">
                                {{ $value->name }}
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
            <div class="col-lg-4 col-md-4 col-6 location-col-half">
                <div class="search-input">
                    <label for="city_search">
                    </label>
                    <select id="city_search" class="form-control">
                        <option value="">Search city</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12 location-col-full">
                <div class="search-input">
                    <label for="subcategory"></label>
                    <select id="subcategory" class="form-control">
                        <option value="">Select Sub Category</option>
                        @foreach(($subCategories ?? []) as $sub)
                            <option value="{{ $sub->id }}" data-parent="{{ $sub->parent_id }}">
                                {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Start Hero Area -->
<section class="hero-area">
    <div class="hero-slider">

        @forelse ($topadvertisments as $key => $topadvertisment)
            <div class="slide {{ ($key == 0) ? 'active' : '' }}">
                <img src="{{ $topadvertisment->image }}" alt="{{ $topadvertisment->image_alt }}">
            </div>
        @empty
            <div class="slide active">
                <img src="{{ asset('public/images/topbanner.jpeg') }}" alt="Default Banner">
            </div>
        @endforelse

        <button class="arrow prev">&#10094;</button>
        <button class="arrow next">&#10095;</button>
        <div class="dots"></div>

    </div>
</section>
<!-- End Hero Area -->
<!-- Category Search -->
<section class="container select-category">
    <div class="search-form wow " >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 p-0 mb-2">
                <div class="search-input">
                    <label for="category"></label>
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
            {{--  <div class="col-lg-6 col-md-6 col-6 p-0">
                <label for="vendor_type_filter"></label>
                <select id="vendor_type_filter">
                    <option value="">All Agent</option>
                    <option value="paid" {{ request('vendor_type') == 'paid' ? 'selected' : '' }}>Paid Agent</option>
                    <option value="free" {{ request('vendor_type') == 'free' ? 'selected' : '' }}>Free Agent</option>
                </select>
            </div>  --}}
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
                            <!-- Image -->
                            <div class="col-lg-3 col-md-4 col-4">
                                <div class="image">
                                    <img src="{{ $vendor->profile_photo }}" 
                                        alt="Vendor Image" class="img-fluid">
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="col-lg-9 col-md-8 col-8">
                                
                                <h4>
                                    <a href="{{ route('front.vendor.details', ['vendor' => $vendor->id]) }}">
                                        {{ $vendor->name }}
                                    </a>
                                </h4>

                                <label class="text-dark">
                                    <i class="lni lni-map-marker"></i>
                                    {{ $vendor->business_address }}
                                </label>

                                <!-- ✅ DESKTOP ACTIONS -->
                                <div class="contact-actions desktop mt-3">
                                    @if($vendor->vendor_type == 'paid')
                                        <a href="tel:{{ $vendor->mobile }}" class="btn call-btn">
                                            <i class="lni lni-phone"></i> Call Now
                                        </a>
                                    @endif

                                    <a href="https://wa.me/{{ $vendor->whats_app }}" class="btn whatsapp-btn">
                                        <i class="lni lni-whatsapp"></i> WhatsApp
                                    </a>

                                    <a href="mailto:{{ $vendor->email }}" class="btn enquiry-btn">
                                        <i class="lni lni-envelope"></i> Send Enquiry
                                    </a>
                                </div>

                                <!-- ✅ MOBILE ACTIONS -->
                                <div class="contact-actions mobile mt-2">
                                    @if($vendor->vendor_type == 'paid')
                                        <a href="tel:{{ $vendor->mobile }}" class="btn call-btn">
                                            <i class="lni lni-phone"></i>
                                        </a>
                                    @endif

                                    <a href="https://wa.me/{{ $vendor->whats_app }}" class="btn whatsapp-btn">
                                        <i class="lni lni-whatsapp"></i>
                                    </a>

                                    <a href="mailto:{{ $vendor->email }}" class="btn enquiry-btn">
                                        <i class="lni lni-envelope"></i>
                                    </a>
                                </div>

                                <!-- Tags -->
                                @if($vendor->vendor_type == 'paid')
                                    <p class="item-position">
                                        <i class="lni lni-bolt"></i> Premium
                                    </p>
                                    <p class="item-position item-position-ai">AI Verified</p>
                                @endif

                            </div>
                        </div>
                    @empty
                        <!-- No Record Found -->
                        <div class="text-center py-5 w-100">
                            <h4 class="text-muted">No record found</h4>
                            <p class="text-muted">Try searching with a different category.</p>
                        </div>
                    @endforelse

                    {{--  <!-- Pagination -->
                    @if($vendoruser->hasPages())
                        <div class="d-flex justify-content-center mt-5">
                            {{ $vendoruser->appends(request()->query())->links() }}
                        </div>
                    @endif  --}}

                </div>
                <!-- /Vendor List -->

                <!-- Sidebar -->
                {{--  <div class="col-lg-3 col-md-12 col-right">
                    @foreach($sideadvertisments as $sideadvertisment)
                        <div class="sidebar-box mb-3">
                            <img src="{{ $sideadvertisment->image }}" class="sideadvertismentimage" alt="{{ $sideadvertisment->image_alt }}">
                        </div>
                    @endforeach
                </div>  --}}
                <!-- Sidebar -->
                <div class="col-lg-3 col-md-12 col-right">
                    @if($sideadvertisments && count($sideadvertisments) > 0)
                        @foreach($sideadvertisments as $sideadvertisment)
                            <div class="sidebar-box mb-3">
                                <img src="{{ $sideadvertisment->image }}" class="sideadvertismentimage" alt="{{ $sideadvertisment->image_alt }}">
                            </div>
                        @endforeach

                    @else
                        <div class="sidebar-box mb-3">
                            <img src="{{ asset('public/images/sidebanner.jpeg') }}" alt="Default Banner" style="width: 100%;">
                        </div>
                    @endif
                </div>
                <!-- /Sidebar -->
                <!-- /Sidebar -->

            </div>
        </div>
    </div>
</section>
<!-- End Items Grid Area -->


<section class="locations-section1">
    <div class="container">
        
        <div class="locations-grid1">

            <!-- Google Ad -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-9918904470832571"
                data-ad-slot="2104355202"
                data-ad-format="auto"
                data-full-width-responsive="true">
            </ins>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('public/plugins/select2/js/select2.min.js') }}"></script>
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
<script>
    $(document).ready(function () {
        var selectedDistrictId = "{{ $location ?? '' }}";
        var selectedCityId = "{{ request()->query('city', '') }}";
        var pendingCategoryId = '';
        var pendingSubCategoryId = '';
        var listUrlTemplate = "{{ route('front.vendorlist.location', ['location' => 'LOCATION_ID_PLACEHOLDER']) }}";
        var locationCategoryUrlTemplate = "{{ route('front.vendorlist.location.category', ['location' => 'LOCATION_ID_PLACEHOLDER', 'category' => 'CATEGORY_ID_PLACEHOLDER']) }}";
        var locationSubCategoryUrlTemplate = "{{ route('front.vendorlist.location.subcategory', ['location' => 'LOCATION_ID', 'subcategory' => 'SUBCATEGORY_ID']) }}";
        var cityApiTemplate = "{{ route('get.cities', ['district' => 'DISTRICT_ID_PLACEHOLDER']) }}";
        var currentCategoryId = "{{ request()->route('category') ?? '' }}";
        var $citySearch = $('#city_search');
        var $categorySearch = $('#category');
        var $subcategory = $('#subcategory');
        var $headerDistrict = $('#header_district_id');
        var $headerCity = $('#header_city_id');
        var $headerContinue = $('#goToListingByLocation');

        $citySearch.select2({
            placeholder: 'Select city',
            allowClear: true,
            width: '100%'
        });
        $categorySearch.select2({
            placeholder: 'Choose Categories',
            allowClear: false,
            width: '100%'
        });
        $subcategory.select2({
            placeholder: 'Select Sub Category',
            allowClear: true,
            width: '100%'
        });

        function getStoredSelection() {
            return {
                districtId: sessionStorage.getItem('selectedDistrictId') || '',
                districtName: sessionStorage.getItem('selectedDistrictName') || '',
                cityId: sessionStorage.getItem('selectedCityId') || ''
            };
        }

        function persistSelection(districtId, districtName, cityId) {
            if (districtId) {
                sessionStorage.setItem('selectedDistrictId', String(districtId));
                sessionStorage.setItem('selectedDistrictName', districtName || '');
            }

            if (cityId) {
                sessionStorage.setItem('selectedCityId', String(cityId));
            } else {
                sessionStorage.removeItem('selectedCityId');
            }
        }

        function resetCityDropdown() {
            $citySearch.html('<option value="">Select city</option><option value="all">All City</option>').trigger('change.select2');
        }

        function loadCitiesByDistrict(districtId, preselectedCity) {
            resetCityDropdown();
            if (!districtId) {
                return;
            }

            var cityApiUrl = cityApiTemplate.replace('DISTRICT_ID_PLACEHOLDER', districtId);

            $.get(cityApiUrl, function (cities) {
                var options = '<option value="">Select city</option><option value="all">All City</option>';

                if (Array.isArray(cities) && cities.length) {
                    cities.forEach(function (city) {
                        options += '<option value="' + city.id + '">' + city.name + '</option>';
                    });
                } else {
                    options += '<option value="" disabled>No city found</option>';
                }

                $citySearch.html(options);

                if (preselectedCity) {
                    $citySearch.val(String(preselectedCity));
                }

                $citySearch.trigger('change.select2');
            }).fail(function () {
                resetCityDropdown();
            });
        }

        function resetHeaderCityDropdown() {
            $headerCity.html('<option value="">Choose city</option>');
        }

        function openDistrictCityModal() {
            if ($('#districtCityModal').length) {
                $('#districtCityModal').modal('show');
            } else {
                alert('Please select district first');
            }
        }

        function loadHeaderCitiesByDistrict(districtId, preselectedCity) {
            resetHeaderCityDropdown();
            if (!districtId) {
                return;
            }

            var cityApiUrl = cityApiTemplate.replace('DISTRICT_ID_PLACEHOLDER', districtId);

            $.get(cityApiUrl, function (cities) {
                var options = '<option value="">Choose city</option><option value="all">All City</option>';

                if (Array.isArray(cities) && cities.length) {
                    cities.forEach(function (city) {
                        options += '<option value="' + city.id + '">' + city.name + '</option>';
                    });
                }

                $headerCity.html(options);

                if (preselectedCity) {
                    $headerCity.val(String(preselectedCity));
                }
            }).fail(function () {
                resetHeaderCityDropdown();
            });
        }

        function selectDistrict($item) {
            $('#location_search').val($item.text().trim());
            selectedDistrictId = String($item.data('id'));
            selectedCityId = '';
            $('#location_id').val(selectedDistrictId);
            persistSelection(selectedDistrictId, $item.text().trim(), '');
            loadCitiesByDistrict(selectedDistrictId, '');
            $('#searchResults').hide();
        }

        $('#searchResults').hide();

        $('#location_search').on('keyup', function () {
            var value = $(this).val().toLowerCase();

            if (value.length === 0) {
                $('#searchResults').hide();
                return;
            }

            $('#searchResults').show();

            $('.result-item').filter(function () {
                $(this).toggle($(this).data('name').indexOf(value) > -1);
            });
        });

        $('#searchResults').on('click', '.result-item', function () {
            selectDistrict($(this));
        });

        $('#location_search').on('keydown', function (e) {
            if (e.key !== 'Enter') {
                return;
            }

            e.preventDefault();
            var $firstVisible = $('.result-item:visible').first();
            if ($firstVisible.length) {
                selectDistrict($firstVisible);
            }
        });

        $citySearch.on('change', function () {
            var cityId = $(this).val();
            selectedCityId = cityId || '';

            if (!selectedDistrictId || !cityId) {
                return;
            }

            persistSelection(selectedDistrictId, $('#location_search').val(), cityId);

            var redirectUrl = currentCategoryId
                ? locationCategoryUrlTemplate
                    .replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId)
                    .replace('CATEGORY_ID_PLACEHOLDER', currentCategoryId)
                : listUrlTemplate.replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId);

            redirectUrl += '?city=' + encodeURIComponent(cityId);
            window.location.href = redirectUrl;
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('.search-input').length) {
                $('#searchResults').hide();
            }
        });

        $headerDistrict.off('change.vendorlist').on('change.vendorlist', function () {
            loadHeaderCitiesByDistrict($(this).val(), '');
        });

        $headerContinue.off('click').on('click', function () {
            var districtId = $headerDistrict.val();
            var cityId = $headerCity.val();

            if (!districtId) {
                alert('Please select district');
                return;
            }

            sessionStorage.setItem('selectedDistrictId', String(districtId));
            sessionStorage.setItem('selectedDistrictName', $headerDistrict.find('option:selected').text());
            if (cityId) {
                sessionStorage.setItem('selectedCityId', String(cityId));
            } else {
                sessionStorage.removeItem('selectedCityId');
            }

            var redirectUrl = pendingCategoryId
                ? locationCategoryUrlTemplate
                    .replace('LOCATION_ID_PLACEHOLDER', districtId)
                    .replace('CATEGORY_ID_PLACEHOLDER', pendingCategoryId)
                : (
                    pendingSubCategoryId
                        ? locationSubCategoryUrlTemplate
                            .replace('LOCATION_ID', districtId)
                            .replace('SUBCATEGORY_ID', pendingSubCategoryId)
                        : listUrlTemplate.replace('LOCATION_ID_PLACEHOLDER', districtId)
                );

            if (cityId) {
                redirectUrl += '?city=' + encodeURIComponent(cityId);
            }

            window.location.href = redirectUrl;
        });

        $('#category').on('change', function () {
            var categoryId = $(this).val();
            if (!categoryId || categoryId === 'none') {
                return;
            }

            pendingCategoryId = categoryId;

            var activeDistrictId = selectedDistrictId || sessionStorage.getItem('selectedDistrictId') || '';
            var activeCityId = selectedCityId || sessionStorage.getItem('selectedCityId') || '';

            if (activeDistrictId) {
                var redirectUrl = locationCategoryUrlTemplate
                    .replace('LOCATION_ID_PLACEHOLDER', activeDistrictId)
                    .replace('CATEGORY_ID_PLACEHOLDER', categoryId);

                if (activeCityId) {
                    redirectUrl += '?city=' + encodeURIComponent(activeCityId);
                }

                window.location.href = redirectUrl;
                return;
            }

            $headerDistrict.val('');
            resetHeaderCityDropdown();
            openDistrictCityModal();
        });

        $subcategory.on('change', function () {
            var subcategoryId = $(this).val();
            if (!subcategoryId) {
                return;
            }

            var stored = getStoredSelection();
            var activeDistrictId = selectedDistrictId || stored.districtId || '';
            var activeCityId = selectedCityId || stored.cityId || '';

            if (activeDistrictId) {
                var redirectUrl = locationSubCategoryUrlTemplate
                    .replace('LOCATION_ID', activeDistrictId)
                    .replace('SUBCATEGORY_ID', subcategoryId);

                if (activeCityId) {
                    redirectUrl += '?city=' + encodeURIComponent(activeCityId);
                }

                window.location.href = redirectUrl;
                return;
            }

            pendingSubCategoryId = subcategoryId;
            openDistrictCityModal();
        });

        if (selectedDistrictId) {
            persistSelection(selectedDistrictId, $('#location_search').val(), selectedCityId);
            loadCitiesByDistrict(selectedDistrictId, selectedCityId);
        } else {
            resetCityDropdown();
        }

        $('.js-open-district-city-popup').on('click', function () {
            pendingCategoryId = '';
            pendingSubCategoryId = '';
        });

        $('#districtCityModal').on('hidden.bs.modal', function () {
            if (pendingCategoryId && !$headerDistrict.val()) {
                pendingCategoryId = '';
                $categorySearch.val('none').trigger('change.select2');
            }
            if (pendingSubCategoryId && !$headerDistrict.val()) {
                pendingSubCategoryId = '';
                $subcategory.val('').trigger('change.select2');
            }
        });
    });
</script>
<script>
    $('#vendor_type_filter').on('change', function () {

        var vendorType = $(this).val();
        var districtId = "{{ $location }}";
        var categoryId = "{{ $selectedCategory }}";
        var cityId = "{{ $selectedCityId }}";

        var url = "{{ route('front.vendorlist.location.category', ['location' => 'LOCATION', 'category' => 'CATEGORY']) }}";

        url = url.replace('LOCATION', districtId);
        url = url.replace('CATEGORY', categoryId);

        var params = [];

        if (cityId) {
            params.push('city=' + cityId);
        }

        if (vendorType) {
            params.push('vendor_type=' + vendorType);
        }

        if (params.length) {
            url += '?' + params.join('&');
        }

        window.location.href = url;
    });
</script>
<script>
    window.addEventListener('load', function () {
        try {
            (adsbygoogle = window.adsbygoogle || []).push({});
        } catch (e) {
            console.log('Adsense error:', e);
        }
    });
</script>
@endpush

