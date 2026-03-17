@extends('admin.layout.main_app')
@section('title', $pageTitle)

@push('styles')
<link href="{{ asset('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
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
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listing View</h3>
                    </div>

                    <form action="{{ route('admin.paid-listing.update', ['id' => $paidlisting->id]) }}" method="post" id="edit-form">
                        @csrf

                        <div class="card-body">
                            <div class="border p-4">

                                {{-- Business Name --}}
                                <div class="row mb-3">
                                    <div class="col-md-2 font-weight-bold">Business Name</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="{{ $paidlisting->business_name ?? '' }}" readonly>
                                    </div>
                                </div>

                                {{-- FREE LISTING --}}
                                @if($paidlisting->paid_type === 'free')

                                    <div class="row mb-3">
                                        <div class="col-md-2 font-weight-bold">Name</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->name ?? '' }}" readonly>
                                        </div>

                                        <div class="col-md-2 font-weight-bold">Email</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->email ?? '' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-2 font-weight-bold">Phone</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->phone ?? '' }}" readonly>
                                        </div>

                                        <div class="col-md-2 font-weight-bold">Home City</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->home_city_name ?? '' }}" readonly>
                                        </div>
                                    </div>

                                    {{-- District + City --}}
                                    <div class="row mb-3">
                                        <div class="col-md-2 font-weight-bold">District</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->district_names ?? '' }}" readonly>
                                        </div>

                                        <div class="col-md-2 font-weight-bold">User City</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->user_city_name ?? '' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-2 font-weight-bold">User District</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->user_district_name ?? '' }}" readonly>
                                        </div>
                                    </div>

                                {{-- PAID LISTING --}}
                                @else

                                    <div class="row mb-3">
                                        <div class="col-md-2 font-weight-bold">Full Name</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->name ?? '' }}" readonly>
                                        </div>

                                        <div class="col-md-2 font-weight-bold">Phone</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->mobile ?? '' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-2 font-weight-bold">Home City</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->home_city_name ?? '' }}" readonly>
                                        </div>

                                        <div class="col-md-2 font-weight-bold">Address</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->business_address ?? '' }}" readonly>
                                        </div>
                                    </div>

                                    {{-- District + City --}}
                                    <div class="row mb-3">
                                        <div class="col-md-2 font-weight-bold">District</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->user_district_name ?? '' }}" readonly>
                                        </div>
                                        <div class="col-md-2 font-weight-bold">City</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->user_city_name ?? '' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-2 font-weight-bold">Amount</div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="{{ $paidlisting->amount ?? '' }}" readonly>
                                        </div>
                                    </div>

                                @endif

                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('admin.paid-listing.index') }}" class="btn btn-info">Cancel</a>
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
@endpush