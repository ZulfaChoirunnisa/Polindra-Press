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

if (! function_exists('limit_sentences')) {
    function limit_sentences($text, $limit = 20) {
        $sentences = preg_split('/(?<!\w\.\w.)(?<![A-Z][a-z]\.)(?<=\.|\?)\s/', $text, -1, PREG_SPLIT_NO_EMPTY);
        if (count($sentences) <= $limit) {
            return $text;
        }
        $limited_text = implode(' ', array_slice($sentences, 0, $limit)) . '.';
        return $limited_text;
    }
}