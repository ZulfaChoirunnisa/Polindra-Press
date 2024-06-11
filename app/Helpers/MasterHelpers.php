<?php

use App\Models\Buku;
use App\Models\Penulis;

if (!function_exists('caripenulis')) {
    function caripenulis($penulisId)
    {
        $results = Penulis::where('id', $penulisId)->first();

        return $results;
    }
}

if (!function_exists('buku')) {
    function buku()
    {
        $results = Buku::where('status', 'accepted')->get();

        return $results;
    }
}