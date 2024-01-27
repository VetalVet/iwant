
@if ($paginator->hasPages())
<div class="pagination-area mt-15 mb-md-5 mb-lg-0 pagination-page">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li class="page-item">
                    <a class="prev page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <svg width="18" height="9" viewBox="0 0 18 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.7935 4.85702C17.7933 4.85723 17.7931 4.85747 17.7929 4.85768L14.119 8.51388C13.8437 8.78778 13.3986 8.78676 13.1246 8.51149C12.8507 8.23626 12.8517 7.79108 13.1269 7.51715L15.5936 5.06243H0.703115C0.314785 5.06243 0 4.74765 0 4.35932C0 3.97099 0.314785 3.6562 0.703115 3.6562H15.5936L13.127 1.20149C12.8517 0.927552 12.8507 0.482374 13.1246 0.20714C13.3986 -0.0681648 13.8438 -0.0691137 14.119 0.20475L17.7929 3.86095C17.7931 3.86116 17.7933 3.8614 17.7936 3.86162C18.0689 4.13646 18.0681 4.58308 17.7935 4.85702Z" fill="#333333"></path>
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
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

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="next page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <svg width="18" height="9" viewBox="0 0 18 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.7935 4.85702C17.7933 4.85723 17.7931 4.85747 17.7929 4.85768L14.119 8.51388C13.8437 8.78778 13.3986 8.78676 13.1246 8.51149C12.8507 8.23626 12.8517 7.79108 13.1269 7.51715L15.5936 5.06243H0.703115C0.314785 5.06243 0 4.74765 0 4.35932C0 3.97099 0.314785 3.6562 0.703115 3.6562H15.5936L13.127 1.20149C12.8517 0.927552 12.8507 0.482374 13.1246 0.20714C13.3986 -0.0681648 13.8438 -0.0691137 14.119 0.20475L17.7929 3.86095C17.7931 3.86116 17.7933 3.8614 17.7936 3.86162C18.0689 4.13646 18.0681 4.58308 17.7935 4.85702Z" fill="#333333"></path>
                        </svg>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>
@endif
