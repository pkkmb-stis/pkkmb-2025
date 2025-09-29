<div>
    <x-card x-data="{ modalRemove: false, kelompokNama: '', kelompokId: '' }">
        <div class="flex items-center justify-between mb-3">
            <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Kelompok</h5>
            @can(PERMISSION_ADD_KELOMPOK)
                @livewire('admin.lapk.kelompok.add')
            @endcan
        </div>
        <x-input wire:model.debounce.200ms="search" type="text" placeholder="Cari nama kelompok/pendamping..."
            class="block w-full mb-3 placeholder-gray-400" />
        <x-table :theads="['nama kelompok', 'pendamping', 'jumlah anggota', 'aksi']" :breakpointVisibility="[
            1 => ['lg' => 'hidden'], // Hide pendamping on lg
            2 => ['sm' => 'hidden'], // Hide jumlahAnggota on sm
            3 => ['sm' => 'hidden'], // Hide aksi on sm
        ]">
            <slot>
                @forelse ($kelompok as $k)
                    <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}"
                        @click="if (window.innerWidth <= 640) window.location='{{ route('lapk.kelompok.detail', ['id' => $k->id]) }}'">
                        <td class="flex items-start justify-between px-6 py-3 sm:block">
                            <div>
                                {{ $k->nama }}
                                <dl class="lg:hidden">
                                    <dd class="mt-0.5 text-xs font-bold italic sm:hidden">
                                        (Click For Detail)
                                    </dd>
                                    <dd class="my-1.5"><a
                                            href="{{ route('user.detail', ['id' => $k->pendamping->id]) }}"
                                            class="underline hover:text-base-brown-500">
                                            {{ $k->pendamping->name }}
                                        </a>
                                    </dd>
                                    <dd class="sm:hidden">
                                        <span class="font-bold">Jumlah Anggota: </span>{{ $k->anggota_count }}
                                    </dd>
                                </dl>
                            </div>
                            <div class="flex items-start ml-auto sm:hidden">
                                @can(PERMISSION_DELETE_KELOMPOK)
                                    <x-button class="ml-2 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                        x-on:click.stop="modalRemove = true; kelompokNama = '{{ $k->nama }}'; kelompokId = '{{ $k->id }}'">
                                        Hapus
                                    </x-button>
                                @endcan
                            </div>
                        </td>
                        <td class="hidden px-6 py-3 lg:table-cell">
                            <a href="{{ route('user.detail', ['id' => $k->pendamping->id]) }}"
                                class="underline hover:text-base-brown-500">
                                {{ $k->pendamping->name }}
                            </a>
                        </td>
                        <td class="hidden px-6 py-3 text-center sm:table-cell">{{ $k->anggota_count }}</td>
                        <td class="hidden px-6 py-3 text-center sm:table-cell">
                            <x-button class="rounded-3xl bg-2025-1 hover:bg-coklat-hover" :tagA="true"
                                href="{{ route('lapk.kelompok.detail', ['id' => $k->id]) }}">
                                Detail
                            </x-button>

                            @can(PERMISSION_DELETE_KELOMPOK)
                                <x-button class="ml-2 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                    x-on:click="modalRemove = true; kelompokNama = '{{ $k->nama }}'; kelompokId = '{{ $k->id }}'">
                                    Hapus
                                </x-button>
                            @endcan
                        </td>

                    </tr>
                @empty
                    <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                        <td colspan="4" class="px-6 py-3 text-sm italic text-center">Tidak ada kelompok</td>
                    </tr>
                @endforelse

            </slot>
        </x-table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $kelompok->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
        </div>
        @can(PERMISSION_DELETE_KELOMPOK)
            <div x-cloak x-show="modalRemove">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus Anggota</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus kelompok <b x-text="kelompokNama"></b>? Semua anggota tidak
                            akan memiliki kelompok lagi
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="modalRemove = false">
                                Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                x-on:click="modalRemove = false; $wire.removeKelompok(kelompokId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan

    </x-card>
</div>
