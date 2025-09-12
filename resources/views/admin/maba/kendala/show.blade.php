<div x-data="{ modalRemove: false, 'nama': '', kendalaId: '' }">
    <x-card>
        <div class="flex justify-between">
            <h5 class="mb-3 text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Pengaduan</h5>
            @livewire('admin.maba.kendala.export-kendala')
        </div>
        <div class="grid mb-3 lg:grid-cols-2 lg:gap-6 gap-y-3">
            <x-select-form wire:model.blur="category">
                <option value="-1">Semua Pengaduan</option>
                @foreach ([1, 2, 3] as $jenis)
                    <option value="{{ $jenis }}">{{ getJenisKendala($jenis) }}</option>
                @endforeach
            </x-select-form>

            <x-select-form wire:model.blur="status">
                <option value="-1">Semua Status</option>
                @foreach ([0, 1, 2] as $status)
                    <option value="{{ $status }}">{{ getStatusKendala($status) }}</option>
                @endforeach
            </x-select-form>
        </div>

        <x-input wire:model.live.debounce.200ms="search" type="text"
            placeholder="Cari berdasarkan nama, nim, atau nimb" class="block w-full mb-3 placeholder-gray-400" />

        <x-table :theads="['Nama', 'Jenis Pengaduan', 'Status', 'Waktu Pengajuan', 'Aksi']" class="mb-3" :breakpointVisibility="[
            3 => ['xl' => 'hidden'], // Hide waktuPengajuan on xl
            1 => ['lg' => 'hidden'], // Hide Jenis on lg
            2 => ['lg' => 'hidden'], // Hide kategori on lg
            4 => ['sm' => 'hidden'], // Hide aksi on sm
        ]">
            @forelse ($kendala as $row)
                <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}
                    x-data="{}"
                    x-on:click="if (window.innerWidth <= 640) { $wire.dispatch('openDetailKendalaAdmin', { kendalaId: {{ $row->id }} }) }">
                    <td class="flex items-start justify-between px-6 py-3 sm:block">
                        <div>
                            <a href="{{ route('user.detail', ['id' => $row->user->id]) }}"
                                class="underline hover:text-base-brown-500">
                                {{ $row->user->name }}
                            </a>
                            <dl class="-ml-0.5">
                                <dd class="mt-1.5 text-xs xl:hidden">
                                    <span class="font-bold">Jenis: </span>{{ getJenisKendala($row->category) }}
                                </dd>
                                <dd class="mt-1.5 lg:hidden">
                                    <x-status-kendala status="{{ $row->status }}" />
                                    <span class="text-xs italic text-base-blue-400 sm:hidden">(Click For Detail)</span>
                                </dd>
                                <dd class="mt-1.5 text-xs italic xl:hidden">
                                    Diajukan pada {{ formatDateIso($row->created_at, 'dddd, D MMMM YYYY HH:mm:ss') }}
                                </dd>
                            </dl>
                        </div>
                        <div class="flex items-start ml-auto sm:hidden">
                            @can(PERMISSION_DELETE_KENDALA)
                                <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                    x-on:click.stop="modalRemove = true; nama = '{{ addslashes($row->user->name) }}'; kendalaId = '{{ $row->id }}'">
                                    Delete
                                </x-button>
                            @endcan
                        </div>
                    </td>
                    <td class="hidden px-6 py-3 lg:table-cell">{{ getJenisKendala($row->category) }}</td>

                    <td class="hidden px-6 py-3 text-center lg:table-cell">
                        <x-status-kendala status="{{ $row->status }}" />
                    </td>
                    <td class="hidden px-6 py-3 text-center xl:table-cell">
                        {{ formatDateIso($row->created_at, 'dddd, D MMMM YYYY HH:mm:ss') }}
                    </td>

                    <td class="hidden px-6 py-3 text-center sm:table-cell">
                        <x-button class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover mx-0.5"
                            wire:click="$dispatch('openDetailKendalaAdmin', {{ $row->id }})">
                            Detail
                        </x-button>

                        @can(PERMISSION_DELETE_KENDALA)
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                x-on:click="modalRemove = true; nama = '{{ addslashes($row->user->name) }}'; kendalaId = '{{ $row->id }}'">
                                Delete
                            </x-button>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                    <td colspan="5" class="px-6 py-3 italic text-center text-md">Belum ada pengaduan</td>
                </tr>
            @endforelse
        </x-table>

        {{ $kendala->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
    </x-card>

    @can(PERMISSION_DELETE_KENDALA)
        <div x-cloak x-show="modalRemove">
            <x-modal>
                <x-modal.warning>
                    <x-slot name="title">
                        <h5 class="font-bold">Hapus Pengaduan</h5>
                    </x-slot>

                    <div>
                        Apakah kamu yakin untuk menghapus pengaduan yang diajukan <b x-text="nama"></b>?
                    </div>

                    <x-slot name="footer">
                        <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                            x-on:click="modalRemove = false">
                            Batal</x-button>
                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover"
                            x-on:click="modalRemove = false; $wire.hapus(kendalaId)">Ya, yakin</x-button>
                    </x-slot>
                </x-modal.warning>
            </x-modal>
        </div>
    @endcan
</div>
