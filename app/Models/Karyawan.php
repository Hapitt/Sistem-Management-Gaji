<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    public $timestamps = false;

    protected $fillable = [
        'id_jabatan',
        'id_rating',
        'nama',
        'divisi',
        'alamat',
        'umur',
        'jenis_kelamin',
        'status',
        'foto',
        'created_at',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'id_rating', 'id_rating');
    }
}
