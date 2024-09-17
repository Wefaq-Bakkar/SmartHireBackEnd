<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrimaryKeyToPreferenceCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('preference_categories', function (Blueprint $table) {
            $table->id()->first(); // Add id column as primary key and make it the first column
        });
    }

    public function down()
    {
        Schema::table('preference_categories', function (Blueprint $table) {
            $table->dropPrimary('preference_categories_id_primary'); // Drop the primary key constraint
        });
    }
}
