<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{

    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worker_id');
            $table->unsignedBigInteger('company_id');
            $table->bigInteger('id_number');
            $table->string('name');
            $table->date('DOB');
            $table->integer('phone');
            $table->string('visa_image');
            $table->integer('status');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('worker_id')->references('id')->on('workers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
