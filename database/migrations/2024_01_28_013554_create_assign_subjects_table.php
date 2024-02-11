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
        Schema::create('assign_subjects', function (Blueprint $table) {
            $table->id();
            // In your migration for the 'assign_subjects' table
            $table->unsignedBigInteger('grievance_subject_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('grievance_subject_id')->references('id')->on('grievance_subjects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

            // Optional: Add a unique constraint to prevent duplicate entries
            $table->unique(['user_id', 'grievance_subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_subjects');
    }
};
