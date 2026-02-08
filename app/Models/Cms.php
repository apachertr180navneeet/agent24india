<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;

class Cms extends Model
{
    use SoftDeletes, Statusable, StatusToggleable;

    protected $table = 'cms';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'created_by',
        'updated_by'
    ];
}
