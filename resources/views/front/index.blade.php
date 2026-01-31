@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
@endpush

@section('content')
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
                            <option value="none" selected disabled>Choose Categories</option>
                            @foreach($category as $key => $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Category -->
    <section class="categories-section">
        <div class="container">
            <div class="categories-grid">
                @foreach($category as $key => $value)
                    <div class="category-card">
                        <img src="{{$value->image}}" alt="{{$value->name}}" >
                        <span>{{$value->name}}</span>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- start locations -->
    <section class="locations-section1">
        <div class="container">
            <div class="section-title">
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Show Locations </h2>
            </div>
            <div class="locations-grid1">

                <!-- Location Card -->
                @foreach($district as $districtkey => $districtvalue)    
                    <a href="#" class="location-card1">
                        <img src="https://mediawtravel.s3.ap-southeast-1.amazonaws.com/wp-content/uploads/2018/12/30030705/23.28.1-The-Blue-City-and-Mehrangarh-Fort-by-Sean-Hsu.jpg" alt="New York">
                        <div class="overlay1">
                            <h3 class="text-light">{{$districtvalue->name}}</h3>
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
@endpush