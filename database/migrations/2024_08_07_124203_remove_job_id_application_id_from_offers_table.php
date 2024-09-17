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
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
            $table->dropColumn('job_id');
            $table->dropForeign(['application_id']);
            $table->dropColumn('application_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');

            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')->references('id')->on('applications');
        });
    }
};
