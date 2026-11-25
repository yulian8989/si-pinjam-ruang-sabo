<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pinjam Ruang Sabo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url("{{ asset('images/baltek-sabo.jpg') }}");
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            align-items: center;
            color: white;
        }
        .card-room {
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
            cursor: pointer;
            border: none;
        }
        .card-room:hover {
            transform: scale(1.05); 
            box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important; 
            z-index: 1;
        }
        .card-room .card-img-top {
            transition: filter 0.3s ease;
        }
        .card-room:hover .card-img-top {
            filter: brightness(90%);
        }
        
        /* Penyesuaian tampilan kalender */
        #calendar {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
        .fc-event {
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-light">

@include('landingpage.partials.navbar')

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3">Pinjam Ruang Sabo</h1>
            <p class="lead mb-5">Layanan baru dari Balai Teknik Sabo untuk memudahkan peminjaman ruangan </p>
            <a href="#jadwal" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow me-2">Cek Jadwal</a>
            <a href="#rooms" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold shadow">Lihat Ruangan</a>
        </div>
    </header>

    {{-- BAGIAN KALENDER JADWAL (BARU) --}}
    <section id="jadwal" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Jadwal Penggunaan Ruangan</h2>
                <p class="text-muted">Cek ketersediaan ruangan sebelum Anda mengajukan peminjaman.</p>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body p-2 p-md-4">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </section>

@include('landingpage.partials.list-rooms')

@include ('landingpage.partials.footer')

    {{-- Script Bawaan --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.3.1/index.min.js"></script>
    
    {{-- Script FullCalendar --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            // Inisialisasi Kalender
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    week: 'Minggu',
                    day: 'Hari'
                },
                locale: 'id', // Mengubah bahasa kalender menjadi Indonesia
                
                // Menerima data JSON dari Controller Laravel
                events: @json($events ?? []), 
                
                // Aksi ketika jadwal diklik (memunculkan alert detail)
                eventClick: function(info) {
                    var startDate = info.event.start.toLocaleString('id-ID', { dateStyle: 'full', timeStyle: 'short' });
                    var endDate = info.event.end ? info.event.end.toLocaleString('id-ID', { timeStyle: 'short' }) : 'Selesai';
                    
                    alert(
                        "Detail Peminjaman:\n\n" +
                        "Peminjam: " + info.event.title + "\n" +
                        "Waktu: " + startDate + " - " + endDate + " WIB\n" +
                        (info.event.extendedProps.purpose ? "Keperluan: " + info.event.extendedProps.purpose : "")
                    );
                }
            });
            
            calendar.render();
        });
    </script>
</body>
</html>