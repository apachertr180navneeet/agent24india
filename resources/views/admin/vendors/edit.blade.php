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
                            <h3 class="card-title">Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('admin.vendors.update', ['id' => $user->id]) }}" method="post" id="edit-user-form" enctype="multipart/form-data">
                            @csrf
                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Hidden input -->
                                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                <!-- Hidden input -->

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Business Name</label>
                                            <input type="text" class="form-control" id="business_name" name="business_name" value="{{ $user->business_name }}" placeholder="Enter Business Name" autocomplete="nofill" data-check-url="{{route('admin.vendors.checkBusinessName')}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Mobile</label>
                                            <input type="number" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}" placeholder="Enter Mobile" data-check-url="{{route('admin.users.checkUserMobile')}}" autocomplete="nofill"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Enter Email" data-check-url="{{route('admin.users.checkUserEmail')}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">State</label>
                                            <select class="form-control select-picker" id="state_id" name="state_id" data-get-districts-url="{{route('admin.vendors.getDistrictsByState')}}">
                                                <option value="">Select</option>
                                                @foreach($states as $key => $value)
                                                    <option value="{{$value->id}}" {{$user->state_id == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
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
                                                @foreach($districts as $key => $value)
                                                    <option value="{{$value->id}}" {{$user->district_id == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                 
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">City</label>
                                            <select class="form-control select-picker" id="city_id" name="city_id" >
                                                <option value="">Select</option>
                                                @foreach($cities as $key => $value)
                                                    <option value="{{$value->id}}" {{$user->city_id == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" placeholder="Enter Address"/>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="pincode">Pincode</label>
                                            <input type="text" class="form-control" id="pincode" name="pincode" value="{{ $user->pincode }}" placeholder="Enter Pincode" autocomplete="nofill"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Pick Your Location</label>
                                            <input type="text" class="form-control" id="pick_your_location" name="pick_your_location" value="{{ $user->pick_your_location }}" placeholder="Pick Your Location" autocomplete="nofill"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        @php
                                        $image = '';
                                        if(isset($user->profile_photo) && !empty($user->profile_photo))
                                        {
                                            $image = $user->profile_photo;
                                        }
                                        @endphp
                                        <div class="form-group">
                                            <label class="">Agent Image 
                                                @if(!empty($image))
                                                    <span>
                                                        <a href="{{$image}}" download><i class="fa fa-download"></i></a>
                                                    </span>
                                                @endif
                                            </label>
                                            <input type="file" class="form-control image-preview" id="image" name="image" data-show-remove="false" data-default-file="{{$image}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Status</label>
                                            <select class="form-control select-picker" id="status" name="status">
                                                <option value="1" {{($user->status == 1) ? 'selected' : ''}}>Active</option>
                                                <option value="0" {{($user->status == 0) ? 'selected' : ''}}>In-active</option>
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
                                                    <option value="{{$value->id}}" {{$user->business_category_id == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Sub Category</label>
                                            <select class="form-control select-picker" id="sub_category_id" name="sub_category_id">
                                                <option value="">Select</option>
                                                @foreach($subCategories as $key => $value)
                                                    <option value="{{$value->id}}" {{$user->business_sub_category_id == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label class="">Description</label>
                                            <textarea class="form-control" rows="4" name="description" id="description">{{ $user->description }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-sm">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label class="">Approve Status</label>
                                            <select class="form-control select-picker" id="is_approved" name="is_approved">
                                                <option value="0" {{$user->is_approved == 0 ? 'selected' : ''}}>Pending</option>
                                                <option value="1" {{$user->is_approved == 1 ? 'selected' : ''}}>Approve</option>
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
                                            <a href="{{route('admin.vendors.index')}}" class="btn btn-info">Cancel</a>
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
    <script src="{{ asset('public/js/vendors/vendors-edit.js') }}"></script>
    @endpush