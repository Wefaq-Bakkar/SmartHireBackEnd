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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs');
            $table->foreignId('seeker_id')->constrained('users');
            $table->foreignId('specialist_id')->constrained('users');
            $table->enum('application_status', [
                'screening',
                'in-review',
                'interview-scheduled',
                'on-hold',
                'rejected',
                'offered',
                'offer-accepted',
                'offer-declined',
                'hired',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};