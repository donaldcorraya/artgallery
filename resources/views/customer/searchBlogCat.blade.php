<div class="list-group" style="max-width: 230px">

<?php  if($total > 0){ ?>
    @foreach($data as $itm)
        <a href="{{ route('front.blogsDetails', ['slug' => $itm->slug]) }}" class="list-group-item list-group-item-action">{{ $itm->title }}</a>
    @endforeach
</div>

<?php }else{ ?>
    <div style="display: flex; justify-content: center; align-items: center; height: 50px; background: #fff; border: 1px solid rgba(0, 0, 0, 0.175); padding: 14px; border-radius: 6px; top: 10px; position: relative;">Sorry, No data found</div>
<?php } ?>