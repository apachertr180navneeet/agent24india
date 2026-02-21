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
        .location-selector-row > div {
            flex: 0 0 100%;
            max-width: 100%;
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
    $districtModel = new \App\Models\District();
    $cityModel = new \App\Models\City();
    $districtList = $districtModel->select('id', 'name')->where('status', 1)->get();
@endphp
@section('content')
    <!-- Location Selector -->
    <section class="container">
        <div class="search-form">
            <div class="row location-selector-row">
                <div class="col-lg-3 p-0">
                    <div class="search-input position-relative">
                        {{--  <label>
                           
                        </label>  --}}

                        <input type="text" 
                            id="location_search" 
                            class="form-control"
                            placeholder="Search or choose district"
                            autocomplete="off">

                        <div id="searchResults" class="search-results">
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
                <div class="col-lg-6 p-0 mt-2 mt-lg-0">
                    <div class="search-input" style="border: 1px solid #000000;border-radius: 15px;">
                        {{--  <label for="city_search">
                            <i class="lni lni-map theme-color"></i>
                        </label>  --}}
                        <select id="city_search" class="form-control">
                            <option value="">Select city</option>
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
                <div class="slide {{($key == 0) ? 'active' : ''}}">
                    <img src="{{ $value->image}}" alt="Slide {{($key + 1)}}">
                </div>
            @endforeach
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
                    <div class="search-input" style="border: 1px solid #000000;border-radius: 15px;">
                        {{--  <label for="category"><i class="lni lni-grid-alt theme-color"></i></label>  --}}
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
            <div class="categories-grid">
                @foreach($category as $key => $value)
                    <a href="javascript:void(0);"
                        class="category-link js-category-location"
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

    <div class="modal fade" id="categoryDistrictModal" tabindex="-1" role="dialog" aria-labelledby="categoryDistrictModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryDistrictModalLabel">Select District And City</h5>
                </div>
                <div class="modal-body">
                    <select id="category_district_id" class="form-control">
                        <option value="">Choose district</option>
                        @foreach($districtList as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                    <select id="category_city_id" class="form-control mt-3">
                        <option value="">Choose city</option>
                    </select>
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
    </section>


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
        var selectedDistrictId = null;
        var selectedCategoryId = '';
        var listUrlTemplate = "{{ route('front.vendorlist.location', ['location' => 'LOCATION_ID_PLACEHOLDER']) }}";
        var locationCategoryUrlTemplate = "{{ route('front.vendorlist.location.category', ['location' => 'LOCATION_ID_PLACEHOLDER', 'category' => 'CATEGORY_ID_PLACEHOLDER']) }}";
        var cityApiTemplate = "{{ route('get.cities', ['district' => 'DISTRICT_ID_PLACEHOLDER']) }}";
        var $citySearch = $('#city_search');
        var $categorySearch = $('#category');
        var $categoryDistrict = $('#category_district_id');
        var $categoryCity = $('#category_city_id');

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
        $citySearch.next('.select2-container').css({
            width: '100%',
            minWidth: '100%',
            maxWidth: '100%'
        });

        function resetCityDropdown() {
            $citySearch.html('<option value="">Select city</option>').trigger('change.select2');
        }

        function loadCitiesByDistrict(districtId) {
            resetCityDropdown();
            if (!districtId) {
                return;
            }

            var cityApiUrl = cityApiTemplate.replace('DISTRICT_ID_PLACEHOLDER', districtId);

            $.get(cityApiUrl, function (cities) {
                var options = '<option value="all">All City</option><option value="">Select city</option>';

                if (Array.isArray(cities) && cities.length) {
                    cities.forEach(function (city) {
                        options += '<option value="' + city.id + '">' + city.name + '</option>';
                    });
                } else {
                    options += '<option value="" disabled>No city found</option>';
                }

                $citySearch.html(options).trigger('change.select2');
            }).fail(function () {
                resetCityDropdown();
            });
        }

        function selectDistrict($item) {
            $('#location_search').val($item.text().trim());
            selectedDistrictId = $item.data('id');
            loadCitiesByDistrict(selectedDistrictId);
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

        // Click select
        $('.result-item').on('click', function () {
            selectDistrict($(this));
        });

        // Select first matched district on Enter
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

        // Redirect when city changes
        $citySearch.on('change', function () {
            var cityId = $(this).val();

            if (!selectedDistrictId || !cityId) {
                return;
            }

            var redirectUrl = listUrlTemplate.replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId) + '?city=' + cityId;
            window.location.href = redirectUrl;
        });

        // Click outside close
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.search-input').length) {
                $('#searchResults').hide();
            }
        });

        function resetModalCityDropdown() {
            $categoryCity.html('<option value="">Choose city</option>');
        }

        function loadModalCitiesByDistrict(districtId, preselectedCity) {
            resetModalCityDropdown();
            if (!districtId) {
                return;
            }

            var cityApiUrl = cityApiTemplate.replace('DISTRICT_ID_PLACEHOLDER', districtId);

            $.get(cityApiUrl, function (cities) {
                var options = '<option value="all">All City</option><option value="">Choose city</option>';

                if (Array.isArray(cities) && cities.length) {
                    cities.forEach(function (city) {
                        options += '<option value="' + city.id + '">' + city.name + '</option>';
                    });
                }

                $categoryCity.html(options);

                if (preselectedCity) {
                    $categoryCity.val(String(preselectedCity));
                }
            }).fail(function () {
                resetModalCityDropdown();
            });
        }

        $(document).on('click', '.js-category-location', function (e) {
            e.preventDefault();
            selectedCategoryId = $(this).data('category-id');
            var currentDistrict = selectedDistrictId || '';
            $categoryDistrict.val(currentDistrict);
            loadModalCitiesByDistrict(currentDistrict, $citySearch.val() || '');
            $('#categoryDistrictModal').modal('show');
        });

        // Bootstrap 5-safe explicit close handlers for X/Cancel
        $(document).on('click', '#categoryDistrictModal [data-bs-dismiss=\"modal\"], #categoryDistrictModal [data-dismiss=\"modal\"]', function () {
            $('#categoryDistrictModal').modal('hide');
        });

        $categoryDistrict.on('change', function () {
            loadModalCitiesByDistrict($(this).val(), '');
        });

        $('#goToCategoryListing').on('click', function () {
            var districtId = $categoryDistrict.val();
            var cityId = $categoryCity.val();

            if (!districtId || !selectedCategoryId) {
                alert('Please select district');
                return;
            }

            var redirectUrl = locationCategoryUrlTemplate
                .replace('LOCATION_ID_PLACEHOLDER', districtId)
                .replace('CATEGORY_ID_PLACEHOLDER', selectedCategoryId);

            if (cityId) {
                redirectUrl += '?city=' + encodeURIComponent(cityId);
            }

            window.location.href = redirectUrl;
        });

    });
</script>
<script>
    $(document).ready(function () {
        $('#category').on('change', function () {
            var selectedCategory = $(this).val();
            var selectedLocation = ($('#location_id').val() || $('#location_search').val() || '').trim();

            if (selectedCategory !== 'none' && selectedLocation === '') {
                alert('Please select location');
            }
        });
    });
</script>
@endpush
