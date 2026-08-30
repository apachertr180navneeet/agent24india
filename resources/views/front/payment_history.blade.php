@extends('front.layout.main')
@section('title', 'Payment History')

@push('styles')
    <style>
        .payment-history-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 32px;
            margin: 40px auto;
            max-width: 1100px;
        }

        .payment-history-title {
            font-size: 20px;
            font-weight: 800;
            color: #0F172A;
            margin-bottom: 20px;
            border-bottom: 2px solid #F1F5F9;
            padding-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .custom-payment-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-payment-table th {
            background: #F8FAFC;
            font-size: 13.5px;
            font-weight: 700;
            color: #475569;
            padding: 14px 16px;
            text-align: left;
            border-bottom: 2px solid #E2E8F0;
        }

        .custom-payment-table td {
            padding: 14px 16px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #F1F5F9;
            vertical-align: middle;
        }

        .status-pill {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pill.paid {
            background: #DCFCE7;
            color: #166534;
        }

        .status-pill.pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .status-pill.failed {
            background: #FEE2E2;
            color: #991B1B;
        }
    </style>
@endpush

@section('content')
    <div class="section-container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
        <div class="payment-history-card">
            
            <h2 class="payment-history-title">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </svg>
                <span>Payment History</span>
            </h2>

            <div style="overflow-x: auto;">
                <table class="custom-payment-table">
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
                                    $parts = explode('_', $order->order_number);
                                    $orderType = $parts[0] ?? '';
                                    $orderNo   = $parts[1] ?? '';
                                    $advertisement = \App\Models\Advertisment::where('order_id', $order->id)->first();
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><strong>{{ $orderType }}</strong></td>
                                    <td><code style="background: #F1F5F9; padding: 3px 6px; border-radius: 4px; font-size: 13px;">{{ $orderNo }}</code></td>
                                    <td style="font-weight: 700; color: #004BEE;">₹ {{ number_format($order->total_amount, 2) }}</td>
                                    <td>{{ optional($advertisement)->sub_type ?? '-' }}</td>
                                    <td>
                                        @if ($order->status == 'paid')
                                            <span class="status-pill paid">Paid</span>
                                        @elseif($order->status == 'pending')
                                            <span class="status-pill pending">Pending</span>
                                        @else
                                            <span class="status-pill failed">Failed</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 30px; color: #64748B;">No payment history found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
