<div>
    <x-card x-data="{ showModalDelete: false, roleToDelete: '' }">
        <div class="flex items-center justify-between mb-3">
            <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">List Role</h5>
            @can(PERMISSION_ADD_ROLE)
                @include('admin.administrator.role.add')
            @endcan
        </div>
        <x-input wire:model.debounce.200ms="search" type="text" placeholder="Cari role .."
            class="block w-full mb-3 placeholder-gray-400" />

        <x-table :theads="['role', 'penjelasan', 'aksi']" :overflow="false">
            @forelse ($roles as $role)
                <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="px-6 py-3 text-center">
                        <a href="{{ route('user.role.detail', ['id' => $role->id]) }}">
                            <small
                                class="p-1 px-3 text-xs rounded-full bg-kuning-1 whitespace-nowrap text-coklat-1">{{ $role->name }}</small>
                        </a>
                    </td>
                    <td class="px-6 py-3">{{ $role->description }}</td>
                    <td class="text-center">
                        @can(PERMISSION_DELETE_ROLE)
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                x-on:click="showModalDelete = true; roleToDelete = '{{ $role->name }}'"
                                wire:click="setRoleToDelete('{{ $role->id }}')">Hapus</x-button>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                    <td colspan="3" class="px-6 py-3 text-sm italic text-center">Belum ada role</td>
                </tr>
            @endforelse
        </x-table>

        {{-- Pagination --}}
        {{ $roles->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}

        {{-- Modal Revoke Permission --}}
        @can(PERMISSION_DELETE_ROLE)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus Role</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus role <b x-text="roleToDelete"></b>?
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalDelete = false" wire:click="deleteRole">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan
    </x-card>
</div>
