{{-- File: resources/views/user/bookings/partials/flatpickr-styles.blade.php --}}
{{-- @push('styles')

@endpush --}}
{{-- 1. Panggil CSS Inti Flatpickr dari CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

{{-- 2. Kustomisasi Tema Gelap --}}
<style>
    /* Tema Gelap Flatpickr (Kustomisasi) */
    .flatpickr-calendar { background: #343a40 !important; box-shadow: 0 10px 25px rgba(0,0,0,0.5) !important; border: 1px solid #495057 !important; }
    .flatpickr-current-month, .flatpickr-month, .flatpickr-weekday, span.flatpickr-weekday { color: #e9ecef !important; fill: #e9ecef !important; }
    .flatpickr-prev-month svg, .flatpickr-next-month svg { fill: #ced4da !important; }
    .flatpickr-prev-month:hover svg, .flatpickr-next-month:hover svg { fill: #0d6efd !important; }
    .flatpickr-day { color: #f8f9fa !important; }
    .flatpickr-day:hover, .flatpickr-day:focus { background: #495057 !important; border-color: #495057 !important; color: #ffffff !important; }
    .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected:focus, .flatpickr-day.selected:hover { background: #0d6efd !important; border-color: #0d6efd !important; color: #ffffff !important; }
    .flatpickr-day.today { border-color: #0dcaf0 !important; }
    .flatpickr-day.today:hover { border-color: #0d6efd !important; background: #495057 !important; }
    .flatpickr-day.prevMonthDay, .flatpickr-day.nextMonthDay { color: #6c757d !important; }
    .flatpickr-day.flatpickr-disabled { color: #495057 !important; }
    
    /* Time Picker */
    .flatpickr-time { border-top: 1px solid #495057 !important; }
    .flatpickr-time input, .flatpickr-time .flatpickr-time-separator, .flatpickr-time .flatpickr-am-pm { color: #f8f9fa !important; }
    .flatpickr-time input:hover, .flatpickr-time .flatpickr-am-pm:hover, .flatpickr-time input:focus { background: #495057 !important; color: #ffffff !important; }
</style>