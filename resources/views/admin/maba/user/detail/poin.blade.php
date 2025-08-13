<div>
    <div x-data="{ showModalDetail: @entangle('showModalDetail') }">

        @if ($user->is_maba)
            <div class="mb-3 grid grid-cols-1 gap-6 lg:grid-cols-12" wire:ignore>
                <div class="col-span-1 lg:col-span-6">
                    <div class="mb-3 flex items-center justify-between">
                        <div class="flex flex-col justify-start">
                            <h5 class="font-bohemianSoul text-lg font-normal text-gray-700">
                                Rekapan Poin {{ $user->name }}
                            </h5>
                        </div>
                        <x-button class="rounded-3xl bg-gray-500 hover:bg-gray-600" :tagA="true"
                            href="{{ session('previous-url') }}">
                            Kembali
                        </x-button>
                    </div>
                    <x-card>
                        <x-doughnut-poin id='donat' poin={{$poin}} poin-max="{{ POIN_MAKSIMAL }}"
                            poin-cadangan="{{ $cadangan }}" />
                    </x-card>
                </div>

                <div class="col-span-1 lg:col-span-6">
                    <x-card class="mb-3">
                        <x-line-poin list-poin="{!! $listPoin !!}" />
                    </x-card>

                    <x-card>
                        <x-bar-poin id="bar" bonus="{{ $banyakBonus }}" pelanggaran="{{ $banyakPelanggaran }}"
                            penebusan="{{ $banyakPenebusan }}" />
                    </x-card>
                </div>
            </div>
        @elseif($user->hasRole(ROLE_PANITIA))
            <div class="mb-3 grid grid-cols-1 gap-6 lg:grid-cols-12" wire:ignore>
                <div class="col-span-1 lg:col-span-7">
                    <div class="mb-3 flex items-center justify-between">
                        <div class="flex flex-col justify-start">
                            <h5 class="font-bohemianSoul text-lg font-normal text-gray-700">
                                Rekapan Poin {{ $user->name }}
                            </h5>
                        </div>
                        <x-button class="rounded-3xl bg-gray-500 hover:bg-gray-600" :tagA="true"
                            href="{{ session('previous-url') }}">
                            Kembali
                        </x-button>
                    </div>

                    <x-card class="mb-3">
                        <x-line-poin list-poin="{!! $listPoin !!}" />
                    </x-card>
                </div>
            </div>
        @endif


        @if ($user->is_maba)
            @livewire('admin.maba.user.detail.list-penebusan', ['user' => $user->id])
        @endif

        <x-card class="mb-8 mt-3">
            <x-table :theads="['Jenis Poin', 'Kategori', 'Poin', 'Diberikan Pada', 'Aksi']" class="mb-3" :breakpointVisibility="[
                1 => ['xl' => 'hidden'], // Hide kategori on xl
                2 => ['lg' => 'hidden'], // Hide poin on sm
                3 => ['xl' => 'hidden'], // Hide diberikan pada on xl
                4 => ['sm' => 'hidden'], // Hide aksi pada on sm
            ]">
                <slot>
                    @forelse ($poins as $p)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }} border-b border-gray-200 hover:bg-blueGray-100"
                            wire:click="getWindowWidth({{ $p->id }}, window.innerWidth)">
                            <td class="px-6 py-3">
                                {{ $p->jenispoin->nama }}
                                <dl class="-ml-0.5 xl:hidden">
                                    <dd class="mt-1">
                                        <x-badge-poin :category="$p->jenispoin->category" /> <span class="text-xs italic sm:hidden">(Click
                                            For Detail)</span>
                                    </dd>
                                    <dd class="ml-0.5 mt-1 text-xs italic">
                                        <span class="lg:hidden">{{ $p->poin }}</span> Poin
                                        diberikan pada
                                        {{ $p->urutan_input }}
                                    </dd>
                                </dl>
                            </td>
                            <td class="hidden px-6 py-3 text-center xl:table-cell">
                                <x-badge-poin :category="$p->jenispoin->category" />
                            </td>
                            <td class="hidden px-6 py-3 text-center lg:table-cell">
                                {{ $p->poin }}</td>
                            <td class="hidden px-6 py-3 text-center xl:table-cell">{{ $p->urutan_input }}</td>
                            <td class="hidden px-6 py-3 text-center sm:table-cell">
                                <x-button wire:click="show({{ $p->id }})"
                                    class="mx-0.5 rounded-3xl bg-coklat-2 hover:bg-coklat-hover">
                                    Detail
                                </x-button>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                            <td colspan="5" class="text-md px-6 py-3 text-center italic">Tidak ada poin</td>
                        </tr>
                    @endforelse
                </slot>
            </x-table>

            {{ !empty($poins) ? $poins->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) : '' }}

            <div x-cloak x-show="showModalDetail">
                @if ($poinToShow)
                    <x-modal>
                        <div class="bg-white p-5">
                            <div class="mb-0 flex items-center justify-between">
                                <div class="mr-3">
                                    <p class="text-md font-poppins font-semibold">
                                        <span>Poin {{ $poinToShow['jenispoin']['nama'] }}</span>
                                        <x-badge-poin :category="$poinToShow['jenispoin']['category']" />
                                    </p>
                                </div>
                                <i class="fa fa-times cursor-pointer" x-on:click="showModalDetail = false"></i>
                            </div>

                            <p class="mt-2 text-xs">
                                Poin Diberikan pada
                                <b>{{ formatDateIso($poinToShow['urutan_input'], 'dddd, Do MMMM HH:mm:ss') }}</b>.
                                Poinnya
                                sebesar
                                <b>{{ $poinToShow['poin'] }}</b>.
                            </p>

                            <p class="mt-2 leading-tight">{{ $poinToShow['alasan'] }}</p>

                            <p class="mt-2">
                                @if ($user->is_maba)
                                    @if ($poinToShow['jenispoin']['category'] == CATEGORY_JENISPOIN_PELANGGARAN)
                                        <span>
                                            Poin ini mengurangi poin {{ $user->name }} yang sebelumnya sebesar
                                            <b>{{ $poinToShow['pertambahan'] }}</b>.
                                            @if ($poinToShow['filename'] != null)
                                                <p class="mt-2 font-bold">Bukti</p>
                                                <img src="{{ asset('storage/images/bukti-poin/' . $poinToShow['filename']) }}"
                                                    alt="Bukti menyusul" class="my-2 h-auto w-64">
                                            @endif
                                        </span>
                                    @else
                                        <span>
                                            Poin ini menambahi poin {{ $user->name }} yang sebelumnya sebesar
                                            <b>{{ $poinToShow['pertambahan'] ?? '-' }}</b>.
                                        </span>
                                    @endif
                                @endif

                                @if (isset($poinToShow['keterangan']))
                                    <span>{{ $poinToShow['keterangan'] }}</span>.
                                @endif

                                <span>
                                    Sehingga akumulasi poin {{ $user->name }} sampai poin ini diberikan
                                    <b>{{ $poinToShow['akumulasi_poin'] }}</b>.
                                    @if ($user->is_maba)
                                        Poin
                                        cadangan {{ $user->name }} sampai poin ini adalah
                                        <b>{{ $poinToShow['cadangan'] }}</b>
                                    @endif
                                </span>
                            </p>
                        </div>
                    </x-modal>
                @endif
            </div>
        </x-card>

    </div>
</div>

@push('script-bottom')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tr[data-id]');

            rows.forEach(row => {
                row.addEventListener('click', function() {
                    const id = row.getAttribute('data-id');
                    const width = window.innerWidth;

                    @this.call('getWindowWidth', id, width);
                });
            });
        });
    </script>
@endpush
