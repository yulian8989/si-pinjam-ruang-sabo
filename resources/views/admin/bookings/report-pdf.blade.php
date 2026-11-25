<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12px; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        
        /* Kop Surat DomPDF Friendly */
        .kop-surat { width: 100%; border-bottom: 3px solid black; margin-bottom: 2px; }
        .kop-surat td { padding: 5px; text-align: center; }
        .garis-tipis { border-bottom: 1px solid black; margin-bottom: 20px; }
        
        /* Tabel Data */
        table.data-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table.data-table th, table.data-table td { border: 1px solid black; padding: 6px; }
        table.data-table th { background-color: #f2f2f2; }
        
        /* Tanda Tangan */
        .ttd { width: 300px; float: right; text-align: center; margin-top: 40px; }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <table class="kop-surat">
        <tr>
            <td>
                <h3 style="margin: 0;">KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</h3>
                <h3 style="margin: 0;">DIREKTORAT JENDERAL SUMBER DAYA AIR</h3>
                <h2 style="margin: 5px 0;">BALAI TEKNIK SABO</h2>
                <p style="margin: 0; font-family: Arial, sans-serif; font-size: 10px;">
                    Sopalan, Maguwoharjo, Depok, Sleman, D.I. Yogyakarta 55282
                </p>
            </td>
        </tr>
    </table>
    <div class="garis-tipis"></div>

    {{-- JUDUL LAPORAN --}}
    <h3 class="text-center" style="font-family: Arial, sans-serif;">{{ mb_strtoupper($title) }}</h3>
    <p style="margin-bottom: 5px;">Tanggal Cetak: {{ $date }}</p>

    {{-- TABEL DATA --}}
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama Peminjam</th>
                <th width="15%">Instansi</th>
                <th width="20%">Ruangan</th>
                <th width="25%">Waktu Pelaksanaan</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $index => $booking)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $booking->user->name ?? 'User Terhapus' }}</td>
                <td>{{ $booking->user->institution ?? '-' }}</td>
                <td class="text-center">{{ $booking->room->name ?? 'Ruangan Terhapus' }}</td>
                <td class="text-center">
                    {{ \Carbon\Carbon::parse($booking->start_time)->translatedFormat('d M Y') }}<br>
                    ({{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }})
                </td>
                <td class="text-center text-bold">{{ strtoupper($booking->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data peminjaman yang disetujui/selesai.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TANDA TANGAN --}}
    <div class="ttd">
        <p>Sleman, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>Administrator,</p>
        <br><br><br>
        <p class="text-bold">( ........................................ )</p>
    </div>

</body>
</html>