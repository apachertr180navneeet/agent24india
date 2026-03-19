@extends('front.layout.main')
@section('title', 'Payment History')

@push('styles')
    <style>
        .table-wrapper {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
        }

        .table th {
            background: #f8f9fa;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 4px;
        }

        .badge-success {
            background: #28a745;
            color: #fff;
        }

        .badge-warning {
            background: #ffc107;
        }

        .badge-danger {
            background: #dc3545;
            color: #fff;
        }
    </style>
@endpush

@section('content')

    <section class="contact-section">
        <div class="container">

            <div class="table-wrapper">

                <h4 class="mb-4">Payment History</h4>

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Order No</th>
                            <th>Amount</th>
                            <th>Banner Type</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @if ($orders->count() > 0)

                            @foreach ($orders as $key => $order)

                                @php
                                    // Split order number (e.g. ABC_12345)
                                    $parts = explode('_', $order->order_number);
                                    $orderType = $parts[0] ?? '';
                                    $orderNo   = $parts[1] ?? '';

                                    $advertisement = \App\Models\Advertisment::where('order_id', $order->id)->first();
                                @endphp

                                <tr>

                                    <td>{{ $key + 1 }}</td>

                                    <td>
                                        <strong>{{ $orderType }}</strong>
                                    </td>

                                    <td>{{ $orderNo }}</td>

                                    <td>₹ {{ number_format($order->total_amount, 2) }}</td>

                                    <td>{{ $advertisement->sub_type }}</td>

                                    <td>
                                        @if ($order->status == 'paid')
                                            <span class="badge badge-success">Paid</span>
                                        @elseif($order->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-danger">Failed</span>
                                        @endif
                                    </td>

                                    <td>{{ $order->created_at->format('d M Y') }}</td>

                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="6" class="text-center">No payment history found</td>
                            </tr>
                        @endif

                    </tbody>

                </table>

            </div>

        </div>
    </section>

@endsection
