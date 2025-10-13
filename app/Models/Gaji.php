<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';
    protected $primaryKey = 'id_gaji';
    public $timestamps = false;

    protected $fillable = [
        'id_karyawan',
        'id_lembur',
        'periode',
        'lama_lembur',
        'total_lembur',
        'total_bonus',
        'total_tunjangan',
        'total_pendapatan',
    ];


    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function lembur()
    {
        return $this->belongsTo(Lembur::class, 'id_lembur');
    }
}
