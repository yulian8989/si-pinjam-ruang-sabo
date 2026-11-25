<h3>Peminjaman Disetujui!</h3>
<p>Halo {{ $booking->user->name }},</p>
<p>Permohonan peminjaman ruangan <strong>{{ $booking->room->name }}</strong> telah disetujui secara final.</p>
<ul>
    <li>Waktu: {{ $booking->start_time }} s/d {{ $booking->end_time }}</li>
    <li>Keperluan: {{ $booking->purpose }}</li>
</ul>
<p>Selamat beraktivitas!</p>