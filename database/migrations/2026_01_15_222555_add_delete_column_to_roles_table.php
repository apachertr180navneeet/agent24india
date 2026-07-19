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
        if(!Schema::hasColumns("roles", ['status', 'created_by', 'updated_by', 'deleted_at'])){
            Schema::table('roles', function (Blueprint $table) {
                $table->boolean('status')->default(1)->after('guard_name')->index();

                $table->unsignedBigInteger('created_by')->after('status')->index()->nullable();
                $table->foreign('created_by')->references('id')->on('users');

                $table->unsignedBigInteger('updated_by')->after('created_by')->index()->nullable();
                $table->foreign('updated_by')->references('id')->on('users');

                $table->softDeletes()->after('updated_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumns("roles", ['status', 'created_by', 'updated_by', 'deleted_at'])){
            Schema::table('roles', function (Blueprint $table) {
                $table->dropColumn(['status', 'created_by', 'updated_by', 'deleted_at']);
            });
        }
    }
};
