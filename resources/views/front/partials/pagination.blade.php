@if ($paginator->lastPage() > 1)
    <nav class="mt-8" aria-label="Pagination">
        <ul class="flex justify-center items-center space-x-1">
            {{-- Previous Page Link --}}
            @if ($paginator->currentPage() > 1)
                <li>
                    <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" class="px-3 py-1 border rounded text-gray-600 hover:bg-primary hover:text-white" rel="prev">&laquo; Prev</a>
                </li>
            @endif
            {{-- Pagination Elements --}}
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li>
                    <a href="{{ $paginator->url($i) }}" class="px-3 py-1 border rounded {{ $paginator->currentPage() == $i ? 'bg-primary text-white' : 'text-gray-600 hover:bg-primary hover:text-white' }}">{{ $i }}</a>
                </li>
            @endfor
            {{-- Next Page Link --}}
            @if ($paginator->currentPage() < $paginator->lastPage())
                <li>
                    <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="px-3 py-1 border rounded text-gray-600 hover:bg-primary hover:text-white" rel="next">Next &raquo;</a>
                </li>
            @endif
        </ul>
    </nav>
@endif