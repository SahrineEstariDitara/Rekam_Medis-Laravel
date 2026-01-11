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
        Schema::table('dokter', function (Blueprint $table) {
            if (!Schema::hasColumn('dokter', 'no_telp')) {
                $table->string('no_telp')->nullable()->after('spesialis');
            }
            if (!Schema::hasColumn('dokter', 'alamat')) {
                $table->text('alamat')->nullable()->after('no_telp');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokter', function (Blueprint $table) {
            if (Schema::hasColumn('dokter', 'no_telp')) {
                $table->dropColumn('no_telp');
            }
            if (Schema::hasColumn('dokter', 'alamat')) {
                $table->dropColumn('alamat');
            }
        });
    }
};
