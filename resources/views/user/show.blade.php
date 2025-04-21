<!-- Input for date -->
<form method="POST" action={{route('store.blocked.date')}}>
    @csrf
<input type="text" id="datepicker" name="selected_date" class="form-control" placeholder="Select a date">
<button type="submit">Save</button>
</form>
<!-- Flatpickr CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    const restricted = @json($restrictedDays); 
    const dayMap = {
        'Sunday': 0,
        'Monday': 1,
        'Tuesday': 2,
        'Wednesday': 3,
        'Thursday': 4,
        'Friday': 5,
        'Saturday': 6
    };

    const disabledDays = restricted.map(day => dayMap[day]);

    flatpickr("#datepicker", {
        dateFormat: "Y-m-d",
        disable: [
            function(date) {
                // Disable restricted weekdays
                return disabledDays.includes(date.getDay());
            }
        ]
    });
</script>
