<div>
    <x-card>
        <div class="flex items-center mb-4">
            <small
                class="p-1 px-3 mr-2 text-xs text-white bg-green-500 rounded-full whitespace-nowrap">{{ $role->name }}</small>
            <p class="text-sm text-gray-600">{{ $role->description }}</p>
        </div>
        <x-table :theads="['permission', 'aksi']" :overflow="false" max-height="max-h-96">
            @forelse ($rolePermissions as $permission)
            <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                <td class="px-6 py-3 text-center">
                    <small
                        class="p-1 px-3 text-xs text-white bg-green-500 rounded-full whitespace-nowrap">{{ $permission}}</small>
                </td>
                <td class="px-6 py-3 text-center">
                    @can(PERMISSION_UPDATE_PERMISSION_ROLE)
                    <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" wire:click="revokePermission('{{ $permission }}')">
                        Revoke</x-button>
                    @endcan
                </td>
            </tr>
            @empty
            <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                <td colspan="2" class="px-6 py-3 text-sm italic text-center">Belum ada permission</td>
            </tr>
            @endforelse
        </x-table>

        <div class="mt-5">
            @can(PERMISSION_UPDATE_PERMISSION_ROLE)
            <h5 class="mb-2 font-bold text-gray-700">Tambah Permission</h5>
            <x-select-form wire:model.defer="permissionToAdd">
                <slot>
                    <option>Pilih Permission</option>
                    @foreach ($permissions as $p)
                    <option value="{{ $p->name }}">{{ $p->name }}</option>
                    @endforeach
                </slot>
            </x-select-form>
            @endcan

            <div class="flex justify-end mt-3">
                <div wire:loading.remove wire:target="addPermission">
                    <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" href="{{ route('user.role') }}" tagA="true">
                        Kembali
                    </x-button>
                    @can(PERMISSION_UPDATE_PERMISSION_ROLE)
                    <x-button class="rounded-3xl bg-2025-1 hover:bg-coklat-hover" wire:click="addPermission">Tambah</x-button>
                    @endcan
                </div>

                <div wire:loading wire:target="addPermission" class="text-xs italic text-gary-600">
                    Sedang memproses. Harap menunggu ..
                </div>
            </div>
        </div>

    </x-card>
</div>
