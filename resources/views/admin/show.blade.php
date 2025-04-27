<!-- resources/views/admin/restrict_days.blade.php -->
<form method="POST" action="{{ route('admin.store') }}">
    @csrf
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
        <label>
            <input type="checkbox" name="weekdays[]" value="{{ $day }}"
                {{ in_array($day, $restrictedDays ?? []) ? 'checked' : '' }}>
            {{ $day }}
        </label><br>
    @endforeach
<br>
<input type="number" value="" name="order_count" placeholder="Add number of Orders">
<br>
<br>
 <button type="submit">Save</button>
 
</form>