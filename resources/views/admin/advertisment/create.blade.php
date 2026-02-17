@extends('admin.layout.main_app')
@section('title', $pageTitle)

@push('styles')
<!-- Select2 css-->
<link href="{{ asset('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/plugins/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('public/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">

<style>
    .bootstrap-select.btn-group > .dropdown-toggle{
        padding: 8px 10px !important;
    }
    /*input[type='text'], input[type='email']{
        text-transform: uppercase;
    }*/
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
                        <div class="card-header">
                            <h3 class="card-title">Add</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('admin.advertisment.store') }}" method="post" id="add-form" enctype="multipart/form-data">
                            @csrf
                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Start Date and Name Row -->
                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Start Date</label>
                                            <input type="date" class="form-control flatpickr-date" id="start_date" name="start_date" value="{{ old('start_date') }}" placeholder="DD/MM/YYYY"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Business name</label>
                                            <select class="form-control select-picker" id="vendor_user_id" name="vendor_user_id">
                                                <option value="">-Select-</option>
                                                @if(isset($vendoruser) && count($vendoruser) > 0)
                                                    @foreach($vendoruser as $key => $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Type and District Row -->
                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Type</label>
                                            <div class="mt-2" id="type-wrapper">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="type_category" name="type" class="custom-control-input" value="listing_page" {{ old('type', 'listing_page') == 'listing_page' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="type_category">Category</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="type_district" name="type" class="custom-control-input" value="district_page" {{ old('type') == 'district_page' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="type_district">District</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6" id="district-col">
                                        <div class="form-group">
                                            <label class="">District</label>
                                            <select class="form-control select-picker" id="district" name="district">
                                                <option value="">-Select-</option>
                                                @if(isset($districts) && count($districts) > 0)
                                                    @foreach($districts as $key => $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Category and Home City Row -->
                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6" id="category-col">
                                        <div class="form-group">
                                            <label class="">Category</label>
                                            <select class="form-control" id="category" name="category">
                                                <option value="">-Select-</option>
                                                @if(isset($parentCategories) && count($parentCategories) > 0)
                                                    @foreach($parentCategories as $key => $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Home City</label>
                                            <input type="text" class="form-control" id="home_city" name="home_city" value="{{ old('home_city') }}" placeholder="Enter Home City"/>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image and Image ALT Row -->
                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Image</label>
                                            <input type="file" class="form-control image-preview" id="image" name="image"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Image ALT</label>
                                            <input type="text" class="form-control" id="image_alt" name="image_alt" value="{{ old('image_alt') }}" placeholder="Enter Image ALT"/>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sub Type and Expiry Date Row -->
                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Sub Type</label>
                                            <select class="form-control select-picker" id="sub_type" name="sub_type">
                                                <option value="">-Select-</option>
                                                <option value="top">Top</option>
                                                <option value="side">Side</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Expiry Date</label>
                                            <input type="date" class="form-control flatpickr-date" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}" placeholder="DD/MM/YYYY"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <!-- Card footer -->
                            <div class="card-footer">
                                <div class="row row-sm">
                                    <div class="col-md-12 col-lg-12 col-xl-12 text-right">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.Card footer -->
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
<script src="{{ asset('public/plugins/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('public/js/components.js') }}"></script>
<script src="{{ asset('public/js/advertisment/create.js') }}"></script>
@endpush
