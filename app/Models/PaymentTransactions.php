<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;

class PaymentTransactions extends Model
{
    use SoftDeletes, Statusable, StatusToggleable;

    protected $table = 'payment_transactions';

    protected $fillable = [
        'order_id',
        'razorpay_payment_id',
        'razorpay_order_id',
        'razorpay_signature',
        'amount',
        'currency',
        'payment_method',
        'status',
        'gateway_response'
    ];
}
