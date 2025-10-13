<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    public $timestamps = false;

    protected $fillable = [
        'jabatan',
        'gaji_pokok',
        'tunjangan',
        'created_at'
    ];
}
