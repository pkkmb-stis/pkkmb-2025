<div x-data="{ showModalDelete: false, user: '', userId: '' }">
    <x-card>
        <div class="flex items-center justify-between mb-3">
            <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar User</h5>
            <div class="flex">
                @livewire('admin.maba.user.export-user')
                @can(PERMISSION_ADD_USER)
                    @livewire('admin.maba.user.add')
                @endcan
            </div>
        </div>
        <div class="mb-3">
            <x-select-form name="kelompok" id="kelompok" wire:model.lazy="kelompok">
                <option value="-1">Semua Kelompok</option>
                <option value="0">Panitia</option>
                @foreach ($daftar_kelompok as $k)
                    <option value='{{ $k->id }}'>{{ $k->nama }}</option>
                @endforeach
            </x-select-form>
        </div>

        <x-input wire:model.debounce.200ms="search" type="text"
            placeholder="Cari berdasarkan nama, no ujian, atau nimb" class="block w-full mb-3 placeholder-gray-400" />
        <div class="hidden sm:block">
            <x-table :theads="['nama', 'no ujian', 'nimb', 'email', 'aksi']" :breakpointVisibility="[
                3 => ['xl' => 'hidden'], // Hide Email Pada on xl
                1 => ['lg' => 'hidden'], // Hide noujian Pada on lg
            ]">
                <slot>
                    @forelse ($users as $user)
                        <tr
                            class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                            <td class="px-6 py-3">
                                <dl>
                                    <dd class="font-bold xl:font-semibold">{{ $user->name }}</dd>
                                    <dd class="mt-1 text-xs xl:hidden">{{ $user->email }}</dd>
                                    <dd class="mt-1 text-xs lg:hidden">{{ $user->username }}</dd>
                                </dl>
                            </td>
                            <td class="hidden px-6 py-3 text-center lg:table-cell">{{ $user->username }}</td>

                            <td class="px-6 py-3 text-center">{{ $user->nimb ?? '-' }}</td>

                            <td class="hidden px-6 py-3 xl:table-cell">{{ $user->email }}</td>
                            <td class="px-6 py-3 text-center">
                                <x-button class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover" :tagA="true"
                                    href="{{ route('user.detail', ['id' => $user->id]) }}">
                                    Detail
                                </x-button>

                                @can(PERMISSION_DELETE_USER)
                                    <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover mx-0.5"
                                        x-on:click="showModalDelete = true; user = '{{ addslashes($user->name) }}'; userId = '{{ $user->id }}'">
                                        Delete
                                    </x-button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                            <td colspan="5" class="px-6 py-3 text-sm italic text-center">Tidak ada user</td>
                        </tr>
                    @endforelse

                </slot>
            </x-table>
        </div>

        {{-- Versi Mobile --}}
        <div class="grid grid-cols-1 gap-4 sm:hidden">
            @forelse ($users as $user)
                <x-card class="flex flex-col items-start justify-between p-4 space-y-2 font-sans"
                    x-on:click="window.location.href='{{ route('user.detail', ['id' => $user->id]) }}'">
                    <div class="flex items-start justify-between w-full">
                        <span class="font-bold text-base-blue-400">
                            {{ ucwords($user->name) }}
                        </span>
                        @can(PERMISSION_DELETE_USER)
                            <x-button class="bg-merah-700 hover:bg-merah-hover rounded-3xl"
                                x-on:click.stop="showModalDelete = true; user = '{{ addslashes($user->name) }}'; userId = '{{ $user->id }}'">
                                Delete
                            </x-button>
                        @endcan
                    </div>
                    <div class="text-xs italic font-semibold leading-tight text-base-blue-400 sm:hidden">
                        (Click For Detail)
                    </div>
                    <div class="mt-1 text-sm font-semibold text-base-blue-400">
                        No Ujian: {{ $user->username }}
                    </div>
                    <div class="mt-1 text-sm font-semibold text-base-blue-400">
                        NIMB: {{ $user->nimb ?? '-' }}
                    </div>
                    <div class="mt-1 text-sm font-semibold text-base-blue-400">
                        Email: {{ $user->email }}
                    </div>
                </x-card>
            @empty
                <div class="col-span-1 italic text-center text-gray-500 sm:col-span-2">Tidak ada user</div>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $users->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
        </div>
    </x-card>

    @can(PERMISSION_DELETE_USER)
        <div x-cloak x-show="showModalDelete">
            <x-modal>
                <x-modal.warning>
                    <x-slot name="title">
                        <h5 class="font-bold">Hapus User</h5>
                    </x-slot>

                    <div>
                        Apakah kamu yakin untuk menghapus <b x-text="user"></b>? Semua datanya akan terhapus
                    </div>

                    <x-slot name="footer">
                        <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                            x-on:click="showModalDelete = false">Batal</x-button>
                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                            x-on:click="showModalDelete = false; $wire.hapus(userId)">Ya, yakin</x-button>
                    </x-slot>
                </x-modal.warning>
            </x-modal>
        </div>
    @endcan
</div>
