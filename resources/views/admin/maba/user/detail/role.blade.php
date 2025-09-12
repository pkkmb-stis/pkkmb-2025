<div>
    <x-card>
        <div x-data="{showModalRevokeRole :false, roleToRevoke : '', showModalTambahRole: false}">
            <div class="flex items-start justify-between mb-3">
                <h5 class="font-bold text-gray-700">Role</h5>
                <x-button x-on:click="showModalTambahRole = true" class="rounded-3xl bg-coklat-1 hover:bg-base-brown-600">Tambah</x-button>
            </div>

            <x-table :theads="['role', 'aksi']" max-height="max-h-96">
                @forelse ($userRole as $role)
                <tr
                    class="border-b border-gray-200 hover:bg-blueGray-100 text-center {{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="px-6 py-3">
                        <small class="p-1 px-3 text-xs text-black rounded-full bg-kuning-1">{{ $role }}</small>
                    </td>
                    <td>
                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover"
                            x-on:click="roleToRevoke = '{{ $role }}'; showModalRevokeRole = true"
                            wire:click="setRoleToRevoke('{{ $role }}')">
                            Hapus
                        </x-button>
                    </td>
                </tr>
                @empty
                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                    <td colspan="2" class="px-6 py-3 text-sm italic text-center">Tidak ada role</td>
                </tr>
                @endforelse
            </x-table>

            {{-- Modal Revoke Role--}}
            <div x-cloak x-show="showModalRevokeRole">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Revoke Role</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus role <b x-text="roleToRevoke"></b> dari
                            {{ $user->name }}?
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalRevokeRole = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalRevokeRole = false" wire:click="revokeRole">Ya, yakin
                            </x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>

            {{-- Modal Tambah Role--}}
            <div x-cloak x-show="showModalTambahRole">
                <x-modal>
                    <div class="px-5 py-3 bg-white">
                        <h5 class="mb-3 font-bold">Tambah Role</h5>

                        <div class="mb-5">
                            <x-select-form wire:model="roleToAdd">
                                <slot>
                                    <option>Pilih Role</option>
                                    @foreach ($roles as $r)
                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                    @endforeach
                                </slot>
                            </x-select-form>
                        </div>

                        <div class="flex justify-end">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalTambahRole= false">
                                Batal
                            </x-button>
                            <x-button class="rounded-3xl bg-coklat-1 hover:bg-base-brown-600" :tagA="false"
                                x-on:click="showModalTambahRole = false" wire:click="addRole">
                                Tambah
                            </x-button>
                        </div>
                    </div>
                </x-modal>
            </div>

        </div>
    </x-card>
</div>
