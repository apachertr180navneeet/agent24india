@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
<style>
    @media (max-width: 767px) {
        .contact-section .row {
            flex-direction: column;
        }

        .contact-info {
            margin-top: 30px;
            text-align: left;
        }
    }

    .alert-success {
        background: #e6fffa;
        color: #065f46;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 4px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }

    .form-group {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    input, textarea {
        padding: 12px;
        border: 1px solid #dcdcdc;
        border-radius: 6px;
        font-size: 14px;
    }

    textarea {
        min-height: 120px;
    }

    .error {
        color: red;
        font-size: 12px;
        margin-top: 4px;
    }

    .form-actions {
        margin-top: 15px;
    }

    button {
        padding: 12px 25px;
        background: #0d6efd;
        border: none;
        color: #fff;
        border-radius: 6px;
        cursor: pointer;
    }

    /* NEW SUPPORT BOX STYLE */
    .support-info {
        background: #f8f9fa;
        padding: 15px;
        border-left: 4px solid #0d6efd;
        border-radius: 6px;
        font-size: 14px;
        line-height: 1.6;
    }

    .support-info strong {
        color: #0d6efd;
    }
</style>
@endpush

@section('content')
<section class="contact-section">
    <div class="container">
        <div class="row">

            <!-- LEFT FORM -->
            <div class="contact-form col-lg-6 col-12 order-1 order-lg-2">
                <form method="POST" action="{{ route('front.contactus.submit') }}">
                    @csrf

                    {{-- SUCCESS MESSAGE --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Person Name" value="{{ old('name') }}">
                            @error('name')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                            @error('phone')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="subject" placeholder="Enter Your Subject" value="{{ old('subject') }}">
                            @error('subject')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <textarea name="message" placeholder="Your Message">{{ old('message') }}</textarea>
                        @error('message')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit">Submit Message</button>
                    </div>
                </form>
            </div>

            <!-- RIGHT INFO -->
            <div class="contact-info col-lg-6 col-sm-12 col-12 order-2 order-lg-1">
                <h3>We are always happy to help you.</h3>

                <!-- UPDATED SUPPORT CONTENT -->
                <div class="support-info">
                    You will receive a call from this number only after submitting the form.<br>
                    Our team will call you only after you submit the form. Direct calls will not be accepted.<br><br>

                    <strong>Timings:</strong> 10:00 AM to 6:00 PM<br>
                    Our support team will respond within <strong>1 to 3 days</strong>.<br><br>

                    <strong>Official Support Number:</strong> +91 9119336617<br>
                    Please do not share your personal information with any unknown number.
                </div>

                <ul class="contact-info mt-3">
                    <li>
                        <i class="fa fa-location-dot"></i>
                        <strong>AGENT 24 INDIA</strong><br>
                        Advertising Agency, Jodhpur, Rajasthan
                    </li>

                    {{--  <li>
                        <i class="fa fa-phone"></i>
                        +91 9119336617
                    </li>  --}}

                    <li>
                        <i class="fa fa-envelope"></i>
                        contact@agent24india.com
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Optional JS if needed
</script>
@endpush