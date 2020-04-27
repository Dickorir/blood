<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('blood_num')->unique();
            $table->string('blood_group');
            $table->string('units')->nullable();
            $table->integer('WBC')->nullable();
            $table->integer('RBC')->nullable();
            $table->integer('platelet')->nullable();
            $table->integer('plasma')->nullable();
            $table->date('date_donated');
            $table->date('exp_date');
            $table->integer('user_id'); // hospital id
            $table->boolean('request')->default(false);
            $table->boolean('expired')->default(false);
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
        Schema::dropIfExists('blood_groups');
    }
}
