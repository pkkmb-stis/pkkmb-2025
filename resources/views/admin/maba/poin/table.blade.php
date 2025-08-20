<div>
    <div x-data="{ openedit: @entangle('openedit'), showModalDelete: false, user_name: '', update_pada: '', poinTitle: '', poinId: '', showModalDetail: @entangle('showModalDetail') }" x-init="document.addEventListener('click', function(event) {
        if (window.innerWidth <= 640) {
            let targetCard = event.target.closest('.clickable-card');
            if (targetCard) {
                $wire.show(targetCard.dataset.id);
            }
        }
    });
    
    Livewire.hook('message.processed', (message, component) => {
        document.querySelectorAll('.clickable-card').forEach(card => {
            if (!card.hasAttribute('data-listener-added')) {
                card.addEventListener('click', function() {
                    if (window.innerWidth <= 640) {
                        $wire.show(card.dataset.id);
                    }
                });
                card.setAttribute('data-listener-added', 'true');
            }
        });
    });;">
        <div class="w-full text-center">
            <img wire:loading wire:target="show,edit" src="{{ asset('/img/icon/loading-ring.svg') }}" class="h-10 my-0"
                alt="">
        </div>
        <x-card class="mb-8">
            <div class="flex items-center justify-between mb-5">
                <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Poin User</h5>
                <div class="flex flex-row-reverse">
                    @can(PERMISSION_ADD_POIN)
                        @livewire('admin.maba.poin.add')
                    @endcan
                    @can(PERMISSION_OTOMATIS_POIN)
                        @livewire('admin.maba.poin.poin-otomatis')
                    @endcan
                    @livewire('admin.maba.poin.export-poin')
                </div>
            </div>
            <div class="grid lg:grid-cols-2 lg:gap-6">
                <div class="mb-3">
                    <x-select-form name="jenisUser" id="jenisUser" wire:model.lazy="jenisUser">
                        <option value="semua">Maba dan Panitia</option>
                        <option value="maba">Maba</option>
                        <option value="panitia">Panitia</option>
                    </x-select-form>
                </div>

                <div class="mb-3">
                    <x-select-form name="tipePoin" id="tipePoin" wire:model.lazy="tipePoin">
                        <option value="-1">Semua Tipe Poin</option>
                        <option value="{{ CATEGORY_JENISPOIN_PENGHARGAAN }}">Penghargaan</option>
                        <option value="{{ CATEGORY_JENISPOIN_PELANGGARAN }}">Pelanggaran</option>
                        <option value="{{ CATEGORY_JENISPOIN_PENEBUSAN }}">Penebusan</option>
                    </x-select-form>
                </div>
            </div>
            <div class="grid lg:grid-cols-2 lg:gap-6">
                <div class="mb-3">
                    <x-date-wo-time-input wire:model.lazy="tanggal_poin" id="tanggal_poin" name="tanggal_poin"
                        x-ref="addDate" />
                </div>

                <div class="mb-3">
                    <x-input wire:model.debounce.200ms="search" type="text"
                        placeholder="Cari nama, no ujian, nim atau nimb"
                        class="block w-full mb-3 placeholder-gray-400" />
                </div>
            </div>
            <div class="hidden sm:block">
                <x-table :theads="['Aksi', 'Nama', 'Jenis Poin', 'Kategori', 'Poin', 'Urutan Input']" class="mb-3" :breakpointVisibility="[
                    3 => ['xl' => 'hidden'], // Hide kategori on xl
                    4 => ['xl' => 'hidden'], // Hide Poin on xl
                    5 => ['xl' => 'hidden'], // Hide urutan input on xl
                ]">
                    <slot>
                        @forelse ($poins as $p)
                            <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}"
                                x-on:click="window.innerWidth < 1024 ? $wire.show({{ $p->id }}) : null">
                                <td class="px-6 py-3 text-center">
                                    <x-button wire:click="show({{ $p->id }})"
                                        class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover mx-0.5 hidden lg:inline">
                                        Detail
                                    </x-button>
                                    @can(PERMISSION_UPDATE_POIN)
                                        <x-button
                                            class="rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 mx-0.5 px-5 sm:block lg:inline mb-2"
                                            wire:click.stop='edit({{ $p->id }})'
                                            x-on:click="initializeEditJenisPoin()">
                                            Edit
                                        </x-button>
                                    @endcan
                                    @can(PERMISSION_DELETE_POIN)
                                        <x-button
                                            class="rounded-3xl bg-merah-700 hover:hover:bg-merah-hover mx-0.5 sm:block lg:inline"
                                            x-on:click.stop="showModalDelete = true; poinTitle = '{{ $p->jenispoin->nama }}'; poinId = '{{ $p->id }}'; user_name = '{{ addslashes($p->user->name) }}'; update_pada = '{{ formatDateIso($p->urutan_input, 'dddd, D MMMM YYYY HH:mm:ss') . ' WIB' }}'">
                                            Delete
                                        </x-button>
                                    @endcan
                                </td>
                                <td class="px-6 py-3 text-left" title="{{ $p->user->name }}">
                                    <a href="{{ route('user.detail', ['id' => $p->user->id]) }}"
                                        class="underline hover:text-base-brown-500">
                                        {{ substr_replace($p->user->name, '..', 20) }}
                                    </a>
                                </td>

                                <td class="px-6 py-3" title="{{ $p->jenispoin->nama }}">
                                    {{ substr_replace($p->jenispoin->nama, '..', 20) }}
                                    <dl class="xl:hidden -ml-0.5">
                                        <dd class="mt-1">
                                            <span class="text-xs italic text-base-blue-400 lg:hidden">(Click For
                                                Detail)</span>
                                        </dd>
                                        <dd class="mt-1">
                                            <x-badge-poin :category="$p->jenispoin->category" />
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white rounded-full whitespace-nowrap bg-coklat-1">
                                                {{ $p->poin }} Poin
                                            </span>
                                            <span class="text-xs italic sm:hidden">(Click
                                                For Detail)</span>
                                        </dd>
                                        <dd class="mt-1 ml-0.5 text-xs italic">
                                            Diberikan pada {{ $p->urutan_input }}
                                        </dd>
                                    </dl>
                                </td>

                                <td class="hidden px-6 py-3 text-center xl:table-cell">
                                    <x-badge-poin :category="$p->jenispoin->category" />
                                </td>

                                <td class="hidden px-6 py-3 text-center xl:table-cell">{{ $p->poin }}</td>
                                <td class="hidden px-6 py-3 text-center xl:table-cell">{{ $p->urutan_input }}
                                </td>
                            </tr>
                        @empty
                            <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                                <td colspan="6" class="px-6 py-3 italic text-center text-md">Tidak ada poin</td>
                            </tr>
                        @endforelse

                    </slot>
                </x-table>
            </div>
            <!-- Versi Mobile untuk Tabel Poin -->
            <div class="grid grid-cols-1 gap-4 sm:hidden">
                @forelse ($poins as $p)
                    <x-card class="flex flex-col items-start justify-between p-4 space-y-3 font-sans clickable-card"
                        data-id="{{ $p->id }}">
                        <div class="flex items-start justify-between w-full">
                            <div class="font-bold text-base-blue-400 ml-0.5">
                                <a href="{{ route('user.detail', ['id' => $p->user->id]) }}"
                                    class="underline hover:text-base-brown-500">
                                    {{ $p->user->name }}
                            </div>
                            </a>
                            @can(PERMISSION_DELETE_POIN)
                                <x-button
                                    x-on:click.stop="showModalDelete = true; poinTitle = '{{ $p->jenispoin->nama }}'; poinId = '{{ $p->id }}'; user_name = '{{ addslashes($p->user->name) }}'; update_pada = '{{ formatDateIso($p->urutan_input, 'dddd, D MMMM YYYY HH:mm:ss') . ' WIB' }}'"
                                    class="bg-merah-700 hover:bg-merah-hover rounded-3xl">Delete</x-button>
                            @endcan
                        </div>
                        <div class="w-full mt-1 font-sans">
                            <x-badge-poin :category="$p->jenispoin->category" />
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white rounded-full whitespace-nowrap bg-coklat-1">
                                {{ $p->poin }} Poin
                            </span>
                            <span class="text-xs italic font-bold text-base-blue-400">(Click For
                                Detail)</span>
                            <dl class="mt-2 text-sm text-base-blue-400">
                                <dt class="inline font-bold">Jenis Poin:</dt>
                                <dd class="inline font-medium">{{ substr_replace($p->jenispoin->nama, '..', 30) }}</dd>
                            </dl>
                            <dl class="mt-2 text-sm italic font-medium text-base-blue-400">
                                Diberikan pada {{ $p->urutan_input }}
                            </dl>
                            @can(PERMISSION_UPDATE_POIN)
                                <x-button wire:click.stop="edit({{ $p->id }})"
                                    class="w-full mt-3 bg-base-orange-500 hover:bg-base-orange-600 rounded-3xl">Edit</x-button>
                            @endcan
                        </div>
                    </x-card>
                @empty
                    <div class="col-span-1 italic text-center text-gray-500 sm:col-span-2">
                        Tidak ada poin
                    </div>
                @endforelse
            </div>
            <div class="mt-3">
                {{ $poins->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
            </div>

        </x-card>

        <div x-cloak x-show="showModalDetail">
            @if ($poinToShow)
                <x-modal>
                    <div class="p-5 bg-white">
                        <div class="flex items-center justify-between mb-0">
                            <div class="mr-3">
                                <p class="font-semibold text-md font-poppins">{{ $poinToShow->user->name }}</p>
                                <small class="text-xs italic text-gray-600">
                                    {{ $poinToShow->user->username }}
                                    @if ($poinToShow->user->is_maba)
                                        | {{ $poinToShow->user->nimb ?? '-' }}
                                    @endif
                                </small>
                            </div>
                            <i class="cursor-pointer fa fa-times" x-on:click="showModalDetail = false"></i>
                        </div>

                        <p class="mt-2 text-xs">
                            Diberikan poin
                            <x-badge-poin :category='$poinToShow->jenispoin->category' />
                            <b>{{ $poinToShow->jenispoin->nama }}</b>
                            yang dilakukan pada
                            <b>{{ formatDateIso($poinToShow->urutan_input, 'dddd, Do MMMM HH:mm:ss') }}</b>
                            dengan poin sebesar <b>{{ $poinToShow->poin }}</b>.
                        </p>

                        <p class="mt-2">{{ $poinToShow->alasan }}</p>
                        @if ($poinToShow->jenispoin->category == CATEGORY_JENISPOIN_PELANGGARAN)
                            @php
                                $telat = [1, 2, 3, 4, 6, 7, 8];
                            @endphp
                            @if (in_array($poinToShow->jenispoin->id, $telat))
                                <p>Kamu sudah melewati batas presensi</p>
                            @else
                                @if ($poinToShow->filename != null)
                                    <p class="mt-2 font-bold">Bukti</p>
                                    <img src="{{ asset('storage/images/bukti-poin/' . $poinToShow->filename) }}"
                                        alt="Bukti menyusul" class="w-64 h-auto my-2">
                                @endif
                            @endif


                        @endif
                    </div>
                </x-modal>
            @endif
        </div>

        @can(PERMISSION_UPDATE_POIN)
            @include('admin.maba.poin.edit')
        @endcan

        @can(PERMISSION_DELETE_POIN)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus Jenis Poin</h5>
                        </x-slot>
                        <div>
                            Apakah kamu yakin untuk menghapus poin <b x-text="poinTitle"></b> yang diberikan pada <b
                                x-text="update_pada"></b> dari user <b x-text="user_name"></b> ?
                        </div>
                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalDelete = false; $wire.destroy(poinId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan
    </div>
</div>
