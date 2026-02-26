@php
    $cmsModel = new \App\Models\Cms();
    $districtModel = new \App\Models\District();
    $privacy = $cmsModel->where('id', 3)->first();
    $trem = $cmsModel->where('id', 2)->first();
    $about = $cmsModel->where('id', 1)->first();
    $districtList = $districtModel->select('id', 'name')->where('status', 1)->orderBy('name')->get();
@endphp
<header class="header">
  <div class="header-inner">

    <!-- LEFT : Logo -->
    <div class="nav-left">
      <a href="{{route('front.index')}}" class="logo">
        <img src="{{asset('public/front/assets/images/logo/agent-india-logo2.png')}}" alt="Logo">
      </a>
    </div>

    <!-- CENTER : Menu -->
    <ul class="main-menu">
      <li><a href="{{route('front.index')}}">Home</a></li>
      <li><a href="javascript:void(0)" class="js-open-district-city-popup">Category</a></li>
      <li>
        @if(\Auth::check())
          <a href="{{ route('front.addListing') }}">Free Listing</a>
        @else
          <a href="javascript:void(0)" class="open-signin">Free Listing</a>
        @endif
      </li>
      <li>
        @if(\Auth::check())
          <a href="{{ route('front.addListing') }}">Banner Ad</a>
        @else
          <a href="javascript:void(0)" class="open-signin">Banner Ad</a>
        @endif
      </li>
      <li class="dropdown">
        <a href="#">Policies ▾</a>
        <ul class="dropdown-menu">
          @if($privacy->status == 1)
            <li><a href="{{route('front.privacyPolicy')}}">Privacy Policy</a></li>
          @endif
          @if($trem->status == 1)
          <li><a href="{{route('front.termsAndConditions')}}">Terms & Conditions</a></li>
          @endif
        </ul>
      </li>
      <li><a href="{{route('front.support')}}">Support & Help</a></li>
    </ul>

    <!-- RIGHT : Sign In + Toggle -->
    <div class="nav-right">
       @if(\Auth::check())
            <a href="{{route('front.logout')}}" class="sign-btn">Logout</a>  
        @else
            <a href="javascript:void(0)" class="sign-btn open-signin">Sign In</a>
        @endif

      <button class="menu-toggle" id="menuToggle">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>

  </div>
</header>

<!-- Overlay -->
<div class="menu-overlay" id="menuOverlay"></div>

<!-- Slide Menu -->
<div class="side-menu" id="sideMenu">
    <button class="close-btn" id="closeMenu">&times;</button>
    <h4>
        @if(\Auth::check())
            <a href="javascript:void(0)">{{auth()->user()->name}}</a>
        @endif
    </h4>
    <ul>
        <li><a href="{{route('front.index')}}">Home</a></li>
        <li><a href="javascript:void(0)" class="js-open-district-city-popup">Category</a></li>
        {{--  <li><a href="{{route('front.vendorlist')}}">Vendor List</a></li>  --}}
        @if(\Auth::check())
        <li><a href="{{route('front.profile')}}">My Profile</a></li>
        <li><a href="{{route('front.addListing')}}">My Listing</a></li>
        <li><a href="">My Banner Ad</a></li>
        <li><a href="#">Payment history</a></li>
        @endif
        @if($about->status == 1)
        <li><a href="{{route('front.aboutus')}}">About Us</a></li>
        @endif
        <li><a href="{{route('front.contactus')}}">Contact Us</a></li>
        <li><a href="#">Notice</a></li>
        <li><a href="{{route('front.support')}}">Support & Help</a></li>
        @if($trem->status == 1)
        <li><a href="{{route('front.termsAndConditions')}}">Terms & Conditions</a></li>
        @endif
        @if($privacy->status == 1)
          <li><a href="{{route('front.privacyPolicy')}}">Privacy Policy</a></li>
        @endif
        {{--  @if(\Auth::check())
            <li><a href="{{route('front.logout')}}">Logout</a></li>    
        @else
            <li><a href="javascript:void(0)" class="open-signin">Sign In</a></li>
        @endif  --}}
    </ul>
</div>

<div class="modal fade" id="districtCityModal" tabindex="-1" role="dialog" aria-labelledby="districtCityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="districtCityModalLabel">Select District And City</h5>
            </div>
            <div class="modal-body">
                <select id="header_district_id" class="form-control">
                    <option value="">Choose district</option>
                    @foreach($districtList as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
                <select id="header_city_id" class="form-control mt-3">
                    <option value="">Choose city</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="goToListingByLocation">Continue</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        var cityApiTemplate = "{{ route('get.cities', ['district' => 'DISTRICT_ID_PLACEHOLDER']) }}";
        var locationUrlTemplate = "{{ route('front.vendorlist.location', ['location' => 'LOCATION_ID_PLACEHOLDER']) }}";
        var listUrl = "{{ route('front.vendorlist') }}";
        var $district = $('#header_district_id');
        var $city = $('#header_city_id');

        function getSelectionFromUrl() {
            var path = (window.location.pathname || '').replace(/\/+$/, '');
            var parts = path.split('/').filter(Boolean);
            var vendorlistIndex = parts.indexOf('vendorlist');
            var districtId = '';
            var cityId = new URLSearchParams(window.location.search).get('city') || '';

            if (vendorlistIndex !== -1 && parts.length > (vendorlistIndex + 1)) {
                districtId = String(parts[vendorlistIndex + 1]);
            }

            return {
                districtId: districtId,
                cityId: cityId
            };
        }

        function syncSelectionFromCurrentUrl() {
            var selection = getSelectionFromUrl();
            if (!selection.districtId) {
                return;
            }

            var districtName = $district.find('option[value="' + selection.districtId + '"]').text() || '';
            localStorage.setItem('selectedDistrictId', String(selection.districtId));
            localStorage.setItem('selectedDistrictName', districtName);

            if (selection.cityId) {
                localStorage.setItem('selectedCityId', String(selection.cityId));
            } else {
                localStorage.removeItem('selectedCityId');
            }
        }

        function getSelectionFromStorage() {
            return {
                districtId: localStorage.getItem('selectedDistrictId') || sessionStorage.getItem('selectedDistrictId') || '',
                cityId: localStorage.getItem('selectedCityId') || sessionStorage.getItem('selectedCityId') || ''
            };
        }

        function resetCityDropdown() {
            $city.html('<option value="">Choose city</option>');
        }

        function loadCitiesByDistrict(districtId, preselectedCityId) {
            resetCityDropdown();
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

                $city.html(options);

                if (preselectedCityId) {
                    $city.val(String(preselectedCityId));
                }
            }).fail(function () {
                resetCityDropdown();
            });
        }

        function prefillModalFromStoredSelection() {
            var stored = getSelectionFromStorage();
            $district.val(stored.districtId || '');

            if (stored.districtId) {
                loadCitiesByDistrict(stored.districtId, stored.cityId || '');
            } else {
                resetCityDropdown();
            }
        }

        $(document).on('click', '.js-open-district-city-popup', function (e) {
            e.preventDefault();

            var stored = getSelectionFromStorage();
            var districtId = stored.districtId || '';
            var cityId = stored.cityId || '';

            if (!districtId) {
                window.location.href = listUrl;
                return;
            }

            var redirectUrl = locationUrlTemplate.replace('LOCATION_ID_PLACEHOLDER', districtId);
            if (cityId) {
                redirectUrl += '?city=' + encodeURIComponent(cityId);
            }

            window.location.href = redirectUrl;
        });

        $district.on('change', function () {
            loadCitiesByDistrict($(this).val(), '');
        });

        $('#goToListingByLocation').on('click', function () {
            var districtId = $district.val();
            var cityId = $city.val();

            if (!districtId) {
                alert('Please select district');
                return;
            }

            localStorage.setItem('selectedDistrictId', String(districtId));
            localStorage.setItem('selectedDistrictName', $district.find('option:selected').text());
            sessionStorage.setItem('selectedDistrictId', String(districtId));
            sessionStorage.setItem('selectedDistrictName', $district.find('option:selected').text());

            if (cityId) {
                localStorage.setItem('selectedCityId', String(cityId));
                sessionStorage.setItem('selectedCityId', String(cityId));
            } else {
                localStorage.removeItem('selectedCityId');
                sessionStorage.removeItem('selectedCityId');
            }

            var redirectUrl = locationUrlTemplate.replace('LOCATION_ID_PLACEHOLDER', districtId);
            if (cityId) {
                redirectUrl += '?city=' + encodeURIComponent(cityId);
            }

            window.location.href = redirectUrl;
        });

        syncSelectionFromCurrentUrl();
    });
</script>
@endpush
