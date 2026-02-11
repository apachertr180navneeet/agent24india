@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
<style>
.alert {
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 5px;
}
.alert-success {
    background: #d4edda;
    color: #155724;
}
.alert-danger {
    background: #f8d7da;
    color: #721c24;
}
.text-danger {
    color: red;
    font-size: 13px;
}
.form-row {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}
.form-row div {
    width: 100%;
}
</style>

@endpush

@section('content')
<section class="contact-section">
    <div class="container">
        <div class="row">
            <!-- Right Box -->
            <div class="support-info col-lg-6 col-12">
                <h3>Need Help? We're Here for You</h3>
                <p>
                    Our dedicated India-based support team is available to assist our agents with quick and
                    reliable solutions.
                </p>

                <ul class="benefits">
                    <li>Dedicated agent support executives</li>
                    <li>Faster issue resolution</li>
                    <li>Clear ticket tracking & follow-ups</li>
                    <li>Secure data handling</li>
                </ul>
            </div>
            <div class="contact-form col-lg-6 col-12">
                <h3>Support</h3>
                <p class="sub-text">
                    If you have any questions, issues, or need assistance, please don't hesitate to contact us.
                    Our support team is always ready to help you.
                </p>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('front.support.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div>
                            <input type="text" name="name" placeholder="Person Name" value="{{ old('name') }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div>
                            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div>
                            <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required>
                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div>
                            <input type="text" name="subject" placeholder="Enter Your Subject" value="{{ old('subject') }}" required>
                            @error('subject') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <label class="file-upload">
                            <input type="file" name="image">
                            <div class="upload-box">
                                <span>Click to upload image</span>
                                <span>PNG, JPG up to 2MB</span>
                            </div>
                        </label>
                        @error('image') <small class="text-danger d-block">{{ $message }}</small> @enderror
                    </div>

                    <textarea name="message" placeholder="Your Message" required>{{ old('message') }}</textarea>
                    @error('message') <small class="text-danger">{{ $message }}</small> @enderror

                    <div class="form-actions">
                        <button type="submit">Submit Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
@endpush
