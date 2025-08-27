<div>
    <x-card x-data="{ showModalDelete: false, 'timelineTitle': '', 'timelineId': '' }">
        <div class="flex items-center justify-between mb-3">
            <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Timeline PKKMB-PKBN 2024</h5>
            @can(PERMISSION_ADD_TIMELINE)
                @livewire('admin.informasi.timeline.add')
            @endcan
        </div>
        <x-input wire:model.debounce.200ms="search" type="text" placeholder="Cari timeline ..."
            class="block w-full mb-3 placeholder-gray-400" />

        <x-table :theads="['Judul', 'Waktu Mulai', 'Waktu Akhir', 'Lokasi', 'Aksi']" :breakpointVisibility="[
            3 => ['2xl' => 'hidden'], // Hide Lokasi on 2xl
            1 => ['lg' => 'hidden'], // Hide waktuMulai on lg
            2 => ['lg' => 'hidden'], // Hide waktuAkhir on lg
            4 => ['sm' => 'hidden'], // Hide aksi on sm
        ]">
            @forelse ($timeline as $t)
                <tr class="{{ $loop->even ? 'bg-gray-50' : '' }} border-b border-gray-200 hover:bg-blueGray-100"
                    x-data="{}"
                    x-on:click="if (window.innerWidth <=640) { $wire.emit('openDetailTimeline', {{ $t->id }})
                    }">
                    <td class="flex items-start justify-between px-6 py-3 sm:block">
                        <div class="w-52 sm:w-auto">
                            <span class="font-bold 2xl:font-semibold">{{ $t->title }}</span>
                            <dl>
                                <dd class="mt-1.5 text-xs italic sm:hidden">
                                    (Click For Detail)
                                </dd>
                                <dd class="mt-1.5 2xl:hidden">
                                    <i class="mr-1 fa-solid fa-location-dot"></i>{{ $t->location ?? '-' }}
                                </dd>
                                <dd class="mt-1.5 lg:hidden">
                                    <i class="mr-1 fa-solid fa-clock"></i>
                                    {{ formatDateIso($t->waktu_mulai, 'D MMMM YYYY') }}
                                    @if ($t->waktu_akhir)
                                        - {{ formatDateIso($t->waktu_akhir, 'D MMMM YYYY') }}
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="flex items-start ml-auto sm:hidden">
                            @can(PERMISSION_DELETE_GALLERY)
                                <x-button class="mx-0.5 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                    x-on:click.stop="showModalDelete = true; timelineTitle = '{{ $t->title }}'; timelineId = '{{ $t->id }}'">
                                    Delete
                                </x-button>
                            @endcan
                        </div>
                    </td>
                    <td class="hidden px-6 py-3 text-center lg:table-cell">
                        {{ formatDateIso($t->waktu_mulai, 'D MMMM YYYY') }}
                    </td>
                    <td class="hidden px-6 py-3 text-center lg:table-cell">
                        @if ($t->waktu_akhir)
                            {{ formatDateIso($t->waktu_akhir, 'D MMMM YYYY') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="hidden px-6 py-3 text-center 2xl:table-cell 2xl:w-60">
                        {{ $t->location ?? '-' }}
                    </td>
                    <td class="hidden px-6 py-3 text-center sm:table-cell">
                        <x-button wire:click="$emit('openDetailTimeline', {{ $t->id }})"
                            class="mx-0.5 rounded-3xl bg-coklat-2 hover:bg-coklat-hover">
                            Detail
                        </x-button>

                        @can(PERMISSION_DELETE_TIMELINE)
                            <x-button class="mx-0.5 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                x-on:click="showModalDelete = true; timelineTitle = '{{ $t->title }}'; timelineId = '{{ $t->id }}'">
                                Delete
                            </x-button>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                    <td colspan="4" class="px-6 py-3 italic text-center text-md">Belum ada timeline</td>
                </tr>
            @endforelse

        </x-table>

        {{ $timeline->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}

        @can(PERMISSION_DELETE_TIMELINE)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus Timeline</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus timeline <b x-text="timelineTitle"></b>?
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalDelete = false; $wire.hapus(timelineId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan
    </x-card>
</div>
