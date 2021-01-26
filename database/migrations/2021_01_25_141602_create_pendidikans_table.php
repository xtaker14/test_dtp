<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->string('nama_sekolah', 100);
            $table->string('jurusan', 100);
            $table->string('tahun_masuk', 4);
            $table->string('tahun_lulus', 4);
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
        Schema::dropIfExists('pendidikan');
    }
}
