<!-- resources/views/admin/restrict_days.blade.php -->
<form method="POST" action="{{ route('admin.store') }}">
    @csrf
    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
        <label>
            <input type="checkbox" name="weekdays[]" value="{{ $day }}"
                {{ in_array($day, $restrictedDays ?? []) ? 'checked' : '' }}>
            {{ $day }}
        </label><br>
    @endforeach
    <button type="submit">Save</button>
</form>