{{-- File: resources/views/user/bookings/partials/flatpickr-scripts.blade.php --}}
{{-- @push('scripts')

@endpush --}}
{{-- 1. Panggil Javascript Inti Flatpickr dari CDN --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

{{-- 2. Inisialisasi Logika Flatpickr --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Flatpickr Tanggal
        flatpickr("#datepicker", {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: [ (date) => (date.getDay() === 0 || date.getDay() === 6) ] 
        });

        // Flatpickr Jam Selesai
        const endPicker = flatpickr("#end_time", {
            enableTime: true, noCalendar: true, dateFormat: "H:i", time_24hr: true,
            minTime: "08:00", maxTime: "17:00",
        });

        // Flatpickr Jam Mulai
        flatpickr("#start_time", {
            enableTime: true, noCalendar: true, dateFormat: "H:i", time_24hr: true,
            minTime: "08:00", maxTime: "17:00",
            onChange: function(selectedDates) {
                if (selectedDates.length > 0) {
                    endPicker.set('minTime', selectedDates[0]);
                    document.getElementById('end_time').disabled = false;
                }
            }
        });
    });
</script>