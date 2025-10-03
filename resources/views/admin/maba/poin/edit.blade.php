<div>
    <div x-cloak x-show="openedit">
        <x-modal maxWidth="max-w-4xl">
            @if ($selected != null)
                <div class="px-5 py-6 bg-white">
                    <p class="mb-4 text-lg leading-3 capitalize">Edit Poin {{ $selected->user->name }}</p>
                    <form wire:submit.prevent="update">
                        <div class="mb-3">
                            <x-label-input for="editJenisPoinSelect">Jenis Poin</x-label-input>
                            <div wire:ignore>
                                <select id="editJenisPoinSelect" class="w-full" wire:model.lazy="jenispoin" {{ !$canChangeJenisPoin ? 'disabled' : '' }} x-init="initializeEditJenisPoin()">
                                    <option value="{{ $selected->jenispoin->category * 1000 + $selected->jenispoin->id }}" selected>{{ MAP_CATEGORY['jenis_poin'][$selected->jenispoin->category] . ' ' . $selected->jenispoin->nama }}</option>
                                    @foreach ($jenispoins as $j)
                                        @if ($j->id != $selected->jenispoin->id)
                                            <option value="{{ $j->category * 1000 + $j->id }}">{{ MAP_CATEGORY['jenis_poin'][$j->category] . ' ' . $j->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <x-error-input name="editJenisPoinSelect" />
                        </div>
                        <div class="grid lg:grid-cols-2 lg:gap-6">
                            <div class="mb-3">
                                <x-label-input for="poin">Poin</x-label-input>
                                <x-input type="number" class="w-full" wire:model.defer="poin" />
                                <x-error-input name="poin" />
                            </div>
                            {{-- BLOK BARU UNTUK INPUT TANGGAL DI MODAL --}}
                            <div class="mb-3 p-3 bg-gray-50 border rounded-md">
                                <p class="text-sm font-medium text-gray-800 mb-2">Ubah Tanggal Poin (Opsional)</p>
                                <div class="flex items-center space-x-4 mb-3">
                                    <div class="flex items-center">
                                        <input wire:model="editDateMode" id="edit_mode_dropdown" type="radio" value="dropdown" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                        <label for="edit_mode_dropdown" class="ml-2 block text-sm text-gray-900">Pilih Hari</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input wire:model="editDateMode" id="edit_mode_manual" type="radio" value="manual" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                        <label for="edit_mode_manual" class="ml-2 block text-sm text-gray-900">Input Manual</label>
                                    </div>
                                </div>
                                <div>
                                    @if ($editDateMode === 'dropdown')
                                    <div>
                                        <select wire:model.defer="selected_day_edit" id="selected_day_edit" class="w-full default-select">
                                            <option value="">-- Biarkan Waktu Asli --</option>
                                            @foreach(\App\Models\Day::getDropdownOptionsWithDescription() as $name => $description)
                                                <option value="{{ $name }}">{{ $description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @elseif ($editDateMode === 'manual')
                                    <div>
                                        <x-input placeholder="Pilih tanggal..." type="date" class="w-full" wire:model.defer="tanggal_edit_manual" />
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <x-label-input for="alasan">Alasan Pemberian Poin</x-label-input>
                            <x-textarea name="alasan" wire:model.defer="alasan" cols="30" rows="8"></x-textarea>
                            <x-error-input name="alasan" />
                        </div>
                        <div class="mb-3" x-show="{{ $selected->jenispoin->category }} == {{ CATEGORY_JENISPOIN_PELANGGARAN }} || $wire.jenispoin > {{ CATEGORY_JENISPOIN_PELANGGARAN * 1000 }} && $wire.jenispoin < {{ (CATEGORY_JENISPOIN_PELANGGARAN + 1) * 1000 }}">
                            <p class="font-bold">Bukti</p>
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="w-64 h-auto my-2">
                            @elseif ($selected->filename)
                                <img src="{{ asset('storage/images/bukti-poin/' . $selected->filename) }}" alt="Bukti awal" class="w-64 h-auto my-2">
                            @endif
                            <x-label-input for="image">Ubah Bukti</x-label-input>
                            <x-input type="file" name="image" wire:model="image" style="border: 1px solid #ccc; padding: 5px; border-radius:5px" />
                            <x-error-input name="image" />
                            <div wire:loading wire:target="image" class="mt-1 text-lg text-green-600 bold">Uploading...</div>
                            <span class="block mt-1 text-xs italic text-gray-400">Jika tidak ingin mengubah, bisa dikosongi.</span>
                        </div>
                        <div class="flex justify-end mt-4">
                            <div wire:loading.remove wire:target="update">
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button" x-on:click="openedit = false" wire:click="resetAll">Batal</x-button>
                                <x-button class="uppercase rounded-3xl bg-indigo-600 hover:bg-indigo-700 text-md" type="submit">Edit Poin</x-button>
                            </div>
                            <div wire:loading wire:target="update" class="text-xs italic text-gray-600">Sedang memproses. Harap menunggu...</div>
                        </div>
                    </form>
                </div>
            @endif
        </x-modal>
    </div>

    @if($showModalDetail && $poinToShow)
        <x-modal wire:model.defer="showModalDetail">
            <div class="p-6 bg-white">
                <h3 class="text-lg font-bold mb-4">Detail Poin: {{ $poinToShow->user->name }}</h3>
                <p><strong>Poin:</strong> {{ $poinToShow->poin }}</p>
                <p><strong>Jenis:</strong> {{ $poinToShow->jenispoin->nama }}</p>
                <p><strong>Alasan:</strong> {{ $poinToShow->alasan }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($poinToShow->urutan_input)->translatedFormat('l, d F Y H:i') }}</p>
                @if($poinToShow->filename)
                    <p class="mt-4"><strong>Bukti:</strong></p>
                    <img src="{{ asset('storage/images/bukti-poin/' . $poinToShow->filename) }}" class="w-full h-auto max-w-sm mt-2 rounded">
                @endif
                <div class="flex justify-end mt-6">
                    <x-button type="button" @click="$wire.set('showModalDetail', false)">Tutup</x-button>
                </div>
            </div>
        </x-modal>
    @endif

    @push('script-bottom')
        <script>
            function initializeEditJenisPoin() {
                new SlimSelect({
                    select: '#editJenisPoinSelect',
                    searchingText: 'Sedang mencari...',
                    searchPlaceholder: 'Cari jenis poin...',
                    placeholder: 'Pilih jenis poin...',
                    events: {
                        afterChange: (newVal) => {
                            if (newVal.length) {
                                @this.set('jenispoin', newVal[0].value);
                            }
                        }
                    }
                });
            }
        </script>
    @endpush
</div>