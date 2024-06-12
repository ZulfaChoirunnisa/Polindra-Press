<?php

namespace App\Http\Controllers\Pengaju;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Penulis;
use DateTime;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HasilReviewController extends Controller
{
    public function index()
    {
        $data['buku'] = Buku::where('pengaju_id', Auth::user()->id)->get();
        return view('pengaju.buku.hasilreview', $data);
    }
    public function editreview($id)
    {
        $data['buku'] = Buku::findOrFail($id);
        return view('pengaju.buku.editreview', $data);
    }

    public function updateReview(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $buku = Buku::findOrFail($id);

            $coverPath = $request->hasFile('coverBuku') ? $this->simpanImage('cover', $request->file('coverBuku')) : $buku->coverBuku;
            $coverBelakangPath = $request->hasFile('coverBukuBelakang') ? $this->simpanImage('coverBelakang', $request->file('coverBukuBelakang')) : $buku->coverBukuBelakang;
            $suratPath = $request->hasFile('suratKeaslian') ? $this->simpanPDF('surat', $request->file('suratKeaslian')) : $buku->suratKeaslian;

            $buku->update([
                'judul' => $request['judul'],
                'jumlahHalaman' => $request['jumlahHalaman'],
                'daftarPustaka' => $request['daftarPustaka'],
                'resensi' => $request['resensi'],
                'suratKeaslian' => $suratPath,
                'coverBuku' => $coverPath,
                'coverBukuBelakang' => $coverBelakangPath,
                'tahunTerbit' => $request['tahunTerbit'],
                'harga' => $request['harga'],
                'noProduk' => null,
                'isbn' => $request['isbn'],
                'status' => 'pending',
                'statusUpload' => 'belum upload',
                'adminComment' => null,
            ]);
            $buku->penulis->update([
                'nama' => $request->namaPenulis,
                'noTelepon' => $request->noTeleponPenulis,
                'alamat' => $request->alamatPenulis
            ]);

            DB::commit();
            return redirect('/Pengaju/buku/review')->with('success', 'Data Buku berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }



    private function simpanImage($type, $file, $oldFilePath = null)
    {
        $dt = new DateTime();
        $path = storage_path('app/public/uploads/cover/' . $type . '/' . $dt->format('Y-m-d'));

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $name =  $type . '_' . $dt->format('Y-m-d');
        $fileName = $name . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/uploads/cover/' . $type . '/' . $dt->format('Y-m-d'), $fileName);

        if ($oldFilePath && Storage::exists($oldFilePath)) {
            Storage::delete($oldFilePath);
        }

        return $filePath;
    }

    private function simpanPDF($type, $file, $oldFilePath = null)
    {
        $dt = new DateTime();
        $path = storage_path('app/public/uploads/surat/' . $type . '/' . $dt->format('Y-m-d'));

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $name =  $type . '_' . $dt->format('Y-m-d');
        $fileName = $name . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/uploads/surat/' . $type . '/' . $dt->format('Y-m-d'), $fileName);

        // Hapus file lama jika ada
        if ($oldFilePath && Storage::exists($oldFilePath)) {
            Storage::delete($oldFilePath);
        }

        return $filePath;
    }
}
