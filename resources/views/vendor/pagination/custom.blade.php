@if ($paginator->hasPages())
    <style>
        .tf-pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid #f1f5f9;
            font-family: inherit;
        }
        .tf-pagination-info {
            font-size: 0.875rem;
            color: #64748b;
        }
        .tf-pagination-info strong {
            color: #0f172a;
            font-weight: 600;
        }
        .tf-pagination-nav {
            margin-left: auto; /* Memastikan pagination selalu berada di pojok kanan bawah */
        }
        .tf-pagination-list {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .tf-page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            min-width: 36px;
            height: 36px;
            padding: 0 0.85rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-decoration: none !important;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            cursor: pointer;
            line-height: 1;
            user-select: none;
        }
        .tf-page-link:hover:not(.tf-disabled):not(.tf-active):not(.tf-dots) {
            background: #f8fafc;
            color: #4338ca;
            border-color: #cbd5e1;
            transform: translateY(-1px);
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.06);
        }
        .tf-page-link.tf-active {
            background: #4338ca;
            color: #ffffff !important;
            border-color: #4338ca;
            box-shadow: 0 3px 10px rgba(67, 56, 202, 0.35);
            cursor: default;
        }
        .tf-page-link.tf-disabled {
            background: #f8fafc;
            color: #94a3b8 !important;
            border-color: #e2e8f0;
            cursor: not-allowed;
            opacity: 0.6;
            box-shadow: none;
        }
        .tf-page-link.tf-dots {
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: default;
            min-width: 20px;
            padding: 0;
            box-shadow: none;
        }
        .tf-page-btn-next {
            font-weight: 700;
            background: #ffffff;
            color: #1e293b;
        }
        .tf-page-btn-next:hover:not(.tf-disabled) {
            background: #4338ca;
            color: #ffffff !important;
            border-color: #4338ca;
        }
        .tf-page-link svg {
            width: 14px;
            height: 14px;
            stroke-width: 2.5;
            display: inline-block;
            vertical-align: middle;
        }
    </style>

    <div class="tf-pagination-container">
        <div class="tf-pagination-info">
            Showing <strong>{{ $paginator->firstItem() ?? 0 }}</strong> to <strong>{{ $paginator->lastItem() ?? 0 }}</strong> of <strong>{{ $paginator->total() }}</strong> entries
        </div>

        <nav class="tf-pagination-nav" role="navigation" aria-label="Pagination Navigation">
            <div class="tf-pagination-list">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="tf-page-link tf-disabled" aria-disabled="true" title="Previous Page">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                        <span>Prev</span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="tf-page-link" rel="prev" title="Previous Page">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                        <span>Prev</span>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="tf-page-link tf-dots" aria-disabled="true">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="tf-page-link tf-active" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="tf-page-link">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="tf-page-link tf-page-btn-next" rel="next" title="Next Page">
                        <span>Next</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </a>
                @else
                    <span class="tf-page-link tf-disabled" aria-disabled="true" title="Next Page">
                        <span>Next</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </span>
                @endif
            </div>
        </nav>
    </div>
@endif
