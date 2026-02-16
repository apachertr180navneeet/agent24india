@extends('admin.layout.main_app')
@section('title', $pageTitle)

@push('styles')
<!-- Select2 css-->
<link href="{{ asset('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Internal DataTables css-->
<link href="{{ asset('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/css/custom.css') }}" rel="stylesheet" type="text/css" />

<style>
    .btn-toolbar{
        justify-content:flex-end !important;
    }
</style>
@endpush

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">{{$pageTitle}}</h3>
                        </div>
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-1">
                            
                        </div>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto;">
                        <table id="dataTable" class="table table-bordered table-hover" data-url="{{route('admin.city.getCities')}}" data-destroy-url="{{route('admin.city.destroy')}}" data-change-status-url="{{route('admin.city.changeStatus')}}" data-export-csv-url="{{route('admin.city.export', ['type' => 'excel'])}}">
                            <thead>
                                <tr>
                                    <th>S.no.</th>
                                    <th>Business Name</th>
                                    <th>Mobile Number</th>
                                    <th>Paid Type</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paidlisting as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->business_name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->paid_type }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>
                                        @if(auth()->user()->hasPermissionTo('Edit Paid Listing'))
                                            <a href="{{ route('admin.paid-listing.edit', ['id' => $item->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@php
$viewPermission = auth()->user()->hasPermissionTo('View CMS');
$editPermission = auth()->user()->hasPermissionTo('Edit CMS');
@endphp

@endsection

@push('scripts')
<script>
    var viewPermission = '{{$viewPermission}}';
    var editPermission = '{{$editPermission}}';
</script>

<!-- Internal Chart.Bundle js-->

@endpush
