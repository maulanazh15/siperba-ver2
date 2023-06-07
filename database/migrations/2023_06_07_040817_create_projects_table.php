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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nama_project');
            $table->date('tanggal_pesan');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('klien_id');
            $table->integer('harga_jual');
            $table->integer('jumlah_pesanan');
            $table->string('status');
            $table->text('detail');
            $table->timestamps();
        
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->foreign('klien_id')->references('id')->on('kliens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
