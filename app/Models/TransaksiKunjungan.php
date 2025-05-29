<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiKunjungan extends Model
{
    protected $fillable = [
        'kunjungan_id', 'tindakan_id', 'obat_id', 'jumlah_obat',
        'biaya_tindakan', 'biaya_obat', 'catatan', 'dokter_id'
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }
}
