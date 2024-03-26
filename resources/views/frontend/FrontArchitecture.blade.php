<?php

// echo "<pre>";
// print_r($frontArchitecture);
// echo "</pre>";die;

?>

@foreach($frontArchitecture as $archi)
<label class="d-flex justify-content-between">
    <div>
        <input type="checkbox" class="architecture" value="{{ $archi->id }}">
        <span>{{ $archi->name }}</span>
    </div>
    <div><span>{{ $archi->total }}</span></div>
</label>
@endforeach