<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $fillable = [
        'penulis_id',
        'pengaju_id',
        'Judul',
        'JumlahHalaman',
        'DaftarPustaka',
        'Resensi',
        'suratkeaslian',
        'coverbuku',
        'tahunterbit',
        'harga',
        'noproduk',
        'ISBN',
        'admin_comments',
        'status',
    ];
    public function penulis(){
        return $this->belongsTo('App\Models\Penulis');
    }
    public function pengaju(){
        return $this->belongsTo('App\Models\Pengaju');
    }
}
