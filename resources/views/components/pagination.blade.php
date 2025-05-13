@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="disabled" aria-disabled="true">&laquo; Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="text-blue-600 hover:text-blue-900">&laquo; Previous</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="text-blue-600 hover:text-blue-900">Next &raquo;</a>
        @else
            <span class="disabled" aria-disabled="true">Next &raquo;</span>
        @endif
    </nav>
@endif