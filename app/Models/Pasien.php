<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = ['nama', 'alamat', 'telepon', 'tanggal_lahir', 'jenis_kelamin'];

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }
}
