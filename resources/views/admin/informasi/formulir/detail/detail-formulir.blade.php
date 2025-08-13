<slot>
    <x-card>
        <h5 class="flex items-center">
            <span class="mr-2 text-xl font-semibold font-poppins">Formulir: {{ $formulir->nama_formulir }}</span>
            <span
                class="px-3 py-1 text-xs font-bold text-white {{ $formulir->is_visible ? 'bg-green-500' : 'bg-red-500' }} rounded-full whitespace-nowrap">
                {{ $formulir->is_visible ? 'Ditampilkan' : 'Disembunyikan' }}
            </span>
        </h5>
        <p class="mt-2 text-xs italic text-gray-600">
            Formulir ini terdaftar pada sistem dengan ID: {{ $formulir->spreadsheet_id }}
        </p>
        <p class="mt-3 mb-4 font-poppins">Range pencarian:
            {{ $formulir->search_range ?? 'Tidak ditentukan' }}</p>
        <div>
            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="true"
                href="{{ route('formulir') }}">
                Kembali
            </x-button>
            <x-button class="mr-2 bg-blue-500 rounded-3xl hover:bg-blue-600" wire:click="handleSyncData"
                wire:loading.attr="disabled">
                <span wire:loading.remove>Sinkronisasi Data</span>
                <span wire:loading>
                    <svg class="items-center inline-block w-3 h-3 mr-3 text-white animate-spin"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.964 7.964 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>Sedang Sinkronisasi Data...
                </span>
            </x-button>

        </div>
    </x-card>

    <hr class="my-4">

    {{-- Tabel untuk menampilkan detail pengguna yang sudah atau belum mengisi formulir --}}
    @livewire('admin.informasi.formulir.detail.show', ['formulir' => $formulir])

</slot>
