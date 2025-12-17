@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination__page"
            ><i class="fa-solid fa-angle-right"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a href="" class="pagination__page ">{{$element}}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="" class="pagination__page pagination__page--current">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}" class="pagination__page ">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination__page"
            ><i class="fa-solid fa-angle-left"></i></a>
        @endif
    </div>
@endif
