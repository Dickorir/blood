<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('code')->unique()->nullable();
            $table->string('tel')->nullable();
            $table->string('level')->nullable();
            $table->string('address')->nullable();
            $table->string('password');
            $table->string('type')->default('public'); // public or private
            $table->string('role')->default('0');
            $table->string('location')->nullable();
            $table->string('county')->nullable();
            $table->string('sub_county')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
