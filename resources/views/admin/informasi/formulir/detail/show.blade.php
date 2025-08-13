<div>
    <x-card>
        <!-- Filter Pencarian -->
        <div class="grid mb-3 lg:grid-cols-2 lg:gap-6 gap-y-3">
            <x-jet-input wire:model.debounce.200ms="search" type="text" placeholder="Cari berdasarkan nama atau NIMB"
                class="block w-full mb-3 placeholder-gray-400" />

            <x-select-form wire:model.lazy="status" class="mb-3">
                <option value="0">Belum Mengisi</option>
                <option value="1">Sudah Mengisi</option>
            </x-select-form>
        </div>

        {{-- Filter Kelompok --}}
        <div>
            <x-select-form wire:model.lazy="kelompokSearch" class="mb-3">
                <option value="%%">Semua Kelompok</option>
                @foreach ($kelompok as $k)
                    <option value="{{ $k }}">{{ $k }}</option>
                @endforeach
            </x-select-form>
        </div>

        <!-- Tabel Data Formulir -->
        <div x-data="{ modalHapus: false, modalUbahStatus: false, namaHapus: '', idHapus: '', namaUbahStatus: '', idUbahStatus: '' }">
            <div class="hidden sm:block">
                <x-table :theads="['Nama', 'NIMB', 'Kelompok', 'Aksi']" class="mb-3" :breakpointVisibility="[
                    1 => ['lg' => 'hidden'], // Hide NIMB on lg
                ]">
                    <slot>
                        @forelse ($users as $user)
                            <tr
                                class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                <td class="px-6 py-3">
                                    <a href="{{ route('user.detail', ['id' => $user->id]) }}"
                                        class="underline hover:text-base-brown-500">
                                        {{ $user->name }}
                                    </a>
                                </td>

                                <td class="hidden px-6 py-3 text-center lg:table-cell">
                                    {{ $user->nimb ?? '-' }}
                                </td>

                                <td class="hidden px-6 py-3 text-center xl:table-cell">
                                    {{ $user->kelompok->nama ?? '-' }}
                                </td>

                                <td class="px-6 py-3 text-center">
                                    @if ($status == 0)
                                        <x-button class="rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 mx-0.5"
                                            x-on:click="modalUbahStatus = true; namaUbahStatus = `{{ addslashes($user->name) }}`; idUbahStatus = '{{ $user->id }}'">
                                            Ubah Status
                                        </x-button>
                                    @elseif ($status == 1)
                                        @can(PERMISSION_DELETE_FORMULIR)
                                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                                x-on:click="modalHapus = true; namaHapus = `{{ addslashes($user->name) }}`; idHapus = '{{ $user->id }}'">
                                                Hapus
                                            </x-button>
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                                <td colspan="4" class="px-6 py-3 italic text-center text-md">Tidak ada data user</td>
                            </tr>
                        @endforelse
                    </slot>
                </x-table>
            </div>

            <!-- Versi Mobile -->
            <div class="grid grid-cols-1 gap-4 sm:hidden">
                @forelse ($users as $user)
                    <x-card class="flex flex-col items-start justify-between p-4 space-y-2 font-sans">
                        <div class="flex items-center justify-between w-full">
                            <span class="font-bold text-base-blue-400">{{ $user->name }}</span>
                            <div>
                                @if ($status == 0)
                                    @can(PERMISSION_UPDATE_FORMULIR)
                                        <x-button class="rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 mx-0.5"
                                            x-on:click="modalUbahStatus = true; namaUbahStatus = `{{ addslashes($user->name) }}`; idUbahStatus = '{{ $user->id }}'">
                                            Ubah Status
                                        </x-button>
                                    @endcan
                                @elseif ($status == 1)
                                    @can(PERMISSION_DELETE_FORMULIR)
                                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                            x-on:click="modalHapus = true; namaHapus = `{{ addslashes($user->name) }}`; idHapus = '{{ $user->id }}'">
                                            Hapus
                                        </x-button>
                                    @endcan
                                @endif
                            </div>
                        </div>
                        <div class="mt-1 text-xs font-semibold text-base-blue-400">
                            <span class="font-bold">NIMB: </span>{{ $user->nimb ?? '-' }}
                        </div>
                        @if ($user->kelompok)
                            <div class="mt-1 text-xs font-semibold text-base-blue-400">
                                <span class="font-bold">Kelompok: </span>{{ $user->kelompok->nama }}
                            </div>
                        @endif
                    </x-card>
                @empty
                    <div class="col-span-1 italic text-center text-gray-500">Tidak ada data user</div>
                @endforelse
            </div>

            <!-- Modal Hapus -->
            @can(PERMISSION_DELETE_FORMULIR)
                <div x-show="modalHapus" x-cloak>
                    <x-modal>
                        <x-modal.warning>
                            <x-slot name="title">
                                <h5 class="font-bold">Hapus Data Formulir</h5>
                            </x-slot>

                            <div>
                                Apakah kamu yakin untuk menghapus data presensi <b x-text="namaHapus"></b>? User tersebut
                                akan masuk ke daftar belum melakukan presensi.
                            </div>

                            <x-slot name="footer">
                                <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600"
                                    x-on:click="modalHapus = false">Batal
                                </x-button>
                                <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                    x-on:click="modalHapus = false; $wire.hapus(idHapus)">Ya, yakin</x-button>
                            </x-slot>
                        </x-modal.warning>
                    </x-modal>
                </div>
            @endcan

            <!-- Modal Ubah Status -->
            @can(PERMISSION_UPDATE_FORMULIR)
                <div x-show="modalUbahStatus" x-cloak>
                    <x-modal>
                        <x-modal.warning>
                            <x-slot name="title">
                                <h5 class="font-bold">Ubah Status</h5>
                            </x-slot>

                            <div>
                                Apakah kamu yakin untuk mengubah status <b x-text="namaUbahStatus"></b> menjadi sudah
                                mengisi?
                            </div>

                            <x-slot name="footer">
                                <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600"
                                    x-on:click="modalUbahStatus = false">Batal
                                </x-button>
                                <x-button class="rounded-3xl bg-base-orange-500 hover:bg-base-orange-600"
                                    x-on:click="modalUbahStatus = false; $wire.ubahStatus(idUbahStatus)">Ya,
                                    yakin</x-button>
                            </x-slot>
                        </x-modal.warning>
                    </x-modal>
                </div>
            @endcan
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $users->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
        </div>
    </x-card>
</div>
