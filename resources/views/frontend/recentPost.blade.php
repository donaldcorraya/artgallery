<ul class="navbar-nav ms-auto ">
    @if(isset($recentPost))
    @foreach($recentPost as $item)
    <li>
        <img src="{{ asset($item['banner']) }}" alt="{{ $item['title'] }}" style="height: 50px">
        <a href="{{ route('front.blogsDetails', ['slug' => $item['slug']])}}">{{ $item['title'] }}</a>
    </li>    
    @endforeach
    @endif
</ul>