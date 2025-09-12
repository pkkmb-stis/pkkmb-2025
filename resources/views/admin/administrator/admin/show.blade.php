<div>
    <x-card class="mb-8">
        <div class="flex items-center justify-between mb-3">
            <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">List Admin</h5>

            @can(PERMISSION_ADD_ADMIN)
                @livewire('admin.administrator.admin.add')
            @endcan
        </div>
        <x-input wire:model.live.debounce.200ms="search" type="text" placeholder="Cari nama admin, role..."
            class="block w-full mb-3 placeholder-gray-400" />

        <div x-data="{ showModalRevoke: false, revokeName: '', revokeId: '' }">
            <x-table :theads="['nama', 'role', 'aksi']" :breakpointVisibility="[
                1 => ['lg' => 'hidden'], // Hide role on lg
                2 => ['md' => 'hidden'], // Hide aksi on md
            ]">
                <slot>
                    @forelse ($admin as $user)
                        <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                            <td class="w-32 px-6 py-3">
                                <div class="flex flex-row justify-between w-full">
                                    <div class="block">
                                        <!-- Nama -->
                                        <div class="flex-1 truncate max-w-[150px] sm:max-w-none">
                                            {{ $user->name }}
                                        </div>

                                        <!-- Role -->
                                        <div class="mt-2 md:hidden">
                                            @forelse ($user->getRoleNames() as $role)
                                                <small
                                                    class="p-1 px-3 text-xs text-black truncate rounded-full bg-kuning-1 whitespace-nowrap">{{ $role }}</small>
                                            @empty
                                                <small>-</small>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end md:hidden">
                                        @can(PERMISSION_UPDATE_AKSES_ADMIN)
                                            <x-button
                                                class="py-1 mb-1 rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 md:mb-0 md:ml-2 whitespace-nowrap"
                                                :tagA="true" href="{{ route('user.detail', ['id' => $user->id]) }}">
                                                Tambah Akses
                                            </x-button>
                                        @endcan

                                        @if (
                                            $user->id !== auth()->user()->id &&
                                                auth()->user()->can(PERMISSION_DELETE_ADMIN))
                                            <x-button class="py-1 ml-2 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                                :tagA="false"
                                                x-on:click="showModalRevoke = true; revokeName = '{{ addslashes($user->name) }}'"
                                                wire:click="setIdRevoke({{ $user->id }})">
                                                Revoke
                                            </x-button>
                                        @endif
                                    </div>
                                    <!-- Aksi -->
                                </div>
                                <dl class="hidden md:block lg:hidden -ml-0.5 mt-2">
                                    <dd>
                                        @forelse ($user->getRoleNames() as $role)
                                            <small
                                                class="p-1 px-3 text-xs text-black rounded-full bg-kuning-1">{{ $role }}</small>
                                        @empty
                                            <small>-</small>
                                        @endforelse
                                    </dd>
                                </dl>
                            </td>
                            <td class="hidden px-6 py-3 text-center lg:table-cell">
                                @forelse ($user->getRoleNames() as $role)
                                    <small
                                        class="p-1 px-3 text-xs text-black rounded-full bg-kuning-1">{{ $role }}</small>
                                @empty
                                    <small>-</small>
                                @endforelse
                            </td>
                            <td class="hidden py-3 text-center md:table-cell">
                                @can(PERMISSION_UPDATE_AKSES_ADMIN)
                                    <x-button class="rounded-3xl bg-base-orange-500 hover:bg-base-orange-600"
                                        :tagA="true" href="{{ route('user.detail', ['id' => $user->id]) }}">
                                        Tambah Akses
                                    </x-button>
                                @endcan

                                @if (
                                    $user->id !== auth()->user()->id &&
                                        auth()->user()->can(PERMISSION_DELETE_ADMIN))
                                    <x-button class="ml-2 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                        :tagA="false"
                                        x-on:click="showModalRevoke = true; revokeName = '{{ addslashes($user->name) }}'"
                                        wire:click="setIdRevoke({{ $user->id }})">
                                        Revoke
                                    </x-button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                            <td colspan="3" class="px-6 py-3 text-sm italic text-center">Tidak ada user</td>
                        </tr>
                    @endforelse
                </slot>
            </x-table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $admin->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
            </div>

            {{-- Modal Revoke --}}
            @can(PERMISSION_DELETE_ADMIN)
                <div x-cloak x-show="showModalRevoke">
                    <x-modal>
                        <x-modal.warning>
                            <x-slot name="title">
                                <h5 class="font-bold">Revoke Admin</h5>
                            </x-slot>

                            <div>
                                Apakah kamu yakin untuk menghapus <b x-text="revokeName"></b> dari admin? Semua hak akses
                                dan rolenya akan hilang
                            </div>

                            <x-slot name="footer">
                                <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                    x-on:click="showModalRevoke = false">Batal</x-button>
                                <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                    x-on:click="showModalRevoke = false" wire:click="revokeAdmin">Ya, yakin</x-button>
                            </x-slot>
                        </x-modal.warning>
                    </x-modal>
                </div>
            @endcan

        </div>

    </x-card>
</div>
