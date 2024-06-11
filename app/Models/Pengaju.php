<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaju extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'foto',
        'job',
        'alamat',
        'notlp',

    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
