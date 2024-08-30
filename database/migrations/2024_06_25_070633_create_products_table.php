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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('pd_code');
            $table->string('pd_name');
            $table->string('pd_unit')->nullable();
            $table->string('pd_group')->nullable();
            $table->decimal('pd_stc',18,2)->nullable();
            $table->decimal('pd_price',18,2)->nullable();
            $table->string('pd_pic1')->nullable();
            $table->string('pd_pic2')->nullable();
            $table->string('pd_pic3')->nullable();
            $table->string('pd_pic4')->nullable();
            $table->boolean('pd_flag')->default(true);
            $table->string('pd_save');
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
        Schema::dropIfExists('products');
    }
};
