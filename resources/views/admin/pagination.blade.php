@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="pagination-container">
        <div class="pagination-content">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="pagination-btn disabled" aria-disabled="true" aria-label="Previous">
                    <i class="fas fa-chevron-left"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-btn" aria-label="Previous">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="pagination-numbers">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="pagination-dots" aria-disabled="true">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="pagination-number active" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="pagination-number">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-btn" aria-label="Next">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <span class="pagination-btn disabled" aria-disabled="true" aria-label="Next">
                    <i class="fas fa-chevron-right"></i>
                </span>
            @endif
        </div>
        
        <div class="pagination-info">
            Mostrando <span class="font-medium">{{ $paginator->firstItem() }}</span> a <span class="font-medium">{{ $paginator->lastItem() }}</span> de <span class="font-medium">{{ $paginator->total() }}</span> resultados
        </div>
    </nav>

    <style>
        .pagination-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .pagination-content {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .pagination-content::-webkit-scrollbar {
            display: none;
        }
        .pagination-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            background-color: white;
            color: #6b7280;
            font-size: 0.875rem;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }
        .pagination-btn:hover:not(.disabled) {
            border-color: var(--primary-color, #2563eb);
            color: var(--primary-color, #2563eb);
            background-color: #eff6ff;
        }
        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: #f9fafb;
        }
        .pagination-numbers {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .pagination-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.25rem;
            height: 2.25rem;
            padding: 0 0.5rem;
            border-radius: 0.5rem;
            border: 1px solid transparent;
            color: #4b5563;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }
        .pagination-number:hover:not(.active) {
            background-color: #f3f4f6;
            color: #111827;
        }
        .pagination-number.active {
            background-color: var(--primary-color, #2563eb);
            color: white;
            border-color: var(--primary-color, #2563eb);
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }
        .pagination-dots {
            padding: 0 0.5rem;
            color: #9ca3af;
        }
        .pagination-info {
            color: #6b7280;
            font-size: 0.875rem;
        }
        .font-medium {
            font-weight: 500;
            color: #1f2937;
        }
        
        @media (max-width: 640px) {
            .pagination-container {
                flex-direction: column;
                gap: 1rem;
            }
            .pagination-content {
                width: 100%;
                justify-content: flex-start;
            }
            .pagination-info {
                text-align: center;
                font-size: 0.8rem;
            }
        }
    </style>
@endif
