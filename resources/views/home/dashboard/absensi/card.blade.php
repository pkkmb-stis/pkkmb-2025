<div>
    @if ($events)
    <div>
        <div class="grid xl:grid-cols-3 md:grid-cols-2 gap-6">
            @foreach ($events as $event)
            <div>
                <x-card class="sm:px-5 px-2 mb-3" style="border: 4px solid #1E2A4A;">
                    <h5 class="text-sm font-poppins">
                        Presensi {{ $event->title }}
                        <span
                            class="bg-base-green-400 py-1 px-3 ml-2 rounded-full text-white text-xs font-bold whitespace-nowrap">{{ $event->is_pasca }}
                        </span>
                    </h5>
                    <p class="my-3 text-sm">{{ $event->caption }}</p>
                    @if (eventCanAbsen($event->waktu_mulai, $event->waktu_akhir, 0, 3))
                    <x-button class="bg-green-500 hover:bg-green-600" wire:click="absenScan('{{ $event->id }}')"
                        wire:loading.remove wire:target="absenScan">
                        Presensi Scan
                    </x-button>

                    <div wire:loading wire:target="absenScan" class="text-xs text-gary-600 italic">
                        Memproses ..
                    </div>
                    <x-button class="bg-red-500 hover:bg-red-600" wire:click="absenForm('{{ $event->id }}')"
                        wire:loading.remove wire:target="absenForm">
                        Presensi Form
                    </x-button>

                    <div wire:loading wire:target="absenForm" class="text-xs text-gary-600 italic">
                        Memproses ..
                    </div>
                    @else
                    <p class="text-xs italic text-gray-500 mb-2">Presensi Akan dibuka pada
                        {{ formatDateIso($event->waktu_mulai) }} WIB. Silakan refresh webnya jika telah melebihi waktu
                        tersebut
                    </p>
                    @endif

                    <x-button class="bg-blue-500 hover:bg-blue-600" :tagA="true" href="{{ $event->link }}"
                        target="_blank">
                        Link Zoom
                    </x-button>
                </x-card>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
