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
            $table->string('judul');
            $table->string('jumlahHalaman');
            $table->string('daftarPustaka');
            $table->string('resensi');
            $table->string('suratKeaslian');
            $table->string('coverBuku');
            $table->string('coverBukuBelakang');
            $table->string('tahunTerbit');
            $table->string('harga');
            $table->string('noProduk')->nullable();
            $table->string('isbn')->nullable();
            $table->enum('status', ['pending', 'accept', 'revisi', 'tolak'])->default('pending');
            $table->enum('statusUpload', ['belum upload', 'sudah upload'])->default('belum upload');
            $table->enum('publish', ['is_publish', 'non_publish'])->default('non_publish');
            $table->text('adminComment')->nullable();
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
