<x-card x-data="{ modalRemove: false, anggotaNama: '', anggotaId: '' }">
    <div class="">
        <x-table :theads="['nama', 'no ujian', 'aksi']" class="mb-3" max-height="max-h-screen" :breakpointVisibility="[
            1 => ['2xl' => 'hidden'], //hide noujian on xl
        ]">
            <slot>
                @forelse ($kelompok->anggota as $anggota)
                    <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                        <td class="px-6 py-3">
                            {{ $anggota->name }}
                            <dl class="2xl:hidden">
                                <dd>
                                    {{ $anggota->username }}
                                </dd>

                            </dl>
                        </td>
                        <td class="hidden px-6 py-3 text-center 2xl:table-cell">{{ $anggota->username }}</td>
                        <td class="px-6 py-3 text-center">

                            <x-button class="mr-2 rounded-3xl bg-coklat-2 hover:bg-coklat-hover" :tagA="true"
                                href="{{ route('user.detail', ['id' => $anggota->id]) }}">Detail</x-button>

                            @if ($canAddDeleteAnggota)
                                <x-button class="ml-2 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                    x-on:click="modalRemove = true; anggotaNama = '{{ $anggota->name }}'; anggotaId = '{{ $anggota->id }}'">
                                    Hapus
                                </x-button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                        <td colspan="3" class="px-6 py-3 italic text-center text-md">Belum ada anggota</td>
                    </tr>
                @endforelse
            </slot>
        </x-table>
    </div>

    @if ($canAddDeleteAnggota)
        <div x-cloak x-show="modalRemove">
            <x-modal>
                <x-modal.warning>
                    <x-slot name="title">
                        <h5 class="font-bold">Hapus Anggota</h5>
                    </x-slot>

                    <div>
                        Apakah kamu yakin untuk menghapus <b x-text="anggotaNama"></b> dari kelompok
                        <b>{{ $kelompok->nama }}</b>?
                    </div>

                    <x-slot name="footer">
                        <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                            x-on:click="modalRemove = false">
                            Batal</x-button>
                        <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover"
                            x-on:click="modalRemove = false; $wire.removeAnggota(anggotaId)">Ya, yakin</x-button>
                    </x-slot>
                </x-modal.warning>
            </x-modal>
        </div>
    @endif
</x-card>
