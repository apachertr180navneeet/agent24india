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
        if(!Schema::hasTable('businesses'))
        {
            Schema::create('businesses', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('user_id')->index()->nullable();
                $table->foreign('user_id')->references('users')->on('id')->restrictOnDelete();

                $table->string('name')->index('businesses_name_index', length: 191);
                $table->string('contact_number', 20)->nullable();
                $table->string('email', 200)->nullable();

                $table->unsignedBigInteger('state_id')->index()->nullable();
                $table->foreign('state_id')->references('states')->on('id')->restrictOnDelete();

                $table->unsignedBigInteger('city_id')->index()->nullable();
                $table->foreign('city_id')->references('cities')->on('id')->restrictOnDelete();

                $table->unsignedBigInteger('district_id')->index()->nullable();
                $table->foreign('district_id')->references('districts')->on('id')->restrictOnDelete();

                $table->text('address')->nullable();
                $table->string('pincode', 10)->nullable();
                $table->text('location')->comment('Google picked location')->nullable();
                $table->string('image')->comment('Vendor image')->nullable();

                $table->unsignedBigInteger('category_id')->index()->nullable();
                $table->foreign('category_id')->references('categories')->on('id')->restrictOnDelete();

                $table->unsignedBigInteger('subcategory_id')->index()->comment('Sub Categories or Tags')->nullable();
                $table->foreign('subcategory_id')->references('categories')->on('id')->restrictOnDelete();

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
        Schema::dropIfExists('businesses');
    }
};
