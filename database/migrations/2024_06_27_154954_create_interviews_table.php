<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')->references('id')->on('applications');
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->unsignedBigInteger('seeker_id');
            $table->foreign('seeker_id')->references('id')->on('users');
            $table->unsignedBigInteger('specialist_id');
            $table->foreign('specialist_id')->references('id')->on('users');
            $table->dateTime('date_from');
            $table->dateTime('date_to');
            $table->string('location');
            $table->enum('status', ['strong-hire', 'wait-list', 'short-list', 'rejected']);
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
        Schema::dropIfExists('interviews');
    }
}