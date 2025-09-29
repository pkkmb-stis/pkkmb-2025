<div>
    <div x-data="{ openedit: @entangle('openedit'), showModalDelete: false, laporanKegiatanTitle: '', laporanKegiatanId: '', showModalDetail: @entangle('showModalDetail') }">
        <x-card class="mb-8">
            <div class="flex items-center justify-between mb-3">
                <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Laporan Kegiatan PKKMB</h5>
                @can(PERMISSION_ADD_LAPORAN_KEGIATAN)
                    @livewire('admin.pengawas.add')
                @endcan
            </div>
            <div class="mb-3">
                <x-select-form wire:model.lazy="isPublished" id="isPublished">
                    <option value="-1">Semua Laporan Kegiatan</option>
                    <option value="0">Belum Publish</option>
                    <option value="1">Publish</option>
                </x-select-form>
            </div>
            <x-input wire:model.debounce.200ms="search" type="text"
                placeholder="Cari berdasarkan judul laporan ..." class="block w-full mb-3 placeholder-gray-400" />

            <div class="hidden sm:block">
                <x-table :theads="['Judul', 'Tanggal Publish', 'Status', 'aksi']" :breakpointVisibility="[
                    1 => ['xl' => 'hidden'], // Hide tanggalPublish on xl
                    2 => ['lg' => 'hidden'], // Hide status on lg
                ]">
                    <slot>
                        @forelse ($laporanKegiatan as $row)
                            <tr
                                class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                <td class="px-6 py-3">
                                    {{ $row->title }}
                                    <dl>
                                        <dd class="mt-1.5 text-xs lg:hidden">
                                            <x-status-publish status="{{ isPublished($row->publish_datetime) }}" />
                                        </dd>
                                        <dd class="mt-1.5 text-xs italic xl:hidden">
                                            Dipublish pada
                                            {{ $row->publish_datetime->isoFormat('dddd, D MMMM YYYY HH:mm') }}
                                        </dd>
                                    </dl>
                                </td>

                                <td class="hidden px-6 py-3 text-center xl:table-cell">
                                    {{ $row->publish_datetime->isoFormat('dddd, D MMMM YYYY HH:mm') }}
                                </td>

                                <td class="hidden px-6 py-3 text-center lg:table-cell">
                                    <x-status-publish status="{{ isPublished($row->publish_datetime) }}" />
                                </td>


                                <td class="px-6 py-3 text-center">
                                    @can(PERMISSION_UPDATE_LAPORAN_KEGIATAN)
                                        <x-button class="rounded-3xl bg-2025-1 hover:bg-coklat-hover mx-0.5"
                                            :tagA="true" href="{{ $row->link }}" target="_blank">
                                            Preview
                                        </x-button>
                                        <x-button
                                            class="px-5 rounded-3xl bg-2025-2 hover:bg-2025-1 mx-0.5"
                                            wire:click='edit({{ $row->id }})'>
                                            Edit
                                        </x-button>
                                    @endcan
                                    @can(PERMISSION_DELETE_LAPORAN_KEGIATAN)
                                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                            x-on:click="showModalDelete = true; laporanKegiatanTitle = '{{ $row->title }}'; laporanKegiatanId = '{{ $row->id }}'">
                                            Delete
                                        </x-button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                                <td colspan="4" class="px-6 py-3 italic text-center text-md">Tidak ada laporan</td>
                            </tr>
                        @endforelse

                    </slot>
                </x-table>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:hidden">
                @forelse ($laporanKegiatan as $row)
                    <x-card class="flex flex-col items-start justify-between p-4 space-y-3 font-sans clickable-card"
                        data-id="{{ $row->id }}">
                        <div class="flex items-start justify-between w-full">
                            <div class="font-bold text-base-blue-400 ml-0.5">
                                {{ $row->title }}
                            </div>
                            @can(PERMISSION_DELETE_MATERI)
                                <x-button
                                    x-on:click="showModalDelete = true; laporanKegiatanTitle = '{{ $row->title }}'; laporanKegiatanId = '{{ $row->id }}'"
                                    class="bg-merah-700 hover:bg-merah-hover rounded-3xl">Delete</x-button>
                            @endcan
                        </div>
                        <div class="w-full mt-1 font-sans">
                            <dl class="mt-2 text-sm text-base-blue-400">
                                <dt class="inline font-bold">Status:</dt>
                                <dd class="inline font-medium">
                                    <x-status-publish status="{{ isPublished($row->publish_datetime) }}" />
                                </dd>
                            </dl>
                            <dl class="mt-2 text-sm italic font-medium text-base-blue-400">
                                Dipublish pada {{ $row->publish_datetime->isoFormat('dddd, D MMMM YYYY HH:mm') }}
                            </dl>
                            <div class="flex justify-end mt-3 space-x-2">
                                @can(PERMISSION_UPDATE_MATERI)
                                    <x-button class="text-center bg-2025-1 hover:bg-coklat-hover rounded-3xl"
                                        :tagA="true" href="{{ $row->link }}" target="_blank">
                                        Preview
                                    </x-button>
                                    <x-button class="text-center bg-2025-2 hover:bg-2025-1 rounded-3xl"
                                        wire:click='edit({{ $row->id }})'>
                                        Edit
                                    </x-button>
                                @endcan
                            </div>
                        </div>
                    </x-card>
                @empty
                    <div class="col-span-1 italic text-center text-gray-500 sm:col-span-2">
                        Tidak ada laporan
                    </div>
                @endforelse
            </div>

            <div class="mt-3">
                {{ $laporanKegiatan->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}

            </div>
        </x-card>

        @can(PERMISSION_DELETE_LAPORAN_KEGIATAN)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus laporan</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus <b x-text="laporanKegiatanTitle"></b>?
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalDelete = false; $wire.hapus(laporanKegiatanId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan

        @can(PERMISSION_UPDATE_LAPORAN_KEGIATAN)
            @include('admin.pengawas.edit')
        @endcan
    </div>
</div>
