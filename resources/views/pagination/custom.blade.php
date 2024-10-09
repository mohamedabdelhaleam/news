@if ($paginator->hasPages())
    <div class="d-flex justify-content-end pt-30">
        <nav class="dm-page">
            <ul class="dm-pagination d-flex">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="dm-pagination__item disabled">
                        <span class="dm-pagination__link pagination-control"><span class="la la-angle-left"></span></span>
                    </li>
                @else
                    <li class="dm-pagination__item">
                        <a href="{{ $paginator->previousPageUrl() }}" class="dm-pagination__link pagination-control"><span
                                class="la la-angle-left"></span></a>
                    </li>
                @endif

                {{-- Page Number Links --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="dm-pagination__item disabled">
                            <span class="dm-pagination__link"><span
                                    class="page-number">{{ $element }}</span></span>
                        </li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="dm-pagination__item">
                                    <a href="{{ $url }}" class="dm-pagination__link active"><span
                                            class="page-number">{{ $page }}</span></a>
                                </li>
                            @else
                                <li class="dm-pagination__item">
                                    <a href="{{ $url }}" class="dm-pagination__link"><span
                                            class="page-number">{{ $page }}</span></a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="dm-pagination__item">
                        <a href="{{ $paginator->nextPageUrl() }}" class="dm-pagination__link pagination-control"><span
                                class="la la-angle-right"></span></a>
                    </li>
                @else
                    <li class="dm-pagination__item disabled">
                        <span class="dm-pagination__link pagination-control"><span
                                class="la la-angle-right"></span></span>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
@endif
