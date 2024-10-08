<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class BukuController extends Controller
{
    public function dashboard()
    {
        $publishedBuku = Buku::where('status', 'accept')->get();

        return view('admin.buku.dashboard', compact('publishedBuku'));
    }
    public function create()
    {
        return view('book.create');
    }
    public function store(Request $request)
    {
        
        $buku = new Buku();
        $buku->title = $request->title;
        $buku->author = $request->author;
        $buku->pages = $request->pages;
        $buku->references = $request->references;
        $buku->review = $request->review;
        $buku->authenticity_statement = $request->authenticity_statement;
        $buku->author_bio = $request->author_bio;
        $buku->save();

        return redirect('/')->with('status', 'Book submitted successfully!');
    }
    public function index()
    {
        $buku = Buku::all();
        $data['buku'] = $buku;
        return view('admin.buku.index', $data);
    }
    public function download()
    {
        $data['buku'] = Buku::where('status', 'accept')->get();
        return view('admin.buku.download', $data);
    }
    public function show($id)
    {
        $buku = Buku::find($id);
        return view('admin.show', compact('book'));
    }

    public function review($id)
    {
        $buku = Buku::find($id);
        $data['buku'] = $buku;
        return view('admin.buku.review', $data);
    }

    public function postreview(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $buku = Buku::find($id);
            $buku->status = $request->status;
            $buku->adminComment = $request->catatan;
            $buku->save();
            DB::commit();
            return back()->with('success', 'Status Berhasil Diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }

        return redirect('/Admin/buku')->with('status', 'Book reviewed successfully!');
    }

    public function postreviewAdmin(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $buku = Buku::find($id);
            $buku->status = $request->status;
            $buku->adminComment = $request->catatan;
            $buku->save();
            DB::commit();
            return back()->with('success', 'Status Berhasil Diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }

        return redirect('/SuperAdmin/buku')->with('status', 'Book reviewed successfully!');
    }

    public function edit(Request $request, $id)
    {
        $data['buku'] = Buku::find($id);
        return view('admin.buku.edit', $data);
    }
    public function storeedit(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $buku = Buku::find($id);
            $buku->update([
                'isbn' => $request->isbn,
                'harga' => $request->harga,
                'noProduk' => $request->noProduk,
            ]);

            DB::commit();
            if (Auth::user()->role == 'admin') {
                return redirect('/Admin/buku/download')->with('success', 'Berhasil menambahkan isbn dan no produk');
            }
            return redirect('/SuperAdmin/buku')->with('success', 'Berhasil menambahkan isbn dan no produk');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error' . $e->getMessage());
        }
    }
    public function exportBukuUsers()
    {
        return Excel::download(new UsersExport(), 'buku ajuan.xlsx');
    }

    // public function Publish()
    // {
    //     $buku = Buku::where('statusUpload', 'belum_upload')->get();

    //     return view('admin.buku.publish', compact('buku'));
    // }

    public function publishBuku(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $buku = Buku::find($id);
            $buku->update([
                'publish' => $request->publish
            ]);
            DB::commit();
            return back()->with('success', 'Data Buku Berhasil Di Publish');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'error' . $e->getMessage());
        }


        // Redirect kembali ke halaman publish dengan pesan sukses
        return redirect()->route('Admin.Buku.Publish')->with('success', 'Buku berhasil dipublish!');
    }

    public function bukuDownload($id, $type)
    {
        $buku = Buku::findOrFail($id);

        if ($type == 'cover') {
            return response()->download(public_path('storage/' . $buku->coverBuku));
        }

        if ($type == 'draft') {
            return response()->download(public_path('storage/' . $buku->draftBuku));
        }

        if ($type == 'keaslian') {
            return response()->download(public_path('storage/' . $buku->suratKeaslian));
        }

        abort(404);
    }
}
