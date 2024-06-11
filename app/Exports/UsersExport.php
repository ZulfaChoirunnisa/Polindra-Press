<?php

namespace App\Exports;

use App\Models\Buku;
use App\Models\Penulis;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;


class UsersExport implements FromCollection,  WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    private $buku;
    private $penulis;

    public function __construct()
    {
        $this->buku = Buku::where('status', 'accepted')->get();
        $this->penulis = Penulis::all();
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->buku->concat($this->penulis);
    }

    public function headings(): array
    {
        return [
            'penulis_id',
            'Judul',
            'JumlahHalaman',
            'DaftarPustaka', 
            'Resensi',
            'suratkeaslian',
            'ISBN',
            'NAMA',
            'NoTelepon',
            'Alamat',
            'NIP',
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
        if ($row instanceof Buku) {
            return [
                $row->penulis_id,
                $row->Judul,
                $row->JumlahHalaman,
                $row->DaftarPustaka,
                $row->Resensi,
                $row->suratkeaslian,
                $row->ISBN,
                $row->penulis->NAMA,
                $row->penulis->NoTelepon,
                $row->penulis->Alamat,
                $row->penulis->NIP,
            ];
        }
        return [];
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
