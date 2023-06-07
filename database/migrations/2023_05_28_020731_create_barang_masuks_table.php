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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id('kode_transaksi');
            $table->timestamp('tanggal_masuk');
            $table->unsignedBigInteger('kode_po');
            $table->unsignedBigInteger('barang_id');
            $table->integer('jumlah_masuk');
            $table->timestamps();

            $table->foreign('kode_po')->references('kode_po')->on('po');
            $table->foreign('barang_id')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
