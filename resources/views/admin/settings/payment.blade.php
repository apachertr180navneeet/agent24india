@extends('admin.layout.main_app')
@section('title', 'Payment History')

@push('styles')
    <link href="{{ asset('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/dropify/dropify.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        .bootstrap-select.btn-group>.dropdown-toggle {
            padding: 8px 10px !important;
        }

        .badge {
            padding: 6px 10px;
            font-size: 12px;
        }

        .badge-success {
            background: #28a745;
            color: #fff;
        }

        .badge-warning {
            background: #ffc107;
            color: #000;
        }

        .badge-danger {
            background: #dc3545;
            color: #fff;
        }

        .badge-secondary {
            background: #6c757d;
            color: #fff;
        }
    </style>
@endpush


@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Payment History</h3>
            </div>

            <div class="card-body">

                <!-- Custom Search (Optional) -->
                <input type="text" id="customSearch" class="form-control mb-3" placeholder="Search payment...">

                <table id="paymentTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Party Name</th>
                            <th>Mobile number</th>
                            <th>Payment Type</th>
                            <th>Order number</th>
                            <th>Amount</th>
                            <th>UTR ID</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @if ($orders->count())

                            @foreach ($orders as $order)
                                <tr>

                                    <td>
                                        {{ date('d/m/Y', strtotime($order->created_at)) }}
                                    </td>

                                    <td>
                                        {{ $order->user_name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $order->user_mobile ?? '-' }}
                                    </td>

                                    <td>
                                        {{ ucfirst(explode('_', $order->order_number)[0]) }}
                                    </td>

                                    <td>
                                        {{ $order->order_number }}
                                    </td>

                                    <td>
                                        ₹ {{ number_format($order->total_amount, 2) }}
                                    </td>

                                    <td>
                                        {{ $order->utr_id ?? '-' }}
                                    </td>

                                    <td>

                                        @if ($order->status == 'paid')
                                            <span class="badge badge-success">Paid</span>
                                        @elseif($order->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($order->status == 'failed')
                                            <span class="badge badge-danger">Failed</span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge badge-secondary">Cancelled</span>
                                        @else
                                            -
                                        @endif

                                    </td>

                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="8" class="text-center">
                                    No Payment Found
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>

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

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {

            // Initialize DataTable
            var table = $('#paymentTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100]
            });

            // Custom Search Input
            $('#customSearch').on('keyup', function () {
                table.search(this.value).draw();
            });

        });
    </script>
@endpush