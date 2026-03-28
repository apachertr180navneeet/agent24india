@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
@endpush

@section('content')
    <section class="about-section">
    <div class="about-container">

        <!-- About Us -->
        <div class="about-card">
            <h3 style="text-align:center;">{!! $about->title ?? 'About Us' !!}</h3>
            <div>
                {!! $about->description ?? 'No about us content available.' !!}
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