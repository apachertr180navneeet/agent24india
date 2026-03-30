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
        .search-form .search-input input.form-control,
        .search-form .search-input select.form-control {
            width: 100%;
            height: 50px;
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 0 15px;
            font-size: 14px;
        }

        /* Select2 Fix */
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

        /* ================= LOCATION ROW ================= */
        .location-selector-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* ================= CATEGORY GRID ================= */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 15px;
        }

        .category-card {
            background: #fff;
            border-radius: 10px;
            padding: 15px 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .category-card img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        /* ================= LOCATION GRID ================= */
        .locations-grid1 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        /* ================= VIDEO ================= */
        .video-thumbnail img {
            width: 100%;
            border-radius: 8px;
        }

        /* ================= RESPONSIVE ================= */

        /* Tablet */
        @media (max-width: 992px) {
            .categories-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .locations-grid1 {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Mobile */
        @media (max-width: 768px) {

            .location-selector-row {
                flex-direction: column;
            }

            .categories-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .locations-grid1 {
                grid-template-columns: repeat(2, 1fr);
            }

            .search-form .search-input input.form-control,
            .search-form .search-input select.form-control {
                height: 45px;
                font-size: 13px;
            }
        }

        /* Small Mobile */
        @media (max-width: 480px) {

            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .locations-grid1 {
                grid-template-columns: repeat(1, 1fr);
            }

            .category-card span {
                font-size: 12px;
            }
        }
        /* Desktop: single row */
        @media (min-width: 992px) {
            .location-selector-row {
                display: flex;
                flex-wrap: nowrap;
                gap: 10px;
            }
        }

        /* Mobile: stack */
        @media (max-width: 768px) {
            .location-selector-row {
                flex-direction: column;
            }
        }

        @media (max-width: 768px) {

            .location-selector-row {
                display: flex;
                flex-wrap: nowrap; /* keep in one line */
                gap: 8px;
            }

            .location-selector-row > div {
                flex: 1; /* equal width */
                padding: 0 2px;
            }

            .search-form .search-input input.form-control,
            .search-form .search-input select.form-control {
                height: 40px;
                font-size: 12px;
                padding: 0 8px;
            }
        }

        /* Mobile */
        @media (max-width: 768px) {

            /* Categories → 3 in one row */
            .categories-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
            }

            /* Locations → 3 in one row */
            .locations-grid1 {
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
            }

            /* Smaller cards */
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

            /* Location card image */
            .location-card1 img {
                height: 90px;
                object-fit: cover;
                border-radius: 8px;
            }

            .overlay1 h3 {
                font-size: 12px;
            }
        }

        /* Very small screens */
        @media (max-width: 480px) {

            .categories-grid,
            .locations-grid1 {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }

            .location-card1 img {
                height: 75px;
            }

            .overlay1 h3 {
                font-size: 11px;
            }
        }
    </style>
@endpush
@php
    $districtModel = new \App\Models\District();
    $cityModel = new \App\Models\City();
    $settingModel = new \App\Models\Setting();
    $districtList = $districtModel->select('id', 'name')->where('status', 1)->get();
    $setting = $settingModel->where('id', 1)->first();
@endphp
@section('content')
    <!-- Location Selector -->
    <section class="container">
        <div class="search-form">
            <div class="row location-selector-row mt-2">

                <!-- District -->
                <div class="col-lg-4 col-md-4 col-12 px-1">
                    <div class="search-input position-relative">
                        <input type="text" id="location_search" class="form-control"
                            placeholder="Search district" autocomplete="off">

                        <div id="searchResults" class="search-results">
                            @foreach ($districtList as $value)
                                <div class="result-item"
                                    data-id="{{ $value->id }}"
                                    data-name="{{ strtolower($value->name) }}">
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
                            <option value="">Select city</option>
                        </select>
                    </div>
                </div>

                <!-- Subcategory -->
                <div class="col-lg-4 col-md-4 col-12 px-1">
                    <div class="search-input">
                        <select id="subcategory" class="form-control">
                            <option value="">Select Sub Category</option>
                            @foreach($subCategories as $sub)
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
            @foreach ($banner as $key => $value)
                <div class="slide {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ $value->image }}" alt="Slide {{ $key + 1 }}">
                </div>
            @endforeach
            <button class="arrow prev">&#10094;</button>
            <button class="arrow next">&#10095;</button>

            <div class="dots"></div>

        </div>
    </section>

    <!-- Location Search -->
    <section class="container select-category">
        <div class="search-form wow ">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 p-0">
                    <div class="search-input search-dropdown-box">
                        {{--  <label for="category"><i class="lni lni-grid-alt theme-color"></i></label>  --}}
                        <select name="category" id="category">
                            <option value="none">Choose Categories</option>
                            @foreach ($category as $value)
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
            <div class="categories-grid">
                @foreach ($category as $key => $value)
                    <a href="javascript:void(0);" class="category-link js-category-location"
                        data-category-id="{{ $value->id }}">
                        <div class="category-card">
                            <img src="{{ $value->image }}" alt="{{ $value->name }}">
                            <span>{{ $value->name }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="modal fade" id="categoryDistrictModal" tabindex="-1" role="dialog"
        aria-labelledby="categoryDistrictModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryDistrictModalLabel">Select District And City</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <select id="category_district_id" class="form-control">
                                <option value="">Choose district</option>
                                @foreach ($districtList as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <select id="category_city_id" class="form-control">
                                <option value="">Choose city</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="goToCategoryListing">Continue</button>
                </div>
            </div>
        </div>
    </div>

    <!-- start locations -->
    <section class="locations-section1">
        <div class="container">
            <div class="section-title">
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Locations </h2>
            </div>
            <div class="locations-grid1">

                <!-- Location Card -->
                @foreach ($districthome as $districtkey => $districtvalue)
                    <a href="{{ route('front.vendorlist.location', ['location' => $districtvalue->id]) }}"
                        class="location-card1 js-home-location-card" data-district-id="{{ $districtvalue->id }}"
                        data-district-name="{{ $districtvalue->name }}">
                        <img src="{{ $districtvalue->image
                            ? $districtvalue->image
                            : 'https://media.istockphoto.com/id/481776206/photo/cityscape-of-blue-city-and-mehrangarh-fort-jodhpur-india.jpg?s=2048x2048&w=is&k=20&c=gWUiWwsZpLsSoBSgLOvnhZbR6pwQpcPEqMLDYUTaIt0=' }}"
                            alt="{{ $districtvalue->name }}">

                        <div class="overlay1">
                            <h3 class="text-light">{{ $districtvalue->name }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Listing -->
    <section class="items-grid section custom-padding">
        <div class="container">
            <div class="single-head">
                <div class="row">

                    <div class="col-12">
                        <h3 class="mb-4">Demo Videos</h3>
                    </div>

                    @php

                    // ✅ URL + TITLE MAP
                    $demoVideos = [
                        1 => [
                            'url'   => $setting->demo_1_video_url ?? '',
                            'title' => $setting->demo_vedio_titel1 ?? 'Demo Video 1'
                        ],
                        2 => [
                            'url'   => $setting->demo_2_video_url ?? '',
                            'title' => $setting->demo_vedio_titel2 ?? 'Demo Video 2'
                        ],
                        3 => [
                            'url'   => $setting->demo_3_video_url ?? '',
                            'title' => $setting->demo_vedio_titel3 ?? 'Demo Video 3'
                        ],
                    ];

                    // ✅ Thumbnail Function
                    function getYoutubeThumbnail($url){

                        if(!$url){
                            return 'https://via.placeholder.com/480x360?text=Demo+Video';
                        }

                        $videoId = null;
                        $parsedUrl = parse_url($url);

                        // youtu.be
                        if(isset($parsedUrl['host']) && strpos($parsedUrl['host'],'youtu.be') !== false){
                            $videoId = trim($parsedUrl['path'],'/');
                        }

                        // watch?v=
                        if(isset($parsedUrl['query'])){
                            parse_str($parsedUrl['query'],$queryParams);
                            $videoId = $queryParams['v'] ?? $videoId;
                        }

                        // embed
                        if(!$videoId && preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/',$url,$matches)){
                            $videoId = $matches[1];
                        }

                        // shorts
                        if(!$videoId && preg_match('/youtube\.com\/shorts\/([a-zA-Z0-9_-]{11})/',$url,$matches)){
                            $videoId = $matches[1];
                        }

                        return $videoId
                            ? "https://img.youtube.com/vi/".$videoId."/hqdefault.jpg"
                            : 'https://via.placeholder.com/480x360?text=Demo+Video';
                    }

                    @endphp


                    @foreach ($demoVideos as $index => $video)

                    @if($video['url'])
                    <div class="col-lg-4 col-md-6 col-12 mb-4">

                        <a href="{{ $video['url'] }}" target="_blank" class="video-card text-decoration-none">

                            <div class="video-thumbnail position-relative">

                                <img src="{{ getYoutubeThumbnail($video['url']) }}" 
                                    alt="{{ $video['title'] }}" 
                                    class="img-fluid rounded">

                                <div class="play-btn">
                                    ▶
                                </div>

                            </div>

                            {{-- ✅ Dynamic Title --}}
                            <h6 class="mt-2 text-dark">
                                {{ $video['title'] }}
                            </h6>

                        </a>

                    </div>
                    @endif

                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('public/plugins/select2/js/select2.min.js') }}"></script>

    <script>

        $('#searchResults').hide();
        /* ================= GLOBAL VARIABLES (FIX) ================= */
        var selectedDistrictId = '';
        var selectedCityId = '';
        var selectedDistrictName = '';
        var selectedCategoryId = '';
        var selectedSubCategoryId = '';

        $('#location_search').on('focus', function () {
            $('#searchResults').show();
        });

        /* ================= GLOBAL FUNCTION (FIX) ================= */
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

        /* ================= MAIN SCRIPT ================= */
        $(document).ready(function() {

            var listUrlTemplate =
                "{{ route('front.vendorlist.location', ['location' => 'LOCATION_ID_PLACEHOLDER']) }}";

            var locationCategoryUrlTemplate =
                "{{ route('front.vendorlist.location.category', ['location' => 'LOCATION_ID_PLACEHOLDER', 'category' => 'CATEGORY_ID_PLACEHOLDER']) }}";

            var locationSubCategoryUrlTemplate =
                "{{ route('front.vendorlist.location.subcategory', ['location' => 'LOCATION_ID', 'subcategory' => 'SUBCATEGORY_ID']) }}";

            var cityApiTemplate =
                "{{ route('get.cities', ['district' => 'DISTRICT_ID_PLACEHOLDER']) }}";

            var $citySearch = $('#city_search');
            var $categorySearch = $('#category');
            var $subcategory = $('#subcategory');
            var $categoryDistrict = $('#category_district_id');
            var $categoryCity = $('#category_city_id');

            /* ================= SELECT2 ================= */
            $citySearch.select2({ placeholder: 'Select city', allowClear: true, width: '100%' });
            $categorySearch.select2({ placeholder: 'Choose Categories', width: '100%' });
            $subcategory.select2({ placeholder: 'Select Sub Category', allowClear: true, width: '100%' });

            $categoryDistrict.select2({
                placeholder: 'Choose district',
                width: '92%',
                dropdownParent: $('#categoryDistrictModal')
            });

            $categoryCity.select2({
                placeholder: 'Choose city',
                width: '77%',
                dropdownParent: $('#categoryDistrictModal')
            });

            /* ================= CITY LOAD ================= */
            function resetCityDropdown() {
                $citySearch.html('<option value="">Select city</option>').trigger('change.select2');
            }

            function loadCitiesByDistrict(districtId, preselectedCity) {
                resetCityDropdown();
                if (!districtId) return;

                var url = cityApiTemplate.replace('DISTRICT_ID_PLACEHOLDER', districtId);

                $.get(url, function(cities) {

                    var options = '<option value="">Select city</option><option value="all">All City</option>';

                    cities.forEach(function(city) {
                        options += `<option value="${city.id}">${city.name}</option>`;
                    });

                    $citySearch.html(options);

                    if (preselectedCity) {
                        $citySearch.val(String(preselectedCity));
                    }

                    $citySearch.trigger('change.select2');

                }).fail(resetCityDropdown);
            }

            /* ================= INIT STORED ================= */
            function initializeFromStoredSelection() {
                var stored = getStoredSelection();

                selectedDistrictId = stored.districtId;
                selectedCityId = stored.cityId;
                selectedDistrictName = stored.districtName;

                if (selectedDistrictName) {
                    $('#location_search').val(selectedDistrictName);
                }

                if (selectedDistrictId) {
                    loadCitiesByDistrict(selectedDistrictId, selectedCityId);
                }
            }

            /* ================= CITY CHANGE ================= */
            $citySearch.on('change', function() {

                var cityId = $(this).val();
                selectedCityId = cityId;

                if (!selectedDistrictId || !cityId) return;

                persistSelection(selectedDistrictId, $('#location_search').val(), cityId);

                var url = listUrlTemplate.replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId) + '?city=' + cityId;

                window.location.href = url;
            });

            /* ================= CATEGORY ================= */
            $categorySearch.on('change', function() {

                var categoryId = $(this).val();
                if (!categoryId || categoryId === 'none') return;

                selectedCategoryId = categoryId;

                var stored = getStoredSelection();
                var districtId = selectedDistrictId || stored.districtId;
                var cityId = selectedCityId || stored.cityId;

                if (districtId) {
                    var url = locationCategoryUrlTemplate
                        .replace('LOCATION_ID_PLACEHOLDER', districtId)
                        .replace('CATEGORY_ID_PLACEHOLDER', categoryId);

                    if (cityId) url += '?city=' + cityId;

                    window.location.href = url;
                } else {
                    $('#categoryDistrictModal').modal('show');
                }
            });

            /* ================= SUBCATEGORY (FIXED) ================= */
            $subcategory.on('change', function () {

                var subcategoryId = $(this).val();
                if (!subcategoryId) return;

                selectedSubCategoryId = subcategoryId;

                var stored = getStoredSelection();
                var districtId = selectedDistrictId || stored.districtId;
                var cityId = selectedCityId || stored.cityId;

                if (districtId) {

                    var url = locationSubCategoryUrlTemplate
                        .replace('LOCATION_ID', districtId)
                        .replace('SUBCATEGORY_ID', subcategoryId);

                    if (cityId) url += '?city=' + cityId;

                    window.location.href = url;
                } else {
                    localStorage.setItem('pendingSubCategory', subcategoryId);
                    $('#categoryDistrictModal').modal('show');
                }
            });

            /* ================= MODAL ================= */
            $categoryDistrict.on('change', function() {

                var districtId = $(this).val();
                if (!districtId) return;

                var url = cityApiTemplate.replace('DISTRICT_ID_PLACEHOLDER', districtId);

                $.get(url, function(cities) {

                    var options = '<option value="">Choose city</option>';

                    cities.forEach(function(city) {
                        options += `<option value="${city.id}">${city.name}</option>`;
                    });

                    $categoryCity.html(options).trigger('change.select2');

                });
            });

            $('#goToCategoryListing').on('click', function() {

                var districtId = $categoryDistrict.val();
                var cityId = $categoryCity.val();

                if (!districtId) {
                    alert('Please select district');
                    return;
                }

                persistSelection(districtId, '', cityId);

                if (selectedSubCategoryId) {

                    var url = locationSubCategoryUrlTemplate
                        .replace('LOCATION_ID', districtId)
                        .replace('SUBCATEGORY_ID', selectedSubCategoryId);

                    if (cityId) url += '?city=' + cityId;

                    window.location.href = url;
                }
            });

            /* ================= INIT ================= */
            resetCityDropdown();
            initializeFromStoredSelection();

            $('#location_search').on('keyup', function () {

                let value = $(this).val().toLowerCase().trim();

                if (value === '') {
                    $('#searchResults').hide();
                    return;
                }

                $('#searchResults').show();

                $('.result-item').each(function () {

                    let name = $(this).data('name'); // already lowercase

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

                // set input value
                $('#location_search').val(districtName);

                // set global values
                selectedDistrictId = districtId;
                selectedDistrictName = districtName;
                selectedCityId = '';

                // save in session
                persistSelection(districtId, districtName, '');

                // load cities
                loadCitiesByDistrict(districtId, '');

                // hide dropdown
                $('#searchResults').hide();

            });

        });
    </script>
@endpush
