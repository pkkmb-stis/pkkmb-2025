<div>
    <div x-data="{ showModalDelete: false, jenispoinTitle: '', user_name: '', update_pada: '', penebusanId: '', showModalDetail: @entangle('showModalDetail') }">

        <x-card class="px-2 sm:px-5" style="border: 4px solid #1E2A4A;">
            <div class="mb-4 flex flex-col">
                <h5 class="mb-4 flex items-center justify-center gap-2 font-brasikaDisplay text-lg font-medium">
                    <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" alt="Cempaka Merah"
                        class="h-7 w-8">

                    <div class="flex justify-center items-center">
                        <h2 class="px-5 lg:px-10 py-2 rounded-full text-center text-sm sm:text-sm md:text-sm lg:text-lg text-2025-1 mx-4 z-10 bg-[radial-gradient(circle,#ffffff,#FFD183)]"
                            style="text-align: center; filter: drop-shadow(0 0 0.25rem #000);">
                            Penebusan
                        </h2>
                    </div>

                    <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" alt="Cempaka Merah"
                        class="h-7 w-8">
                </h5>
                <div class="mt-2">
                    @if (POIN_MINIMUM > $detailPoins['akumulasi'])
                        @livewire('home.dashboard.penebusan.add', ['detailPoin' => $detailPoins ?? null])
                    @endif
                </div>
            </div>
            <div class="divide-y">
                @forelse ($penebusan as $p)
                    <div class="px-5 py-4 hover:bg-blueGray-50">
                        <div class="justify-between md:flex">

                            <div class="mb-3 md:mb-0 md:mr-5">
                                <p class="text-sm md:text-base">Penebusan {{ getTipePenebusan($p->jenispoin->type) }}
                                    {{ $p->jenispoin->nama }}
                                </p>

                                <div class="mt-2">
                                    <x-button wire:click="show({{ $p->id }})"
                                        class="mx-0.5 my-0.5 rounded-3xl bg-2025-1 hover:bg-coklat-hover">
                                        Detail
                                    </x-button>

                                    @if ($p->status == PENEBUSAN_MENUNGGU_UPLOAD || $p->status == PENEBUSAN_BUTUH_REVISI)
                                        <x-button
                                            class="mx-0.5 my-0.5 rounded-3xl bg-2025-2 hover:bg-2025-1"
                                            wire:click="$emit('mabaUploadPenebusan', {{ $p->id }})">
                                            Upload Tugas
                                        </x-button>

                                        <x-button class="mx-0.5 my-0.5 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                            x-on:click="showModalDelete = true; jenispoinTitle = '{{ $p->jenispoin->nama }}'; penebusanId = '{{ $p->id }}'; user_name = '{{ addslashes($p->user->name) }}'; update_pada = '{{ $p->updated_at ? $p->updated_at->locale('id')->isoFormat('dddd, Do MMMM H:mm') : '' }}'">
                                            Batalkan
                                        </x-button>
                                    @endif

                                    @if ($p->link)
                                        <x-button :tagA="true"
                                            download="{{ str_replace('penebusan/', '', $p->link) }}"
                                            href="{{ storage($p->link) }}"
                                            class="mx-0.5 my-0.5 rounded-3xl bg-blue-500">
                                            <i class="fa fa-download fa-fw mr-1"></i>Periksa Tugas</x-button>
                                    @endif
                                </div>
                            </div>

                            <div class="whitespace-nowrap">
                                <div class="md:text-right">
                                    @if ($p->status == PENEBUSAN_MENUNGGU_UPLOAD || $p->status == PENEBUSAN_BUTUH_REVISI)
                                        <p class="text-sm"> Deadline:
                                            <b>{{ formatDateIso($p->deadline, 'dddd, HH:mm') . ' WIB' }}</b>
                                        </p>
                                        <p class="text-xs">
                                            {{ $p->deadline->diffForHumans() }}
                                        </p>
                                    @endif

                                    @if ($p->status == PENEBUSAN_SELESAI)
                                        <p class="md:text-md text-xs md:text-right">Poin penebusan telah ditambahkan</p>
                                    @endif
                                </div>

                                <div class="mt-2">
                                    <x-badge-status-penebusan class="ml-1 h-5" category="{{ $p->status }}" />
                                    <x-badge-status-penebusan class="ml-1 h-5" category="{{ PENEBUSAN_SELESAI }}"
                                        content="{{ $p->jenispoin->poin }} poin" />
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="px-5 py-4 hover:bg-blueGray-50">
                        <p class="mt-1 text-center text-sm italic text-gray-500">
                            Tidak ada riwayat penebusan
                        </p>
                    </div>
                @endforelse
            </div>

            @if (POIN_MINIMUM > $detailPoins['akumulasi'])
                @include('home.dashboard.penebusan.warning')
            @endif
        </x-card>

        <div x-cloak x-show="showModalDelete">
            <x-modal>
                <x-modal.warning>
                    <x-slot name="title">
                        <h5 class="font-bold">Batalkan Penugasan</h5>
                    </x-slot>
                    <div>
                        Apakah kamu yakin untuk membatalkan penugasan <b x-text="jenispoinTitle"></b>? (kamu dapat
                        menambahkan penugasan ini kembali)
                    </div>
                    <x-slot name="footer">
                        <x-button class="mr-2 bg-gray-500 hover:bg-gray-600" :tagA="false"
                            x-on:click="showModalDelete = false">Tidak, nanti dulu</x-button>
                        <x-button class="bg-red-500 hover:bg-red-600" :tagA="false"
                            x-on:click="showModalDelete = false; $wire.destroy(penebusanId)">Ya, yakin</x-button>
                    </x-slot>
                </x-modal.warning>
            </x-modal>
        </div>

        @include('home.dashboard.penebusan.detail')
        @livewire('home.dashboard.penebusan.upload')
    </div>
</div>
