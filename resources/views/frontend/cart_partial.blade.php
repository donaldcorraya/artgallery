<ul>
    @foreach ($cartContent as $item)
    <li>
        <div class="mini-cart-thumb">
            <a href="#"><img src="{{ asset($item->options->productImage)}}" alt="img" /></a>
        </div>
        <div class="mini-cart-heading">
            <strong>{{ $item->name }}</strong><br>
            <span>{{ $item->price}}</span>
        </div>
        <div class="mini-cart-remove">
            <a href="{{ route('remove-cart-item', $item->rowId ) }}" class="removeBtn btn"
                style="color: red; text-decoration: none">&#x2715;</a>
        </div>
    </li>
    @endforeach
</ul>
<div class="minicart-total justify-content-between d-flex">
    <span class="pull-left">Total : </span>
    <span class="pull-right"> TK. {{$total}}</span>
</div>
<div class="mini-cart-checkout">
    <a target="blank" href="{{ route('front.cart') }}" class="btn-common view-cart">{{ __('messages.ViewCart') }}</a>
    <a target="blank" href="{{ route('front.checkout') }}"
        class="btn-common checkout mt-10">{{ __('messages.checkout') }}</a>
</div>