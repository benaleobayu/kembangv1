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
            $table->unsignedBigInteger('langganan_id');
            $table->foreign('langganan_id')->references('id')->on('langganans')->onDelete('cascade');
            $table->unsignedBigInteger('flowers_id');
            $table->foreign('flowers_id')->references('id')->on('flowers');
            $table->integer('total');
            $table->timestamps();
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
