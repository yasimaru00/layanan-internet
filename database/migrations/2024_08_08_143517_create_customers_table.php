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
            // $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('sales_id')->references('id')->on('sales');
            $table->foreign('paket_layanan_id')->references('id')->on('paket_layanans');
            // $table->foreign('user_id')->references('id')->on('users');


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
