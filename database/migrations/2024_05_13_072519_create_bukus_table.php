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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penulis_id');
            $table->unsignedBigInteger('pengaju_id');
            $table->string('Judul');
            $table->string('JumlahHalaman');
            $table->string('DaftarPustaka');
            $table->string('Resensi');
            $table->string('suratkeaslian');
            $table->string('coverbuku');
            $table->string('tahunterbit');
            $table->string('harga');
            $table->string('noproduk')->nullable();
            $table->string('ISBN')->nullable();
            $table->string('status')->default('pending');
            $table->string('statusupload')->default('belum upload');
            $table->text('admin_comments')->nullable();
            $table->timestamps();

            $table->foreign('penulis_id')->references('id')->on('penulis')->onDelete('cascade');
            $table->foreign('pengaju_id')->references('id')->on('pengajus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukus');
    }
};
