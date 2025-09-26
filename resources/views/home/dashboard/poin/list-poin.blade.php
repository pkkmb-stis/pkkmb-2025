<div x-data="{ showModalDetail: @entangle('showModalDetail') }" x-on:close-modal.window="showModalDetail = false">
    <x-card class="px-2 sm:px-5" style="border: 4px solid #1E1E1E;">
        <h5 class="mb-4 flex items-center justify-center gap-2 font-brasikaDisplay text-lg font-medium">
            <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" 
                alt="Cempaka Merah" 
                class="w-8 h-7">
            
            <div class="relative">
                <img src="{{ asset('img/asset/2025/background_subjudul.png') }}" alt="BG" class="h-12 rounded-lg">
                <span class="absolute inset-0 flex items-center justify-center text-[#8B2F4B] -translate-y-1">
                    Poin
                </span>
            </div>
            
            <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" 
                alt="Cempaka Merah" 
                class="w-8 h-7">
        </h5>
        <div class="divide-y">
            @forelse ($poin as $p)
                <div class="px-2 py-4 hover:bg-blueGray-50 sm:px-5 cursor-pointer" wire:click="show({{ $p['id'] }})">
                    <h6>
                        <span class="mr-2 font-base font-poppins">Poin {{ $p['jenispoin']['nama'] }}</span>
                        <x-badge-poin :category="$p['jenispoin']['category']" />
                    </h6>
                    <p class="mt-1 text-xs italic text-gray-500">Poin diberikan pada
                        {{ formatDateIso($p['urutan_input'], 'dddd, D MMMM YYYY HH:mm:ss') }} WIB. Poin bernilai
                        <b>{{ $p['poin'] }}</b>
                    </p>
                    <p class="mt-1 text-sm">{{ $p['alasan'] }}</p>
                </div>

            @empty
                <div class="px-5 py-4 hover:bg-blueGray-50">
                    <p class="mt-1 text-sm italic text-center text-gray-500">
                        Kamu belum terkena poin. Poin awalmu
                        <b>
                            @if (auth()->user()->is_maba)
                                {{ POIN_AWAL_MABA }}
                            @else
                                {{ POIN_AWAL_PANITIA }}
                            @endif
                        </b>
                    </p>
                </div>
            @endforelse
        </div>

        @if (count($poin) > 0)
            <div class="flex justify-end mt-3">
                <x-button
                    class="uppercase rounded-3xl text-md whitespace-nowrap bg-base-blue-300 hover:bg-base-blue-400"
                    :tagA="true" href="{{ route('home.profil') . '?menu=poin' }}">
                    Selengkapnya
                </x-button>
            </div>
        @endif
    </x-card>
    <div x-cloak x-show="showModalDetail" x-on:keydown.escape.window="showModalDetail = false">
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
                        Poin diberikan pada
                        <b>{{ formatDateIso($poinToShow['urutan_input'], 'dddd, Do MMMM YYYY HH:mm:ss') }}</b>.
                        Poin bernilai
                        <b>{{ $poinToShow['poin'] }}</b>.
                    </p>

                    <p class="mt-2 leading-tight">{{ $poinToShow['alasan'] }}</p>

                    @if ($poinToShow['jenispoin']['category'] == CATEGORY_JENISPOIN_PELANGGARAN && $poinToShow['filename'])
                        <p class="mt-2 font-bold">Bukti</p>
                        <img src="{{ asset('storage/images/bukti-poin/' . $poinToShow['filename']) }}"
                            alt="Bukti menyusul" class="w-64 h-auto my-2">
                    @endif

                    <hr>

                    <p class="mt-2">
                        @if (auth()->user()->is_maba)
                            @if ($poinToShow['jenispoin']['category'] == CATEGORY_JENISPOIN_PELANGGARAN)
                                Poin ini mengurangi poinmu sebelumnya sebesar
                                <b>{{ $poinToShow['pertambahan'] }}</b>.
                            @else
                                Poin ini menambah poinmu sebelumnya sebesar
                                <b>{{ $poinToShow['pertambahan'] }}</b>.
                            @endif
                        @endif

                        @if (isset($poinToShow['keterangan']) && $poinToShow['keterangan'])
                            {{ $poinToShow['keterangan'] }}.
                        @endif

                        Sehingga akumulasi poin sampai poin ini diberikan adalah
                        <b>{{ $poinToShow['akumulasi_poin'] }}</b>.

                        @if (auth()->user()->is_maba)
                            Poin cadanganmu sampai poin ini adalah
                            <b>{{ $poinToShow['cadangan'] }}</b>.
                        @endif
                    </p>
                </div>
            </x-modal>
        @endif
    </div>
</div>
