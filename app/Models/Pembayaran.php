<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'kunjungan_id', 'total_tagihan', 'metode_pembayaran',
        'lunas', 'tanggal_pembayaran', 'kasir_id', 'catatan'
    ];

    protected $casts = [
        'lunas' => 'boolean',
        'tanggal_pembayaran' => 'datetime',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }
}
