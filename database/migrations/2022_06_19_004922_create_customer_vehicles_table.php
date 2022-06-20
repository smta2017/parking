<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerVehiclesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_vehicles', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('customer_id');
            $table->string('plate_number')->nullable();
            $table->string('plate_image')->nullable();
            $table->string('vehicle_color')->nullable();
            $table->string('vehicle_brand')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_model_year')->nullable();
            $table->enum('vehicle_type', ["sidan", "suv", "van", "bus", "minibus", "microbus"])->nullable()->default("sidan");
            $table->string('license_number')->nullable();
            $table->date('license_expiration')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_vehicles');
    }
}
