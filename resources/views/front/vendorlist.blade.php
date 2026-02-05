@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
<style>
    .search-results {
        position: absolute;
        width: 100%;
        background: #fff;
        border: 1px solid #ddd;
        max-height: 200px;
        overflow-y: auto;
        z-index: 9999;
    }

    .result-item {
        padding: 10px;
        cursor: pointer;
    }

    .result-item:hover {
        background: #f2f2f2;
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
        <div class="row">
            <div class="col-lg-12 p-0">

                <div class="search-input position-relative">
                    <label>
                        <i class="lni lni-map-marker theme-color"></i>
                    </label>

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
<script>
    $(function () {

        var baseUrl = "{{ route('front.vendorlist.location', ['location' => 'LOCATION_ID_PLACEHOLDER']) }}";

        // Click on search result
        $('#searchResults').on('click', '.result-item', function () {
            var name = $(this).text().trim();
            var id   = $(this).data('id');

            $('#location_search').val(name);
            $('#location_id').val(id);

            $('#searchResults').hide();

            // Redirect
            var url = baseUrl.replace('LOCATION_ID_PLACEHOLDER', id);
            window.location.href = url;
        });

    });
</script>
<script>
    // Client-side mapping of district name -> id (populated from server-rendered data)
    document.addEventListener('DOMContentLoaded', function(){
        var locMap = {};
        @foreach($districtList as $d)
            locMap["{{ addslashes($d->name) }}"] = "{{ $d->id }}";
        @endforeach

        // When user picks/enters a value in the search input, set the select and trigger change
        $('#location_search').on('input change', function(){
            var name = $(this).val();
            if (locMap[name]){
                $('#location').val(locMap[name]).trigger('change');
            }
        });

        // Optional: pressing Enter when a partial name matches first result
        $('#location_search').on('keydown', function(e){
            if (e.key === 'Enter'){
                var val = $(this).val();
                if (locMap[val]){
                    $('#location').val(locMap[val]).trigger('change');
                } else {
                    // try case-insensitive partial match
                    var foundId = null;
                    var q = val.toLowerCase();
                    for (var k in locMap){ if (k.toLowerCase().indexOf(q) !== -1){ foundId = locMap[k]; break; } }
                    if (foundId) $('#location').val(foundId).trigger('change');
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function () {

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
            $('#location_search').val($(this).text());
            $('#searchResults').hide();
        });

        // Click outside close
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.search-input').length) {
                $('#searchResults').hide();
            }
        });

    });
</script>
@endpush
