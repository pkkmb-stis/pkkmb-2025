<div x-data="{ showModalBerita: @entangle('showModalBerita') }">

    @if ($berita)
        <div x-cloak x-show="showModalBerita">
            <x-modal.berita judul="{{ $berita->judul }}" image="{{ storage($berita->thumbnails) }}">
                <x-slot name="icon">
                    <div class="flex items-center justify-center mr-1 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span
                            class="ml-1">{{ formatDateIso($berita->published_datetime, 'D MMMM YYYY HH:mm') }}</span>
                    </div>

                    <div class="flex items-center justify-center mx-1 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-1">{{ $berita->published_by }}</span>
                    </div>

                    <div class="flex items-center justify-center ml-1 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-1">{{ getKategoriBerita($berita->category) }}</span>
                    </div>
                </x-slot>

                <x-slot name="closeButton">
                    <div x-on:click="showModalBerita = false">
                        <x-close-button />
                    </div>
                </x-slot>

                <div class="ql-editor text-gray-50">{{ strip_tags($berita->content) }}</div>


            </x-modal.berita>
        </div>
    @endif
</div>

@push('css')
    <style>
        .ql-editor {
            color: white;
        }
    </style>
@endpush
