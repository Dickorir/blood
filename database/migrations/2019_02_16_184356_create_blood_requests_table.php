<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_request_id');
            $table->string('user_respond_id');
            $table->string('blood_num');
            $table->string('blood_group');
            $table->integer('status')->default(0); // 0-just requested  1- accepted   2- declined  3-canceled
            $table->date('date_required');
            $table->dateTime('date_respond')->nullable();
            $table->text('user_request_notes')->nullable();
            $table->text('user_respond_notes')->nullable();
            $table->text('user_request_cancel_notes')->nullable();
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
        Schema::dropIfExists('blood_requests');
    }
}
