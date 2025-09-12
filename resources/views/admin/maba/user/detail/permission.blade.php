<div>
    <x-card>
        <div x-data="{showModalRevoke :false, permissionToRevoke : '', showModalTambah: false}">
            <div class="flex items-start justify-between mb-3">
                <h5 class="font-bold text-gray-700">Permission</h5>
                <x-button x-on:click="showModalTambah = true" class="rounded-3xl bg-coklat-1 hover:bg-base-brown-600">Tambah</x-button>
            </div>

            <x-table :theads="['permission', 'aksi']" max-height="max-h-96">
                @forelse ($userPermission as $permission)
                <tr
                    class="border-b border-gray-200 hover:bg-blueGray-100 text-center {{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="px-6 py-3">
                        <small class="p-1 px-3 text-xs text-white bg-green-500 rounded-full">{{ $permission }}</small>
                    </td>
                    <td>
                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover"
                            x-on:click="permissionToRevoke = '{{ $permission }}'; showModalRevoke = true"
                            wire:click="setPermissionToRevoke('{{ $permission }}')">
                            Hapus
                        </x-button>
                    </td>
                </tr>
                @empty
                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                    <td colspan="2" class="px-6 py-3 text-sm italic text-center">Tidak ada permission</td>
                </tr>
                @endforelse
            </x-table>

            {{-- Modal Revoke Permission--}}
            <div x-cloak x-show="showModalRevoke">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Revoke Permission</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus permission <b x-text="permissionToRevoke"></b> dari
                            {{ $user->name }}?
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalRevoke = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalRevoke = false" wire:click="revokePermission">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>

            {{-- Modal Tambah Permission--}}
            <div x-cloak x-show="showModalTambah">
                <x-modal>
                    <div class="px-5 py-3 bg-white">
                        <h5 class="mb-3 font-bold">Tambah Permission</h5>

                        <div class="mb-5">
                            <x-select-form wire:model="permissionToAdd">
                                <slot>
                                    <option>Pilih Permission</option>
                                    @foreach ($permissions as $p)
                                    <option value="{{ $p->name }}">{{ $p->name }}</option>
                                    @endforeach
                                </slot>
                            </x-select-form>
                        </div>

                        <div class="flex justify-end">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalTambah= false">
                                Batal
                            </x-button>
                            <x-button class="rounded-3xl bg-coklat-1 hover:bg-base-brown-600" :tagA="false"
                                x-on:click="showModalTambah = false" wire:click="addPermission">
                                Tambah
                            </x-button>
                        </div>
                    </div>
                </x-modal>
            </div>

        </div>
    </x-card>

</div>
