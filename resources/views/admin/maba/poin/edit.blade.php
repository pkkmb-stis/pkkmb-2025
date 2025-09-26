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
                                <select id="editJenisPoinSelect" class="w-full" wire:model.lazy="jenispoin"
                                    {{ !$canChangeJenisPoin ? 'disabled' : '' }} x-init="initializeEditJenisPoin()">

                                    <option
                                        value="{{ $selected->jenispoin->category * 1000 + $selected->jenispoin->id }}"
                                        selected>
                                        {{ MAP_CATEGORY['jenis_poin'][$selected->jenispoin->category] . ' ' . $selected->jenispoin->nama }}
                                    </option>

                                    @foreach ($jenispoins as $j)
                                        @if ($j->id != $selected->jenispoin->id)
                                            <option value="{{ $j->category * 1000 + $j->id }}">
                                                {{ MAP_CATEGORY['jenis_poin'][$j->category] . ' ' . $j->nama }}
                                            </option>
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

                            <div class="mb-3">
                                <x-label-input for="selected_day_edit">Hari Terkena Poin</x-label-input>

                                <select wire:model.defer="selected_day_edit" id="selected_day_edit" name="selected_day_edit" 
                                    class="w-full block px-3 py-2.5 text-base border border-gray-300 rounded-md focus:border-base-brown-300 focus:ring focus:ring-base-brown-200 focus:ring-opacity-50 sm:text-sm sm:leading-5">
                                    <option value="">Gunakan Waktu Asli</option>
                                    @foreach(\App\Models\Day::getDropdownOptionsWithDescription() as $name => $description)
                                        <option value="{{ $name }}">{{ $description }}</option>
                                    @endforeach
                                </select>
                               
                                <x-error-input name="selected_day_edit" />
                                <span class="mt-1 text-xs italic text-gray-400">
                                    Pilih hari untuk mengubah tanggal poin. Kosongkan untuk mempertahankan waktu asli
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <x-label-input for="alasan">Alasan Pemberian Poin</x-label-input>
                            <x-textarea name="alasan" wire:model.defer="alasan" cols="30"
                                rows="8"></x-textarea>
                            <x-error-input name="alasan" />
                        </div>

                        <div class="mb-3"
                            x-show="
                      {{ $selected->jenispoin->category }} == {{ CATEGORY_JENISPOIN_PELANGGARAN }} ||
                      $wire.jenispoin > {{ CATEGORY_JENISPOIN_PELANGGARAN * 1000 }} &&
                      $wire.jenispoin < {{ (CATEGORY_JENISPOIN_PELANGGARAN + 1) * 1000 }}">
                            <p class="font-bold">Bukti</p>
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="w-64 h-auto my-2">
                            @else
                                @if (
                                    $selected->jenispoin->category == CATEGORY_JENISPOIN_PELANGGARAN ||
                                        ($jenispoin > CATEGORY_JENISPOIN_PELANGGARAN * 1000 &&
                                            $jenispoin < (CATEGORY_JENISPOIN_PELANGGARAN + 1) * 1000))
                                    <img src="{{ asset('storage/images/bukti-poin/' . $selected->filename) }}"
                                        alt="Bukti awal" class="w-64 h-auto my-2">
                                @endif
                            @endif
                            <x-label-input for="image">Ubah Bukti</x-label-input>
                            <x-input type="file" name="image" wire:model="image"
                                style="border: 1px solid #ccc; padding: 5px; border-radius:5px" />
                            <x-error-input name="image" />
                            <div wire:loading wire:target="image" class="mt-1 text-lg text-green-600 bold">Uploading...
                            </div>
                            <span class="block mt-1 text-xs italic text-gray-400">
                                Jika tidak ingin mengubah, bisa dikosongi
                            </span>
                        </div>

                        <div class="flex justify-end mt-4">
                            <div wire:loading.remove wire:target="update">
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                    type="button" x-on:click="openedit = false" wire:click="resetAll">
                                    Batal
                                </x-button>
                                <x-button
                                    class="uppercase rounded-3xl bg-2025-2 hover:bg-2025-1 text-md"
                                    type="submit" x-on:click="openedit = false">
                                    Edit Poin
                                </x-button>
                            </div>


                            <div wire:loading wire:target="update" class="text-xs italic text-gray-600">
                                Sedang memproses. Harap menunggu...
                            </div>
                        </div>

                    </form>
                </div>
            @endif
        </x-modal>
    </div>
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
                        @this.set('jenispoin', newVal[0].value);
                }
            }
                });
            }
        </script>
    @endpush

</div>
