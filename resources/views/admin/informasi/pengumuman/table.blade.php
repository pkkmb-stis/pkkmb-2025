<div>
    <div x-data="{ openedit: @entangle('openedit'), showModalDelete: false, pengumumanTitle: '', pengumumanId: '', showModalDetail: @entangle('showModalDetail'), detail: '' }">
        <x-card class="mb-8">
            <div class="flex items-center justify-between mb-3">
                <h5 class="text-gray-700 text-xlfont-normal font-bohemianSoul">Daftar Pengumuman</h5>
                @can(PERMISSION_ADD_PENGUMUMAN)
                    @livewire('admin.informasi.pengumuman.add')
                @endcan
            </div>
            <div class="mb-3">
                <x-select-form wire:model.lazy="isPublished" id="isPublished">
                    <option value="-1">Semua Pengumuman</option>
                    <option value="0">Belum Publish</option>
                    <option value="1">Publish</option>
                </x-select-form>
            </div>

            <x-jet-input wire:model.debounce.200ms="search" type="text" placeholder="Cari pengumuman ..."
                class="block w-full mb-3 placeholder-gray-400" />

            <div class="hidden sm:block">
                <x-table :theads="['Judul', 'Tanggal Publish', 'status', 'aksi']" :breakpointVisibility="[
                    1 => ['xl' => 'hidden'], // Hide tglPublish on xl
                    2 => ['lg' => 'hidden'], // Hide status on lg
                    3 => ['sm' => 'hidden'], // Hide aksi on sm
                ]">
                    <slot>
                        @forelse ($pengumuman as $p)
                            <tr
                                class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                <td class="px-6 py-3">
                                    {{ $p->title }}
                                    <dl>
                                        <dd class="mt-1.5 lg:hidden">
                                            <x-status-publish status="{{ isPublished($p->publish_datetime) }}" /> <span
                                                class="text-xs italic sm:hidden">
                                                (Click For Detail)
                                            </span>
                                        </dd>
                                        <dd class="mt-1.5 text-xs italic xl:hidden">
                                            Dipublish pada {{ formatDateIso($p->publish_datetime) }}
                                        </dd>
                                    </dl>
                                </td>

                                <td class="hidden px-6 py-3 text-center xl:table-cell">
                                    {{ formatDateIso($p->publish_datetime) }}
                                </td>

                                <td class="hidden px-6 py-3 text-center lg:table-cell">
                                    <x-status-publish status="{{ isPublished($p->publish_datetime) }}" />
                                </td>
                                <td class="hidden px-6 py-3 text-center sm:table-cell">
                                    <x-button wire:click="show({{ $p->id }})"
                                        class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover mx-0.5">
                                        Detail
                                    </x-button>

                                    @can(PERMISSION_UPDATE_PENGUMUMAN)
                                        <x-button
                                            class="rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 px-5 mx-0.5"
                                            wire:click='edit({{ $p->id }})'>
                                            Edit
                                        </x-button>
                                    @endcan

                                    @can(PERMISSION_DELETE_PENGUMUMAN)
                                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                            x-on:click="showModalDelete = true; pengumumanTitle = '{{ $p->title }}'; pengumumanId = '{{ $p->id }}'">
                                            Delete
                                        </x-button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                                <td colspan="4" class="px-6 py-3 italic text-center text-md">Tidak ada pengumuman
                                </td>
                            </tr>
                        @endforelse

                    </slot>
                </x-table>
            </div>

            {{-- Versi Mobile --}}
            <div class="grid grid-cols-1 gap-4 sm:hidden">
                @forelse ($pengumuman as $p)
                    <x-card class="flex flex-col items-start justify-between p-4 space-y-3 font-sans"
                        wire:click="show({{ $p->id }})">
                        <div class="flex items-start justify-between w-full">
                            <div class="font-bold text-base-blue-400 ml-0.5">
                                {{ $p->title }}
                            </div>
                            @can(PERMISSION_DELETE_PENGUMUMAN)
                                <x-button
                                    x-on:click.stop="showModalDelete = true; pengumumanTitle = '{{ $p->title }}'; pengumumanId = '{{ $p->id }}'"
                                    class="bg-merah-700 hover:bg-merah-hover rounded-3xl">Delete</x-button>
                            @endcan
                        </div>
                        <div class="w-full font-sans">

                            <dl class="mt-0.5 text-sm text-base-blue-400">
                                <dd class="inline font-medium">
                                    <x-status-publish status="{{ isPublished($p->publish_datetime) }}" /><span
                                        class="text-xs italic text-base-blue-400 sm:hidden">
                                        (Click For Detail)
                                    </span>
                                </dd>
                            </dl>
                            <dl class="mt-2 ml-0.5 text-sm text-base-blue-400">
                                <dd class="inline italic font-medium">Dipublish
                                    pada {{ formatDateIso($p->publish_datetime) }}</dd>
                            </dl>
                            <div class="flex w-full mt-3 space-x-2">
                                @can(PERMISSION_UPDATE_PENGUMUMAN)
                                    <x-button wire:click.stop="edit({{ $p->id }})"
                                        class="w-full bg-base-orange-500 hover:bg-base-orange-600 rounded-3xl">
                                        Edit
                                    </x-button>
                                @endcan
                            </div>
                        </div>
                    </x-card>
                    <x-button x-ref="detailButton" wire:click="show({{ $p->id }})" class="hidden"></x-button>
                @empty
                    <div class="col-span-1 italic text-center text-gray-500 sm:col-span-2">
                        Tidak ada pengumuman
                    </div>
                @endforelse
            </div>

            <div class="mt-3">
                {{ $pengumuman->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
            </div>
        </x-card>

        <div x-cloak x-show="showModalDetail">
            @if ($pengumumanToShow)
                <x-modal>
                    <div class="p-5 bg-white" x-effect="$refs.detail.innerHTML = '{{ $pengumumanToShow->content }}'">
                        <div class="flex items-center justify-between mb-3">
                            <div class="mr-3">
                                <p class="text-lg font-bold">{{ $pengumumanToShow->title }}</p>
                                <small class="italic text-grat-600">
                                    Dipublish pada
                                    {{ formatDateIso($pengumumanToShow->publish_datetime) }}
                                </small>
                            </div>
                            <i class="cursor-pointer fa fa-times" x-on:click="showModalDetail = false"></i>
                        </div>
                        <p x-ref="detail" class="ql-editor height"></p>
                        @if($pengumumanToShow->image != null)
                            <div class="flex justify-center mt-4">
                                <div class="max-w-full overflow-hidden">
                                    <img src="{{ asset('storage/images/upload-pengumuman/' . $pengumumanToShow->image) }}"
                                alt="image" class="w-64 h-auto my-2">
                                </div>
                            </div>
                        @endif
                    </div>
                </x-modal>
            @endif
        </div>

        @can(PERMISSION_UPDATE_PENGUMUMAN)
            @include('admin.informasi.pengumuman.edit')
        @endcan

        @can(PERMISSION_DELETE_PENGUMUMAN)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus Pengumuman</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus <b x-text="pengumumanTitle"></b>?
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalDelete = false; $wire.destroy(pengumumanId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan
    </div>

    @push('css')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <style>
            .height {
                min-height: 0 !important;
            }

            .ql-editor {
                min-height: 200px;
            }
        </style>
    @endpush

    @push('script-bottom')
        <!-- Include the Quill library -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    @endpush
</div>
