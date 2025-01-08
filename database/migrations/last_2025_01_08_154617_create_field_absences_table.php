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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('fingerprint_id')->nullable();
            $table->string('state')->nullable();
            $table->string('type')->nullable();
            $table->timestamp('timestamp');
            $table->timestamps();

            $table->foreign('fingerprint_id')->references('id')->on('fingerprints')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
