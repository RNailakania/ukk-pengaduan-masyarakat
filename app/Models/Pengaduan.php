<?php

namespace App\Models;

use App\Models\Masyarakat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik_id',
        'tgl_pengaduan',
        'isilaporan',
        'foto',
        'status',
    ];

    public function masyarakat(){
        return $this->hasMany(Masyarakat::class);
    }
}
