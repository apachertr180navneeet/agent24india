<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\UploadImage;
use App\Http\Traits\UploadFile;

class BusinessListing extends Model
{
    use SoftDeletes, Statusable, StatusToggleable, UploadImage, UploadFile;

    protected $fillable = [
        'user_id',
        'full_name',
        'home_city',
        'contact_number',
        'company_name',
        'email',
        'banner_title',
        'banner_image',
        'banner_target_url',
        'type',
        'is_approved',
        'status',
        'created_by',
        'updated_by'
    ];
}
