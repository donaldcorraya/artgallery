@foreach($productSize as $size)
<label class=" d-block">
    <input type="checkbox">
    <span> {{ $size['size'] }} </span>
</label>
@endforeach