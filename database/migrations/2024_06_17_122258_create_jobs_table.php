<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('salary');
            $table->string('image');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('category_id');
            $table->enum('type', ['full time', 'part time', 'contract', 'freelance', 'remote']);
            $table->string('country');
            $table->date('datePosted');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['draft', 'publish', 'closed'])->default('draft');
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
