<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;

class PaidListing extends Model
{
    use SoftDeletes, Statusable, StatusToggleable;

    protected $table = 'paid_listing';

    protected $fillable = [
        'bussines_id',
        'primium_start_date',
        'amount',
        'expiry_date',
        'type',
        'phone',
        'district',
        'home_city',
        'status',
        'paid_type',
        'name',
        'email',
    ];
}
