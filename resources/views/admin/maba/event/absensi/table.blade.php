<div>
    <x-card>
        <div class="grid mb-3 lg:grid-cols-2 lg:gap-6 gap-y-3">
            <x-select-form wire:model.lazy="isMaba">
                <option value="1">Maba</option>
                <option value="0">Panitia</option>
            </x-select-form>

            <x-select-form wire:model.lazy="belumAbsen">
                <option value="1">Belum Absen</option>
                <option value="0">Sudah Absen</option>
            </x-select-form>
        </div>

        <div class="{{ $isMaba ? '' : 'hidden' }}">
            <x-select-form wire:model.lazy="kelompokSearch" class="mb-3">
                <option value="%%">Semua Kelompok</option>
                @foreach ($kelompok as $k)
                    <option value="{{ $k }}">{{ $k }}</option>
                @endforeach
            </x-select-form>
        </div>

        <div class="{{ $belumAbsen ? 'hidden' : '' }}">
            <x-select-form wire:model.lazy="statusAbsensi" class="mb-3">
                <option value="-1">Semua Status</option>
                @foreach ([0, 1, 2, 3, 4] as $status)
                    <option value="{{ $status }}">{{ getStatusAbsensi($status) }}</option>
                @endforeach
            </x-select-form>
        </div>

        <x-input wire:model.debounce.200ms="namaSearch" type="text"
            placeholder="Cari berdasarkan nama, nim panitia, atau nimb maba"
            class="block w-full mb-3 placeholder-gray-400" />

        <div x-data="{ modalHapus: false, namaHapus: '', idHapus: '', link: '' }">
            @if ($belumAbsen)
                {{-- tabel belum absen --}}
                <div class="hidden sm:block">
                    <x-table :theads="['Nama', 'NIMB/NIM', 'Kelompok', 'Aksi']" class="mb-3" :breakpointVisibility="[
                        2 => ['xl' => 'hidden'], // Hide kelompok on xl
                        1 => ['lg' => 'hidden'], // Hide NIMB/NIM on lg
                    ]">
                        <slot>
                            @forelse ($users as $user)
                                <tr
                                    class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                    <td class="px-6 py-3">
                                        <dl>
                                            <dd>
                                                <a href="{{ route('user.detail', ['id' => $user->id]) }}"
                                                    class="underline hover:text-base-brown-500">
                                                    {{ $user->name }}
                                                </a>
                                            </dd>
                                            <dd class="mt-1 text-xs lg:hidden">
                                                @if ($user->is_maba)
                                                    <span class="font-bold">NIMB: </span>{{ $user->nimb ?? '-' }}
                                                @else
                                                    {{ $user->username }}
                                                @endif
                                            </dd>
                                            @if ($user->kelompok)
                                                <dd class="mt-1 text-xs xl:hidden">
                                                    <span class="font-bold">Kelompok:
                                                    </span>{{ $user->kelompok->nama }}
                                                </dd>
                                            @endif
                                        </dl>
                                    </td>

                                    <td class="hidden px-6 py-3 text-center lg:table-cell">
                                        @if ($user->is_maba)
                                            {{ $user->nimb ?? '-' }}
                                        @else
                                            {{ $user->username }}
                                        @endif
                                    </td>

                                    <td class="hidden px-6 py-3 text-center xl:table-cell">
                                        {{ $user->kelompok->nama ?? '-' }}
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        @if ($canAddNewAbsen)
                                            <x-button
                                                class="rounded-3xl bg-2025-2 hover:bg-2025-1 mx-0.5"
                                                wire:click="$emit('openModalAddAbsensi', {{ $user->id }}, {{ $event->id }})">
                                                Ubah Status
                                            </x-button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                                    <td colspan="4" class="px-6 py-3 italic text-center text-md">Tidak ada user</td>
                                </tr>
                            @endforelse

                        </slot>
                    </x-table>
                </div>
                {{-- Versi mobile --}}
                <div class="grid grid-cols-1 gap-4 sm:hidden">
                    @forelse ($users as $user)
                        <x-card class="flex flex-col items-start justify-between p-4 space-y-2 font-sans">
                            <div class="flex items-center justify-between w-full">
                                <span class="font-bold text-base-blue-400">
                                    {{ $user->name }}
                                </span>
                                @if ($canAddNewAbsen)
                                    <x-button class="bg-2025-2 hover:bg-2025-1 rounded-3xl"
                                        wire:click="$emit('openModalAddAbsensi', {{ $user->id }}, {{ $event->id }})">
                                        Ubah Status
                                    </x-button>
                                @endif
                            </div>
                            <div class="mt-1 text-xs font-semibold text-base-blue-400">
                                @if ($user->is_maba)
                                    <span class="font-bold">NIMB: </span>{{ $user->nimb ?? '-' }}
                                @else
                                    {{ $user->username }}
                                @endif
                            </div>
                            @if ($user->kelompok)
                                <div class="mt-1 text-xs font-semibold text-base-blue-400">
                                    <span class="font-bold">Kelompok: </span>{{ $user->kelompok->nama }}
                                </div>
                            @endif
                        </x-card>
                    @empty
                        <div class="col-span-1 italic text-center text-gray-500">Tidak ada user</div>
                    @endforelse
                </div>

                @if ($canAddNewAbsen)
                    @livewire('admin.maba.event.absensi.add')
                @endif
            @else
                <div class="hidden sm:block">
                    {{-- table sudah absen --}}
                    <x-table :theads="['Nama', 'NIMB/NIM', 'Kelompok', 'Status', 'Aksi']" class="mb-3" :breakpointVisibility="[
                        2 => ['xl' => 'hidden'], // Hide kelompok on xl
                        1 => ['lg' => 'hidden'], // Hide NIMB/NIM on lg
                        3 => ['lg' => 'hidden'], // Hide Status on lg
                    ]">
                        <slot>
                            @forelse ($users as $user)
                                <tr
                                    class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                                    <td class="px-6 py-3">
                                        <dl>
                                            <dd>
                                                <a href="{{ route('user.detail', ['id' => $user->id]) }}"
                                                    class="underline hover:text-base-brown-500">
                                                    {{ $user->name }}
                                                </a>
                                                <span class="ml-2 text-xs lg:hidden"><x-status-absensi
                                                        status="{{ $user->status }}" /></span>
                                            </dd>
                                            <dd class="mt-1 text-xs lg:hidden">
                                                @if ($user->is_maba)
                                                    <span class="font-bold">NIMB: </span>{{ $user->nimb ?? '-' }}
                                                @else
                                                    {{ $user->username }}
                                                @endif
                                            </dd>
                                            @if ($user->kelompok)
                                                <dd class="mt-1 text-xs xl:hidden">
                                                    <span class="font-bold">Kelompok:
                                                    </span>{{ $user->kelompok->nama }}
                                                </dd>
                                            @endif
                                        </dl>
                                    </td>
                                    <td class="hidden px-6 py-3 text-center lg:table-cell">
                                        @if ($user->is_maba)
                                            {{ $user->nimb ?? '-' }}
                                        @else
                                            {{ $user->username }}
                                        @endif
                                    </td>
                                    <td class="hidden px-6 py-3 text-center xl:table-cell">
                                        {{ $user->kelompok->nama ?? '-' }}</td>

                                    <?php $pivot = $user->getAttributes(); ?>
                                    <td class="hidden px-6 py-3 text-center lg:table-cell">
                                        <x-status-absensi status="{{ $user->status }}" />
                                    </td>

                                    <td class="px-6 py-3 text-center">
                                        <x-button class="rounded-3xl bg-2025-1 hover:bg-coklat-hover mx-0.5"
                                            wire:click="$emit('openModalDetailAbsensi', {{ $user->user_id }}, {{ $user->event_id }})">
                                            Detail
                                        </x-button>

                                        @can(PERMISSION_DELETE_ABSENSI)
                                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                                x-on:click="modalHapus = true; namaHapus = `{{ addslashes($user->name) }}`; idHapus = '{{ $user->user_id }}'; link = '{{ $user->link }}'">
                                                Hapus
                                            </x-button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                                    <td colspan="5" class="px-6 py-3 italic text-center text-md">Tidak ada user</td>
                                </tr>
                            @endforelse

                        </slot>
                    </x-table>
                </div>

                {{-- Mobile Version --}}
                <div class="grid grid-cols-1 gap-4 sm:hidden">
                    @forelse ($users as $user)
                        <x-card class="flex flex-col items-start justify-between p-4 space-y-2 font-sans"
                            x-data="{}"
                            @click="$wire.emit('openModalDetailAbsensi', {{ $user->user_id }}, {{ $user->event_id }})">
                            <div class="flex items-center justify-between w-full">
                                <span class="font-bold text-base-blue-400">
                                    {{ $user->name }}
                                </span>
                                @can(PERMISSION_DELETE_ABSENSI)
                                    <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                        x-on:click.stop="modalHapus = true; namaHapus = `{{ addslashes($user->name) }}`; idHapus = '{{ $user->user_id }}'; link = '{{ $user->link ?? '' }}'">
                                        Hapus
                                    </x-button>
                                @endcan
                            </div>
                            <div class="mt-1">
                                <x-status-absensi status="{{ $user->status }}" />
                                <span class="text-xs italic font-bold text-base-blue-400 sm:hidden">(Click For
                                    Detail)</span>
                            </div>
                            <div class="mt-1 text-xs font-semibold text-base-blue-400">
                                @if ($user->is_maba)
                                    <span class="font-bold">NIMB: </span>{{ $user->nimb ?? '-' }}
                                @else
                                    {{ $user->username }}
                                @endif
                            </div>
                            @if ($user->kelompok)
                                <div class="mt-1 text-xs font-semibold text-base-blue-400">
                                    <span class="font-bold">Kelompok: </span>{{ $user->kelompok->nama }}
                                </div>
                            @endif
                        </x-card>
                    @empty
                        <div class="col-span-1 italic text-center text-gray-500">Tidak ada user</div>
                    @endforelse
                </div>

                @livewire('admin.maba.event.absensi.detail')

                @can(PERMISSION_DELETE_ABSENSI)
                    <div x-show="modalHapus" x-cloak>
                        <x-modal>
                            <x-modal.warning>
                                <x-slot name="title">
                                    <h5 class="font-bold">Hapus Data Presensi</h5>
                                </x-slot>

                                <div>
                                    Apakah kamu yakin untuk menghapus data presensi <b x-text="namaHapus"></b>? User
                                    tersebut
                                    akan masuk kedaftar belum melakukan presensi.
                                </div>

                                <x-slot name="footer">
                                    <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600"
                                        x-on:click="modalHapus = false">Batal
                                    </x-button>
                                    <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                        x-on:click="modalHapus = false; $wire.hapus(idHapus, link)">Ya, yakin</x-button>
                                </x-slot>
                            </x-modal.warning>
                        </x-modal>
                    </div>
                @endcan

            @endif
        </div>

        <div class="mt-3">
            {{ $users->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
        </div>
    </x-card>
</div>
