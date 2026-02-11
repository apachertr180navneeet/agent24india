<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;

class SupportForm extends Model
{
    use SoftDeletes, Statusable, StatusToggleable;

    protected $table = 'support_form';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'image',
        'message'
    ];
}
