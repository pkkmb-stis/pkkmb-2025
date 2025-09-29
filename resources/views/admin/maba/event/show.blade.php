<div>
    <div x-data="{ openedit: @entangle('openedit'), showModalDelete: false, eventTitle: '', eventId: '' }">
        <x-card class="mb-8">
            <div class="flex items-center justify-between mb-3">
                <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Acara</h5>
                <div class="flex">
                    @livewire('admin.maba.event.export-presensi')
                    @can(PERMISSION_ADD_EVENT)
                        @livewire('admin.maba.event.add')
                    @endcan
                </div>
            </div>
            <x-input wire:model.debounce.200ms="search" type="text" placeholder="Cari Berdasarkan Nama Acara"
                class="block w-full mb-3 placeholder-gray-400" />
            <div class="hidden sm:block">
                <x-table :theads="['Acara', 'Waktu Mulai Absen', 'Waktu Akhir Absen', 'Aksi']" class="mb-3" :breakpointVisibility="[
                    1 => ['xl' => 'hidden'], // Hide waktu mulai on xl
                    2 => ['xl' => 'hidden'], // Hide waktu akhir on xl
                ]">
                    <slot>
                        @forelse ($event as $row)
                            <tr
                                class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                <td class="px-6 py-3">
                                    <dl>
                                        <dd class="font-bold xl:font-medium">{{ $row->title }}</dd>
                                        <dd class="mt-1 text-xs xl:hidden">
                                            Waktu Mulai Absen: {{ formatDateIso($row->waktu_mulai) }}
                                        </dd>
                                        <dd class="mt-1 text-xs xl:hidden">
                                            Waktu Akhir Absen: {{ formatDateIso($row->waktu_akhir) }}
                                        </dd>
                                    </dl>

                                </td>

                                <td class="hidden px-6 py-3 text-center xl:table-cell">
                                    {{ formatDateIso($row->waktu_mulai) }}
                                </td>

                                <td class="hidden px-6 py-3 text-center xl:table-cell">
                                    {{ formatDateIso($row->waktu_akhir) }}
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <x-button class="rounded-3xl bg-2025-1 hover:bg-coklat-hover mx-0.5"
                                        :tagA="true" href="{{ route('absensi.detail', ['id' => $row->id]) }}">
                                        Detail
                                    </x-button>

                                    @can(PERMISSION_UPDATE_EVENT)
                                        <x-button
                                            class="rounded-3xl bg-2025-2 hover:bg-2025-1 px-5 mx-0.5"
                                            wire:click='edit({{ $row->id }})'>
                                            Edit
                                        </x-button>
                                    @endcan

                                    @can(PERMISSION_DELETE_EVENT)
                                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                            x-on:click="showModalDelete = true; eventTitle = '{{ $row->title }}'; eventId = '{{ $row->id }}'">
                                            Delete
                                        </x-button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                                <td colspan="4" class="px-6 py-3 italic text-center text-md">Tidak ada acara</td>
                            </tr>
                        @endforelse

                    </slot>
                </x-table>
            </div>
            {{-- Versi Mobile --}}
            <div class="grid grid-cols-1 gap-4 sm:hidden">
                @forelse ($event as $row)
                    <x-card class="flex flex-col items-start justify-between p-4 space-y-2 font-sans"
                        x-on:click="window.location.href='{{ route('absensi.detail', ['id' => $row->id]) }}'">
                        <div class="flex items-center justify-between w-full item-s">
                            <span class="font-bold text-base-blue-400">
                                {{ $row->title }}
                            </span>
                            @can(PERMISSION_DELETE_EVENT)
                                <x-button class="bg-merah-700 hover:bg-merah-hover rounded-3xl"
                                    x-on:click.stop="showModalDelete = true; eventTitle = '{{ addslashes($row->title) }}'; eventId = '{{ $row->id }}'">
                                    Delete
                                </x-button>
                            @endcan
                        </div>
                        <div class="text-xs italic font-semibold leading-tight text-base-blue-400 sm:hidden">
                            (Click For Detail)
                        </div>
                        <div class="mt-1 text-sm font-semibold text-base-blue-400">
                            <span class="font-bold">Waktu Mulai Absen: </span>{{ formatDateIso($row->waktu_mulai) }}
                        </div>
                        <div class="mt-1 text-sm font-semibold text-base-blue-400">
                            <span class="font-bold">Waktu Akhir Absen: </span>{{ formatDateIso($row->waktu_akhir) }}
                        </div>
                        <div class="flex self-stretch justify-between space-x-2">
                            @can(PERMISSION_UPDATE_EVENT)
                                <x-button
                                    class="rounded-3xl flex-grow  bg-2025-2 hover:bg-2025-1 px-5 mx-0.5"
                                    wire:click.stop='edit({{ $row->id }})'>
                                    Edit
                                </x-button>
                            @endcan
                        </div>
                    </x-card>
                @empty
                    <div class="col-span-1 italic text-center text-gray-500 sm:col-span-2">Tidak ada acara</div>
                @endforelse
            </div>
            <div class="mt-3">
                {{ $event->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
            </div>
        </x-card>

        @can(PERMISSION_DELETE_EVENT)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus acara</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus <b x-text="eventTitle"></b>? Semua data absensinya akan hilang
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hove" :tagA="false"
                                x-on:click="showModalDelete = false; $wire.hapus(eventId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan

        @can(PERMISSION_UPDATE_EVENT)
            @include('admin.maba.event.edit')
        @endcan
    </div>
</div>
