@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')

@endpush

@section('content')
<!-- Start Hero Area -->

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
                <div class="col-lg-3 col-md-6 col-6 p-2">
                    <div class="single-grid wow fadeInUp" data-wow-delay=".2s" data-category="Premium">
                        <div class="image">
                            <a href="item-details.html" class="thumbnail"><img src="{{asset('public/front/assets/images/items-grid/img1.jpg')}}" alt="#"></a>
                            <div class="author">
                                <div class="author-image">
                                    <a href="javascript:void(0)"><img src="{{asset('public/front/assets/images/items-grid/author-1.jpg')}}" alt="#">
                                        <span>Rahul Sharma</span></a><br>
                                    <a href="javascript:void(0)" class="tag">Travel Agent</a>
                                        <ul class="info-list">
                                    <li><a href="javascript:void(0)"><i class="lni lni-map-marker"></i> 123, Ratanada, Jodhpur</a></li>
                                </ul>
                                </div>
                            </div>
                            <p class="item-position"><i class="lni lni-bolt"></i> Premium</p>
                        </div> 
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6  p-2">
                    <div class="single-grid wow fadeInUp" data-wow-delay=".2s" data-category="Premium">
                        <div class="image">
                            <a href="item-details.html" class="thumbnail"><img src="{{asset('public/front/assets/images/items-grid/img1.jpg')}}" alt="#"></a>
                            <div class="author">
                                <div class="author-image">
                                    <a href="javascript:void(0)"><img src="{{asset('public/front/assets/images/items-grid/author-1.jpg')}}" alt="#">
                                        <span>Rahul Sharma</span></a><br>
                                    <a href="javascript:void(0)" class="tag">Travel Agent</a>
                                        <ul class="info-list">
                                    <li><a href="javascript:void(0)"><i class="lni lni-map-marker"></i> 123, Ratanada, Jodhpur</a></li>
                                </ul>

                                </div>
                            </div>
                            <p class="item-position"><i class="lni lni-bolt"></i> Premium</p>
                        </div> 
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6  p-2">
                    <div class="single-grid wow fadeInUp" data-wow-delay=".2s" data-category="Premium">
                        <div class="image">
                            <a href="item-details.html" class="thumbnail"><img src="{{asset('public/front/assets/images/items-grid/img1.jpg')}}" alt="#"></a>
                            <div class="author">
                                <div class="author-image">
                                    <a href="javascript:void(0)"><img src="{{asset('public/front/assets/images/items-grid/author-1.jpg')}}" alt="#">
                                        <span>Rahul Sharma</span></a><br>
                                    <a href="javascript:void(0)" class="tag">Travel Agent</a>
                                        <ul class="info-list">
                                    <li><a href="javascript:void(0)"><i class="lni lni-map-marker"></i> 123, Ratanada, Jodhpur</a></li>
                                </ul>

                                </div>
                            </div>
                            <p class="item-position"><i class="lni lni-bolt"></i> Premium</p>
                        </div> 
                    </div>
                </div>
            
                <div class="col-lg-3 col-md-6 col-6 p-2">
                    <div class="single-grid wow fadeInUp" data-wow-delay=".2s" data-category="Free">
                        <div class="image">
                            <a href="item-details.html" class="thumbnail"><img src="{{asset('public/front/assets/images/items-grid/img1.jpg')}}" alt="#"></a>
                            <div class="author">
                                <div class="author-image">
                                    <a href="javascript:void(0)"><img src="{{asset('public/front/assets/images/items-grid/author-1.jpg')}}" alt="#">
                                        <span>Rahul Sharma</span></a><br>
                                    <a href="javascript:void(0)" class="tag">Travel Agent</a>
                                        <ul class="info-list">
                                    <li><a href="javascript:void(0)"><i class="lni lni-map-marker"></i> 123, Ratanada, Jodhpur</a></li>
                                </ul>

                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            
                <div class="col-lg-3 col-md-6 col-6 p-2">
                    <div class="single-grid wow fadeInUp" data-wow-delay=".2s" data-category="Free">
                        <div class="image">
                            <a href="item-details.html" class="thumbnail"><img src="{{asset('public/front/assets/images/items-grid/img1.jpg')}}" alt="#"></a>
                            <div class="author">
                                <div class="author-image">
                                    <a href="javascript:void(0)"><img src="{{asset('public/front/assets/images/items-grid/author-1.jpg')}}" alt="#">
                                        <span>Rahul Sharma</span></a><br>
                                    <a href="javascript:void(0)" class="tag">Travel Agent</a>
                                        <ul class="info-list">
                                    <li><a href="javascript:void(0)"><i class="lni lni-map-marker"></i> 123, Ratanada, Jodhpur</a></li>
                                </ul>

                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6 p-2">
                    <div class="single-grid wow fadeInUp" data-wow-delay=".2s" data-category="Free">
                        <div class="image">
                            <a href="item-details.html" class="thumbnail"><img src="{{asset('public/front/assets/images/items-grid/img1.jpg')}}" alt="#"></a>
                            <div class="author">
                                <div class="author-image">
                                        <a href="javascript:void(0)"><img src="{{asset('public/front/assets/images/items-grid/author-1.jpg')}}" alt="#">
                                        <span>Rahul Sharma</span></a><br>
                                        <a href="javascript:void(0)" class="tag">Travel Agent</a>
                                        <ul class="info-list">
                                            <li><a href="javascript:void(0)"><i class="lni lni-map-marker"></i> 123, Ratanada, Jodhpur</a></li>
                                        </ul>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6 p-2">
                    <div class="single-grid wow fadeInUp" data-wow-delay=".2s" data-category="Free">
                        <div class="image">
                            <a href="item-details.html" class="thumbnail"><img src="{{asset('public/front/assets/images/items-grid/img1.jpg')}}" alt="#"></a>
                            <div class="author">
                                <div class="author-image">
                                    <a href="javascript:void(0)"><img src="{{asset('public/front/assets/images/items-grid/author-1.jpg')}}" alt="#">
                                        <span>Rahul Sharma</span></a><br>
                                    <a href="javascript:void(0)" class="tag">Travel Agent</a>
                                        <ul class="info-list">
                                    <li><a href="javascript:void(0)"><i class="lni lni-map-marker"></i> 123, Ratanada, Jodhpur</a></li>
                                </ul>

                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6 p-2">
                    <div class="single-grid wow fadeInUp" data-wow-delay=".2s" data-category="Free">
                        <div class="image">
                            <a href="item-details.html" class="thumbnail"><img src="{{asset('public/front/assets/images/items-grid/img1.jpg')}}" alt="#"></a>
                            <div class="author">
                                <div class="author-image">
                                    <a href="javascript:void(0)"><img src="{{asset('public/front/assets/images/items-grid/author-1.jpg')}}" alt="#">
                                    <span>Rahul Sharma</span></a><br>
                                    <a href="javascript:void(0)" class="tag">Travel Agent</a>
                                    <ul class="info-list">
                                        <li><a href="javascript:void(0)"><i class="lni lni-map-marker"></i> 123, Ratanada, Jodhpur</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

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
