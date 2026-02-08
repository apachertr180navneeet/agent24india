@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
@endpush

@section('content')
<section class="privacy-section">
    <div class="privacy-container">

        <h2 style="text-align:center;">{{ $privacyPolicy->title ?? 'Privacy Policy' }}</h2>

        <div>
            {!! $privacyPolicy->description ?? 'No privacy policy content available.' !!}
        </div>

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