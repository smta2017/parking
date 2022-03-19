<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
             //---------------------------------
             $table->string('phone')->nullable();
             $table->date('dop')->nullable();
             $table->string('profile_picture')->default('avatar.png');
             $table->timestamp('phone_verified_at')->nullable();
             $table->enum('gender', ['mail', 'femail'])->nullable();
             $table->tinyInteger('sms_notification')->nullable();
             $table->tinyInteger('is_active')->nullable();
             $table->string('lang')->nullable();
             $table->string('firebase_token')->nullable();
             $table->string('google_id')->nullable();
             $table->string('facebook_id')->nullable();
             $table->rememberToken();
             $table->timestamps();
             $table->softDeletes();
        });

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => \Hash::make('password'),
            'email_verified_at' => Carbon::now(),

        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
