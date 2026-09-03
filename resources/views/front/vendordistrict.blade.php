@extends('front.layout.main')
@section('title', $pageTitle ?? 'District Categories')

@php
    if (!isset($districtList)) {
        $districtList = isset($district) && is_iterable($district) 
            ? $district 
            : \App\Models\District::where('status', 1)->orderBy('name')->get();
    }
@endphp

@push('styles')
<style>
    .vendorlist-page {
        background-color: #F8FAFC;
        padding-bottom: 60px;
    }

    /* Top Search Filter Box */
    .vl-search-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        padding: 20px 24px;
        margin: 20px auto;
        max-width: 1280px;
    }

    .vl-search-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    @media (max-width: 991px) {
        .vl-search-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 575px) {
        .vl-search-grid {
            grid-template-columns: 1fr;
        }
    }

    .vl-field-group {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .vl-field-label {
        font-size: 13px;
        font-weight: 700;
        color: #1E293B;
    }

    .vl-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    .vl-input-wrap .vl-icon {
        position: absolute;
        left: 14px;
        pointer-events: none;
        z-index: 3;
        color: #004BEE;
    }

    .vl-input {
        width: 100%;
        height: 48px;
        padding: 0 16px 0 42px;
        border: 1.5px solid #CBD5E1;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #0F172A;
        background-color: #FFFFFF;
        outline: none;
        transition: all 0.2s ease;
    }

    .vl-input:focus {
        border-color: #004BEE;
        box-shadow: 0 0 0 3.5px rgba(0, 75, 238, 0.12);
    }

    .vl-input-wrap .select2-container {
        width: 100% !important;
    }

    .vl-input-wrap .select2-container--default .select2-selection--single {
        height: 48px !important;
        border: 1.5px solid #CBD5E1 !important;
        border-radius: 10px !important;
        padding-left: 40px !important;
        display: flex !important;
        align-items: center !important;
    }

    .vl-input-wrap .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 0 !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        color: #0F172A !important;
    }

    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #FFFFFF;
        border: 1.5px solid #CBD5E1;
        border-radius: 10px;
        max-height: 220px;
        overflow-y: auto;
        z-index: 99999;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        margin-top: 4px;
    }

    .result-item {
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        cursor: pointer;
        transition: background 0.15s;
    }

    .result-item:hover {
        background: #EFF6FF;
        color: #004BEE;
    }

    /* Hero Slider Container */
    .vl-hero-banner-container {
        max-width: 1280px;
        margin: 0 auto 24px auto;
        padding: 0 20px;
    }

    .hero-slider {
        position: relative;
        width: 100%;
        overflow: hidden;
        border-radius: 16px;
        aspect-ratio: 16 / 5.5;
        background: #F1F5F9;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.05);
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
        border-radius: 16px;
    }

    /* Main Grid */
    .vl-main-layout {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .vl-main-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 24px;
    }

    @media (max-width: 991px) {
        .vl-main-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Categories Grid */
    .vl-categories-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    @media (max-width: 1200px) {
        .vl-categories-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 575px) {
        .vl-categories-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .vl-category-card {
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 20px 12px;
        text-align: center;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
    }

    .vl-category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 75, 238, 0.1);
        border-color: #BFDBFE;
    }

    .vl-category-card img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .vl-category-card span {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: #0F172A;
    }

    /* Sidebar */
    .vl-sidebar-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        margin-bottom: 20px;
    }

    .vl-sidebar-title {
        font-size: 14px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .vl-sidebanner-img {
        width: 100%;
        border-radius: 12px;
        display: block;
    }
</style>
@endpush

@section('content')
<div class="vendorlist-page">

    <!-- Top Multi-Filter Search Card -->
    <div class="vl-search-card">
        <div class="vl-search-grid">
            
            <!-- District -->
            <div class="vl-field-group">
                <label class="vl-field-label">District / जिला</label>
                <div class="vl-input-wrap">
                    <svg class="vl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <input type="text" id="location_search" class="vl-input" placeholder="Search District..." autocomplete="off" value="{{ $selectedDistrict ? $selectedDistrict->name : '' }}">

                    <div id="searchResults" class="search-results" style="display:none;">
                        @foreach(($districtList ?? $district ?? []) as $value)
                            <div class="result-item" data-id="{{ $value->id }}" data-name="{{ strtolower(trim($value->name)) }}">
                                {{ $value->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- City -->
            <div class="vl-field-group">
                <label class="vl-field-label">City / शहर</label>
                <div class="vl-input-wrap">
                    <svg class="vl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <select id="city_search" class="select2">
                        <option value="">Select City</option>
                    </select>
                </div>
            </div>

            <!-- Subcategory -->
            <div class="vl-field-group">
                <label class="vl-field-label">Speciality / सेवा</label>
                <div class="vl-input-wrap">
                    <svg class="vl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <select id="subcategory" class="select2">
                        <option value="">Select Sub Category</option>
                        @foreach(($subCategories ?? []) as $sub)
                            <option value="{{ $sub->id }}">
                                {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Category -->
            <div class="vl-field-group">
                <label class="vl-field-label">Main Category</label>
                <div class="vl-input-wrap">
                    <svg class="vl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <select name="category" id="category" class="select2">
                        <option value="none">Choose Categories</option>
                        @foreach(($category ?? []) as $value)
                            <option value="{{ $value->id }}" {{ request()->route('category') == $value->id ? 'selected' : '' }}>
                                {{ $value->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    </div>

    <!-- Top Advertisement Hero Slider -->
    @if(isset($banner) && count($banner) > 0)
        <div class="vl-hero-banner-container">
            <div class="hero-slider">
                @foreach ($banner as $key => $value)
                    <div class="slide {{ ($key == 0) ? 'active' : '' }}">
                        <img src="{{ $value->image }}" alt="Slide {{ $key + 1 }}">
                    </div>
                @endforeach

                <button class="arrow prev" aria-label="Previous Slide">&#10094;</button>
                <button class="arrow next" aria-label="Next Slide">&#10095;</button>
                <div class="dots"></div>
            </div>
        </div>
    @endif

    <!-- Main Content & Sidebar Grid -->
    <div class="vl-main-layout">
        <div class="vl-main-grid">

            <!-- Left: Categories Grid -->
            <div>
                <div class="vl-categories-grid">
                    @foreach(($category ?? []) as $key => $value)
                        <a href="{{ route('front.vendorlist.location.category', ['location' => $selectedDistrict->id ?? '', 'category' => $value->id]) }}{{ !empty($selectedCityId) ? '?city=' . urlencode($selectedCityId) : '' }}" class="vl-category-card">
                            <img src="{{ $value->image }}" alt="{{ $value->name }}">
                            <span>{{ $value->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="vl-sidebar-column">
                <div class="vl-sidebar-card">
                    <div class="vl-sidebar-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span>Sponsored</span>
                    </div>

                    @if(isset($sideadvertisments) && count($sideadvertisments) > 0)
                        @foreach($sideadvertisments as $sideadvertisment)
                            <div style="margin-bottom: 14px;">
                                <img src="{{ $sideadvertisment->image }}" class="vl-sidebanner-img" alt="{{ $sideadvertisment->image_alt }}" onerror="this.onerror=null; this.src='{{ asset('images/sidebanner.jpeg') }}';">
                            </div>
                        @endforeach
                    @else
                        <div>
                            <img src="{{ asset('images/sidebanner.jpeg') }}" class="vl-sidebanner-img" alt="Default Banner" onerror="this.onerror=null; this.src='{{ asset('public/images/sidebanner.jpeg') }}';">
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
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

        if ($.fn.select2) {
            $citySearch.select2({
                placeholder: 'Select City',
                allowClear: true,
                width: '100%'
            });
            $categorySearch.select2({
                placeholder: 'Choose Categories',
                allowClear: false,
                width: '100%'
            });
            $('#subcategory').select2({
                placeholder: 'Select Sub Category',
                allowClear: true,
                width: '100%'
            });
        }

        function resetCityDropdown() {
            $citySearch.html('<option value="">Select city</option><option value="all">All City</option>').trigger('change.select2');
        }

        function loadCitiesByDistrict(districtId, preselectedCity) {
            resetCityDropdown();
            if (!districtId) return;

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
            });
        }

        $('#searchResults').hide();

        $('#location_search').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            if (!value) {
                $('#searchResults').hide();
                return;
            }
            $('#searchResults').show();
            $('.result-item').filter(function () {
                $(this).toggle($(this).data('name').indexOf(value) > -1);
            });
        });

        $('#searchResults').on('click', '.result-item', function () {
            var districtId = $(this).data('id');
            var districtName = $(this).text().trim();
            $('#location_search').val(districtName);
            $('#searchResults').hide();

            var redirectUrl = currentCategoryId
                ? locationCategoryUrl.replace('LOCATION_ID_PLACEHOLDER', districtId).replace('CATEGORY_ID_PLACEHOLDER', currentCategoryId)
                : listUrlTemplate.replace('LOCATION_ID_PLACEHOLDER', districtId);

            window.location.href = redirectUrl;
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('.vl-input-wrap').length) {
                $('#searchResults').hide();
            }
        });

        $citySearch.on('change', function () {
            var cityId = $(this).val();
            if (!selectedDistrictId || !cityId) return;

            var redirectUrl = currentCategoryId
                ? locationCategoryUrl.replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId).replace('CATEGORY_ID_PLACEHOLDER', currentCategoryId)
                : listUrlTemplate.replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId);

            redirectUrl += '?city=' + encodeURIComponent(cityId);
            window.location.href = redirectUrl;
        });

        $('#category').on('change', function () {
            var categoryId = $(this).val();
            if (!categoryId || categoryId === 'none') return;

            var redirectUrl = selectedDistrictId
                ? locationCategoryUrl.replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId).replace('CATEGORY_ID_PLACEHOLDER', categoryId)
                : categoryOnlyUrl.replace('CATEGORY_ID_PLACEHOLDER', categoryId);

            if (selectedCityId) {
                redirectUrl += '?city=' + encodeURIComponent(selectedCityId);
            }
            window.location.href = redirectUrl;
        });

        if (selectedDistrictId) {
            loadCitiesByDistrict(selectedDistrictId, selectedCityId);
        }
    });
</script>
@endpush
