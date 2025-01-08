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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['pns', 'ppnpn'])->default('pns');
            $table->string('name');
            $table->string('nip')->nullable();
            $table->string('username')->nullable();
            $table->string('last_education')->nullable();
            $table->string('pob')->nullable();
            $table->date('dob')->nullable();

            $table->string('kelas_jabatan')->nullable();
            $table->string('sk_tmt_jabatan')->nullable();
            $table->string('sk_tmt_golongan')->nullable();
            $table->string('nomor_karpeg')->nullable();
            $table->string('tmt_kenaikan_pangkat_selanjutnya')->nullable();


            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('work_unit_id')->nullable();
            $table->unsignedBigInteger('rank_id')->nullable();
            $table->unsignedBigInteger('placement_id')->nullable();
            $table->unsignedBigInteger('fingerprint_id')->nullable();

            $table->timestamps();

            $table->foreign('position_id')->references('id')->on('positions')->nullOnDelete();
            $table->foreign('work_unit_id')->references('id')->on('work_units')->nullOnDelete();
            $table->foreign('rank_id')->references('id')->on('ranks')->nullOnDelete();
            $table->foreign('placement_id')->references('id')->on('placements')->nullOnDelete();
            $table->foreign('fingerprint_id')->references('id')->on('fingerprints')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
