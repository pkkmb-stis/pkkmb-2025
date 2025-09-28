<div>
    <div x-data="{ openedit: @entangle('openedit'), showModalDelete: false, jenispoinTitle: '', jenispoinId: '', showModalDetail: @entangle('showModalDetail') }" x-init="document.addEventListener('click', function(event) {
        if (window.innerWidth <= 640) {
            let targetCard = event.target.closest('.clickable-card');
            if (targetCard) {
                $wire.show(targetCard.dataset.id);
            }
        }
    });
    
    Livewire.hook('message.processed', (message, component) => {
        // Reinitialize event listeners after Livewire updates
        document.querySelectorAll('.clickable-card').forEach(card => {
            card.addEventListener('click', function() {
                if (window.innerWidth <= 640) {
                    $wire.show(card.dataset.id);
                }
            });
        });
    });">
        <x-card class="mb-8">
            <div class="flex items-center justify-between mb-3">
                <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Jenis Poin</h5>
                @can(PERMISSION_ADD_JENISPOIN)
                    @livewire('admin.tibum.jenispoin.add')
                @endcan
            </div>
            <div class="mb-3">
                <x-select-form wire:model.lazy="categorySelected" id="categorySelected">
                    <option value="-1">Semua Kategori</option>
                    @foreach ([1, 2, 3] as $category)
                        <option value="{{ $category }}">{{ getCategoryPoin($category) }}</option>
                    @endforeach
                </x-select-form>
            </div>

            <x-input wire:model.debounce.200ms="search" type="text" placeholder="Cari Jenis Poin ..."
                class="block w-full mb-3 placeholder-gray-400" />

            <div class="hidden md:block">
                <x-table :theads="['Aksi', 'Nama Poin', 'Tipe', 'Poin']" class="mb-3" :breakpointVisibility="[
                    2 => ['xl' => 'hidden'], // Hide tipe on xl
                    3 => ['lg' => 'hidden'], // Hide poin on lg
                ]">
                    <slot>
                        @forelse ($jenispoin as $j)
                            <tr
                                class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                <td class="px-6 py-3 text-center md:w-60 lg:w-64 xl:w-58">
                                    <x-button wire:click="show({{ $j->id }})"
                                        class="rounded-3xl bg-2025-1 hover:bg-coklat-hover mx-0.5">
                                        Detail
                                    </x-button>

                                    @can(PERMISSION_UPDATE_JENISPOIN)
                                        <x-button
                                            class="rounded-3xl bg-2025-2 hover:bg-2025-1 lg:px-5 mx-0.5"
                                            wire:click='edit({{ $j->id }})'>
                                            Edit
                                        </x-button>
                                    @endcan

                                    @can(PERMISSION_DELETE_JENISPOIN)
                                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                            x-on:click="showModalDelete = true; jenispoinTitle = '{{ $j->title }}'; jenispoinId = '{{ $j->id }}'">
                                            Delete
                                        </x-button>
                                    @endcan
                                </td>
                                <td class="px-6 py-3 text-left w-96 md:w-72 lg:w-96">
                                    <dl>
                                        <dd class="xl:hidden">
                                            <x-badge-poin :category="$j->category" />
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white rounded-full whitespace-nowrap bg-coklat-1 lg:hidden">{{ $j->poin }}
                                                Poin</span>
                                        </dd>
                                        <dd class="mt-1 xl:mt-0">{{ $j->nama }}</dd>
                                    </dl>
                                </td>
                                <td class="hidden w-32 px-6 py-3 text-center xl:table-cell">
                                    <x-badge-poin :category="$j->category" />
                                </td>
                                <td class="hidden w-16 px-6 py-3 text-center lg:table-cell">{{ $j->poin }}</td>
                            </tr>
                        @empty
                            <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                                <td colspan="4" class="px-6 py-3 italic text-center text-md">Tidak ada jenis poin
                                </td>
                            </tr>
                        @endforelse

                    </slot>
                </x-table>
            </div>

            <!-- Versi Mobile untuk Tabel Jenis Poin -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:hidden">
                @forelse ($jenispoin as $j)
                    <x-card class="flex flex-col items-start justify-between p-4 space-y-3 font-sans clickable-card"
                        data-id="{{ $j->id }}">
                        <div class="flex items-start justify-between w-full">
                            <div class="font-medium text-base-blue-400 ml-0.5">{{ $j->nama }}</div>
                            @can(PERMISSION_DELETE_JENISPOIN)
                                <x-button
                                    x-on:click.stop="showModalDelete = true; jenispoinTitle = '{{ $j->title }}'; jenispoinId = '{{ $j->id }}'"
                                    class="bg-merah-700 hover:bg-merah-hover rounded-3xl">Delete</x-button>
                            @endcan
                        </div>
                        <div class="mt-1 w-full">
                            <x-badge-poin :category="$j->category" />
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white rounded-full whitespace-nowrap bg-coklat-1">
                                {{ $j->poin }} Poin
                            </span>
                            <span class="text-xs italic font-bold text-base-blue-400 sm:hidden">(Click For
                                Detail)</span>
                            @can(PERMISSION_UPDATE_JENISPOIN)
                                <x-button wire:click.stop="edit({{ $j->id }})"
                                    class="w-full mt-3 bg-2025-2 hover:bg-2025-1 rounded-3xl">Edit</x-button>
                            @endcan
                        </div>
                    </x-card>
                @empty
                    <div class="col-span-1 italic text-center text-gray-500 sm:col-span-2">
                        Tidak ada jenis poin
                    </div>
                @endforelse
            </div>


            <div class="mt-4">
                {{ $jenispoin->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
            </div>
        </x-card>

        <div x-cloak x-show="showModalDetail">
            @if ($jenispoinToShow)
                <x-modal>
                    <div class="p-5 bg-white">
                        <div class="flex items-center justify-between mb-0">
                            <div class="mr-3">
                                <p class="flex items-center text-lg font-bold">
                                    {{ $jenispoinToShow->nama }}
                                    <x-badge-poin :category='$jenispoinToShow->category' class="ml-1" />
                                </p>
                            </div>
                            <i class="cursor-pointer fa fa-times" x-on:click="showModalDetail = false"></i>
                        </div>
                        <span>Poin: <b> {{ $jenispoinToShow->poin }}</b></span>
                        @if ($jenispoinToShow->category == CATEGORY_JENISPOIN_PELANGGARAN && $jenispoinToShow->is_bintang)
                            <span>(per kegiatan)</span>
                        @endif
                        @if ($jenispoinToShow->category == CATEGORY_JENISPOIN_PENEBUSAN)
                            <p>Jenis Penebusan: {{ MAP_CATEGORY['tipe_poin'][$jenispoinToShow->type] }}</p>
                            <p>Lama Pengerjaan: {{ $jenispoinToShow->deadline }} hari</p>
                        @endif
                        <br>
                        <p>Detail: </p>
                        <p>{{ $jenispoinToShow->detail }}</p>
                    </div>
                </x-modal>
            @endif
        </div>

        @can(PERMISSION_UPDATE_JENISPOIN)
            @include('admin.tibum.jenispoin.edit')
        @endcan

        @can(PERMISSION_DELETE_JENISPOIN)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus Jenis Poin</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus poin <b x-text="jenispoinTitle"></b>?
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalDelete = false; $wire.destroy(jenispoinId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan

    </div>
</div>
