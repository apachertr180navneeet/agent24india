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

        span.selection {
            width: 100%;
        }

        span.select2-selection.select2-selection--single {
            height: 45px;
            padding: 8px 0px 0px 0px;
        }
    </style>
@endpush


@section('content')
    <div class="container mt-4">
        @php
            $user = auth()->user();
        @endphp
        @if($user->is_approved == '1')
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs mb-3" id="adTabs" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ !empty($disableFreeListing) ? '' : 'active' }}" id="free-tab" data-bs-toggle="tab"
                        data-bs-target="#free" type="button" role="tab" @if (!empty($disableFreeListing)) disabled @endif>
                        Free Listing
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ !empty($disableFreeListing) ? 'active' : '' }}" id="paid-tab"
                        data-bs-toggle="tab" data-bs-target="#paid" type="button" role="tab">
                        Paid Listing
                    </button>
                </li>

            </ul>


            <div class="tab-content">

                <!-- FREE LISTING -->
                <div class="tab-pane fade {{ !empty($disableFreeListing) ? '' : 'show active' }}" id="free">

                    @if (!empty($disableFreeListing))
                        <div class="alert alert-warning mt-3">
                            Free listing is disabled because your paid listing is active.
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('front.addListing.store') }}">
                        @csrf

                        <input type="hidden" name="type" value="free">

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->business_name }}"
                                    readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Home City</label>
                                <input type="text" name="home_city" class="form-control"
                                    value="{{ old('home_city', !empty($hasFreeListing) ? $existingListing->home_city ?? '' : '') }}"
                                    required>
                            </div>

                        </div>


                        <div class="row mb-3">

                            <div class="col-md-6">

                                <label class="form-label">Email</label>

                                <div class="input-group">

                                    <input type="email" name="email" id="listing_email" class="form-control"
                                        value="{{ old('email', $user->email) }}" readonly>

                                    <button type="button" class="btn btn-primary" id="sendOtpBtn">
                                        Send OTP
                                    </button>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">Whatsapp Number (Update In profile)</label>

                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $user->whats_app) }}" readonly>

                            </div>

                        </div>


                        <div class="row mb-3">

                            <div class="col-md-6">

                                <label class="form-label">Email OTP Verify</label>

                                <div class="input-group">

                                    <input type="text" name="otp" class="form-control" placeholder="Enter OTP"
                                        @if (!empty($hasFreeListing)) readonly @endif>

                                    <button type="button" class="btn btn-primary" id="verifyOtpBtn"
                                        @if (!empty($hasFreeListing)) disabled @endif>
                                        Verify
                                    </button>

                                </div>

                                <small id="timerText" class="text-muted"></small>

                                <button type="button" class="btn btn-link p-0 d-none" id="resendOtpBtn">
                                    Resend OTP
                                </button>

                            </div>

                        </div>


                        <button type="submit" class="btn btn-success" id="submitListingBtn"
                            @if (empty($hasFreeListing)) disabled @endif>
                            Submit Free Ad
                        </button>

                    </form>

                </div>


                <!-- PAID LISTING -->
                <div class="tab-pane fade {{ !empty($disableFreeListing) ? 'show active' : '' }}" id="paid">

                    <form action="{{ route('front.addListing.store') }}" method="POST">

                        @csrf

                        <input type="hidden" name="type" value="paid">

                        <div class="paid-listing-box">

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $existingPaidListing->name ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Home City</label>
                                    <input type="text" name="home_city" class="form-control"
                                        value="{{ old('home_city', $existingPaidListing->home_city ?? '') }}">
                                </div>


                            </div>


                            <div class="listing-footer mt-4">

                                <div class="price">
                                    <span>1 Month Price</span>
                                    <strong>250 Rs</strong>

                                    <input type="hidden" name="price" value="250">

                                </div>

                                <button type="submit" class="btn btn-primary px-4">
                                    Confirm
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>
        @else
            <h3 style="font-weight:bold; text-align:center;">
                After admin approval, you can add it to the listing.
            </h3>
        @endif

    </div>
@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        (function() {

            let otpTimer = 60;
            let otpInterval = null;

            function startOtpTimer() {

                otpTimer = 60;

                $('#resendOtpBtn').addClass('d-none');

                if (otpInterval) {
                    clearInterval(otpInterval);
                }

                otpInterval = setInterval(function() {

                    $('#timerText').text(`Resend OTP in ${otpTimer}s`);

                    otpTimer--;

                    if (otpTimer < 0) {

                        clearInterval(otpInterval);

                        $('#timerText').text('');

                        $('#resendOtpBtn').removeClass('d-none');

                    }

                }, 1000);

            }



            $('#sendOtpBtn').on('click', function() {

                let email = $('#listing_email').val();

                if (!email) {

                    alert('Enter email first');

                    return;

                }

                $.post("{{ route('front.sendEmailOtp') }}", {

                    email: email,

                    _token: "{{ csrf_token() }}"

                }, function(res) {

                    if (res.status) {

                        startOtpTimer();

                        alert('OTP sent');

                    }

                });

            });



            $('#resendOtpBtn').on('click', function() {

                $.post("{{ route('front.resendEmailOtp') }}", {

                    _token: "{{ csrf_token() }}"

                }, function(res) {

                    if (res.status) {

                        startOtpTimer();

                        alert('OTP resent');

                    } else {

                        alert(res.message);

                    }

                });

            });

        })();




        (function() {

            $('#verifyOtpBtn').on('click', function() {

                let otp = $('input[name="otp"]').val();

                if (!otp) {

                    alert('Please enter OTP');

                    return;

                }

                $.post("{{ route('front.verifyEmailOtp') }}", {

                    otp: otp,

                    _token: "{{ csrf_token() }}"

                }, function(res) {

                    if (res.status) {

                        alert('OTP Verified');

                        $('input[name="otp"]').prop('readonly', true);

                        $('#verifyOtpBtn').prop('disabled', true);

                        $('#submitListingBtn').prop('disabled', false);

                        $('#resendOtpBtn').addClass('d-none');

                        $('#timerText').text('OTP verified successfully');

                    } else {

                        alert(res.message);

                    }

                });

            });

        })();
    </script>
@endpush
