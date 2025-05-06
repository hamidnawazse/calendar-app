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
<select name="product_type" id="product_type">
    <option>---Select Product Type---</option>
    {{-- <option value="Laptop">Laptop</option>
    <option value="Shirt">Shirt</option>
    <option value="Shoe">Shoe</option>
    <option value="Bag">Bag</option> --}}
    @foreach ($productTypes as $type )
        <option value="{{$type}}">{{$type}}</option>
    @endforeach
</select>
<br>
<br>
<input type="number" value="" name="product_count" placeholder="Product Type Count">
<br>
<br>
 <button type="submit">Save</button>
 
</form>