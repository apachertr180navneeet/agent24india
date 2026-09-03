@extends('admin.layout.main_app')
@section('title', 'Setting')

@push('styles')
<link href="{{ asset('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/plugins/dropify/dropify.css') }}" rel="stylesheet">

<style>
    .bootstrap-select.btn-group > .dropdown-toggle{
        padding: 8px 10px !important;
    }
</style>
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card">

                    <form action="{{ route('admin.setting.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="row">

                                {{-- Site Title --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Site Title</label>
                                        <input type="text" class="form-control" name="site_title"
                                            value="{{ $setting->site_title ?? '' }}" required>
                                    </div>
                                </div>

                                {{-- Logo Title --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Logo Title</label>
                                        <input type="text" class="form-control" name="logo_title"
                                            value="{{ $setting->logo_title ?? '' }}" required>
                                    </div>
                                </div>

                                {{-- Payment Gateway --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Payment Gateway</label>
                                        <input type="text" class="form-control" name="payment_gateway"
                                            value="{{ $setting->payment_gateway ?? '' }}" required>
                                    </div>
                                </div>

                                {{-- ================= DEMO 1 ================= --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Demo 1 Video URL</label>
                                        <input type="url" class="form-control" name="demo_1_video_url"
                                            value="{{ $setting->demo_1_video_url ?? '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Demo 1 Video Title</label>
                                        <input type="text" class="form-control" name="demo_video_title1"
                                            value="{{ $setting->demo_vedio_titel1 ?? '' }}">
                                    </div>
                                </div>

                                {{-- ================= DEMO 2 ================= --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Demo 2 Video URL</label>
                                        <input type="url" class="form-control" name="demo_2_video_url"
                                            value="{{ $setting->demo_2_video_url ?? '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Demo 2 Video Title</label>
                                        <input type="text" class="form-control" name="demo_video_title2"
                                            value="{{ $setting->demo_vedio_titel2 ?? '' }}">
                                    </div>
                                </div>

                                {{-- ================= DEMO 3 ================= --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Demo 3 Video URL</label>
                                        <input type="url" class="form-control" name="demo_3_video_url"
                                            value="{{ $setting->demo_3_video_url ?? '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Demo 3 Video Title</label>
                                        <input type="text" class="form-control" name="demo_video_title3"
                                            value="{{ $setting->demo_vedio_titel3 ?? '' }}">
                                    </div>
                                </div>

                                {{-- Logo Image --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Logo Image</label>
                                        <input type="file" class="form-control" name="logo_image" accept="image/*">
                                        @php
                                            $adminLogoPreview = null;
                                            if (!empty($setting->logo_image)) {
                                                $fn = basename(parse_url($setting->logo_image, PHP_URL_PATH) ?? $setting->logo_image);
                                                if (file_exists(public_path('upload/setting/' . $fn))) {
                                                    $adminLogoPreview = asset('public/upload/setting/' . $fn);
                                                } else {
                                                    $adminLogoPreview = $setting->logo_image;
                                                }
                                            }
                                            if (empty($adminLogoPreview)) {
                                                $latestLogo = glob(public_path('upload/setting/*.*'));
                                                if (!empty($latestLogo)) {
                                                    usort($latestLogo, function($a, $b) {
                                                        return filemtime($b) - filemtime($a);
                                                    });
                                                    $adminLogoPreview = asset('public/upload/setting/' . basename($latestLogo[0]));
                                                }
                                            }
                                        @endphp
                                        @if(!empty($adminLogoPreview))
                                            <div class="mt-2 p-2 border rounded bg-light d-inline-block">
                                                <small class="text-muted d-block mb-1 font-weight-bold">Current Dynamic Logo:</small>
                                                <img src="{{ $adminLogoPreview }}" alt="Current Logo" style="max-height: 48px; max-width: 220px; object-fit: contain;">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('public/plugins/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('public/js/components.js') }}"></script>
<script src="{{ asset('public/js/settings/settings-edit.js') }}"></script>
@endpush