@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            
            {{-- Previous Page Link --}}
            @if(isset($_GET['min']) && isset($_GET['max']))

                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl().'&min='.$_GET['min'].'&max='.$_GET['max'] }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
                    </li>
                @endif

            @else
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
                    </li>
                @endif
            @endif



            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                



                @if(isset($_GET['min']) && isset($_GET['max']))

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ URL::to('/shop/filter/product')."?page=$page"."&min=".$_GET['min'].'&max='.$_GET['max'] }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif

                @else

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif                    

                @endif




            @endforeach


            {{-- Next Page Link --}}
            
            @if(isset($_GET['min']) && isset($_GET['max']))
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl().'&min='.$_GET['min'].'&max='.$_GET['max'] }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">Next</span>
                    </li>
                @endif
            @else

            
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">Next</span>
                    </li>
                @endif
            @endif
        </ul>
    </nav>
@endif
