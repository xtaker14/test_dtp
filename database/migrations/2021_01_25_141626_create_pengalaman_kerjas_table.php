<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengalamanKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengalaman_kerja', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->string('perusahaan', 100);
            $table->string('jabatan', 100);
            $table->string('tahun', 4);
            $table->text('keterangan')->nullable();
            $table->dateTime('creation_date', $precision = 0);
            $table->dateTime('updated_date', $precision = 0);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengalaman_kerja');
    }
}
