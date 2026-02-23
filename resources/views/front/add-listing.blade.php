@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.district-switch .btn {
    border-radius: 8px;
    margin-right: 10px;
    min-width: 120px;
}

.form-control,
.form-select {
    background: #e0e0e0;
    border: none;
    border-radius: 6px;
    padding: 10px;
}

.listing-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.listing-footer .price span {
    font-weight: 600;
    margin-right: 10px;
}

.listing-footer .price strong {
    font-size: 20px;
}
</style>
@endpush

@section('content')
<div class="container mt-4">

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs mb-3" id="adTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active"
                    id="free-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#free"
                    type="button"
                    role="tab">
                Free Listing
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="paid-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#paid"
                    type="button"
                    role="tab">
                Paid Listing
            </button>
        </li>

        {{--  <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="banner-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#banner"
                    type="button"
                    role="tab">
                Banner Ad
            </button>
        </li>  --}}
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">

        <!-- Free Listing -->
        <div class="tab-pane fade show active" id="free" role="tabpanel">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <form method="POST" action="{{ route('front.addListing.store') }}">
                @csrf

                <!-- TYPE FIELD (Hidden) -->
                <input type="hidden" name="type" value="free">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text"
                            name="name"
                            class="form-control"
                            placeholder="Enter Your Name"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Home City</label>
                        <input type="text"
                            name="home_city"
                            class="form-control"
                            placeholder="City"
                            required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email"
                                name="email"
                                id="listing_email"
                                class="form-control"
                                placeholder="Enter Email"
                                required>
                            <button type="button" class="btn btn-primary" id="sendOtpBtn">
                                Send OTP
                            </button>
                        </div>
                        <small class="text-success d-none" id="otpSuccess">
                            OTP sent successfully
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="text"
                            name="phone"
                            class="form-control"
                            placeholder="Phone Number"
                            required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">OTP</label>
                        <div class="input-group">
                            <input type="text" name="otp" class="form-control" placeholder="Enter OTP">
                            <button type="button" class="btn btn-primary" id="verifyOtpBtn">
                                Verify
                            </button>
                        </div>

                        <small id="timerText" class="text-muted mt-1"></small>

                        <button type="button"
                                class="btn btn-link p-0 d-none"
                                id="resendOtpBtn">
                            Resend OTP
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-success" id="submitListingBtn" disabled>
                    Submit Free Ad
                </button>
            </form>
        </div>

        <!-- Paid Listing -->
        <div class="tab-pane fade" id="paid" role="tabpanel">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <form action="{{ route('front.addListing.store') }}" method="POST">
                @csrf
                 <!-- TYPE FIELD (Hidden) -->
                <input type="hidden" name="type" value="paid">
                <div class="paid-listing-box">

                    <!-- District Type -->
                    <div class="district-switch mb-4">
                        <button type="button" class="btn btn-primary" id="oneDistrict">
                            1 District
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="fourDistrict">
                            4 District
                        </button>

                        <!-- hidden input -->
                        <input type="hidden" name="district_type" id="district_type" value="1">
                    </div>

                    <!-- Form Fields -->
                    <div class="row g-4">

                        <!-- Select District -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Select Dist.</label>

                            <select name="district_ids[]" id="districtSelect" class="form-select">
                                <option value="">Select</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>

                            <small class="text-danger" id="districtHint">
                                Select only 1 district
                            </small>
                        </div>

                        <!-- Home City -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Home City</label>
                            <input type="text" name="city" class="form-control" placeholder="city">
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="name">
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="listing-footer mt-4">
                        <div class="price">
                            <span>1 Month Price</span>
                            <strong id="priceText">250 Rs</strong>
                            <input type="hidden" name="price" id="price" value="250">
                        </div>

                        <button type="submit" class="btn btn-primary px-4">
                            Confirm
                        </button>
                    </div>

                </div>
            </form>
        </div>


        <!-- Banner Ad -->
        {{--  <div class="tab-pane fade" id="banner" role="tabpanel">
            <h3>Banner Ad</h3>
        </div>  --}}

    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    (function () {

        let otpTimer = 60;
        let otpInterval = null;

        function startOtpTimer() {
            otpTimer = 60;
            $('#resendOtpBtn').addClass('d-none');

            if (otpInterval) {
                clearInterval(otpInterval);
            }

            otpInterval = setInterval(function () {
                $('#timerText').text(`Resend OTP in ${otpTimer}s`);
                otpTimer--;

                if (otpTimer < 0) {
                    clearInterval(otpInterval);
                    $('#timerText').text('');
                    $('#resendOtpBtn').removeClass('d-none');
                }
            }, 1000);
        }

        $('#sendOtpBtn').on('click', function () {
            let email = $('#listing_email').val();

            if (!email) {
                alert('Enter email first');
                return;
            }

            $.post("{{ route('front.sendEmailOtp') }}", {
                email: email,
                _token: "{{ csrf_token() }}"
            }, function (res) {
                if (res.status) {
                    startOtpTimer();
                    alert('OTP sent');
                }
            });
        });

        $('#resendOtpBtn').on('click', function () {
            $.post("{{ route('front.resendEmailOtp') }}", {
                _token: "{{ csrf_token() }}"
            }, function (res) {
                if (res.status) {
                    startOtpTimer();
                    alert('OTP resent');
                } else {
                    alert(res.message);
                }
            });
        });

    })();
    
    (function () {

        $('#verifyOtpBtn').on('click', function () {

            let otp = $('input[name="otp"]').val();

            if (!otp) {
                alert('Please enter OTP');
                return;
            }

            $.post("{{ route('front.verifyEmailOtp') }}", {
                otp: otp,
                _token: "{{ csrf_token() }}"
            }, function (res) {

                if (res.status) {

                    alert('OTP Verified ✅');

                    // Lock OTP field
                    $('input[name="otp"]').prop('readonly', true);
                    $('#verifyOtpBtn').prop('disabled', true);

                    // Enable Submit Button ✅
                    $('#submitListingBtn').prop('disabled', false);

                    // UI cleanup
                    $('#resendOtpBtn').addClass('d-none');
                    $('#timerText').text('OTP verified successfully');

                } else {
                    alert(res.message);
                }

            }).fail(function () {
                alert('Server error');
            });
        });

    })();
</script>

<script>
(function () {
    const oneBtn = document.getElementById('oneDistrict');
    const fourBtn = document.getElementById('fourDistrict');
    const paidTabBtn = document.getElementById('paid-tab');
    const districtSelect = document.getElementById('districtSelect');
    const districtHint = document.getElementById('districtHint');
    const priceText = document.getElementById('priceText');
    const priceInput = document.getElementById('price');
    const $districtSelect = $('#districtSelect');
    let currentMode = 1;

    if (!oneBtn || !fourBtn || !districtSelect || !districtHint || !$districtSelect.length) {
        return;
    }

    function initDistrictSelect(mode) {
        // Destroy only when Select2 is already active
        if ($districtSelect.hasClass('select2-hidden-accessible')) {
            $districtSelect.select2('destroy');
        }

        if (mode === 1) {
            $districtSelect.select2({
                placeholder: 'Select district',
                width: '100%',
                allowClear: true
            });
            return;
        }

        $districtSelect.select2({
            placeholder: 'Select district',
            width: '100%',
            closeOnSelect: false,
            maximumSelectionLength: 4
        });
    }

    function setDistrictMode(mode) {
        currentMode = mode;

        if (mode === 1) {
            oneBtn.classList.add('btn-primary');
            oneBtn.classList.remove('btn-outline-primary');
            fourBtn.classList.remove('btn-primary');
            fourBtn.classList.add('btn-outline-primary');

            districtSelect.removeAttribute('multiple');
            districtSelect.value = '';
            initDistrictSelect(1);

            districtHint.innerText = 'Select only 1 district';
            document.getElementById('district_type').value = 1;
            if (priceText) {
                priceText.innerText = '250 Rs';
            }
            if (priceInput) {
                priceInput.value = 250;
            }
            return;
        }

        fourBtn.classList.add('btn-primary');
        fourBtn.classList.remove('btn-outline-primary');
        oneBtn.classList.remove('btn-primary');
        oneBtn.classList.add('btn-outline-primary');

        districtSelect.setAttribute('multiple', 'multiple');
        $districtSelect.val(null);
        initDistrictSelect(4);

        districtHint.innerText = 'Select exactly 4 districts';
        document.getElementById('district_type').value = 4;
        if (priceText) {
            priceText.innerText = '500 Rs';
        }
        if (priceInput) {
            priceInput.value = 500;
        }
    }

    // default mode
    setDistrictMode(1);

    // Re-init when paid tab becomes visible (Select2 behaves better on visible elements)
    if (paidTabBtn) {
        paidTabBtn.addEventListener('shown.bs.tab', function () {
            setDistrictMode(currentMode);
        });
    }

    oneBtn.addEventListener('click', function () {
        setDistrictMode(1);
    });

    fourBtn.addEventListener('click', function () {
        setDistrictMode(4);
    });
})();
</script>





@endpush
