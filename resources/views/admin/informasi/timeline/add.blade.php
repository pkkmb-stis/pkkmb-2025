<div x-data="{ showModalAdd: @entangle('showModalAdd') }">
    <x-button class="uppercase rounded-full opacity-100 bg-coklat-1 hover:bg-base-brown-600 whitespace-nowrap"
        type="button" x-on:click="showModalAdd = true">
        Tambah Timeline
    </x-button>
    <div x-cloak x-show="showModalAdd">
        <x-modal>
            <div class="px-5 py-6 bg-white">
                <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Timeline</p>
                <form wire:submit.prevent="submit" class="text-sm text-gray-700">
                    <div class="mb-3">
                        <x-label-input for="title">Judul</x-label-input>
                        <x-input type="text" class="w-full" wire:model.defer="title" id="title" />
                        <x-error-input name="title" />
                    </div>

                    <div class="grid sm:grid-cols-2 sm:gap-6">
                        <div class="mb-3">
                            <x-label-input for="waktuMulai">Waktu Mulai</x-label-input>
                            <x-date-input wire:model.defer="waktuMulai" id="waktuMulai" name="waktuMulai" />
                            <x-error-input name="waktuMulai" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="waktuAkhir">Waktu Akhir</x-label-input>
                            <x-date-input wire:model.defer="waktuAkhir" id="waktuAkhir" name="waktuAkhir" />
                            <x-error-input name="waktuAkhir" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <x-label-input for="caption">Deskripsi</x-label-input>
                        <x-textarea name="caption" wire:model.defer="caption" id="caption" cols="30"
                            rows="8">
                        </x-textarea>
                        <x-error-input name="caption" />
                    </div>

                    <div class="mb-3">
                        <x-label-input for="location">Lokasi</x-label-input>
                        <x-input type="text" class="w-full" wire:model.defer="location" id="location" />
                        <x-error-input name="location" />
                    </div>

                    <div class="flex justify-end mt-4">
                        <div wire:loading.remove wire:target="submit">
                            <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                type="button" wire:click="resetAll">
                                Batal
                            </x-button>
                            <x-button class="uppercase rounded-3xl bg-2025-1 hover:bg-coklat-hover text-md"
                                type="submit">
                                Tambah Timeline
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
