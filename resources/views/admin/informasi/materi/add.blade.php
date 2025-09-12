<div>
    <div x-data="{ isModalOpen: @entangle('isModalOpen').live }">
        <x-button class="uppercase rounded-full opacity-100 bg-coklat-1 hover:bg-base-brown-600 whitespace-nowrap"
            type="button" x-on:click="isModalOpen = true">
            Tambah Materi
        </x-button>
        <div x-cloak x-show="isModalOpen">
            <x-modal>
                <div class="px-5 py-6 bg-white">
                    <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Materi</p>
                    <form wire:submit="submit" class="text-sm text-gray-700" enctype="multipart/form-data">
                        <div class="mb-3">
                            <x-label-input for="title">Judul Materi</x-label-input>
                            <x-input type="text" class="w-full" wire:model="title" id="title" />
                            <x-error-input name="title" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="publish_datetime">Tanggal Publish</x-label-input>
                            <x-date-input wire:model="publish_datetime" id="publish_datetime"
                                name="publish_datetime" x-ref="addDate" />
                            <x-error-input name="publish_datetime" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="link">Link Materi</x-label-input>
                            <x-textarea name="link" wire:model="link" id="link" cols="30"
                                rows="8">
                            </x-textarea>
                            <x-error-input name="link" />
                        </div>

                        <small class="text-xs italic text-gray-600">Silakan filenya disimpan di google drive dan
                            copykan linknya</small>

                        <div class="flex justify-end mt-4">
                            <div wire:loading.remove wire:target="submit">
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                    type="button" wire:click="closeModal">
                                    Batal
                                </x-button>
                                <x-button class="uppercase rounded-3xl bg-coklat-2 hover:bg-coklat-hover text-md"
                                    type="submit" wire:loading.remove wire:target="fileUpload">
                                    Tambah Materi
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
