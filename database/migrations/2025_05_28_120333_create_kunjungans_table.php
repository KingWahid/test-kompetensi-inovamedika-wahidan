<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained()->onDelete('cascade');
            $table->foreignId('tindakan_id')->constrained()->onDelete('set null');
            $table->date('tanggal_kunjungan');
            $table->text('catatan')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('set null'); // Petugas yang mendaftarkan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};
