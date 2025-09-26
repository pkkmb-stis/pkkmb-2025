<div class="h-full" x-data="{ showDetailAbsensi: @entangle('showDetailAbsensi') }">
    <x-card class="px-2 sm:px-5" style="border: 4px solid #1E1E1E;">
        <h5 class="mb-4 flex items-center justify-center gap-2 font-brasikaDisplay text-lg font-medium">
            <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" 
                alt="Cempaka Merah" 
                class="w-8 h-7">
            
            <div class="relative">
                <img src="{{ asset('img/asset/2025/background_subjudul.png') }}" alt="BG" class="h-12 rounded-lg">
                <span class="absolute inset-0 flex items-center justify-center text-[#8B2F4B] -translate-y-1">
                    List Presensi
                </span>
            </div>
            
            <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" 
                alt="Cempaka Merah" 
                class="w-8 h-7">
        </h5>
        <div class="divide-y">
            @forelse ($absensi as $absen)
                <div class="cursor-pointer px-2 py-4 hover:bg-blueGray-50 sm:px-5"
                    wire:click="openDetailAbsensi({{ $absen->pivot }}, '{{ $absen->title }}')">
                    <h6>
                        <span class="font-base mr-2 font-poppins">Presensi {{ $absen->title }}</span>
                        <x-status-absensi status="{{ $absen->pivot->status }}" />
                    </h6>
                    <p class="mt-1 text-xs italic text-gray-500">Melakukan presensi pada
                        {{ formatDateIso($absen->pivot->created_at, 'dddd, D MMMM YYYY HH:mm:ss') }} WIB</p>

                    @if (auth()->user()->is_maba)
                        @if (auth()->user()->kelompok()->first()->jenis_kelompok)
                            @if ($absen->waktu_akhir->addHours(6) > now())
                                <x-button class="mt-2 bg-blue-500 hover:bg-blue-600" :tagA="true" target="blank"
                                    href="{{ $absen->link }}">
                                    Link Zoom
                                </x-button>
                            @endif
                        @endif
                    @endif
                </div>
            @empty
                <div class="px-5 py-4 hover:bg-blueGray-50" wire:click="openDetailAbsensi">
                    <p class="mt-1 text-center text-sm italic text-gray-500">
                        Kamu belum pernah melakukan presensi
                    </p>
                </div>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $absensi->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
        </div>
    </x-card>

    <div x-cloak x-show="showDetailAbsensi">
        <x-modal>
            @if ($detailAbsensi)
                <div class="bg-white p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-left">
                            <h5 class="text-xl">
                                Presensi {{ $title }}
                                <x-status-absensi status="{{ $detailAbsensi['status'] }}" />
                            </h5>
                            <p class="mt-1 text-xs italic text-gray-500">Melakukan presensi pada
                                {{ formatDateIso($detailAbsensi['created_at'], 'dddd, D MMMM YYYY HH:mm:ss', 7) }} WIB
                            </p>

                        </div>
                        <i class="fa fa-times cursor-pointer" x-on:click="showDetailAbsensi = false"></i>
                    </div>

                    @if ($detailAbsensi['alasan'])
                        <p class="my-3 text-sm">{{ $detailAbsensi['alasan'] }}</p>
                    @endif

                    @if ($detailAbsensi['link'])
                        <a target="_blank" href="{{ storage($detailAbsensi['link']) }}"
                            class="cursor-pointer rounded-md bg-base-blue-300 px-3 py-1 text-xs text-white hover:bg-base-blue-400">
                            Bukti Keterlambatan
                        </a>
                    @endif

                    @if ($detailAbsensi['status'] == 0)
                        <p class="mb-3 mt-5 text-lg font-semibold">Pertahankan!</p>
                    @endif
                </div>
            @endif
        </x-modal>
    </div>
</div>
