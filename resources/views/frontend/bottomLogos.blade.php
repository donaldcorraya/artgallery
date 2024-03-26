<!--===========================client_logo Products part start===================================-->
<section class="client_logo text-center pb-5 pt-5">
  <div class="container">
    <div class="row">
      @foreach ($brandName as $item)
      <div class="col-sm-3">
        <img src="{{ asset('images/'.$item->brand_img) }}" alt="img">
      </div>
      @endforeach
    </div>
  </div>
</section>
<!--===========================client_logo Products part end===================================-->
