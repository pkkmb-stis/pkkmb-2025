<div x-data="{ showModalDetail: @entangle('showModalDetail') }">
    <div x-cloak x-show="showModalDetail">
        <x-modal>
            <div class="px-5 py-6 bg-white">
                <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Detail FAQ</p>
                <form wire:submit.prevent="update" class="text-sm text-gray-700">
                    <div class="mb-3">
                        <x-label-input for="pertanyaan2">Pertanyaan</x-label-input>
                        <x-textarea cols="30" rows="6" wire:model.defer="pertanyaan" id="pertanyaan2"
                            disabled="{{ !$canUpdate }}" />
                        <x-error-input name="pertanyaan" />
                    </div>

                    <div class="mb-3">
                        <x-label-input for="jawaban2">Jawaban</x-label-input>
                        <x-textarea name="jawaban" wire:model.defer="jawaban" id="jawaban2" cols="30"
                            rows="10" disabled="{{ !$canUpdate }}">
                        </x-textarea>
                        <x-error-input name="jawaban" />
                    </div>

                    <div class="flex justify-end mt-4">
                        <div wire:loading.remove wire:target="update">
                            <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                type="button" x-on:click="showModalDetail = false">
                                Batal
                            </x-button>
                            @can(PERMISSION_UPDATE_FAQ)
                                <x-button class="uppercase rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 text-md"
                                    type="submit">
                                    Simpan Perubahan
                                </x-button>
                            @endcan
                        </div>

                        <div wire:loading wire:target="update" class="text-xs italic text-gary-600">
                            Sedang memproses. Harap menunggu ..
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
</div>
