<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained()->onDelete('cascade');
            $table->decimal('total_tagihan', 10, 2);
            $table->string('metode_pembayaran')->nullable(); // Tunai, Kartu, Transfer
            $table->boolean('lunas')->default(false);
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->foreignId('kasir_id')->constrained('users')->onDelete('set null'); // Kasir yang memproses
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
