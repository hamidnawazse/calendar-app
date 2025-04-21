<html>
<head>
    <title>Select Blocked Dates</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <h2>Select Dates to Block</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('store.blocked.dates') }}">
        @csrf
        <input type="text" id="datePicker" name="blocked_dates" placeholder="Select Dates" class="form-control">
        <button type="submit">Save</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#datePicker", {
            mode: "multiple",
            dateFormat: "Y-m-d"
        });
    </script>
</body>
</html>