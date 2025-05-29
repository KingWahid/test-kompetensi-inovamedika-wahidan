<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained()->onDelete('cascade');
            $table->foreignId('tindakan_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('obat_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('jumlah_obat')->nullable(); // Jumlah obat yang diresepkan
            $table->decimal('biaya_tindakan', 10, 2)->nullable(); // Biaya tindakan
            $table->decimal('biaya_obat', 10, 2)->nullable(); // Biaya obat (jumlah * harga)
            $table->text('catatan')->nullable();
            $table->foreignId('dokter_id')->constrained('users')->onDelete('set null'); // Dokter yang menangani
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_kunjungans');
    }
};
