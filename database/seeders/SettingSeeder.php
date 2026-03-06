<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = Setting::orderBy('id', 'asc')->first();

        if (!$setting) {
            Setting::create([
                'site_title' => 'agent24india',
                'logo_title' => 'agent24india',
                'payment_gateway' => '',
                'demo_1_video_url' => null,
                'demo_2_video_url' => null,
                'demo_3_video_url' => null,
                'logo_image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

