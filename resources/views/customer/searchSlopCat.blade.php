
<div class="list-group" style="max-width: 230px">
<?php 
if($total != 0){
?>
   

    <ul class="navbar-nav ms-auto cat_ul cat_ul_ajax">
        @foreach($data as $itm)                
            <li><a class="list-group-item list-group-item-action" data-index="{{ $itm->id }}" href="{{ route('shop') }}/{{ $itm->slug }}">{{ $itm->name }}</a></li>
        @endforeach
    </ul>
</div>

<?php }else{ ?>
    <div class="list-group" style="max-width: 230px">

    <span class="list-group-item list-group-item-action">Sorry, No data found</span>
</div>

<?php } ?>



<script>

$('.category_item').on('click', function(){

    $('.architecture').prop('checked', false);

    const architecture_id = [];

    architecture_id.push($(this).attr('data-index'));

    $('.cat_ul li').removeClass('active');
    $(this).parent().addClass('active');


    $.ajax({
        type: 'GET',
        url: "{{ route('front.architect_id_ajax') }}",
        dataType: 'html',
        data : {
            "_token": "{{ csrf_token() }}",
            'id' : JSON.stringify(architecture_id),
            'page' : 1,
            'type' : 2,
            
        },
        success: function (data) {
            if(data){
                $('#products').empty();
                $('#products').html(data);
                $('.cat_ul_ajax').remove();
            }
        },
    });

}); 

</script>