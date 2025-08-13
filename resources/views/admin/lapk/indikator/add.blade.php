<div>
    <div x-data="{ isModalOpen: @entangle('isModalOpen') }">
        <x-button class="uppercase rounded-3xl bg-coklat-1 hover:bg-base-brown-600 whitespace-nowrap" type="button"
            x-on:click="isModalOpen = true">
            Tambah Indikator
        </x-button>
        <div x-cloak x-show="isModalOpen">
            <x-modal>
                <div class="px-5 py-6 bg-white">
                    <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Indikator</p>
                    <form wire:submit.prevent="submit" class="text-sm text-gray-700">
                        <div class="mb-3">
                            <label for="nama2" class="block mb-1 font-bold">Indikator</label>
                            <x-jet-input type="text" class="w-full" wire:model.defer="nama" />
                            <x-error-input name="nama" />
                        </div>

                        <div class="mb-3">
                            <label for="dimensi2" class="block mb-1 font-bold">Dimensi</label>
                            <x-select-form id="dimensi2" wire:model.defer="dimensi">
                                <option>Pilih Dimensi</option>
                                <option value="{{ DIMENSI_NASIONALISME }}">{{ DIMENSI_NASIONALISME }}</option>
                                <option value="{{ DIMENSI_BUDI_PEKERTI }}">{{ DIMENSI_BUDI_PEKERTI }}</option>
                                <option value="{{ DIMENSI_BERINTELEKTUAL }}">{{ DIMENSI_BERINTELEKTUAL }}</option>
                                <option value="{{ DIMENSI_LITERASI }}">{{ DIMENSI_LITERASI }}</option>
                            </x-select-form>
                            <x-error-input name="dimensi" />
                        </div>

                        <div class="mb-3">
                            <label for="sks2" class="block mb-1 font-bold">SKS</label>
                            <x-jet-input id="sks2" type="number" min="1" max="4" class="w-full"
                                wire:model.defer="sks" />
                            <x-error-input name="sks" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="detail2">Detail</x-label-input>
                            <x-textarea name="detail" wire:model.defer="detail" id="detail2" cols="30"
                                rows="6">
                            </x-textarea>
                            <x-error-input name="detail" />
                        </div>

                        <div class="flex justify-end my-3">
                            <div wire:loading.remove wire:target="submit">
                                <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" wire:click="resetAll"
                                    type="button">
                                    Batal
                                </x-button>
                                <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover">
                                    Tambah Indikator
                                </x-button>
                            </div>

                            <div wire:loading wire:target="submit" class="text-xs italic text-gary-600">
                                Sedang memproses. Harap menunggu ..
                            </div>
                        </div>
                    </form>
                </div>
            </x-modal>
        </div>
    </div>
</div>
