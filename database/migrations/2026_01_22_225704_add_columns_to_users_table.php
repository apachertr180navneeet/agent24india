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
        if(!Schema::hasColumns("users", ['business_name', 'business_category_id', 'business_address', 'state_id', 'district_id', 'city_id', 'pincode', 'terms_agree', 'email_verification_otp'])){
            Schema::table('users', function (Blueprint $table) {
                $table->string('business_name', 225)->nullable()->after('profile_photo')->index();
                $table->text('business_address')->after('business_name')->nullable();

                $table->unsignedBigInteger('business_category_id')->after('business_address')->index()->nullable();
                $table->foreign('business_category_id')->references('categories')->on('id')->restrictOnDelete();

                $table->unsignedBigInteger('state_id')->after('business_category_id')->index()->nullable();
                $table->foreign('state_id')->references('states')->on('id')->restrictOnDelete();

                $table->unsignedBigInteger('district_id')->after('state_id')->index()->nullable();
                $table->foreign('district_id')->references('districts')->on('id')->restrictOnDelete();

                $table->unsignedBigInteger('city_id')->after('district_id')->index()->nullable();
                $table->foreign('city_id')->references('cities')->on('id')->restrictOnDelete();

                $table->unsignedInteger('pincode')->after('city_id')->nullable();
                $table->unsignedInteger('email_verification_otp')->after('pincode')->nullable();
                $table->boolean('terms_agree')->after('email_verification_otp')->default(0);

                $table->boolean('is_approved')->after('terms_agree')->default(0);
                $table->string('vendor_image', 225)->after('is_approved');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumns("users", ['business_name', 'business_category_id', 'business_address', 'state_id', 'district_id', 'city_id', 'pincode', 'terms_agree', 'email_verification_otp'])){
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['business_name', 'business_category_id', 'business_address', 'state_id', 'district_id', 'city_id', 'pincode', 'terms_agree', 'email_verification_otp']);
            });
        }
    }
};
