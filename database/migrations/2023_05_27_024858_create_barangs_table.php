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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->unsignedBigInteger('kelompok_barang_id');
            // $table->decimal('harga_beli', 10, 2)->nullable();
            // $table->decimal('harga_jual', 10, 2)->nullable();
            $table->integer('stok')->default('0');
            $table->unsignedBigInteger('lokasi_barang_id');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('kelompok_barang_id')->references('id')->on('kelompok_barang');
            $table->foreign('lokasi_barang_id')->references('id')->on('lokasi_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
