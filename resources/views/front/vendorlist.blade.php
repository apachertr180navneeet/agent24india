@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
<link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
<style>
    .search-results {
        position: absolute;
        width: 100%;
        background: #fff;
        border: 1px solid #000;
        max-height: 200px;
        overflow-y: auto;
        z-index: 9999;
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

    .location-selector-row .search-input {
        width: 100%;
    }

    .search-form .search-input .select2-container .select2-selection--single {
        width: 100%;
        background: #fff;
        border-radius: 6px;
        border: none;
        padding: 0 25px;
        padding-right: 45px;
        height: 55px;
        font-size: 15px;
    }

    .search-form .search-input .select2-container .select2-selection--single:focus {
        outline: none !important;
    }

    .search-form .search-input .select2-container .select2-selection__rendered {
        line-height: 55px;
        color: #081828;
        padding-left: 0;
        padding-right: 0;
    }

    .search-form .search-input .select2-container .select2-selection__placeholder {
        color: #6c757d;
    }

    .search-form .search-input .select2-container .select2-selection__arrow {
        display: none;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #f2f2f2;
        color: #333;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #f8f9fa;
        color: #333;
    }

    .search-form .search-input input.form-control {
        border: 1px solid #000;
    }

    .search-form .search-input #location_search.form-control {
        height: 60px;
        padding: 0 25px;
        padding-right: 45px;
        border-radius: 6px;
    }

    .search-form .search-input select.form-control {
        border: 1px solid #000;
    }

    .select2-dropdown {
        border: 1px solid #000;
    }

    @media (max-width: 991.98px) {
        .location-selector-row {
            display: flex;
            flex-wrap: nowrap;
        }

        .location-selector-row > div {
            flex: 0 0 50%;
            max-width: 50%;
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
        <div class="row location-selector-row">
            <div class="col-lg-6 p-0">

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
            <div class="col-lg-6 p-0">
                <div class="search-input" style="border: 1px solid #000000;border-radius: 4px;height: 57px;margin: 2px 7px;width: 96%;">
                    <label for="city_search">
                    </label>
                    <select id="city_search" class="form-control">
                        <option value="">Search city</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>
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
    <div class="search-form wow " >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 p-0">
                <div class="search-input" style="border: 1px solid #000000;border-radius: 4px;height: 57px;margin: 2px 7px;width: 96%;">
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
                                    <img src="{{ $vendor->profile_photo }}" 
                                         alt="Vendor Image" class="img-fluid">
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-8 col-8">
                                <h4>
                                    <a href="{{ route('front.vendor.details', ['vendor' => $vendor->id]) }}">{{ $vendor->name }}</a>
                                </h4>
                                <p>{{ $vendor->business_name }}</p>
                                <label class="text-dark">
                                    <i class="lni lni-map-marker"></i>
                                    {{ $vendor->business_address }}
                                </label>

                                <!-- Desktop Actions -->
                                <div class="row desktop">
                                    <div class="contact-actions col-12 mt-3">
                                        <a href="tel:{{ $vendor->mobile ?? '0000000000' }}" class="call-btn">
                                            <i class="lni lni-phone"></i> Call Now
                                        </a>
                                        <a href="https://wa.me/{{ $vendor->mobile ?? '' }}" class="whatsapp">
                                            <i class="lni lni-whatsapp"></i> WhatsApp
                                        </a>
                                        <a href="mailto:{{ $vendor->email ?? 'info@example.com' }}" class="call-btn">
                                            <i class="lni lni-envelope"></i> Send Enquiry
                                        </a>
                                    </div>
                                </div>
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

                    <!-- Pagination -->
                    @if($vendoruser->hasPages())
                        <div class="d-flex justify-content-center mt-5">
                            {{ $vendoruser->appends(request()->query())->links() }}
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
        var listUrlTemplate = "{{ route('front.vendorlist.location', ['location' => 'LOCATION_ID_PLACEHOLDER']) }}";
        var locationCategoryUrlTemplate = "{{ route('front.vendorlist.location.category', ['location' => 'LOCATION_ID_PLACEHOLDER', 'category' => 'CATEGORY_ID_PLACEHOLDER']) }}";
        var cityApiTemplate = "{{ route('get.cities', ['district' => 'DISTRICT_ID_PLACEHOLDER']) }}";
        var currentCategoryId = "{{ request()->route('category') ?? '' }}";
        var $citySearch = $('#city_search');
        var $categorySearch = $('#category');
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
                : listUrlTemplate.replace('LOCATION_ID_PLACEHOLDER', districtId);

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
            $headerDistrict.val('');
            resetHeaderCityDropdown();
            $('#districtCityModal').modal('show');
        });

        if (selectedDistrictId) {
            loadCitiesByDistrict(selectedDistrictId, selectedCityId);
        } else {
            resetCityDropdown();
        }

        $('.js-open-district-city-popup').on('click', function () {
            pendingCategoryId = '';
        });

        $('#districtCityModal').on('hidden.bs.modal', function () {
            if (pendingCategoryId && !$headerDistrict.val()) {
                pendingCategoryId = '';
                $categorySearch.val('none').trigger('change.select2');
            }
        });
    });
</script>
@endpush
