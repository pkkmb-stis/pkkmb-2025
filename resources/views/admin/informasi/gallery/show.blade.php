<div>
    <x-card x-data="{ showModalDelete: false, 'galleryTitle': '', 'galleryId': '' }">
        <div class="flex items-center justify-between mb-3">
            <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Foto dan Video</h5>
            @can(PERMISSION_ADD_GALLERY)
                @livewire('admin.informasi.gallery.add')
            @endcan
        </div>
        <div class="grid mb-3 lg:grid-cols-2 lg:gap-6 gap-y-3">
            <x-select-form wire:model.lazy="category">
                <option value="{{ CATEGORY_GALLERY_FOTO }}">{{ getCategoryGallery(CATEGORY_GALLERY_FOTO) }}</option>
                <option value="{{ CATEGORY_GALLERY_VIDEO }}">{{ getCategoryGallery(CATEGORY_GALLERY_VIDEO) }}</option>
            </x-select-form>

            <x-select-form wire:model.lazy="inHome">
                <option value="0">Semuanya</option>
                <option value="1">Tampil di Home</option>
            </x-select-form>
        </div>

        @php
            $placeholder =
                $category == CATEGORY_GALLERY_FOTO ? 'Cari berdasarkan judul, event...' : 'Cari berdasarkan judul...';
            $theads = ['Judul'];
            $breakpointVisibility = [];

            if ($category == CATEGORY_GALLERY_FOTO) {
                $theads[] = 'Event';
                $breakpointVisibility = [
                    2 => ['xl' => 'hidden'], // Hide Tanggal Upload on xl
                    1 => ['lg' => 'hidden'], // Hide Event on lg
                    3 => ['sm' => 'hidden'], // Hide Aksi on sm
                ];
            } else {
                $breakpointVisibility = [
                    1 => ['xl' => 'hidden'], // Hide Tanggal Upload on xl
                    2 => ['sm' => 'hidden'], // Hide Aksi on sm
                ];
            }

            $theads[] = 'Tanggal Upload';
            $theads[] = 'Aksi';
        @endphp

        <x-input wire:model.debounce.200ms="title" type="text" placeholder="{{ $placeholder }}"
            class="block w-full mb-3 placeholder-gray-400" />

        <x-table :theads="$theads" :breakpointVisibility="$breakpointVisibility">
            <slot>
                @forelse ($gallery as $g)
                    <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}"
                        x-data="{}"
                        x-on:click="if (window.innerWidth <=640) { $wire.emit('openDetailGallery', {{ $g->id }})
                        }">
                        <td class="flex items-start justify-between px-6 py-3 sm:block">
                            <div class="w-48 sm:w-auto">
                                <span class="font-bold xl:font-semibold">{{ $g->title }}</span>
                                <dl>
                                    <dd class="mt-1.5 text-xs italic sm:hidden">
                                        (Click For Detail)
                                    </dd>
                                    @if ($category == CATEGORY_GALLERY_FOTO)
                                        <dd class="mt-1.5 text-xs lg:hidden">
                                            <span
                                                class="font-bold">{{ $g->event ? $g->event->title : 'Tidak ada event' }}</span>
                                        </dd>
                                        <dd class="mt-1.5 text-xs italic lg:hidden">
                                            Diupload pada {{ formatDateIso($g->created_at) }}
                                        </dd>
                                    @else
                                        <dd class="mt-1.5 text-xs italic xl:hidden">
                                            Diupload pada {{ formatDateIso($g->created_at) }}
                                        </dd>
                                    @endif
                                </dl>
                            </div>
                            <div class="flex items-start ml-auto sm:hidden">
                                @can(PERMISSION_DELETE_GALLERY)
                                    <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                        x-on:click.stop="showModalDelete = true; galleryTitle = '{{ $g->title }}'; galleryId = '{{ $g->id }}'">
                                        Delete
                                    </x-button>
                                @endcan
                            </div>
                        </td>

                        <!-- Kondisi untuk menampilkan kolom Event hanya jika kategori adalah Foto -->
                        @if ($category == CATEGORY_GALLERY_FOTO)
                            <td class="hidden px-6 py-3 lg:table-cell">
                                {{ $g->event ? $g->event->title : 'Tidak ada event' }}
                                <dl>
                                    <dd class="mt-1.5 text-xs italic xl:hidden">
                                        Diupload pada {{ formatDateIso($g->created_at) }}
                                    </dd>
                                </dl>
                            </td>
                        @endif

                        <td class="hidden px-6 py-3 text-center xl:table-cell">
                            {{ formatDateIso($g->created_at) }}
                        </td>
                        <td class="hidden px-6 py-3 text-center sm:table-cell">
                            <x-button wire:click="$emit('openDetailGallery', {{ $g->id }})"
                                class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover mx-0.5">
                                Detail
                            </x-button>

                            @can(PERMISSION_DELETE_GALLERY)
                                <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                    x-on:click="showModalDelete = true; galleryTitle = '{{ $g->title }}'; galleryId = '{{ $g->id }}'">
                                    Delete
                                </x-button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                        <td colspan="{{ $category == CATEGORY_GALLERY_FOTO ? 4 : 3 }}"
                            class="px-6 py-3 italic text-center text-md">Belum ada {{ $tipe }}</td>
                    </tr>
                @endforelse
            </slot>
        </x-table>

        {{ $gallery->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}

        @can(PERMISSION_DELETE_GALLERY)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus <span class="capitalize">{{ $tipe }}</span></h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus {{ $tipe }} <b x-text="galleryTitle"></b>?
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalDelete = false; $wire.hapus(galleryId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan

    </x-card>
</div>
