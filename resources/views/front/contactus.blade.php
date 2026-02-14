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
    </style>



@endpush

@section('content')
    <section class="contact-section">
      <div class="container">
        <div class="row">

            <!-- LEFT FORM (Mobile: first, Desktop: right) -->
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

            <!-- RIGHT INFO (Mobile: bottom, Desktop: left) -->
            <div class="contact-info col-lg-6 col-sm-12 col-12 order-2 order-lg-1">
                <h3><span></span> We are always happy to help you.</h3>
                <p>If you have any questions, feedback, or support-related queries, please feel free to reach out to us.</p>

                <ul>
                    <li><i class="fa fa-location-dot"></i> 23 New Design Str, Jodhpur, Rajasthan</li>
                    <li><i class="fa fa-phone"></i> +91 78528 33871</li>
                    <li><i class="fa fa-envelope"></i> info@agent24india.com, support@agent24india.com</li>
                </ul>
            </div>

        </div>

      </div>
    </section>

<style>

</style>
@endsection

@push('scripts')
<script>
    
</script>
@endpush