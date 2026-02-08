@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
@endpush

@section('content')
<section class="terms-section">
    <div class="terms-container">

        <h2 style="text-align:center;">{{ $termsAndConditions->title ?? 'Terms & Conditions' }} </h2>

        <div>
            {!! $termsAndConditions->description ?? 'No terms and conditions content available.' !!}
        </div>

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