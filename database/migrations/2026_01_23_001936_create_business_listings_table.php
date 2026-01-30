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
        if(!Schema::hasTable('business_listings')){
            Schema::create('business_listings', function (Blueprint $table) {
                $table->id();
                
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                $table->string("full_name", 225)->nullable();
                $table->string("home_city", 225)->nullable();
                $table->string("contact_number", 225)->nullable();

                $table->string("company_name", 225)->nullable();
                $table->string("email", 225)->nullable();
                
                $table->string("banner_title", 225)->nullable();
                $table->string("banner_image", 225)->nullable();
                $table->string("banner_target_url", 225)->nullable();

                $table->integer("otp")->nullable();
                $table->enum('type', ['F', 'P', 'B'])->default('F')->comment("F = Free, P = Paid, B = Banner-Ad");
                $table->boolean('is_approved')->default(0);

                $table->boolean('status')->default(1)->index();

                $table->unsignedBigInteger('created_by')->index()->nullable();
                $table->foreign('created_by')->references('id')->on('users');

                $table->unsignedBigInteger('updated_by')->index()->nullable();
                $table->foreign('updated_by')->references('id')->on('users');

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
        Schema::dropIfExists('business_listings');
    }
};
