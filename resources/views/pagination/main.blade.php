@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 md:hidden">
            @if (!$paginator->onFirstPage())
                <a wire:click="previousPage"
                    class="relative inline-flex items-center px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-pointer font-poppins focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 hover:text-base-red-400 hover:bg-base-yellow-200">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a wire:click="nextPage" wire:loading.attr="disabled"
                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-pointer font-poppins focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 hover:text-base-red-400 hover:bg-base-yellow-200">
                    {!! __('pagination.next') !!}
                </a>
            @endif
        </div>

        <div class="items-center justify-center flex-1 hidden md:flex lg:justify-between">
            <div class="hidden lg:block">
                <p class="text-sm leading-5 text-gray-700">
                    {!! __('Showing') !!}
                    <span class="">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-md shadow-sm">
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm leading-5 text-gray-700 bg-white border border-gray-300 cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm leading-5 border border-gray-300 cursor-default font-poppins text-base-red-400 bg-base-yellow-200">{{ $page }}</span>
                                    </span>
                                @else
                                    <a wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled"
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 cursor-pointer font-poppins focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 hover:text-base-red-400 hover:bg-base-yellow-200"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </span>
            </div>
        </div>
    </nav>
@endif
