<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('dokter_id');
            $table->text('keluhan');
            $table->text('diagnosa');
            $table->text('tindakan');
            $table->text('catatan')->nullable();
            $table->date('tanggal_periksa');
            $table->timestamps();
            
            $table->foreign('pasien_id')
                  ->references('id')
                  ->on('pasien')
                  ->onDelete('cascade');
                  
            $table->foreign('dokter_id')
                  ->references('id')
                  ->on('dokter')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
