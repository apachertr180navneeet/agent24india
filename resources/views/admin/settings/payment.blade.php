@extends('admin.layout.main_app')
@section('title', 'Payment History')

@push('styles')
    <link href="{{ asset('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/dropify/dropify.css') }}" rel="stylesheet">

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

                    <table class="table table-bordered table-striped">
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
                                            {{ $order->order_number }}
                                        </td>

                                        <td>
                                            {{ ucfirst(explode('_', $order->order_number)[0]) }}
                                        </td>

                                        <td>
                                            ₹ {{ number_format($order->total_amount, 2) }}
                                        </td>

                                        <td>
                                            {{ $order->utr_id ?? '-' }}
                                        </td>

                                        <td>

                                            @if ($order->status == 'paid')
                                                <span class="badge badge-success">
                                                    Paid
                                                </span>
                                            @elseif($order->status == 'pending')
                                                <span class="badge badge-warning">
                                                    Pending
                                                </span>
                                            @elseif($order->status == 'failed')
                                                <span class="badge badge-danger">
                                                    Failed
                                                </span>
                                            @elseif($order->status == 'cancelled')
                                                <span class="badge badge-secondary">
                                                    Cancelled
                                                </span>
                                            @else
                                                -
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">
                                        No Payment Found
                                    </td>
                                </tr>

                            @endif

                        </tbody>
                    </table>


                    {{--  <div class="d-flex justify-content-center mt-3">
                        {{ $orders->links() }}
                    </div>  --}}


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
