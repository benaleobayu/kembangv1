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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('langganans_id');
            $table->unsignedBigInteger('flowers_id');
            $table->integer('total');
            // tambahkan kolom-kolom lain yang dibutuhkan

            $table->timestamps();

            $table->foreign('langganans_id')->references('id')->on('langganans');
            $table->foreign('flowers_id')->references('id')->on('flowers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
