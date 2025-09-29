<div class="h-full" x-data="{ showDetailKendala: @entangle('showDetailKendala') }">
    <x-card class="px-2 sm:px-5" style="border: 4px solid #1E2A4A;">
        <h5 class="mb-4 flex items-center justify-center gap-2 font-brasikaDisplay text-lg font-medium">
            <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" alt="Cempaka Merah"
                class="h-7 w-8">

            <div class="flex justify-center items-center">
                <h2 class="px-5 lg:px-10 py-2 rounded-full text-center text-sm sm:text-sm md:text-sm lg:text-lg text-2025-1 mx-4 z-10 bg-[radial-gradient(circle,#ffffff,#FFD183)]"
                    style="text-align: center; filter: drop-shadow(0 0 0.25rem #000);">
                    Pengaduan
                </h2>
            </div>

            <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" alt="Cempaka Merah"
                class="h-7 w-8">
        </h5>
        <div class="divide-y">
            @forelse ($kendala as $k)
                <div class="cursor-pointer px-2 py-4 hover:bg-blueGray-50 sm:px-5"
                    wire:click="openDetailKendala({{ $k->id }})">
                    <h6>
                        <span class="font-base mr-2 font-poppins">Pengaduan {{ getJenisKendala($k->category) }}</span>
                        <x-status-kendala status="{{ $k->status }}" />
                    </h6>
                    <p class="mt-1 text-xs italic text-gray-500">Pengaduan dilaporkan pada
                        {{ formatDateIso($k->created_at, 'dddd, D MMMM YYYY HH:mm:ss') }} WIB</p>
                </div>
            @empty
                <div class="px-5 py-4 hover:bg-blueGray-50" wire:click="openDetailKendala">
                    <p class="mt-1 text-center text-sm italic text-gray-500">
                        Kamu belum pernah melaporkan pengaduan.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $kendala->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
        </div>
    </x-card>

    <div x-cloak x-show="showDetailKendala">
        <x-modal>
            @if ($detailKendala)
                <div class="bg-white p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-left">
                            <h5 class="text-xl">
                                Pengaduan {{ getJenisKendala($detailKendala->category) }}
                                <x-status-kendala status="{{ $detailKendala->status }}" />
                            </h5>
                            <p class="mt-1 text-xs italic text-gray-500">Pengaduan dilaporkan pada
                                {{ formatDateIso($detailKendala->created_at, 'dddd, D MMMM YYYY HH:mm:ss') }} WIB</p>
                        </div>
                        <i class="fa fa-times cursor-pointer" x-on:click="showDetailKendala = false"></i>
                    </div>
                    <p class="my-3 text-sm">{{ $detailKendala->content }}</p>
                    {{-- <div>
                    @if ($detailKendala->foto_kendala)
                    <x-button class="bg-base-blue-300 hover:bg-base-blue-400 mr-2" :tagA="true" target="_blank"
                        href="{{ storage($detailKendala->foto_kendala) }}">Foto Kendala</x-button>
                    @endif
                    @if ($detailKendala->foto_atribute)
                    <x-button class="bg-base-blue-300 hover:bg-base-blue-400 mr-2" :tagA="true" target="_blank"
                        href="{{ storage($detailKendala->foto_atribute) }}">Foto Atribute</x-button>
                    @endif
                    @if ($detailKendala->foto_perlengkapan)
                    <x-button class="bg-base-blue-300 hover:bg-base-blue-400" :tagA="true" target="_blank"
                        href="{{ storage($detailKendala->foto_perlengkapan) }}">Foto Perlengkapan</x-button>
                    @endif
                </div> --}}

                    @if ($detailKendala->tanggapan && $detailKendala->status != 0)
                        <div class="mt-4">
                            <h5 class="mb-1 font-semibold">Tanggapan Panitia</h5>
                            <p class="text-sm">{{ $detailKendala->tanggapan }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </x-modal>
    </div>
</div>
