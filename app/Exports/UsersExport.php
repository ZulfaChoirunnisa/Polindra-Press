<?php

namespace App\Exports;

use App\Models\Buku;
use App\Models\Penulis;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    private $bukus;
    private $penulis;

    public function __construct()
    {
        $this->bukus = Buku::where('status', 'accept')->get();
        $this->penulis = Penulis::all();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Combine both Buku and Penulis into one collection
        $combined = $this->bukus->map(function($buku) {
            $penulis = $this->penulis->firstWhere('id', $buku->penulis_id);
            return ['buku' => $buku, 'penulis' => $penulis];
        });

        return $combined;
    }

    public function headings(): array
    {
        return [
            'judul',
            'jumlahHalaman',
            'daftarPustaka', 
            'resensi',
            'suratKeaslian',
            'coverBuku',
            'coverBukuBelakang',
            'draftBuku',
            'tahunTerbit',
            'harga',
            'noProduk',
            'isbn',
            'nama',
            'noTelepon',
            'alamat',
        ];
    }

    /**
     * Map the data for each row.
     *
     * @param $row
     * @return array
     */
    public function map($row): array
    {
        $buku = $row['buku'];
        $penulis = $row['penulis'];

        return [
            $buku->judul,
            $buku->jumlahHalaman,
            $buku->daftarPustaka,
            $buku->resensi,
            $buku->suratKeaslian,
            $buku->coverBuku,
            $buku->coverBukuBelakang,
            $buku->draftBuku,
            $buku->tahunTerbit,
            $buku->harga,
            $buku->noProduk,
            $buku->isbn,
            $penulis ? $penulis->nama : '',
            $penulis ? $penulis->noTelepon : '',
            $penulis ? $penulis->alamat : '',
        ];
    }

    /**
     * Apply styles to the worksheet.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
