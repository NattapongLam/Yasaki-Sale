<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code');
            $table->string('customer_name');
            $table->string('customer_contact')->nullable();
            $table->boolean('customer_flag')->default(true);
            $table->string('customer_save');
            $table->bigInteger('custgroup_id');
            $table->string('customer_address')->nullable();
            $table->bigInteger('province_id')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->bigInteger('subdistrict_id')->nullable();
            $table->string('customer_zipcode')->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->integer('customer_creditday')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
