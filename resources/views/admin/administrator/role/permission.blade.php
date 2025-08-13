<div>
    <x-card>
        <h5 class="mb-3 text-xl font-normal text-gray-700 font-bohemianSoul">List Permission</h5>
        <x-jet-input wire:model.debounce.200ms="search" type="text" placeholder="Cari permission .."
            class="block w-full mb-3 placeholder-gray-400" />
        <x-table :theads="['permission', 'penjelasan']" :overflow="false">
            @forelse ($permissions as $permission)
                <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="px-6 py-3 text-center">
                        <small
                            class="p-1 px-3 text-xs rounded-full bg-base-orange-500 whitespace-nowrap text-coklat-1">{{ $permission->name }}</small>
                    </td>
                    <td class="px-6 py-3">{{ $permission->description }}</td>
                </tr>
            @empty
                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                    <td colspan="2" class="px-6 py-3 text-sm italic text-center">Belum ada permission</td>
                </tr>
            @endforelse
        </x-table>
        {{ $permissions->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
    </x-card>
</div>
