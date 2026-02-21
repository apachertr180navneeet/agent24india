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
                        <h3 class="card-title">Listing View</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.paid-listing.update', ['id' => $paidlisting->id]) }}" method="post" id="edit-form" enctype="multipart/form-data">
                        @csrf
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="border p-4">

                                {{-- Row 1 --}}
                                <div class="row mb-3">
                                    <div class="col-md-2 font-weight-bold">Business Name</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="{{ $paidlisting->business_name ?? 'test' }}" readonly>
                                    </div>

                                    <div class="col-md-2 font-weight-bold">Mobile Number</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="{{ $paidlisting->phone ?? '' }}" readonly>
                                    </div>
                                </div>

                                {{-- Row 2 --}}
                                <div class="row mb-3">
                                    <div class="col-md-2 font-weight-bold">Type</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="{{ $paidlisting->type ?? '1' }} District" readonly>
                                    </div>

                                    <div class="col-md-2 font-weight-bold">Dist.</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="{{ $paidlisting->area_districts ?? '' }}" readonly>
                                    </div>
                                </div>

                                {{-- Row 3 --}}
                                <div class="row mb-3">
                                    <div class="col-md-2 font-weight-bold">Home City</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="{{ $paidlisting->home_city ?? 'Osia' }}" readonly>
                                    </div>

                                    <div class="col-md-2 font-weight-bold">Amount</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="{{ $paidlisting->amount ?? '250' }}" readonly>
                                    </div>
                                </div>

                                {{-- Row 4 --}}
                                {{--  <div class="row mb-3">
                                    <div class="col-md-2 font-weight-bold">Status</div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="status">
                                            <option value="1" {{ $paidlisting->status == '1' ? 'selected' : '' }}>Approved</option>
                                            <option value="0" {{ $paidlisting->status == '0' ? 'selected' : '' }}>Pending</option>
                                        </select>
                                    </div>
                                </div>  --}}

                            </div>
                        </div>

                        <!-- /.card-body -->
                        <!-- Card footer -->
                        <div class="card-footer">
                            <div class="row row-sm">
                                <div class="col-md-12 col-lg-12 col-xl-12 text-right">
                                    <div class="form-group">
                                        <a href="{{route('admin.paid-listing.index')}}" class="btn btn-info">Cancel</a>
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

@endpush
