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
.alert-info {
    background: #e7f3ff;
    color: #0c5460;
    border-left: 4px solid #007bff;
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
.file-upload {
    width: 100%;
    cursor: pointer;
}
.upload-box {
    border: 2px dashed #ccc;
    padding: 15px;
    text-align: center;
    border-radius: 6px;
    background: #fafafa;
}
.upload-box span {
    display: block;
    font-size: 13px;
}
textarea {
    width: 100%;
    min-height: 120px;
    padding: 10px;
    margin-top: 10px;
}
.form-actions {
    margin-top: 10px;
}
.form-actions button {
    background: #007bff;
    color: #fff;
    padding: 10px 18px;
    border: none;
    border-radius: 5px;
}
</style>
@endpush

@section('content')
<section class="contact-section">
    <div class="container">
        <div class="row">

            <!-- Left Info -->
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

            <!-- Right Form -->
            <div class="contact-form col-lg-6 col-12">
                <h3>Support</h3>

                <p class="sub-text">
                    If you have any questions, issues, or need assistance, please don't hesitate to contact us.
                    Our support team is always ready to help you.
                </p>

                <!-- ✅ Support Instructions Box -->
                <div class="alert alert-info">
                    <p><strong>Support Instructions:</strong></p>
                    <p>
                        For help and support, please fill out the form. Our team will contact you by phone or email 
                        after receiving your request (within <strong>1 to 3 days</strong>).
                    </p>
                    <p><strong>Timings:</strong> 10:00 AM to 6:00 PM</p>
                    <p>
                        Our team will call you only after you submit the form. Direct calls will not be accepted.
                    </p>
                    <p>
                        <strong>Official Support Number:</strong> 
                        <a href="tel:9119336617">9119336617</a>
                    </p>
                    <p style="color:red; font-weight:500;">
                        ⚠ Please do not share your personal information with any unknown number. 
                        This is our verified support number.
                    </p>
                </div>

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