<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;

class Orders extends Model
{
    use SoftDeletes, Statusable, StatusToggleable;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'order_number',
        'razorpay_order_id',
        'total_amount',
        'currency',
        'status',
        'description'
    ];
}
