<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $fillable = ['pasien_id', 'tindakan_id', 'tanggal_kunjungan', 'catatan', 'user_id'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksiKunjungans()
    {
        return $this->hasMany(TransaksiKunjungan::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}
