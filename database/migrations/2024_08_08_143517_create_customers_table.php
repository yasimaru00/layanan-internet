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
            $table->string('name');
            $table->string('telp')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('service_package_id');
            $table->timestamps();

            $table->foreign('sales_id')->references('id')->on('sales');
            $table->foreign('service_package_id')->references('id')->on('service_packages');


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
