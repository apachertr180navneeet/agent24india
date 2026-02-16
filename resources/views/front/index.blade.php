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
                    <div class="search-input">
                        <label for="category"><i class="lni lni-grid-alt theme-color"></i></label>
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
                    <a href="{{ route('front.vendorlist.category', ['category' => $value->id]) }}" class="category-link">
                        <div class="category-card">
                            <img src="{{ $value->image }}" alt="{{ $value->name }}">
                            <span>{{ $value->name }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

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
    <section class="items-grid section custom-padding">
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
    </section>
@endsection

@push('scripts')
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
