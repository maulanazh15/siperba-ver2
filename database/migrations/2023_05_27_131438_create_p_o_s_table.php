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
        Schema::create('po', function (Blueprint $table) {
            $table->id('kode_po');
            $table->timestamp('tanggal');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('supplier_id');
            $table->integer('harga_barang');
            $table->integer('jumlah_barang');
            $table->enum('status',['Dipesan','Masuk']);
            $table->string('detail')->nullable();

            $table->foreign('barang_id')->references('id')->on('barang');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po');
    }
};
