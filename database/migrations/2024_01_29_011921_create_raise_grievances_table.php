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
        Schema::create('raise_grievances', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('complain');
            $table->string('complain_number');
            $table->string('message');
            $table->string('status_raise');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raise_grievances');
    }
};
