<?php

namespace App\Http\Controllers\Pengaju;

use App\Http\Controllers\Controller;
use App\Models\Penulis;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use DateTime;

class BukuController extends Controller
{
    public function create()
    {
        return view('pengaju.buku.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        // Validasi input
        $request->validate([
            'namaPenulis' => 'required|string|max:255',
            'noTeleponPenulis' => 'required|string|max:15',
            'alamatPenulis' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'jumlahHalaman' => 'required|integer',
            'daftarPustaka' => 'nullable|string|max:70000',
            'resensi' => 'nullable|string',
            'tahunTerbit' => 'required|integer',
            'coverBuku' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'coverBukuBelakang' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'suratKeaslian' => 'required|file|mimes:pdf|max:25000', // 25000 KB = 25 MB
            'draftBuku' => 'required|file|mimes:pdf|max:25000', // 25000 KB = 25 MB
        ]);

        try {

            $penulis = Penulis::create([
                'nama' => $request['namaPenulis'],
                'noTelepon' => $request['noTeleponPenulis'],
                'alamat' => $request['alamatPenulis'],
            ]);
            // dd($penulis);
            $coverPath = $this->simpanFile('cover', $request->file('coverBuku'));
            $coverBelakangPath = $request->hasFile('coverBukuBelakang') ? $this->simpanFile('coverBelakang', $request->file('coverBukuBelakang')) : null;

            $suratPath = $this->simpanFile('surat', $request->file('suratKeaslian'));
            $draftBukuPath = $this->simpanFile('draftBuku', $request->file('draftBuku'));

            Buku::create([
                'pengaju_id' => Auth::user()->pengaju->id,
                'penulis_id' => $penulis->id,
                'judul' => $request['judul'],
                'jumlahHalaman' => $request['jumlahHalaman'],
                'daftarPustaka' => $request['daftarPustaka'],
                'resensi' => $request['resensi'],
                'draftBuku' => $draftBukuPath,
                'suratKeaslian' => $suratPath,
                'coverBuku' => $coverPath,
                'coverBukuBelakang' => $coverBelakangPath,
                'tahunTerbit' => $request['tahunTerbit'],
                // 'harga' => $request['harga'],
                // 'noProduk' => null,
                // 'isbn' => $request['isbn'],
                'status' => 'pending',
                'statusUpload' => 'belum upload',
                // 'adminComment' => null,
            ]);

            DB::commit();

            return back()->with('success', 'Data Buku Pengajuan Berhasil Dikirim');
        } catch (\Exception $e) {
            DB::rollBack();
            // Deteksi kesalahan ukuran file secara spesifik
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                $errors = $e->validator->errors();
                if ($errors->has('coverBuku') || $errors->has('coverBukuBelakang') || $errors->has('suratKeaslian') || $errors->has('draftBuku')) {
                    return back()->with('error', 'File yang diunggah melebihi batas ukuran yang diizinkan.');
                }
            }
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function simpanFile($type, $file)
    {
        $dt = new DateTime();
        $path = 'uploads/' . $type . '/' . $dt->format('Y-m-d');

        $fileName = $type . '_' . $dt->format('Y-m-d_His') . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($path, $fileName, 'public');
        return $filePath;
    }
}
