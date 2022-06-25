<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('name');
            $table->string('image');
            $table->unsignedBigInteger('nationality_id');
            $table->integer('age');
            $table->integer('experience');
            $table->integer('in_sa');
            $table->string('language');
            $table->string('religion');
            $table->integer('approve_chiled');
            $table->integer('is_coocked');
            $table->integer('is_quick');
            $table->integer('time')->nullable();
            $table->string('url_sand');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('nationality_id')->references('id')->on('nationalities');
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
        Schema::dropIfExists('workers');
    }
}
