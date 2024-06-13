<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function home()
    {
        $data['buku'] = Buku::where('publish', 'is_publish')->get();
        return view('layouts.landingpage.index', $data);
    }

    public function detailBuku($id)
    {
        $data['detailBuku'] = Buku::find($id);
        return view('layouts.landingpage.detail_buku', $data);
    }
}
