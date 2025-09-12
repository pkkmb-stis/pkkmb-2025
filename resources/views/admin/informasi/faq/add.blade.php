<div x-data="{ showModalAdd: @entangle('showModalAdd').live }">
    <x-button class="uppercase rounded-full opacity-100 bg-coklat-1 hover:bg-base-brown-600 whitespace-nowrap"
        type="button" x-on:click="showModalAdd = true">
        Tambah FAQ
    </x-button>
    <div x-cloak x-show="showModalAdd">
        <x-modal>
            <div class="px-5 py-6 bg-white">
                <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah FAQ</p>
                <form wire:submit="submit" class="text-sm text-gray-700">
                    <div class="mb-3">
                        <x-label-input for="pertanyaan">Pertanyaan</x-label-input>
                        <x-textarea cols="30" rows="6" wire:model="pertanyaan" id="pertanyaan" />
                        <x-error-input name="pertanyaan" />
                    </div>

                    <div class="mb-3">
                        <x-label-input for="jawaban">Jawaban</x-label-input>
                        <x-textarea name="jawaban" wire:model="jawaban" id="jawaban" cols="30"
                            rows="10">
                        </x-textarea>
                        <x-error-input name="jawaban" />
                    </div>

                    <div class="flex justify-end mt-4">
                        <div wire:loading.remove wire:target="submit">
                            <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                type="button" wire:click="resetAll">
                                Batal
                            </x-button>
                            <x-button class="uppercase rounded-3xl bg-coklat-2 hover:bg-coklat-hover text-md"
                                type="submit">
                                Tambah FAQ
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
