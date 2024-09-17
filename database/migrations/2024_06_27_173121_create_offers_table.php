<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')->references('id')->on('applications');
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->unsignedBigInteger('seeker_id');
            $table->foreign('seeker_id')->references('id')->on('users');
            $table->unsignedBigInteger('specialist_id');
            $table->foreign('specialist_id')->references('id')->on('users');
            $table->enum('status', ['sent', 'accepted', 'rejected']);
            $table->decimal('salary', 10, 2);
            $table->date('startdate');
            $table->date('expiredate');
            $table->enum('employment_type', ['full time', 'part time', 'contract', 'freelance', 'remote']);
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
        Schema::dropIfExists('offers');
    }
}