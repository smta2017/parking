<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            //---------------------------------
            $table->string('phone')->nullable();
            $table->string('job_title')->nullable();
            $table->string('edu')->nullable();
            $table->string('national_id')->nullable();
            $table->date('dob')->nullable();
            $table->string('avatar')->default('avatar.png');
            $table->timestamp('phone_verified_at')->nullable();
            $table->enum('gender', ['mail', 'femail'])->nullable();
            $table->tinyInteger('sms_notification')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->tinyInteger('is_admin')->nullable();
            $table->string('lang')->nullable();
            $table->string('firebase_token')->nullable();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->integer('zone_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
