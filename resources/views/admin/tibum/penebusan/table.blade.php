<div>
    <div x-data="{ openedit: @entangle('openedit'), showModalDelete: false, jenispoinTitle: '', user_name: '', update_pada: '', penebusanId: '', showModalDetail: @entangle('showModalDetail'), isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress" x-init="document.addEventListener('click', function(event) {
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

            <div class="flex items-center justify-between mb-2">
                <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Penebusan</h5>
                <div class="flex flex-row-reverse">
                    @can(PERMISSION_ADD_PENEBUSAN)
                        @livewire('admin.tibum.penebusan.add')
                    @endcan
                </div>
            </div>
            <div class="grid mb-3 lg:grid-cols-2 lg:gap-6 gap-y-3">
                <x-select-form wire:model.lazy="selectedStatus">
                    <option value="-1">Semua Status</option>
                    @foreach (MAP_CATEGORY['penebusan_user'] as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </x-select-form>

                <x-select-form wire:model.lazy="selectedTipe">
                    <option value="-1">Semua Tipe</option>
                    @foreach (MAP_CATEGORY['tipe_poin'] as $key => $tipe)
                        <option value="{{ $key }}">{{ $tipe }}</option>
                    @endforeach
                </x-select-form>
            </div>

            <x-input wire:model.debounce.200ms="search" type="text" placeholder="Cari nama atau nimb"
                class="block w-full mb-3 placeholder-gray-400" />
            <div class="hidden sm:block">
                <x-table :theads="['Aksi', 'Nama', 'Status', 'Tipe', 'Diupdate Pada']" class="mb-3" :breakpointVisibility="[
                    4 => ['xl' => 'hidden'], // Hide Diupdate Pada on xl
                    3 => ['lg' => 'hidden'], // Hide tipe on lg
                    2 => ['lg' => 'hidden'], // Hide status on lg
                ]">
                    <slot>
                        @forelse ($penebusan as $p)
                            <tr
                                class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                <td class="px-6 py-3 text-center">
                                    <x-button wire:click="show({{ $p->id }})"
                                        class="rounded-3xl bg-2025-1 hover:bg-coklat-hover mx-0.5">
                                        Detail
                                    </x-button>

                                    @can(PERMISSION_UPDATE_PENEBUSAN)
                                        <x-button
                                            class="rounded-3xl px-5 bg-2025-2 hover:bg-2025-1 mx-0.5"
                                            wire:click='edit({{ $p->id }})'>
                                            Edit
                                        </x-button>
                                    @endcan

                                    @can(PERMISSION_DELETE_PENEBUSAN)
                                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                            x-on:click="showModalDelete = true; jenispoinTitle = '{{ $p->jenispoin ? $p->jenispoin->nama : '' }}'; penebusanId = '{{ $p->id }}'; user_name = '{{ addslashes($p->user->name) }}'; update_pada = '{{ $p->updated_at ? $p->updated_at->locale('id')->isoFormat('dddd, Do MMMM H:mm') . ' WIB' : '' }}'">
                                            Delete
                                        </x-button>
                                    @endcan
                                </td>
                                <td class="px-6 py-3 text-left">
                                    <a href="{{ route('user.detail', ['id' => $p->user->id]) }}"
                                        class="underline hover:text-base-brown-500">
                                        {{ ucwords($p->user->name) }}
                                    </a>
                                    <dl>
                                        <dd class="mt-1 lg:hidden">
                                            <x-badge-status-penebusan category="{{ $p->status }}" />
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white rounded-full whitespace-nowrap bg-coklat-1">{{ getTipePenebusan($p->jenispoin ? $p->jenispoin->type : '') }}</span>
                                        </dd>
                                        <dd class="mt-1 text-xs italic xl:hidden">
                                            Diupdate pada
                                            {{ $p->updated_at ? formatDateIso($p->updated_at, 'dddd, Do MMMM H:mm') . ' WIB' : '-' }}
                                        </dd>
                                    </dl>
                                </td>
                                <td class="hidden px-6 py-3 text-center lg:table-cell">
                                    <x-badge-status-penebusan category="{{ $p->status }}" />
                                </td>
                                <td class="hidden px-6 py-3 text-center lg:table-cell">
                                    {{ getTipePenebusan($p->jenispoin ? $p->jenispoin->type : '') }}
                                </td>
                                <td class="hidden px-6 py-3 text-center xl:table-cell">
                                    {{ $p->updated_at ? formatDateIso($p->updated_at, 'dddd, Do MMMM H:mm') . ' WIB' : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                                <td colspan="5" class="px-6 py-3 italic text-center text-md">Tidak ada penebusan</td>
                            </tr>
                        @endforelse

                    </slot>
                </x-table>
            </div>

            {{-- Versi Mobile --}}
            <div class="grid grid-cols-1 gap-4 sm:hidden">
                @forelse ($penebusan as $p)
                    <x-card class="flex flex-col items-start justify-between p-4 space-y-3 font-sans clickable-card"
                        data-id="{{ $p->id }}">
                        <div class="flex items-end justify-between w-full item-s">
                            <a href="{{ route('user.detail', ['id' => $p->user->id]) }}"
                                class="font-medium underline text-base-blue-400 hover:text-base-brown-500">
                                {{ ucwords($p->user->name) }}
                            </a>
                            @can(PERMISSION_DELETE_PENEBUSAN)
                                <x-button
                                    x-on:click.stop="showModalDelete = true; jenispoinTitle = '{{ $p->jenispoin ? $p->jenispoin->nama : '' }}'; penebusanId = '{{ $p->id }}'; user_name = '{{ addslashes($p->user->name) }}'; update_pada = '{{ $p->updated_at ? $p->updated_at->locale('id')->isoFormat('dddd, Do MMMM H:mm') . ' WIB' : '' }}'"
                                    class="bg-merah-700 hover:bg-merah-hover rounded-3xl">Delete</x-button>
                            @endcan
                        </div>
                        <div class="mt-1">
                            <x-badge-status-penebusan category="{{ $p->status }}" />
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white rounded-full whitespace-nowrap bg-coklat-1">
                                {{ getTipePenebusan($p->jenispoin ? $p->jenispoin->type : '') }}
                            </span>
                            <span class="text-xs italic font-bold text-base-blue-400 sm:hidden">(Click For
                                Detail)</span>
                        </div>
                        <div class="mt-1 text-xs italic font-medium text-base-blue-400 ml-0.5">
                            Diupdate pada
                            {{ $p->updated_at ? formatDateIso($p->updated_at, 'dddd, Do MMMM H:mm') . ' WIB' : '-' }}
                        </div>
                        <div class="flex self-stretch justify-between space-x-2">
                            @can(PERMISSION_UPDATE_PENEBUSAN)
                                <x-button wire:click="edit({{ $p->id }})"
                                    class="flex-grow bg-2025-2 hover:bg-2025-1 rounded-3xl">Edit</x-button>
                            @endcan
                        </div>
                    </x-card>
                @empty
                    <div class="col-span-1 italic text-center text-gray-500 sm:col-span-2">Tidak ada penebusan</div>
                @endforelse
            </div>

            <div class="mt-3">
                {{ $penebusan->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
            </div>

        </x-card>
        <div x-cloak x-show="showModalDetail">
            @if ($penebusanToShow)
                <x-modal>
                    <div class="p-5 bg-white">
                        <div class="flex items-center justify-between mb-0">
                            <div class="mr-3">
                                <p class="text-lg font-semibold text-gray-700 capitalize">Penebusan
                                    <b>{{ $penebusanToShow->user->name }}</b>
                                </p>
                                <p class="text-xs text-gray-600">
                                    <span class="text-sm text-gray-400">{{ $penebusanToShow->user->username }} |
                                        {{ $penebusanToShow->user->nimb ?? '-' }}</span>
                                    <x-badge-status-penebusan category="{{ $penebusanToShow->status }}" />
                                </p>

                            </div>
                            <i class="cursor-pointer fa fa-times" x-on:click="showModalDetail = false"></i>
                        </div>

                        <div class="my-4">
                            <p class="text-sm font-bold">Penebusan
                                {{ getTipePenebusan($penebusanToShow->jenispoin ? $penebusanToShow->jenispoin->type : '') }}
                                {{ $penebusanToShow->jenispoin ? $penebusanToShow->jenispoin->nama : '' }}
                            </p>
                            <p>
                                Poin
                                <x-badge-poin :category='$penebusanToShow->jenispoin ? $penebusanToShow->jenispoin->category : 3' />
                                : <b>{{ $penebusanToShow->jenispoin ? $penebusanToShow->jenispoin->poin : '' }}</b>
                            </p>
                        </div>

                        <p>
                            Deadline:
                            <b>{{ $penebusanToShow->deadline ? formatDateIso($penebusanToShow->deadline, 'dddd, Do MMMM H:mm') . ' WIB' : '' }}</b>
                        </p>
                        <p>
                            Ditugaskan Pada:
                            <b>{{ $penebusanToShow->taken_at ? formatDateIso($penebusanToShow->taken_at, 'dddd, Do MMMM H:mm') . ' WIB' : '' }}</b>
                        </p>
                        <p>
                            Dikumpulkan Pada:
                            <b>{{ $penebusanToShow->submited_at ? formatDateIso($penebusanToShow->submited_at, 'dddd, Do MMMM H:mm') . ' WIB' : '' }}</b>
                        </p>
                        <p>
                            Diterima Pada:
                            <b>{{ $penebusanToShow->accepted_at ? formatDateIso($penebusanToShow->accepted_at, 'dddd, Do MMMM H:mm') . ' WIB' : '' }}</b>
                        </p>
                        <p>
                            Diupdate Pada:
                            <b>{{ $penebusanToShow->updated_at ? formatDateIso($penebusanToShow->updated_at, 'dddd, Do MMMM H:mm') . ' WIB' : '' }}</b>
                        </p>
                        <p>
                            Dibuat Pada:
                            <b>{{ $penebusanToShow->created_at ? formatDateIso($penebusanToShow->created_at, 'dddd, Do MMMM H:mm') . ' WIB' : '' }}</b>
                        </p>

                        @if ($penebusanToShow->catatan)
                            <p>
                                Catatan Revisi:
                                <b>{{ $penebusanToShow->catatan }}</b>
                            </p>
                        @endif

                        @if ($penebusanToShow->link)
                            @can(PERMISSION_DOWNLOAD_PENEBUSAN)
                                <div class="mt-4">
                                    <x-button :tagA="true"
                                        download="{{ str_replace('penebusan/', '', $penebusanToShow->link) }}"
                                        href="{{ storage($penebusanToShow->link) }}"
                                        class="rounded-3xl bg-2025-1 hover:bg-coklat-hover my-0.5 mx-0.5">
                                        <i class="mr-1 fa fa-download fa-fw"></i>Periksa Tugas
                                    </x-button>
                                </div>
                            @endcan
                        @endif

                    </div>
                </x-modal>
            @endif
        </div>

        @can(PERMISSION_UPDATE_PENEBUSAN)
            @include('admin.tibum.penebusan.edit')
        @endcan

        @can(PERMISSION_DELETE_PENEBUSAN)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus Jenis Poin</h5>
                        </x-slot>
                        <div>
                            Apakah kamu yakin untuk menghapus penebusan <b x-text="jenispoinTitle"></b> yang dilakukan oleh
                            <b x-text="user_name"></b> ?
                        </div>
                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalDelete = false; $wire.destroy(penebusanId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan
    </div>
</div>
