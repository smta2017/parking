<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('type')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('plate_img')->nullable();
            $table->dateTime('out_at')->nullable();
            $table->string('qr_code')->nullable();
            $table->float('is_payed')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('zone_id')->nullable();
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
        Schema::drop('transactions');
    }
}
