<?php

namespace App\Http\Controllers\Pengaju;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\Penulis;
use App\Models\Buku;
use App\Models\Pengaju;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

use function Psy\debug;

class BukuController extends Controller
{
    public function create()
    {
        return view('pengaju.buku.create');
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $penulis = Penulis::create([
                'nama' => $request['namaPenulis'],
                'noTelepon' => $request['noTeleponPenulis'],
                'alamat' => $request['alamatPenulis'],
            ]);

            $coverPath = $this->simpanImage('cover', $request->file('coverBuku'));
            $coverBelakangPath = $this->simpanImage('coverBelakang', $request->file('coverBukuBelakang')); // Path untuk cover belakang

            $suratPath = $this->simpanPDF('surat', $request->file('suratKeaslian'));
            $draftBukuPath = $this->simpanPDF('draftBuku', $request->file('draftBuku'));

            Buku::create([
                'pengaju_id' => Auth::user()->id,
                'penulis_id' => $penulis->id,
                'judul' => $request['judul'],
                'jumlahHalaman' => $request['jumlahHalaman'],
                'daftarPustaka' => $request['daftarPustaka'],
                'resensi' => $request['resensi'],
                'draftBuku' => $draftBukuPath,
                'suratKeaslian' => $suratPath,
                'coverBuku' => $coverPath,
                'coverBukuBelakang' => $coverBelakangPath, // Simpan path untuk cover buku belakang
                'tahunTerbit' => $request['tahunTerbit'],
                'harga' => $request['harga'],
                'noProduk' => null,
                'isbn' => $request['isbn'],
                'status' => 'pending',
                'statusUpload' => 'belum upload',
                'adminComment' => null,
            ]);
            DB::commit();
            return back()->with('success', 'Data Buku Pengajuan Berhasil Dikirim');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    private function simpanPDF($type, $file)
    {
        $dt = new DateTime();
        $path = storage_path('app/public/uploads/' . $type . '/' . $dt->format('Y-m-d'));

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $name = $type . '_' . $dt->format('Y-m-d');
        $fileName = $name . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/uploads/' . $type . '/' . $dt->format('Y-m-d'), $fileName);
        return $filePath;
    }


    private function simpanImage($type, $file)
    {
        $dt = new DateTime();
        $path = storage_path('app/public/uploads/cover/' . $type . '/' . $dt->format('Y-m-d'));

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $name =  $type . '_' . $dt->format('Y-m-d');
        $fileName = $name . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/uploads/cover/' . $type . '/' . $dt->format('Y-m-d'), $fileName);
        return $filePath;
    }


    private function caripenulis($buku_id)
    {
        return Penulis::where('buku_id', $buku_id)->first();
    }

    // public function Storeeditreview (Request $request, $id)
    // {
    //     $data1 = $request->all();
    //     $buku = Buku::findOrFail($id);
    //     $buku->update($data1);
    //     return redirect('/Admin/buku/download')->with('success', 'Data buku berhasil diperbarui.');
    // }



}
