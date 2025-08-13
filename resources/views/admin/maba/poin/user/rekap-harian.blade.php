<div>
    <div x-data="{ rekapHarian: @entangle('rekapHarian') }">
        <x-button class="uppercase rounded-3xl text-coklat-1 bg-kuning-1 hover:bg-kuning-hover whitespace-nowrap"
            type="button" x-on:click="rekapHarian = true">
            Rekap Harian
        </x-button>

        <div x-cloak x-show="rekapHarian">
            <x-modal>
                <x-modal.warning>
                    <x-slot name="title">
                        <h5 class="font-bold">Rekap Jumlah Penghargaan dan Pelanggaran Harian Maba</h5>
                    </x-slot>
                    <div class="mt-5">
                        <div>
                            <x-label-input for="password">Tanggal</x-label-input>
                            <div class="mb-3">
                                <x-date-wo-time-input wire:model.lazy="tanggal_rekap" id="tanggal_rekap"
                                    name="tanggal_rekap" x-ref="addDate" />
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-2 lg:gap-6">
                            @forelse ($rekap as $r)
                                @if ($r->kategori == 1)
                                    <div class="text-center">
                                        <h4 class="font-bold">Jumlah Penghargaan</h4>
                                        <h1 class="text-3xl font-bold text-green-500">{{ $r->kategori_count }}</h1>
                                    </div>
                                @elseif ($r->kategori == 2)
                                    <div class="text-center">
                                        <h4 class="font-bold">Jumlah Pelanggaran</h4>
                                        <h1 class="text-3xl font-bold text-red-500">{{ $r->kategori_count }}</h1>
                                    </div>
                                @endif
                            @empty
                                <div class="text-center">
                                    <h4 class="font-bold">Jumlah Penghargaan</h4>
                                    <h1 class="text-3xl font-bold text-green-500">Kosong</h1>
                                </div>
                                <div class="text-center">
                                    <h4 class="font-bold">Jumlah Pelanggaran</h4>
                                    <h1 class="text-3xl font-bold text-red-500">Kosong</h1>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <x-slot name="footer">
                        <div wire:loading.remove wire:target="submit">
                            <x-button class="mr-1 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="rekapHarian = false">Tutup</x-button>
                            {{-- <x-button class="bg-red-500 rounded-3xl hover:bg-red-600" :tagA="false" wire:click="submit">Ya, yakin
                            </x-button> --}}
                        </div>
                        {{-- <div wire:loading wire:target="submit" class="text-xs italic text-gary-600">
                            Sedang memproses. Harap menunggu ..
                        </div> --}}
                    </x-slot>
                </x-modal.warning>
            </x-modal>
        </div>
    </div>
</div>
