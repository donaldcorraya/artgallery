<li class="nav-item text-uppercase @if($hasChildren = count($menu->children) > 0) dropdown @endif">
    <a href="{{ url('front-pages/'.$menu->url) }}" class="nav-link @if($hasChildren) dropdown-toggle @endif" @if($hasChildren) role="button" data-bs-toggle="dropdown" aria-expanded="false" @endif>
        {{ $menu->name }}
        @if($hasChildren) 
            <i class="bi bi-caret-down"></i> <!-- Bootstrap 5 equivalent -->
        @endif
    </a>

    @if ($hasChildren)
        <ul class="dropdown-menu">
            @foreach($menu->children as $submenu)
                <li class="dropdown-item text-uppercase">
                    <a style="color: black; text-decoration: none;" href="{{ url('front-pages/'.$submenu->url) }}">{{ $submenu->name }}</a>
                    @if (count($submenu->children) > 0)
                        <ul class="dropdown-menu">
                            @foreach($submenu->children as $subsubmenu)
                                <li><a class="dropdown-item text-uppercase" href="{{ url('front-pages/'.$subsubmenu->url) }}">{{ $subsubmenu->name }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</li>
