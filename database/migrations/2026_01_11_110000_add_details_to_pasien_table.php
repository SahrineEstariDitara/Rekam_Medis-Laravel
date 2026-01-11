<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pasien', function (Blueprint $table) {
            $table->string('tempat_lahir')->after('nama');
            $table->string('no_tlp')->after('alamat');
            $table->text('keluhan')->after('no_tlp');
            $table->integer('tinggi_badan')->nullable()->after('keluhan');
            $table->integer('berat_badan')->nullable()->after('tinggi_badan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pasien', function (Blueprint $table) {
            $table->dropColumn(['tempat_lahir', 'no_tlp', 'keluhan', 'tinggi_badan', 'berat_badan']);
        });
    }
};
