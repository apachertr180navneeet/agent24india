@extends('admin.layout.main_app')
@section('title', 'Setting')

@push('styles')
<!-- Select2 css-->
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
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Customer Detail</h3>
                    </div> -->
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.setting.edit') }}" method="post" id="edit-setting-form" enctype="multipart/form-data">
                            <div class="card-body">
                            @csrf
                            <div class="row row-sm">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="">Site Title</label>
                                        <input type="text" class="form-control" id="site_title" name="site_title" value="{{ $setting->site_title ?? '' }}" placeholder="Enter Site Title" required/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="">Logo Title</label>
                                        <input type="text" class="form-control" id="logo_title" name="logo_title" value="{{ $setting->logo_title ?? '' }}" placeholder="Enter Logo Title" required/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="">Payment Gateway</label>
                                        <input type="text" class="form-control" id="payment_gateway" name="payment_gateway" value="{{ $setting->payment_gateway ?? '' }}" placeholder="Enter Payment Gateway" required/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="">Demo 1 Video URL</label>
                                        <input type="url" class="form-control" id="demo_1_video_url" name="demo_1_video_url" value="{{ $setting->demo_1_video_url ?? '' }}" placeholder="Enter Demo 1 Video URL"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="">Demo 2 Video URL</label>
                                        <input type="url" class="form-control" id="demo_2_video_url" name="demo_2_video_url" value="{{ $setting->demo_2_video_url ?? '' }}" placeholder="Enter Demo 2 Video URL"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="">Demo 3 Video URL</label>
                                        <input type="url" class="form-control" id="demo_3_video_url" name="demo_3_video_url" value="{{ $setting->demo_3_video_url ?? '' }}" placeholder="Enter Demo 3 Video URL"/>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="">Logo Image</label>
                                        <input type="file" class="form-control" id="logo_image" name="logo_image" placeholder="Enter Logo Image"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row row-sm">
                                <div class="col-md-12 col-lg-12 col-xl-12 text-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
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
