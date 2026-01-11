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
        Schema::table('resep', function (Blueprint $table) {
            if (!Schema::hasColumn('resep', 'jumlah')) {
                $table->integer('jumlah')->default(1)->after('obat_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resep', function (Blueprint $table) {
            if (Schema::hasColumn('resep', 'jumlah')) {
                $table->dropColumn('jumlah');
            }
        });
    }
};
