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
                            @if(auth()->user()->hasPermissionTo('Add District'))
                                <a href="{{ route('admin.district.create') }}" class="btn btn-block btn-primary"><i class="fas fa-plus"></i> Add</a>
                            @endif

                            <a href="{{ route('admin.district.listHomeDistricts') }}" class="btn btn-block btn-success"><i class="fas fa-plus"></i> Home page</a>
                        </div>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto;">
                        <table id="dataTable" class="table table-bordered table-hover" data-url="{{route('admin.district.getDistricts')}}" data-destroy-url="{{route('admin.district.destroy')}}" data-change-status-url="{{route('admin.district.changeStatus')}}" data-export-csv-url="{{route('admin.district.export', ['type' => 'excel'])}}">
                            <thead>
                                <tr>
                                    <th>S.no.</th>
                                    <th>Name</th>
                                    <th>State Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Home Page</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
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
$viewPermission = auth()->user()->hasPermissionTo('View District');
$editPermission = auth()->user()->hasPermissionTo('Edit District');
$deletePermission = auth()->user()->hasPermissionTo('Delete District');
@endphp

@endsection

@push('scripts')
<script>
    var viewPermission = '{{$viewPermission}}';
    var editPermission = '{{$editPermission}}';
    var deletePermission = '{{$deletePermission}}';
</script>

<!-- Internal Chart.Bundle js-->
<script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('public/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('public/js/components.js') }}"></script>
<script src="{{ asset('public/js/district/index.js') }}"></script>
@endpush
