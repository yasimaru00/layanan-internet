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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('paket_layanan_id');
            $table->timestamps();
             // Relasi ke tabel sales
             $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');

             // Relasi ke tabel paket layanan
             $table->foreign('paket_layanan_id')->references('id')->on('paket_layanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
