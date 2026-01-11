<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahkan kolom ke tabel dokters
        if (Schema::hasTable('dokter')) {
            Schema::table('dokter', function (Blueprint $table) {
                if (!Schema::hasColumn('dokter', 'jenis_kelamin')) {
                    $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('nama');
                }
                if (!Schema::hasColumn('dokter', 'tanggal_lahir')) {
                    $table->date('tanggal_lahir')->nullable()->after('jenis_kelamin');
                }
            });
        }

        // Tambahkan kolom ke tabel users
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'jenis_kelamin')) {
                    $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('role');
                }
                if (!Schema::hasColumn('users', 'tanggal_lahir')) {
                    $table->date('tanggal_lahir')->nullable()->after('jenis_kelamin');
                }
            });
        }
    }

    public function down(): void
    {
        // Hapus kolom dari tabel dokters
        if (Schema::hasTable('dokter')) {
            Schema::table('dokter', function (Blueprint $table) {
                if (Schema::hasColumn('dokter', 'jenis_kelamin')) {
                    $table->dropColumn('jenis_kelamin');
                }
                if (Schema::hasColumn('dokter', 'tanggal_lahir')) {
                    $table->dropColumn('tanggal_lahir');
                }
            });
        }

        // Hapus kolom dari tabel users
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'jenis_kelamin')) {
                    $table->dropColumn('jenis_kelamin');
                }
                if (Schema::hasColumn('users', 'tanggal_lahir')) {
                    $table->dropColumn('tanggal_lahir');
                }
            });
        }
    }
};