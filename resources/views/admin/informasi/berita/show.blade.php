<div>
    <div x-data="{ showModalDelete: false, beritaTitle: '', beritaId: '' }">
        <x-card class="mb-8">
            <div class="flex items-center justify-between mb-3">
                <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Berita</h5>
                @can(PERMISSION_ADD_BERITA)
                    <x-button class="uppercase rounded-full opacity-100 bg-coklat-1 hover:bg-base-brown-600"
                        :tagA="true" href="{{ route('berita.add') }}">
                        Tambah Berita
                    </x-button>
                @endcan
            </div>
            <div class="mb-3">
                <x-select-form wire:model.blur="isPublished" id="isPublished">
                    <option value="-1">Semua Materi</option>
                    <option value="0">Belum Publish</option>
                    <option value="1">Publish</option>
                </x-select-form>
            </div>

            <x-input wire:model.live.debounce.200ms="search" type="text"
                placeholder="Cari Berdasarkan Judul atau Penulis" class="block w-full mb-3 placeholder-gray-400" />

            <div class="hidden sm:block">
                <x-table :theads="['judul', 'penulis', 'status', 'tanggal publish', 'aksi']" :breakpointVisibility="[
                    3 => ['xl' => 'hidden'], // Hide tanggalPublish on xl
                    1 => ['lg' => 'hidden'], // Hide penulis on lg
                ]">
                    <slot>
                        @forelse ($berita as $row)
                            <tr
                                class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                <td class="px-6 py-3">
                                    {{ $row->judul }}
                                    <dl>
                                        <dd class="mt-1.5 text-xs lg:hidden">
                                            <span class="font-bold">{{ $row->published_by }}</span>
                                        </dd>
                                        <dd class="mt-1.5 text-xs italic xl:hidden">
                                            Dipublish pada {{ formatDateIso($row->published_datetime) }}
                                        </dd>
                                    </dl>
                                </td>
                                <td class="hidden px-6 py-3 text-center lg:table-cell">{{ $row->published_by }}</td>

                                <td class="px-6 py-3 text-center">
                                    <x-status-publish status="{{ isPublished($row->published_datetime) }}" />
                                </td>
                                <td class="hidden px-6 py-3 text-center xl:table-cell">
                                    {{ formatDateIso($row->published_datetime) }}
                                </td>
                                <td class="px-6 py-3 text-center">

                                    @can(PERMISSION_UPDATE_BERITA)
                                        <x-button class="px-5 mr-1 rounded-3xl bg-base-orange-500 hover:bg-base-orange-600"
                                            :tagA="true" href="{{ route('berita.edit', ['id' => $row->id]) }}">
                                            Edit
                                        </x-button>
                                    @endcan

                                    @can(PERMISSION_DELETE_BERITA)
                                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                            x-on:click="showModalDelete = true; beritaTitle ='{{ $row->judul }}'; beritaId = '{{ $row->id }}'">
                                            Delete
                                        </x-button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                                <td colspan="5" class="px-6 py-3 italic text-center text-md">Tidak Ada Berita</td>
                            </tr>
                        @endforelse

                    </slot>
                </x-table>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:hidden">
                @forelse ($berita as $row)
                    <x-card class="flex flex-col items-start justify-between p-4 space-y-3 font-sans clickable-card"
                        data-id="{{ $row->id }}">
                        <div class="flex items-start justify-between w-full">
                            <div class="font-bold text-base-blue-400 ml-0.5">
                                {{ $row->judul }}
                            </div>
                            @can(PERMISSION_DELETE_BERITA)
                                <x-button
                                    x-on:click="showModalDelete = true; beritaTitle ='{{ $row->judul }}'; beritaId = '{{ $row->id }}'"
                                    class="bg-merah-700 hover:bg-merah-hover rounded-3xl">Delete</x-button>
                            @endcan
                        </div>
                        <div class="w-full mt-1 font-sans">
                            <dl class="mt-2 text-sm text-base-blue-400">
                                <dt class="inline font-bold">Penulis:</dt>
                                <dd class="inline font-medium">{{ $row->published_by }}</dd>
                            </dl>
                            <dl class="mt-2 text-sm text-base-blue-400">
                                <dt class="inline font-bold">Status:</dt>
                                <dd class="inline font-medium">
                                    <x-status-publish status="{{ isPublished($row->published_datetime) }}" />
                                </dd>
                            </dl>
                            <dl class="mt-2 text-sm italic font-medium text-base-blue-400">
                                Dipublish pada {{ formatDateIso($row->published_datetime) }}
                            </dl>
                            @can(PERMISSION_UPDATE_BERITA)
                                <x-button
                                    class="w-full mt-3 text-center bg-base-orange-500 hover:bg-base-orange-600 rounded-3xl"
                                    :tagA="true" href="{{ route('berita.edit', ['id' => $row->id]) }}">
                                    Edit
                                </x-button>
                            @endcan
                        </div>
                    </x-card>
                @empty
                    <div class="col-span-1 italic text-center text-gray-500 sm:col-span-2">
                        Tidak ada berita
                    </div>
                @endforelse
            </div>


            <div class="mt-3">
                {{ $berita->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
            </div>
        </x-card>

        @can(PERMISSION_DELETE_BERITA)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus Berita Harian</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus <b x-text="beritaTitle"></b>?
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalDelete = false; $wire.hapus(beritaId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan

    </div>
</div>
