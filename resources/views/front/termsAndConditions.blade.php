@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
@endpush

@section('content')
<section class="terms-section">
    <div class="terms-container">

        <h2 style="text-align:center;">Terms & Conditions</h2>

        <p><strong>Welcome to Agent 24 India.</strong><br>
        By accessing or using our website, you agree to comply with and be bound by these Terms & Conditions. Please read them carefully before using the platform.</p>

        <h4>1. Platform Usage</h4>
        <p>
            Agent 24 India provides a digital platform that allows agents to create profiles and promote their services through listings and banner advertisements. We act only as a facilitator and do not guarantee leads, conversions, sales, or any specific business outcomes.
        </p>

        <h4>2. User Responsibility</h4>
        <p>
            Users are solely responsible for the accuracy, authenticity, and legality of the information shared on their profiles, including contact details, services offered, images, and advertisements.
        </p>

        <h4>3. Prohibited Content</h4>
        <p>
            Users must not upload or publish any content that is false, misleading, illegal, offensive, defamatory, or infringes on intellectual property rights. Agent 24 India reserves the right to remove such content without prior notice.
        </p>

        <h4>4. Payments & Advertisements</h4>
        <p>
            All payments made for banner advertisements, featured listings, or premium services are <strong>non-refundable</strong>, unless explicitly stated otherwise in writing. Advertisement visibility depends on selected plans, availability, and technical constraints.
        </p>

        <h4>5. Account Suspension</h4>
        <p>
            Agent 24 India reserves the right to suspend, restrict, or permanently terminate any account that violates these terms or misuses the platform in any manner.
        </p>

        <h4>6. Technical Issues & Downtime</h4>
        <p>
            The website may occasionally be unavailable due to maintenance, server issues, technical faults, or unforeseen circumstances. Agent 24 India and its partners shall not be liable for any data loss, business loss, revenue loss, or inconvenience arising from such downtime.
        </p>

        <h4>7. Changes to Terms</h4>
        <p>
            Agent 24 India may update these Terms & Conditions at any time without prior notice. Continued use of the website constitutes acceptance of the updated terms.
        </p>

        <p><strong>Disclaimer:</strong> Agent 24 India does not verify or endorse any agents listed on the platform. Users are advised to independently verify credentials and services before engaging.</p>

    </div>
</section>
<style>
.terms-container, .about-container {
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