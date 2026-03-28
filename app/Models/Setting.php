<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'site_title',
        'logo_title',
        'payment_gateway',
        'demo_vedio_titel1',
        'demo_vedio_titel2',
        'demo_vedio_titel3',
        'demo_1_video_url',
        'demo_2_video_url',
        'demo_3_video_url',
        'logo_image',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['pivot'];
}
