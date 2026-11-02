@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-1 font-sans">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="Previous page"
                  class="inline-flex items-center justify-center w-8 h-8 rounded text-slate-300 bg-slate-50 border border-slate-200 cursor-not-allowed select-none">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page"
               class="inline-flex items-center justify-center w-8 h-8 rounded text-slate-700 bg-white border border-slate-300 hover:bg-slate-100 hover:border-slate-400 hover:text-slate-900 transition-colors shadow-xs">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="inline-flex items-center justify-center w-8 h-8 text-slate-400 font-bold select-none text-xs">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"
                              class="inline-flex items-center justify-center min-w-8 h-8 px-2.5 rounded font-bold text-xs bg-[#0052a3] text-white border border-[#0052a3] shadow-xs select-none">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="inline-flex items-center justify-center min-w-8 h-8 px-2.5 rounded font-semibold text-xs text-slate-700 bg-white border border-slate-300 hover:bg-slate-100 hover:border-slate-400 hover:text-slate-900 transition-colors shadow-xs">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page"
               class="inline-flex items-center justify-center w-8 h-8 rounded text-slate-700 bg-white border border-slate-300 hover:bg-slate-100 hover:border-slate-400 hover:text-slate-900 transition-colors shadow-xs">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @else
            <span aria-disabled="true" aria-label="Next page"
                  class="inline-flex items-center justify-center w-8 h-8 rounded text-slate-300 bg-slate-50 border border-slate-200 cursor-not-allowed select-none">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        @endif
    </nav>
@endif

