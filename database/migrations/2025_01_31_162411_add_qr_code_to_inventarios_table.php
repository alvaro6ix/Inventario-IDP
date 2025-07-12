<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQrCodeToInventariosTable extends Migration
{
    public function up()
    {
        Schema::table('inventarios', function (Blueprint $table) {
            $table->string('qr_code')->nullable();  // Añade la columna qr_code
        });
    }

    public function down()
    {
        Schema::table('inventarios', function (Blueprint $table) {
            $table->dropColumn('qr_code');  // Elimina la columna qr_code
        });
    }
}
