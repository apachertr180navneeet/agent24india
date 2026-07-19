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
        if(!Schema::hasTable('cities'))
        {
            Schema::create('cities', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('state_id')->index()->nullable();
                $table->foreign('state_id')->references('states')->on('id')->restrictOnDelete();
                
                $table->string('name');
                $table->string('image')->nullable();
                $table->text('description')->nullable();
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
        Schema::dropIfExists('cities');
    }
};
