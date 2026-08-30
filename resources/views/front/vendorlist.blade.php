@extends('front.layout.main')
@section('title', $pageTitle ?? 'Verified Agents List')

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

    .vl-input-wrap .select2-container--default.select2-container--open .select2-selection--single,
    .vl-input-wrap .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #004BEE !important;
        box-shadow: 0 0 0 3.5px rgba(0, 75, 238, 0.12) !important;
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

    /* Main Layout Grid */
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

    /* Agent Horizontal Card */
    .vl-agent-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
        display: flex;
        gap: 20px;
        align-items: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        position: relative;
    }

    .vl-agent-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 75, 238, 0.08);
        border-color: #BFDBFE;
    }

    .vl-agent-photo-wrap {
        width: 110px;
        height: 110px;
        border-radius: 14px;
        background: #F8FAFC;
        border: 1.5px solid #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
    }

    .vl-agent-photo-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vl-agent-info {
        flex: 1;
        min-width: 0;
    }

    .vl-agent-top-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
        flex-wrap: wrap;
    }

    .vl-badge-verified {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #DCFCE7;
        color: #166534;
        font-size: 11.5px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 20px;
    }

    .vl-badge-premium {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #EFF6FF;
        color: #004BEE;
        font-size: 11.5px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 20px;
    }

    .vl-agent-name {
        font-size: 18px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 6px;
        line-height: 1.3;
    }

    .vl-agent-name a {
        color: #0F172A;
        text-decoration: none;
        transition: color 0.2s;
    }

    .vl-agent-name a:hover {
        color: #004BEE;
    }

    .vl-agent-location {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13.5px;
        color: #64748B;
        margin-bottom: 14px;
    }

    .vl-agent-location svg {
        flex-shrink: 0;
        color: #004BEE;
    }

    .vl-agent-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }

    .vl-btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 13.5px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .vl-btn-call {
        background: #004BEE;
        color: #FFFFFF !important;
        box-shadow: 0 4px 12px rgba(0, 75, 238, 0.2);
    }

    .vl-btn-call:hover {
        background: #0036B8;
        transform: translateY(-1px);
        color: #FFFFFF !important;
    }

    .vl-btn-whatsapp {
        background: #16A34A;
        color: #FFFFFF !important;
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.2);
    }

    .vl-btn-whatsapp:hover {
        background: #15803D;
        transform: translateY(-1px);
        color: #FFFFFF !important;
    }

    .vl-btn-enquiry {
        background: #EFF6FF;
        color: #004BEE !important;
        border: 1px solid #BFDBFE;
    }

    .vl-btn-enquiry:hover {
        background: #004BEE;
        color: #FFFFFF !important;
        border-color: #004BEE;
    }

    /* Sidebar Styles */
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

    /* Empty state */
    .vl-empty-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 50px 30px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }

    .vl-empty-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #EFF6FF;
        color: #004BEE;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px auto;
    }

    @media (max-width: 575px) {
        .vl-agent-card {
            flex-direction: column;
            text-align: center;
            padding: 16px;
        }

        .vl-agent-top-meta {
            justify-content: center;
        }

        .vl-agent-location {
            justify-content: center;
        }

        .vl-agent-actions {
            justify-content: center;
            width: 100%;
        }

        .vl-btn-action {
            flex: 1;
            font-size: 12.5px;
            padding: 8px 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="vendorlist-page">

    <!-- Top Multi-Filter Search Card -->
    <div class="vl-search-card">
        <div class="vl-search-grid">
            
            <!-- Filter 1: District Search Autocomplete -->
            <div class="vl-field-group">
                <label class="vl-field-label">District / जिला</label>
                <div class="vl-input-wrap">
                    <svg class="vl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <input type="text" id="location_search" class="vl-input" placeholder="Search District..." autocomplete="off" value="{{ $selectedDistrict ? $selectedDistrict->name : '' }}">
                    <input type="hidden" name="location" id="location_id" value="{{ $location ?? '' }}">

                    <div id="searchResults" class="search-results" style="display:none;">
                        @foreach($districtList as $value)
                            <div class="result-item" data-id="{{ $value->id }}" data-name="{{ strtolower($value->name) }}">
                                {{ $value->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Filter 2: City Dropdown (Select2) -->
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

            <!-- Filter 3: Sub Category Dropdown (Select2) -->
            <div class="vl-field-group">
                <label class="vl-field-label">Speciality / सेवा</label>
                <div class="vl-input-wrap">
                    <svg class="vl-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <select id="subcategory" class="select2">
                        <option value="">Select Sub Category</option>
                        @foreach(($subCategories ?? []) as $sub)
                            <option value="{{ $sub->id }}" data-parent="{{ $sub->parent_id }}" {{ request()->route('subcategory') == $sub->id ? 'selected' : '' }}>
                                {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filter 4: Category Dropdown (Select2) -->
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
                        <option value="none">All Categories</option>
                        @foreach($category as $value)
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
    @if(isset($topadvertisments) && count($topadvertisments) > 0)
        <div class="vl-hero-banner-container">
            <div class="hero-slider">
                @foreach ($topadvertisments as $key => $topadvertisment)
                    <div class="slide {{ ($key == 0) ? 'active' : '' }}">
                        <img src="{{ $topadvertisment->image }}" alt="{{ $topadvertisment->image_alt }}">
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

            <!-- Left 8-Col: Agent List Cards -->
            <div class="vl-agents-column">
                @forelse ($vendoruser as $vendor)
                    <div class="vl-agent-card">
                        
                        <!-- Agent Photo -->
                        <div class="vl-agent-photo-wrap">
                            <img src="{{ $vendor->profile_photo ? $vendor->profile_photo : asset('images/images.png') }}" alt="{{ $vendor->name }}" onerror="this.onerror=null; this.src='{{ asset('images/images.png') }}';">
                        </div>

                        <!-- Agent Information -->
                        <div class="vl-agent-info">
                            <div class="vl-agent-top-meta">
                                <span class="vl-badge-verified">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>Verified Agent</span>
                                </span>

                                @if($vendor->vendor_type == 'paid')
                                    <span class="vl-badge-premium">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                        </svg>
                                        <span>AI Verified</span>
                                    </span>
                                @endif
                            </div>

                            <h3 class="vl-agent-name">
                                <a href="{{ route('front.vendor.details', ['vendor' => $vendor->id]) }}">
                                    {{ $vendor->name }}
                                </a>
                            </h3>

                            <div class="vl-agent-location">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>{{ $vendor->business_address ?? 'Jaipur, Rajasthan' }}</span>
                            </div>

                            @php
                                $cleanMobile = !empty($vendor->mobile) ? preg_replace('/[^0-9+]/', '', $vendor->mobile) : (!empty($vendor->whats_app) ? preg_replace('/[^0-9+]/', '', $vendor->whats_app) : '');
                                $waNum = '';
                                if (!empty($vendor->whats_app)) {
                                    $waNum = preg_replace('/[^0-9]/', '', $vendor->whats_app);
                                    if (strlen($waNum) == 10) {
                                        $waNum = '91' . $waNum;
                                    }
                                }
                            @endphp

                            <!-- Action Buttons -->
                            <div class="vl-agent-actions">
                                @if(!empty($cleanMobile))
                                    <a href="tel:{{ $cleanMobile }}" class="vl-btn-action vl-btn-call" onclick="if(!/Android|iPhone|iPad|iPod/i.test(navigator.userAgent)){ event.preventDefault(); alert('Phone Number: {{ $cleanMobile }}'); }">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                        <span>Call Now</span>
                                    </a>
                                @endif

                                @if($vendor->vendor_type == 'paid' && !empty($waNum))
                                    <a href="https://wa.me/{{ $waNum }}" class="vl-btn-action vl-btn-whatsapp" target="_blank">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        <span>WhatsApp</span>
                                    </a>
                                @endif

                                @if(!empty($vendor->email))
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $vendor->email }}" class="vl-btn-action vl-btn-enquiry" target="_blank">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span>Send Enquiry</span>
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                @empty
                    <!-- No Record Found Card -->
                    <div class="vl-empty-card">
                        <div class="vl-empty-icon">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                <line x1="8" y1="11" x2="14" y2="11"></line>
                            </svg>
                        </div>
                        <h3 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 6px;">No Verified Agents Found</h3>
                        <p style="font-size: 14.5px; color: #64748B; margin-bottom: 20px;">Try searching with a different district or category.</p>
                        <a href="{{ route('front.vendorlist') }}" class="vl-btn-action vl-btn-call">Clear Filters</a>
                    </div>
                @endforelse
            </div>

            <!-- Right Sidebar: Advertisements -->
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
        var $citySearch = $('#city_search');
        var $categorySearch = $('#category');
        var $subcategory = $('#subcategory');
        var $headerDistrict = $('#district_id_header');
        var $headerCity = $('#city_id_header');
        var $headerContinue = $('#applyDistrictCity');

        var cityApiTemplate = "{{ route('get.cities', ['district' => 'DISTRICT_ID_PLACEHOLDER']) }}";
        var listUrlTemplate = "{{ route('front.vendorlist.location', ['location' => 'LOCATION_ID_PLACEHOLDER']) }}";
        var locationCategoryUrlTemplate = "{{ route('front.vendorlist.location.category', ['location' => 'LOCATION_ID_PLACEHOLDER', 'category' => 'CATEGORY_ID_PLACEHOLDER']) }}";
        var locationSubCategoryUrlTemplate = "{{ route('front.vendorlist.location.subcategory', ['location' => 'LOCATION_ID', 'subcategory' => 'SUBCATEGORY_ID']) }}";

        var currentCategoryId = "{{ $selectedCategory ?? '' }}";
        var selectedSubCategory = "{{ $selectedSubCategory ?? '' }}";
        var selectedDistrictId = "{{ $location ?? '' }}";
        var selectedCityId = "{{ $selectedCityId ?? '' }}";
        var pendingCategoryId = '';
        var pendingSubCategoryId = '';

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
            $subcategory.select2({
                placeholder: 'Select Sub Category',
                allowClear: true,
                width: '100%'
            });
        }

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

        function selectDistrict($item) {
            $('#location_search').val($item.text().trim());
            selectedDistrictId = String($item.data('id'));
            selectedCityId = '';
            $('#location_id').val(selectedDistrictId);
            persistSelection(selectedDistrictId, $item.text().trim(), '');
            loadCitiesByDistrict(selectedDistrictId, '');
            $('#searchResults').hide();

            // Redirect on district select
            var redirectUrl = currentCategoryId
                ? locationCategoryUrlTemplate
                    .replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId)
                    .replace('CATEGORY_ID_PLACEHOLDER', currentCategoryId)
                : listUrlTemplate.replace('LOCATION_ID_PLACEHOLDER', selectedDistrictId);

            window.location.href = redirectUrl;
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
            if (e.key === 'Enter') {
                e.preventDefault();
                var $firstVisible = $('.result-item:visible').first();
                if ($firstVisible.length) {
                    selectDistrict($firstVisible);
                }
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
            if (!$(e.target).closest('.vl-input-wrap').length) {
                $('#searchResults').hide();
            }
        });

        $('#category').on('change', function () {
            var categoryId = $(this).val();
            if (!categoryId || categoryId === 'none') {
                return;
            }

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
            }
        });

        $subcategory.on('change', function () {
            var subcategoryId = $(this).val();
            if (!subcategoryId) {
                localStorage.removeItem('selectedSubCategory');
                return;
            }

            localStorage.setItem('selectedSubCategory', subcategoryId);
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
            }
        });

        if (selectedDistrictId) {
            persistSelection(selectedDistrictId, $('#location_search').val(), selectedCityId);
            loadCitiesByDistrict(selectedDistrictId, selectedCityId);
        } else {
            resetCityDropdown();
        }

        if (selectedSubCategory) {
            localStorage.setItem('selectedSubCategory', selectedSubCategory);
            $subcategory.val(selectedSubCategory).trigger('change.select2');
        } else {
            var storedSubCategory = localStorage.getItem('selectedSubCategory');
            if (storedSubCategory) {
                $subcategory.val(storedSubCategory).trigger('change.select2');
            }
        }
    });
</script>
@endpush
