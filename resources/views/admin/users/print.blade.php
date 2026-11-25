<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Pengguna</title>
    {{-- Memanggil Bootstrap CSS untuk styling tabel --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: white; 
            color: black; 
            font-family: 'Times New Roman', Times, serif; /* Font resmi surat */
        }
        .kop-surat { 
            border-bottom: 4px solid black; 
            padding-bottom: 10px; 
            margin-bottom: 25px; 
        }
        .kop-surat .garis-tipis {
            border-bottom: 1px solid black;
            margin-top: 2px;
            margin-bottom: 0;
        }
        .table { font-family: Arial, sans-serif; font-size: 14px; }
        
        /* Pengaturan khusus saat di-print */
        @media print {
            @page { margin: 1.5cm; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container-fluid mt-4">
        
        {{-- KOP SURAT --}}
        <div class="kop-surat text-center">
            <h5 class="mb-0">KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</h5>
            <h5 class="mb-0">DIREKTORAT JENDERAL SUMBER DAYA AIR</h5>
            <h4 class="fw-bold mt-1 mb-0">BALAI TEKNIK SABO</h4>
            <p class="mb-0 small" style="font-family: Arial, sans-serif;">Sopalan, Maguwoharjo, Depok, Sleman, D.I. Yogyakarta 55282</p>
            <div class="garis-tipis"></div>
        </div>

        {{-- JUDUL LAPORAN --}}
        <h5 class="text-center fw-bold mb-4" style="font-family: Arial, sans-serif;">LAPORAN DATA PENGGUNA SISTEM PEMINJAMAN RUANGAN</h5>

        {{-- TABEL DATA --}}
        <table class="table table-bordered table-sm border-dark">
            <thead class="text-center align-middle" style="background-color: #f8f9fa !important; -webkit-print-color-adjust: exact;">
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama Lengkap</th>
                    <th width="15%">NIK</th>
                    <th width="20%">Kontak (Email & WA)</th>
                    <th width="15%">Instansi</th>
                    <th width="10%">Role</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @forelse($users as $index => $user)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td class="text-center font-monospace">{{ $user->nik ?? '-' }}</td>
                    <td>
                        {{ $user->email }}<br>
                        <small>{{ $user->phone ?? '-' }}</small>
                    </td>
                    <td>{{ $user->institution ?? '-' }}</td>
                    <td class="text-center text-uppercase">{{ $user->role }}</td>
                    <td class="text-center">{{ $user->is_active ? 'Aktif' : 'Belum Aktif' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- TANDA TANGAN (Otomatis menyesuaikan tanggal hari ini) --}}
        <div class="row mt-5" style="page-break-inside: avoid; font-family: Arial, sans-serif;">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <p class="mb-5">Sleman, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>Administrator,</p>
                <p class="fw-bold mb-0">( ........................................ )</p>
            </div>
        </div>
        
    </div>
</body>
</html>