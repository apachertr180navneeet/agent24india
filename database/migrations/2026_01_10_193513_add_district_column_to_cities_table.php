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
        if(!Schema::hasColumns("cities", ['district_id'])){
            Schema::table('cities', function (Blueprint $table) {
                $table->unsignedBigInteger('district_id')->after('state_id')->index()->nullable();
                $table->foreign('district_id')->references('districts')->on('id')->restrictOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumns("cities", ['district_id'])){
            Schema::table('cities', function (Blueprint $table) {
                $table->dropColumn('district_id');
            });
        }
    }
};
