<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferenceCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('preference_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // Add any additional columns if needed

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('preference_categories');
    }
}