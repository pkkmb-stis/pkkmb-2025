<div>
    <div x-data="{showModalDetail : @entangle('showModalDetail')}">

        <x-card class="bg-opacity-70">
            <div class="divide-y">
                @forelse ($penebusan as $p)
                <div class="px-5 py-4 hover:bg-blueGray-50">
                    <div class="justify-between md:flex">

                        <div class="mb-3 md:mr-5 md:mb-0">
                            <p class="text-sm md:text-base">Penebusan {{ getTipePenebusan($p->jenispoin->type) }}
                                {{  $p->jenispoin->nama}}
                            </p>

                            <div class="mt-2">
                                <x-button wire:click="show({{$p->id}})"
                                    class="rounded-3xl bg-2025-1 hover:bg-coklat-hover mx-0.5 my-0.5">
                                    Detail
                                </x-button>

                                @if($p->link)
                                <x-button :tagA="true" download="{{ str_replace('penebusan/', '', $p->link) }}"
                                    href="{{storage($p->link)}}" class="rounded-3xl bg-2025-2 hover:bg-2025-1 my-0.5 mx-0.5">
                                    <i class="mr-1 fa fa-download fa-fw"></i>Periksa Tugas</x-button>
                                @endif
                            </div>
                        </div>

                        <div class="whitespace-nowrap">
                            <div class="md:text-right">
                                @if(($p->status == PENEBUSAN_MENUNGGU_UPLOAD) || ($p->status ==
                                PENEBUSAN_BUTUH_REVISI))
                                <p class="text-sm"> Deadline:
                                    <b>{{ formatDateIso($p->deadline, 'dddd, HH:mm') . ' WIB'}}</b>
                                </p>
                                <p class="text-xs">
                                    {{ $p->deadline->diffForHumans()}}
                                </p>
                                @endif

                                @if($p->status == PENEBUSAN_SELESAI)
                                <p class="text-xs md:text-md md:text-right">Poin penebusan telah ditambahkan</p>
                                @endif
                            </div>

                            <div class="mt-2">
                                <x-badge-status-penebusan class="h-5 ml-1" category="{{ $p->status }}" />
                                <x-badge-status-penebusan class="h-5 ml-1" category="{{ PENEBUSAN_SELESAI }}"
                                    content="{{$p->jenispoin->poin}} poin" />
                            </div>
                        </div>

                    </div>
                </div>
                @empty
                <div class="px-5 py-4 hover:bg-blueGray-50">
                    <p class="mt-1 text-sm italic text-center text-gray-500">
                        Tidak ada riwayat penebusan
                    </p>
                </div>
                @endforelse
            </div>

            @if(POIN_MINIMUM > $detailPoins['akumulasi'])
            @include('admin.maba.user.detail.warning')
            @endif
        </x-card>

        @include('home.dashboard.penebusan.detail')

    </div>
</div>
