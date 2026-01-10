@if ($paginator->hasPages())
    <nav class="d-flex justify-content-end align-items-center py-2">
        
        {{-- Mobile View --}}
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination mb-0">
                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">@lang('pagination.previous')</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
                @endif
                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">@lang('pagination.next')</span></li>
                @endif
            </ul>
        </div>

        {{-- Desktop View --}}
        <div class="d-none d-sm-flex align-items-center gap-3">
            <div class="text-muted small">
                Showing
                <span class="fw-bold">{{ $paginator->firstItem() }}</span>
                to
                <span class="fw-bold">{{ $paginator->lastItem() }}</span>
                of
                <span class="fw-bold">{{ $paginator->total() }}</span>
            </div>

            <ul class="pagination mb-0">
                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-left"></i></span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a></li>
                @endif

                {{-- Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a></li>
                @else
                    <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-right"></i></span></li>
                @endif
            </ul>
        </div>
    </nav>
@endif
