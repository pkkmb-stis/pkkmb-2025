<div>
    <x-card x-data="{ showModalDelete: false, 'formulirName': '', 'formulirId': '' }">
        <div class="flex items-center justify-between mb-3">
            <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Formulir</h5>
            @can(PERMISSION_ADD_FORMULIR)
                @livewire('admin.informasi.formulir.add')
            @endcan
        </div>
        <x-input wire:model.live.debounce.200ms="search" type="text" placeholder="Cari formulir ..."
            class="block w-full mb-3 placeholder-gray-400" />

        <x-table :theads="['Nama Formulir', 'Spreadsheet ID', 'Nama Sheet', 'Aksi']" :breakpointVisibility="[
            1 => ['xl' => 'hidden'], // Hide spreadsheet_id on xl
            2 => ['lg' => 'hidden'], // Hide nama sheet on lg
            3 => ['md' => 'hidden'], // Hide aksi on md
        ]">
            @forelse ($formulirs as $formulir)
                <tr class="{{ $loop->even ? 'bg-gray-50' : '' }} border-b border-gray-200 hover:bg-blueGray-100"
                    x-data="{}"
                    x-on:click="if (window.innerWidth <=640) { window.location.href='{{ route('formulir.detail', ['id' => $formulir->id]) }}'
                    }">
                    <td class="flex items-start justify-between w-[85vw] px-6 py-3 md:block md:w-80">
                        <div>
                            <span class="font-bold xl:font-semibold">{{ $formulir->nama_formulir }}</span>
                            <dl>
                                <dd class="mt-1.5 text-xs italic sm:hidden">
                                    (Click For Detail)
                                </dd>
                                <dd class="mt-1.5 w-48 xl:hidden truncate">
                                    {{ $formulir->spreadsheet_id }}
                                </dd>
                                <dd class="mt-1.5 lg:hidden">
                                    {{ $formulir->nama_sheet }}
                                </dd>
                            </dl>
                        </div>
                        <div class="flex items-start ml-auto md:hidden">
                            <x-button class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover mx-0.5 hidden sm:block"
                                :tagA="true" href="{{ route('formulir.detail', ['id' => $formulir->id]) }}">
                                Detail
                            </x-button>
                            @can(PERMISSION_UPDATE_FORMULIR)
                                <x-button wire:click.stop="$dispatch('openDetailFormulir', {{ $formulir->id }})"
                                    class="mx-0.5 px-5 rounded-3xl bg-base-orange-500 hover:bg-base-orange-600">
                                    Edit
                                </x-button>
                            @endcan
                            @can(PERMISSION_DELETE_FORMULIR)
                                <x-button class="mx-0.5 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                    x-on:click.stop="showModalDelete = true; formulirName = '{{ $formulir->nama_formulir }}'; formulirId = '{{ $formulir->id }}'">
                                    Delete
                                </x-button>
                            @endcan
                        </div>
                    </td>
                    <td class="hidden px-6 py-3 w-96 xl:table-cell">
                        {{ $formulir->spreadsheet_id }}
                    </td>
                    <td class="hidden px-6 py-3 text-center lg:table-cell">
                        {{ $formulir->nama_sheet }}
                    </td>
                    <td class="hidden px-6 py-3 text-center md:table-cell">
                        <x-button class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover mx-0.5" :tagA="true"
                            href="{{ route('formulir.detail', ['id' => $formulir->id]) }}">
                            Detail
                        </x-button>
                        @can(PERMISSION_UPDATE_FORMULIR)
                            <x-button wire:click.stop="$dispatch('openDetailFormulir', {{ $formulir->id }})"
                                class="mx-0.5 rounded-3xl px-5 bg-base-orange-500 hover:bg-base-orange-600">
                                Edit
                            </x-button>
                        @endcan

                        @can(PERMISSION_DELETE_FORMULIR)
                            <x-button class="mx-0.5 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                x-on:click="showModalDelete = true; formulirName = '{{ $formulir->nama_formulir }}'; formulirId = '{{ $formulir->id }}'">
                                Delete
                            </x-button>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                    <td colspan="4" class="px-6 py-3 italic text-center text-md">Belum ada Formulir</td>
                </tr>
            @endforelse
        </x-table>

        {{ $formulirs->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}

        @can(PERMISSION_DELETE_FORMULIR)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus Formulir</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus Formulir <b x-text="formulirName"></b>?
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalDelete = false; $wire.hapus(formulirId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan
    </x-card>
</div>
