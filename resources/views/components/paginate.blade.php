@php
    $i = 0;
    $blockClass = 'flex items-center justify-center px-4 py-2 mx-1 text-gray-500 capitalize bg-white rounded-md cursor-not-allowed rtl:-scale-x-100 dark:bg-gray-800 dark:text-gray-600';
    $openClass = 'hidden px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md sm:inline dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200';
    $classFirstPage = $openClass;
    $classLastPage = $openClass;
    if ($paginator->onFirstPage()) {
        $classFirstPage = $blockClass;
    }
    if ($paginator->onLastPage()) {
        $classLastPage = $blockClass;
    }
@endphp
<div class="flex">
    <a href="{{$paginator->previousPageUrl() . $tag}}" class="{{$classFirstPage}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </a>
    <a href="{{$paginator->url(1) . $tag}}" class="{{1 === $paginator->currentPage() ? $blockClass : $openClass}}">
        1
    </a>

    @foreach($paginator->getUrlRange($paginator->currentPage(), $paginator->lastPage()) as $number => $url)
        @if (!in_array($number, [1, $paginator->lastPage()]))
            @php $i++; @endphp
            @if($i <= 2)
                @if($i === 1 && $paginator->currentPage() > 1)
                    <span class="{{$blockClass}}">
                    ...
                </span>
                @endif
                <a href="{{$url . $tag}}" class="{{$number === $paginator->currentPage() ? $blockClass : $openClass}}">
                    {{$number}}
                </a>
            @else
                <span class="{{$blockClass}}">
                    ...
                </span>
                @php break; @endphp
            @endif
        @endif
    @endforeach

    <a href="{{$paginator->url($paginator->lastPage()) . $tag}}" class="{{$paginator->lastPage() === $paginator->currentPage() ? $blockClass : $openClass}}">
        {{$paginator->lastPage()}}
    </a>
    <a href="{{$paginator->nextPageUrl() . $tag}}" class="{{$classLastPage}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
    </a>
</div>
