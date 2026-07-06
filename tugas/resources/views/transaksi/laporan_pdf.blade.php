<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 11px; color: #000; margin: 15px 25px; }
 
        /* Header Instansi / Kop Surat */
        .kop-surat { text-align: center; border-bottom: 2px solid #000; padding-bottom: 8px; margin-bottom: 18px; }
        .kop-surat h1 { font-size: 16px; margin: 0; text-transform: uppercase; font-weight: bold; }
        .kop-surat p { font-size: 11px; margin: 2px 0; }
 
        /* Judul Laporan Diperkecil Sesuai Request */
        h2 { text-align: center; font-size: 12px; margin: 15px 0 20px 0; text-transform: uppercase; font-weight: bold; }
 
        /* Layout Info Surat dan Tanggal Kanan Atas */
        .meta-wrapper { width: 100%; margin-bottom: 20px; }
        .info-surat { float: left; width: 60%; font-size: 11px; line-height: 1.5; }
        .info-surat table { border: none; width: auto; }
        .info-surat td { padding: 1px 4px; vertical-align: top; border: none; }
        .info-surat td.label { width: 120px; }
        .info-surat td.titik-dua { width: 10px; text-align: center; }
        .info-surat td.value { font-weight: bold; }
 
        /* Blok Tanggal Atas Sebelah Kanan Banget */
        .tanggal-atas { float: right; width: 35%; text-align: right; font-size: 11px; padding-right: 4px; font-weight: bold; }
 
        /* Tabel Utama Data */
        table.data { width: 100%; border-collapse: collapse; margin-top: 15px; table-layout: fixed; clear: both; }
        table.data th, table.data td { border: 1px solid #000; padding: 6px 6px; font-size: 10.5px; word-wrap: break-word; }
        table.data th { text-align: center; font-weight: bold; text-transform: uppercase; background-color: #f5f5f5; }
        
        .nowrap { white-space: nowrap; }
        table.data td.denda { text-align: right; white-space: nowrap; font-variant-numeric: tabular-nums; }
        table.data td.center { text-align: center; }
 
        /* Blok Tanda Tangan Bawah */
        .ttd-wrapper { margin-top: 50px; width: 100%; clear: both; }
        .ttd-box { float: right; text-align: center; width: 230px; font-size: 11px; }
        .ttd-box .jabatan-wrapper { margin-bottom: 65px; }
        .ttd-box .nama { text-decoration: underline; font-weight: bold; margin-top: 4px; }
        .ttd-box .jabatan { font-size: 10.5px; }
        .clearfix::after { content: ""; display: table; clear: both; }
 
        .footer-note { margin-top: 35px; font-size: 8.5px; text-align: center; font-style: italic; color: #444; clear: both; }
    </style>
</head>
<body>
 
    {{-- Kop Surat / Header Instansi --}}
    <div class="kop-surat">
        <h1>Perpustakaan Bina Nusantara</h1>
        <p>Jl. Pahlawan No. 1, Pekalongan, Jawa Tengah</p>
        <p>Email: perpustakaan@binanusantara.ac.id | Telp: (0285) 123456</p>
    </div>
 
    {{-- Judul Halaman (Ukurannya Sudah Dikecilkan) --}}
    <h2>Laporan Analisis Transaksi Perpustakaan</h2>
 
    {{-- Gabungan Info Surat Kiri dan Tanggal Pojok Kanan Atas --}}
    <div class="meta-wrapper clearfix">
        <div class="info-surat">
            <table>
                <tr>
                    <td class="label">Hal</td>
                    <td class="titik-dua">:</td>
                    <td class="value">Rekapitulasi Riwayat Peminjaman Buku</td>
                </tr>
                <tr>
                    <td class="label">Total Transaksi (Filter)</td>
                    <td class="titik-dua">:</td>
                    <td class="value">{{ $totalTransaksi }} Data Transaksi</td>
                </tr>
                <tr>
                    <td class="label">Total Denda Terbuku</td>
                    <td class="titik-dua">:</td>
                    <td class="value">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
        
        {{-- Tanggal ditaruh di paling kanan atas sejajar baris 'Hal' --}}
        <div class="tanggal-atas">
            Pekalongan, {{ \Carbon\Carbon::now()->format('d F Y') }}
        </div>
    </div>
 
    {{-- Tabel Utama Data --}}
    <table class="data">
        <thead>
            <tr>
                <th style="width: 11%;">Kode</th>
                <th style="width: 22%;">Anggota</th>
                <th style="width: 29%;">Buku</th>
                <th style="width: 14%;">Tgl Pinjam</th>
                <th style="width: 12%;">Status</th>
                <th style="width: 12%;">Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $trx)
            <tr>
                <td class="center nowrap" style="font-family: monospace; font-size: 9.5px;">{{ $trx->kode_transaksi }}</td>
                <td>{{ $trx->anggota->nama }}</td>
                <td>{{ $trx->buku->judul ?? '-' }}</td>
                <td class="center nowrap">{{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d-m-Y') }}</td>
                <td class="center nowrap">{{ ucfirst(strtolower($trx->status)) }}</td>
                <td class="denda">Rp {{ number_format($trx->denda ?? 0, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; padding: 15px; color: #555;">Tidak ada data transaksi yang memenuhi kriteria filter.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
 
    {{-- Blok Tanda Tangan Bawah --}}
    <div class="ttd-wrapper clearfix">
        <div class="ttd-box">
            <div class="jabatan-wrapper">
                <div>Mengetahui,</div>
                <div class="jabatan">Petugas Penanggung Jawab</div>
            </div>
            <div class="nama">Puspa Dwi Setyorini</div>
            <div class="jabatan">NIP. Perpustakaan-2026001</div>
        </div>
    </div>
 
    <p class="footer-note">Dokumen ini dihasilkan secara otomatis oleh Sistem Informasi Perpustakaan dan sah tanpa memerlukan cap basah resmi.</p>
 
</body>
</html>