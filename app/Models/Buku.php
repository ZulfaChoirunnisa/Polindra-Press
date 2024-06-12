<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'penulis_id');
    }
    public function pengaju()
    {
        return $this->belongsTo('App\Models\Pengaju');
    }
}
