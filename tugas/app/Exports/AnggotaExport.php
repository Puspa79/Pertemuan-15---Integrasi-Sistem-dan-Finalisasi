<?php

namespace App\Exports;
 
use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
 
class AnggotaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengambil kolom yang spesifik agar data sensitif/internal tidak ikut bocor ke Excel
        return Anggota::select([
            'kode_anggota', 'nama', 'email', 'telepon', 'alamat',
            'tanggal_lahir', 'jenis_kelamin', 'pekerjaan', 'status', 'tanggal_daftar',
        ])->get();
    }
 
    public function headings(): array
    {
        // Memberikan judul kolom pada baris pertama spreadsheet
        return [
            'Kode', 'Nama', 'Email', 'Telepon', 'Alamat',
            'Tanggal Lahir', 'Jenis Kelamin', 'Pekerjaan', 'Status', 'Tanggal Daftar',
        ];
    }
}
