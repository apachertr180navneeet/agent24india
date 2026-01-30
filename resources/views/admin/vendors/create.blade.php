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
                        <form role="form" action="{{ route('admin.vendors.store') }}" method="post" id="add-user-form" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Business Name</label>
                                            <input type="text" class="form-control" id="business_name" name="business_name" value="{{ old('business_name') }}" placeholder="Enter Business Name" autocomplete="nofill" data-check-url="{{route('admin.vendors.checkBusinessName')}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Mobile</label>
                                            <input type="number" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Enter Mobile" data-check-url="{{route('admin.users.checkUserMobile')}}" autocomplete="nofill"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Enter Password" autocomplete="off nofill" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Confirm Password" autocomplete="nofill" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email" data-check-url="{{route('admin.users.checkUserEmail')}}" autocomplete="nofill"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">State</label>
                                            <select class="form-control select-picker" id="state_id" name="state_id" data-get-districts-url="{{route('admin.vendors.getDistrictsByState')}}">
                                                <option value="">Select</option>
                                                @foreach($states as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">District</label>
                                            <select class="form-control select-picker" id="district_id" name="district_id" data-get-cities-url="{{route('admin.vendors.getCitiesByDistrict')}}">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>                                 
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">City</label>
                                            <select class="form-control select-picker" id="city_id" name="city_id" >
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Enter Address" autocomplete="nofill"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="pincode">Pincode</label>
                                            <input type="text" class="form-control" id="pincode" name="pincode" value="{{ old('pincode') }}" placeholder="Enter Pincode" autocomplete="nofill"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Pick Your Location</label>
                                            <input type="text" class="form-control" id="pick_your_location" name="pick_your_location" value="{{ old('pick_your_location') }}" placeholder="Pick Your Location" autocomplete="nofill"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Agent Image</label>
                                            <input type="file" class="form-control image-preview" id="image" name="image"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Status</label>
                                            <select class="form-control select-picker" id="status" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">In-active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <h4>Tags</h4>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Category</label>
                                            <select class="form-control select-picker" id="category_id" name="category_id" data-get-sub-categories-url="{{route('admin.vendors.getSubCategories')}}">
                                                <option value="">Select</option>
                                                @foreach($categories as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Sub Category</label>
                                            <select class="form-control select-picker" id="sub_category_id" name="sub_category_id">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Description</label>
                                            <textarea class="form-control" rows="4" name="description" id="description"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Approve Status</label>
                                            <select class="form-control select-picker" id="is_approved" name="is_approved">
                                                <option value="0">Pending</option>
                                                <option value="1">Approve</option>
                                            </select>
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
<script src="{{ asset('public/js/vendors/vendors-create.js') }}"></script>
@endpush