<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_profile', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('bio');
            $table->string('avatar')->default('/user/default.png');
            $table->string('job_position')->nullable();
            $table->string('gender')->nullable();
            $table->tinyInteger('is_read')->unsigned()->nullable();
            $table->tinyInteger('is_view')->unsigned()->nullable();
            $table->tinyInteger('is_sharing')->unsigned()->nullable();
            $table->tinyInteger('is_card_active')->nullable();;
            $table->string('current_lat')->nullable();
            $table->string('current_long')->nullable();
            $table->string('privacy')->nullable();
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
        Schema::dropIfExists('users_profile');
    }
}
