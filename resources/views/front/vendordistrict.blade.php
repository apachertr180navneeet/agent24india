@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
<link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
<style>
    /* ================= COMMON ================= */
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

    .result-item {
        padding: 10px;
        cursor: pointer;
    }

    .result-item:hover {
        background: #f2f2f2;
    }

    /* ================= SEARCH FORM ================= */
    .search-form .search-input {
        width: 100%;
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

    /* ================= SELECT2 ================= */
    .select2-container {
        width: 100% !important;
    }

    .select2-selection--single {
        height: 50px !important;
        padding: 10px !important;
        border-radius: 6px !important;
    }

    .select2-selection__rendered {
        line-height: 30px !important;
    }

    .select2-dropdown {
        border: 1px solid #ddd;
        z-index: 99999 !important;
    }

    /* ================= LOCATION ROW ================= */
    .location-selector-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    /* Desktop → 3 column fix */
    @media (min-width: 992px) {
        .location-selector-row {
            flex-wrap: nowrap;
        }

        .location-selector-row > div {
            flex: 1;
            max-width: 33.33%;
        }
    }

    /* Mobile → stack */
    @media (max-width: 768px) {
        .location-selector-row {
            flex-direction: column;
        }

        .location-selector-row > div {
            max-width: 100%;
        }

        .search-form .search-input input.form-control,
        .search-form .search-input select.form-control {
            height: 45px;
            font-size: 13px;
        }
    }

    /* ================= CATEGORY ================= */
    .categories-section {
        padding: 40px 0;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 15px;
    }

    .category-link {
        text-decoration: none;
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
        width: 50px;
        height: 50px;
        object-fit: contain;
        margin-bottom: 8px;
    }

    .category-card span {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #333;
    }

    /* Tablet */
    @media (max-width: 1200px) {
        .categories-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    /* Mobile */
    @media (max-width: 768px) {
        .categories-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Small Mobile */
    @media (max-width: 480px) {
        .categories-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .category-card {
            padding: 10px 5px;
        }

        .category-card img {
            width: 45px;
            height: 45px;
        }

        .category-card span {
            font-size: 11px;
        }
    }

    /* ================= SIDEBAR ================= */
    .sideadvertismentimage {
        width: 100%;
    }
</style>
@endpush
 @php
    $districtModel = new \App\Models\District();
    $cityModel = new \App\Models\City();
    $districtList = $districtModel->select('id', 'name')->where('status', 1)->get();
@endphp
@section('content')
    <!-- Location Selector -->
    <section class="container">
        <div class="search-form">
            <div class="row location-selector-row">

                <!-- District -->
                <div class="col-lg-4 col-md-4 col-12 px-1">
                    <div class="search-input position-relative">
                        <input type="text" 
                            id="location_search" 
                            class="form-control"
                            placeholder="Search district"
                            autocomplete="off"
                            value="{{ $selectedDistrict ? $selectedDistrict->name : '' }}">

                        <div id="searchResults" class="search-results">
                            @foreach($districtList as $value)
                                <div class="result-item"
                                    data-id="{{ $value->id }}"
                                    data-name="{{ strtolower(trim($value->name)) }}">
                                    {{ $value->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- City -->
                <div class="col-lg-4 col-md-4 col-12 px-1">
                    <div class="search-input">
                        <select id="city_search" class="form-control">
                            <option value="">Search city</option>
                        </select>
                    </div>
                </div>

                <!-- Subcategory -->
                <div class="col-lg-4 col-md-4 col-12 px-1">
                    <div class="search-input">
                        <select id="subcategory" class="form-control">
                            <option value="">Select Sub Category</option>
                            @foreach($subCategories as $sub)
                                <option value="{{ $sub->id }}">
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

            @if($banner && count($banner) > 0)

                @foreach ($banner as $key => $value)
                    <div class="slide {{ ($key == 0) ? 'active' : '' }}">
                        <img src="{{ $value->image }}" alt="Slide {{ $key + 1 }}">
                    </div>
                @endforeach

            @else
                <div class="slide active">
                    <img src="https://agent24india.com/public/upload/banner/1771654878_Property%20Solutions%20You%20Can%20Trust%20(2).png" alt="Default Banner">
                </div>
            @endif

            <button class="arrow prev">&#10094;</button>
            <button class="arrow next">&#10095;</button>

            <div class="dots"></div>

        </div>
    </section>

    <!-- Location Search -->
    <section class="container select-category">
        <div class="search-form wow " >
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 p-0">
                    <div class="search-input" style="border: 1px solid #000000;border-radius: 4px;height: 60px;margin: 1px 7px;width: 100%;">
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


    <!-- Category Section -->
    <section class="categories-section">
        <div class="container">
            <div class="row">
                <div class="vendorlist col-lg-9">
                    <div class="categories-grid">
                        @foreach($category as $key => $value)
                            <a href="{{ route('front.vendorlist.location.category', ['location' => $selectedDistrict->id ?? '', 'category' => $value->id]) }}{{ !empty($selectedCityId) ? '?city=' . urlencode($selectedCityId) : '' }}" class="category-link">
                                <div class="category-card">
                                    <img src="{{ $value->image }}" alt="{{ $value->name }}">
                                    <span>{{ $value->name }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

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
                            <img src="{{ asset('public/images/sideiamge.jpeg') }}" alt="Default Banner" style="width: 100%;">
                        </div>
                    @endif
                </div>
                <!-- /Sidebar -->
            </div>
        </div>
    </section>


     <!-- start locations -->
    {{--  <section class="locations-section1">
        <div class="container">
            <div class="section-title">
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Locations </h2>
            </div>
            <div class="locations-grid1">

                <!-- Location Card -->
                @foreach($districthome as $districtkey => $districtvalue)    
                    <a href="{{ route('front.vendorlist.location', ['location' => $districtvalue->id]) }}" class="location-card1">
                        <img 
                            src="{{ $districtvalue->image 
                                ? $districtvalue->image 
                                : 'https://media.istockphoto.com/id/481776206/photo/cityscape-of-blue-city-and-mehrangarh-fort-jodhpur-india.jpg?s=2048x2048&w=is&k=20&c=gWUiWwsZpLsSoBSgLOvnhZbR6pwQpcPEqMLDYUTaIt0=' }}" 
                            alt="{{ $districtvalue->name }}"
                        >

                        <div class="overlay1">
                            <h3 class="text-light">{{ $districtvalue->name }}</h3>
                        </div>
                    </a>
    
                @endforeach
            </div>
        </div>
    </section>  --}}


    <!-- Listing -->
    {{--  <section class="items-grid section custom-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <center>
                            <div class="ads-tabs">
                                <button class="tab-btn active" data-filter="Premium">Premium Listing</button>
                                <button class="tab-btn " data-filter="Free">Free Listing</button>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="single-head">
                <div class="row">
                    @foreach($paidlisting as $paidlistingkey => $paidlistingvalue)

                        @php
                            $datafree = ($paidlistingvalue->vendor_type == 'free') ? 'Free' : 'Premium';
                        @endphp

                        <div class="col-lg-3 col-md-6 col-6 p-2" @if($datafree === 'Free') style="display:none;" @endif>
                            <div class="single-grid wow fadeInUp" 
                                data-wow-delay=".2s" 
                                data-category="{{ $datafree }}">

                                <div class="image">
                                    <a href="item-details.html" class="thumbnail">
                                        <img src="{{ asset('public/front/assets/images/items-grid/img1.jpg') }}" alt="#">
                                    </a>

                                    <div class="author">
                                        <div class="author-image">
                                            <a href="{{ route('front.vendor.details', ['vendor' => $paidlistingvalue->id]) }}">
                                                <img src="{{ $paidlistingvalue->profile_photo }}" alt="#">
                                                <span>{{ $paidlistingvalue->name }}</span>
                                            </a><br>

                                            <a href="{{ route('front.vendor.details', ['vendor' => $paidlistingvalue->id]) }}" class="tag">
                                                {{ $paidlistingvalue->business_name }}
                                            </a>

                                            <ul class="info-list">
                                                <li>
                                                    <a href="{{ route('front.vendor.details', ['vendor' => $paidlistingvalue->id]) }}">
                                                        <i class="lni lni-map-marker"></i>
                                                        {{ $paidlistingvalue->business_address }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    @if($paidlistingvalue->vendor_type == 'paid')
                                        <p class="item-position">
                                            <i class="lni lni-bolt"></i> Premium
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </section>  --}}
@endsection

@push('scripts')
<script src="{{ asset('public/plugins/select2/js/select2.min.js') }}"></script>
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
<script>
    $(document).ready(function () {
        var selectedDistrictId = "{{ $location ?? '' }}";
        var selectedCityId = "{{ $selectedCityId ?? '' }}";
        var listUrlTemplate = "{{ route('front.vendorlist.location', ['location' => 'LOCATION_ID_PLACEHOLDER']) }}";
        var locationCategoryUrl = "{{ route('front.vendorlist.location.category', ['location' => 'LOCATION_ID_PLACEHOLDER', 'category' => 'CATEGORY_ID_PLACEHOLDER']) }}";
        var categoryOnlyUrl = "{{ route('front.vendorlist.category', ['category' => 'CATEGORY_ID_PLACEHOLDER']) }}";
        var cityApiTemplate = "{{ route('get.cities', ['district' => 'DISTRICT_ID_PLACEHOLDER']) }}";
        var currentCategoryId = "{{ request()->route('category') ?? '' }}";
        var $citySearch = $('#city_search');
        var $categorySearch = $('#category');

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

        function selectDistrict($item) {
            $('#location_search').val($item.text().trim());
            selectedDistrictId = $item.data('id');
            selectedCityId = '';
            loadCitiesByDistrict(selectedDistrictId, '');
            $('#searchResults').hide();
        }

        $('#searchResults').hide();

        $('#location_search').on('keyup', function () {
            let value = $(this).val().toLowerCase();

            if (value.length === 0) {
                $('#searchResults').hide();
                return;
            }

            $('#searchResults').show();

            $('.result-item').filter(function () {
                $(this).toggle(
                    $(this).data('name').indexOf(value) > -1
                );
            });
        });

        $('.result-item').on('click', function () {
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
                ? locationCategoryUrl
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

        if (selectedDistrictId) {
            loadCitiesByDistrict(selectedDistrictId, selectedCityId);
        } else {
            resetCityDropdown();
        }

        $('#category').on('change', function () {
            var categoryId = $(this).val();
            if (!categoryId || categoryId === 'none') {
                return;
            }

            var redirectUrl = selectedDistrictId
                ? locationCategoryUrl
                    .replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId)
                    .replace('CATEGORY_ID_PLACEHOLDER', categoryId)
                : categoryOnlyUrl.replace('CATEGORY_ID_PLACEHOLDER', categoryId);

            if (selectedDistrictId && selectedCityId) {
                redirectUrl += '?city=' + encodeURIComponent(selectedCityId);
            }

            window.location.href = redirectUrl;
        });
    });
</script>
<script>
$(document).ready(function () {

    var selectedDistrictId = "{{ $location ?? '' }}";
    var selectedCityId = "{{ $selectedCityId ?? '' }}";

    var listUrlTemplate = "{{ route('front.vendorlist.location', ['location' => 'LOCATION_ID_PLACEHOLDER']) }}";

    var locationCategoryUrl = "{{ route('front.vendorlist.location.category', ['location' => 'LOCATION_ID_PLACEHOLDER', 'category' => 'CATEGORY_ID_PLACEHOLDER']) }}";

    var locationSubCategoryUrl = "{{ route('front.vendorlist.location.subcategory', ['location' => 'LOCATION_ID', 'subcategory' => 'SUBCATEGORY_ID']) }}";

    var cityApiTemplate = "{{ route('get.cities', ['district' => 'DISTRICT_ID_PLACEHOLDER']) }}";

    var currentCategoryId = "{{ request()->route('category') ?? '' }}";

    var $citySearch = $('#city_search');
    var $categorySearch = $('#category');
    var $subcategory = $('#subcategory');

    /* ================= SELECT2 ================= */
    $citySearch.select2({ placeholder: 'Select city', width: '100%' });
    $categorySearch.select2({ placeholder: 'Choose Categories', width: '100%' });
    $subcategory.select2({ placeholder: 'Select Sub Category', allowClear: true, width: '100%' });

    /* ================= CITY ================= */
    function resetCityDropdown() {
        $citySearch.html('<option value="">Select city</option><option value="all">All City</option>').trigger('change.select2');
    }

    function loadCitiesByDistrict(districtId, preselectedCity) {

        resetCityDropdown();
        if (!districtId) return;

        var url = cityApiTemplate.replace('DISTRICT_ID_PLACEHOLDER', districtId);

        $.get(url, function (cities) {

            var options = '<option value="">Select city</option><option value="all">All City</option>';

            cities.forEach(function (city) {
                options += `<option value="${city.id}">${city.name}</option>`;
            });

            $citySearch.html(options);

            if (preselectedCity) {
                $citySearch.val(String(preselectedCity));
            }

            $citySearch.trigger('change.select2');

        }).fail(resetCityDropdown);
    }

    /* ================= DISTRICT SEARCH ================= */
    $('#searchResults').hide();

    $('#location_search').on('keyup', function () {

        let value = $(this).val().toLowerCase().trim();

        if (value === '') {
            $('#searchResults').hide();
            return;
        }

        $('#searchResults').show();

        $('.result-item').each(function () {

            let name = $(this).data('name');

            if (name.includes(value)) {
                $(this).show();
            } else {
                $(this).hide();
            }

        });

    });

    $(document).on('click', '.result-item', function () {

        let districtId = $(this).data('id');
        let districtName = $(this).text().trim();

        $('#location_search').val(districtName);

        selectedDistrictId = districtId;
        selectedCityId = '';

        loadCitiesByDistrict(districtId, '');

        $('#searchResults').hide();
    });

    /* ================= ENTER SELECT ================= */
    $('#location_search').on('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            let first = $('.result-item:visible').first();
            if (first.length) first.click();
        }
    });

    /* ================= CITY CHANGE ================= */
    $citySearch.on('change', function () {

        var cityId = $(this).val();
        selectedCityId = cityId;

        if (!selectedDistrictId || !cityId) return;

        var url = currentCategoryId
            ? locationCategoryUrl
                .replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId)
                .replace('CATEGORY_ID_PLACEHOLDER', currentCategoryId)
            : listUrlTemplate.replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId);

        url += '?city=' + cityId;

        window.location.href = url;
    });

    /* ================= CATEGORY ================= */
    $categorySearch.on('change', function () {

        var categoryId = $(this).val();
        if (!categoryId || categoryId === 'none') return;

        var url = locationCategoryUrl
            .replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId)
            .replace('CATEGORY_ID_PLACEHOLDER', categoryId);

        if (selectedCityId) {
            url += '?city=' + selectedCityId;
        }

        window.location.href = url;
    });

    /* ================= SUBCATEGORY (NEW) ================= */
    $subcategory.on('change', function () {

        var subcategoryId = $(this).val();
        if (!subcategoryId) return;

        if (!selectedDistrictId) {
            alert('Please select district first');
            return;
        }

        var url = locationSubCategoryUrl
            .replace('LOCATION_ID', selectedDistrictId)
            .replace('SUBCATEGORY_ID', subcategoryId);

        if (selectedCityId) {
            url += '?city=' + selectedCityId;
        }

        window.location.href = url;
    });

    /* ================= CLICK OUTSIDE ================= */
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-input').length) {
            $('#searchResults').hide();
        }
    });

    /* ================= INIT ================= */
    if (selectedDistrictId) {
        loadCitiesByDistrict(selectedDistrictId, selectedCityId);
    } else {
        resetCityDropdown();
    }

});
</script>
@endpush
