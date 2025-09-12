<div x-data="{ showModalDetail: @entangle('showModalDetail').live }">
    @if ($check)
        <div class="grid grid-cols-1 gap-3">
            <div class="col-span-1 ">
                <x-card class="px-2 sm:px-5">
                    <h1 class="text-xl font-semibold text-center text-gray-900 font-poppins">Poin Terbaru</h1>
                    <div class="divide-y">
                        @forelse ($poins as $p)
                            <div class="px-2 py-4 cursor-pointer sm:px-5 hover:bg-blueGray-50"
                                wire:click="show({{ $p->id }})">
                                <h6>
                                    <span class="mr-2 text-sm font-poppins">Poin {{ $p->jenispoin->nama }}</span>
                                </h6>
                                <small class="mt-1 text-xs italic text-gray-500">Diberikan pada
                                    {{ $p->urutan_input }} WIB.</b>.</small>
                                <div class="flex justify-start w-full gap-8 my-2">
                                    <div class="flex gap-4">
                                        <p class="text-xs font-semibold text-gray-700 font-poppins md:text-sm">Nilai
                                            Poin</p>
                                        <p
                                            class="rounded-xl px-4 bg-[#B9683A] text-gray-50 font-semibold md:text-sm text-xs py-0">
                                            <b>{{ $p->poin }}</b>
                                        </p>
                                    </div>
                                    <div class="flex gap-4">
                                        <p class="text-xs font-semibold text-gray-700 font-poppins md:text-sm">Kategori
                                        </p>
                                        <x-badge-poin :category="$p->jenispoin->category" />
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-5 py-4 cursor-pointer hover:bg-blueGray-50">
                                <div class="text-sm italic text-center text-gray-500 font-poppins">Kamu belum
                                    memiliki poin apapun. Poin awalmu
                                    @if (auth()->user()->is_maba)
                                        {{ POIN_AWAL_MABA }}
                                    @else
                                        {{ POIN_AWAL_PANITIA }}
                                    @endif
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-3">
                        {{ $poins->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
                    </div>
                </x-card>
            </div>

            <div class="col-span-1 xl:col-span-5" wire:ignore>

                <div class="grid grid-cols-1 gap-3 lg:grid-cols-2">
                    <div class="col-span-1">
                        <x-card>
                            <x-line-poin list-poin="{!! $listPoin !!}" />
                        </x-card>
                    </div>
                    @if (auth()->user()->is_maba)
                        <div class="col-span-1">
                            <x-card>
                                <x-bar-poin id="bar" bonus="{{ $banyakBonus }}"
                                    pelanggaran="{{ $banyakPelanggaran }}" penebusan="{{ $banyakPenebusan }}" />
                            </x-card>
                        </div>
                        <div class="col-span-1">
                            <x-card>
                                <x-doughnut-poin id='donat' poin={{$akumulasi}}
                                    poin-max="{{ POIN_MAKSIMAL }}" poin-cadangan="{{ $cadangan }}" />
                            </x-card>
                        </div>
                    @endif
                </div>

            </div>

            <div x-cloak x-show="showModalDetail">
                @if ($poinToShow)
                    <x-modal>
                        <div class="p-5 bg-white">
                            <div class="flex items-center justify-between mb-0">
                                <div class="mr-3">
                                    <p class="font-semibold text-md font-poppins">
                                        <span>Poin {{ $poinToShow['jenispoin']['nama'] }}</span>
                                        <x-badge-poin :category="$poinToShow['jenispoin']['category']" />
                                    </p>
                                </div>
                                <i class="cursor-pointer fa fa-times" x-on:click="showModalDetail = false"></i>
                            </div>

                            <p class="mt-2 text-xs">
                                Poin Diberikan pada
                                <b>{{ formatDateIso($poinToShow['urutan_input'], 'dddd, Do MMMM HH:mm:ss') }}</b>.
                                Poinnya
                                sebesar
                                <b>{{ $poinToShow['poin'] }}</b>.
                            </p>

                            <p class="mt-2 leading-tight">{{ $poinToShow['alasan'] }}</p>
                            @if ($poinToShow['jenispoin']['category'] == CATEGORY_JENISPOIN_PELANGGARAN)
                                @if ($poinToShow['filename'] != null)
                                    <p class="mt-2 font-bold">Bukti</p>
                                    <img src="{{ asset('storage/images/bukti-poin/' . $poinToShow['filename']) }}"
                                        alt="Bukti menyusul" class="w-64 h-auto my-2">
                                @endif
                            @endif
                            <hr>

                            <p class="mt-2">
                                @if (auth()->user()->is_maba)
                                    @if ($poinToShow['jenispoin']['category'] == CATEGORY_JENISPOIN_PELANGGARAN)
                                        <span>
                                            Poin ini mengurangi poinmu yang sebelumnya sebesar
                                            <b>{{ $poinToShow['pertambahan'] }}</b>.
                                        </span>
                                    @else
                                        <span>
                                            Poin ini menambahi poinmu yang sebelumnya sebesar
                                            <b>{{ $poinToShow['pertambahan'] }}</b>.
                                        </span>
                                    @endif
                                @endif

                                @if (isset($poinToShow['keterangan']))
                                    <span>{{ $poinToShow['keterangan'] }}</span>.
                                @endif

                                <span>
                                    Sehingga akumulasi poin sampai poin ini diberikan
                                    <b>{{ $poinToShow['akumulasi_poin'] }}</b>.

                                    @if (auth()->user()->is_maba)
                                        Poin
                                        cadanganmu sampai poin ini adalah <b>{{ $poinToShow['cadangan'] }}</b>
                                    @endif

                                </span>
                            </p>
                        </div>
                    </x-modal>
                @endif
            </div>
        </div>
    @else
        <div class="p-3 text-sm text-center text-black rounded-md font-bohemianSoul md:text-base bg-base-yellow-200">
            <p>Untuk melihat poin, silakan mengisi formulir berikut: </p>
        </div>
        <div class="mx-4 sm:mx-8">
            @if (!empty($unfilledFormulirs))
                <ul class="mt-6">
                    @foreach ($unfilledFormulirs as $formulir)
                        <li>
                            <div class="flex justify-center mt-4">
                                <x-button tagA="true" href="{{ $formulir->link_form }}" target="_blank"
                                    class="block w-3/4 text-sm text-center rounded-full md:text-base bg-merah-1 hover:bg-opacity-90">
                                    Isi {{ $formulir->nama_formulir }}
                                </x-button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
</div>
