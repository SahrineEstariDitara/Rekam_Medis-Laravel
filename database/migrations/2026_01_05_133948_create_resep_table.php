<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resep', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rekam_medis_id');
            $table->unsignedBigInteger('obat_id');
            $table->string('dosis');
            $table->timestamps();
            
            $table->foreign('rekam_medis_id')
                  ->references('id')
                  ->on('rekam_medis')
                  ->onDelete('cascade');
                  
            $table->foreign('obat_id')
                  ->references('id')
                  ->on('obat')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resep');
    }
};
