@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
@endpush

@section('content')
<section class="privacy-section">
    <div class="privacy-container">

        <h2 style="text-align:center;">Privacy Policy</h2>

        <p>
            <strong>At Agent 24 India,</strong> your privacy is very important to us. This Privacy Policy explains how we collect, use, and protect your information when you use our website and services.
        </p>

        <h4>1. Information We Collect</h4>
        <p>
            We may collect personal information such as your name, phone number, email address, business details, and profile information when you register or use our services.
        </p>

        <h4>2. Use of Information</h4>
        <p>Your information is used to:</p>
        <ul>
            <li>Create and manage your profile</li>
            <li>Display your services to users</li>
            <li>Improve our platform and services</li>
            <li>Communicate important updates and notifications</li>
        </ul>

        <h4>3. Data Protection</h4>
        <p>
            We take reasonable security measures to protect your personal data from unauthorized access, misuse, or loss. However, no method of transmission over the internet is 100% secure.
        </p>

        <h4>4. Third-Party Sharing</h4>
        <p>
            We do not sell, trade, or rent your personal information to third parties, except when required by law or necessary to provide our services.
        </p>

        <h4>5. Cookies</h4>
        <p>
            Our website may use cookies to enhance user experience, analyze website traffic, and improve overall performance.
        </p>

        <h4>6. Policy Updates</h4>
        <p>
            This Privacy Policy may be updated from time to time. Continued use of the website means you accept any changes made to this policy.
        </p>

        <p>
            If you have any questions about our Terms & Conditions or Privacy Policy, please contact us at 
            <a href="mailto:info@agent24india.com">info@agent24india.com</a>.
        </p>

    </div>
</section>

<style>
.privacy-container {
    max-width: 900px;
    margin: auto;
    padding: 30px;
    line-height: 1.8;
    font-size: 16px;
}


h4 {
    margin-top: 20px;
}

</style>
@endsection

@push('scripts')
<script>
    
</script>
@endpush