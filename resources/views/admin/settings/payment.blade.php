@extends('admin.layout.main_app')
@section('title', 'Payment History')

@push('styles')
    <link href="{{ asset('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/dropify/dropify.css') }}" rel="stylesheet">

    <style>
        .bootstrap-select.btn-group>.dropdown-toggle {
            padding: 8px 10px !important;
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
                                <th>#</th>
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            @if ($orders->count())

                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->user_name ?? '-' }}</td>
                                        <td>₹{{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            @if ($order->status == 'paid')
                                                <span class="badge badge-success">Paid</span>
                                            @else
                                                <span class="badge badge-danger">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No Payment Found</td>
                                </tr>

                            @endif

                        </tbody>

                    </table>

                    <div class="mt-3">
                        {{ $orders->links() }}
                    </div>

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
