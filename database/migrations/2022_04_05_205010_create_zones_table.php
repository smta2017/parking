<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('manager');
            $table->string('phone');
            $table->integer('capacity');
            $table->integer('parent_id')->nullable();
            $table->float('hour_rate')->default(10);
            $table->float('second_hour_rate')->nullable()->default(5);
            $table->float('overnight_rate')->nullable()->default(20);
            $table->integer('is_closed')->nullable();
            $table->integer('parent_zone_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('zones');
    }
}
