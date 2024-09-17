<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHiresTable extends Migration
{
    public function up()
    {
        Schema::create('hires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->unsignedBigInteger('specialist_id');
            $table->foreign('specialist_id')->references('id')->on('users');
            $table->unsignedBigInteger('seeker_id');
            $table->foreign('seeker_id')->references('id')->on('users');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('salary', 10, 2);
            $table->enum('employment_type', ['full time', 'part time', 'contract', 'freelance', 'remote']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hires');
    }
}