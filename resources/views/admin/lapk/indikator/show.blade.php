<div>
    <x-card x-data="{ modalRemove: false, indikatorNama: '', indikatorId: '', indikatorDimensi: '' }">
        <div class="flex items-center justify-between mb-3">
            <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Indikator Penilaian</h5>
            @can(PERMISSION_ADD_INDIKATOR_PENILAIAN)
                @livewire('admin.lapk.indikator.add')
            @endcan
        </div>
        <div class="hidden lg:block">
            <x-table :theads="['Dimensi', 'Indikator', 'SKS', 'aksi']" :breakpointVisibility="[
                1 => ['xl' => 'hidden'], // Hide Indikator on xl
            ]">
                <slot>
                    @forelse ($indikator as $k)
                        <tr class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                            <td class="px-6 py-3">
                                {{-- <span class="inline xl:hidden">Dimensi: </span> --}}
                                <span class="font-bold xl:font-semibold">{{ $k->dimensi }}</span>
                                <dl>
                                    <dd class="xl:hidden">Indikator: {{ $k->nama }}</dd>
                                </dl>
                            </td>
                            <td class="hidden px-6 py-3 xl:table-cell">{{ $k->nama }}</td>
                            <td class="px-6 py-3 text-center">{{ $k->sks }}</td>
                            <td class="px-6 py-3 text-center">
                                <x-button class="mr-2 rounded-3xl bg-2025-1 hover:bg-coklat-hover"
                                    wire:click="setField({{ $k->id }})">
                                    Detail
                                </x-button>

                                @can(PERMISSION_DELETE_INDIKATOR_PENILAIAN)
                                    <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                        x-on:click="modalRemove = true; indikatorNama = '{{ $k->nama }}'; indikatorId = '{{ $k->id }}'; indikatorDimensi = '{{ $k->dimensi }}'">
                                        Hapus
                                    </x-button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                            <td colspan="4" class="px-6 py-3 text-sm italic text-center">Tidak Ada Indikator</td>
                        </tr>
                    @endforelse
                </slot>
            </x-table>

        </div>

        <!-- Versi Mobile Tabel Indikator -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-1 lg:hidden">
            @forelse ($indikator as $k)
                <x-card class="flex flex-col items-start justify-between p-4 space-y-3 cursor-pointer"
                    wire:click="setField({{ $k->id }})">
                    <div class="flex items-start justify-between w-full">
                        <!-- Informasi Indikator -->
                        <div class="flex-grow mr-4 text-sm"> <!-- Menambahkan margin-right untuk memberikan ruang -->
                            <div class="font-bold text-black">Dimensi: {{ $k->dimensi }}</div>
                            <div class="mt-1 text-black">{{ $k->nama }}</div>
                            <div class="mt-1 text-black">
                                {{ $k->sks }} SKS
                                <span class="text-xs italic font-bold">(Click For Detail)</span>
                            </div>
                        </div>

                        <!-- Tombol Hapus di Pojok Kanan -->
                        @can(PERMISSION_DELETE_INDIKATOR_PENILAIAN)
                            <x-button class="flex-shrink-0 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                x-on:click.stop="modalRemove = true; indikatorNama = '{{ $k->nama }}'; indikatorId = '{{ $k->id }}'; indikatorDimensi = '{{ $k->dimensi }}'; $event.stopPropagation()">
                                Hapus
                            </x-button>
                        @endcan
                    </div>
                </x-card>
            @empty
                <div class="col-span-1 italic text-center text-gray-500 sm:col-span-2">
                    Tidak Ada Indikator
                </div>
            @endforelse
        </div>


        @can(PERMISSION_DELETE_INDIKATOR_PENILAIAN)
            <div x-cloak x-show="modalRemove">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus Indikator</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus indikator <b x-text="indikatorNama"></b> pada dimensi <b
                                x-text="indikatorDimensi"></b> ? Hal ini akan
                            berpengaruh terhadap nilai MABA
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="modalRemove = false">
                                Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                x-on:click="modalRemove = false; $wire.hapus(indikatorId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan

    </x-card>


    @if ($openModal)
        <div>
            <x-modal>
                <div class="px-5 py-6 bg-white">
                    <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Ubah Indikator</p>
                    <form wire:submit.prevent="ubahIndikator" class="text-sm text-gray-700">
                        <div class="mb-3">
                            <label for="nama" class="block mb-1 font-bold">Indikator</label>
                            <x-input type="text" class="w-full" wire:model.defer="nama"
                                disabled="{{ !$canEdit }}" />
                            <x-error-input name="nama" />
                        </div>
                        <div class="mb-3">
                            <label for="dimensi" class="block mb-1 font-bold">Dimensi</label>
                            <x-select-form id="dimensi" wire:model.defer="dimensi" disabled="{{ !$canEdit }}">
                                <option value="{{ DIMENSI_NASIONALISME }}">{{ DIMENSI_NASIONALISME }}</option>
                                <option value="{{ DIMENSI_BUDI_PEKERTI }}">{{ DIMENSI_BUDI_PEKERTI }}</option>
                                <option value="{{ DIMENSI_BERINTELEKTUAL }}">{{ DIMENSI_BERINTELEKTUAL }}</option>
                                <option value="{{ DIMENSI_LITERASI }}">{{ DIMENSI_LITERASI }}</option>
                            </x-select-form>
                            <x-error-input name="dimensi" />
                        </div>

                        <div class="mb-3">
                            <label for="sks" class="block mb-1 font-bold">SKS</label>
                            <x-input type="number" min="1" max="4" class="w-full"
                                wire:model.defer="sks" disabled="{{ !$canEdit }}" />
                            <x-error-input name="sks" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="detail">Detail</x-label-input>
                            <x-textarea name="detail" wire:model.defer="detail" id="detail" cols="30"
                                rows="6" disabled="{{ !$canEdit }}">
                            </x-textarea>
                            <x-error-input name="detail" />
                        </div>

                        <div class="flex justify-end my-3">
                            <div wire:loading.remove wire:target="ubahIndikator">
                                <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600"
                                    wire:click="toggleModal" type="button">
                                    Batal
                                </x-button>
                                @if ($canEdit)
                                    <x-button class="rounded-3xl bg-2025-2 hover:bg-2025-1">
                                        Ubah Indikator
                                    </x-button>
                                @endif
                            </div>

                            <div wire:loading wire:target="ubahIndikator" class="text-xs italic text-gary-600">
                                Sedang memproses. Harap menunggu ..
                            </div>
                        </div>
                    </form>
                </div>
            </x-modal>
        </div>
    @endif
</div>
