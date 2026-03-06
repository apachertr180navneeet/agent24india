<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('settings'))
        {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('site_title')->nullable();
                $table->string('logo_title')->nullable();
                $table->string('payment_gateway')->nullable();
                $table->text('demo_1_video_url')->nullable();
                $table->text('demo_2_video_url')->nullable();
                $table->text('demo_3_video_url')->nullable();
                $table->string('logo_image')->nullable();

                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
