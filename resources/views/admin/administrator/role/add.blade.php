<div x-data="{isModalOpen : @entangle('isModalOpen')}">
    <x-button class="ml-2 uppercase rounded-3xl bg-coklat-1 hover:bg-base-brown-600" type="button" x-on:click="isModalOpen = true">
        Tambah Role
    </x-button>
    <div x-cloak x-show="isModalOpen">
        <x-modal>
            <div class="px-4 py-6 bg-white">
                <h5 class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Role</h5>
                <div class="text-sm text-gray-700">
                    <form wire:submit.prevent="addRole">
                        <div class="mb-3">
                            <x-label-input for="name">Nama Role</x-label-input>
                            <x-input type="text" class="w-full" wire:model.defer="name" id="name" />
                            <x-error-input name="name" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="description">Deskripsi</x-label-input>
                            <textarea rows="3" wire:model.defer="description"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-base-brown-300 focus:ring focus:ring-base-brown-200 focus:ring-opacity-50"></textarea>
                            <x-error-input name="description" />
                        </div>

                        <div class="flex justify-end mt-4">
                            <div wire:loading.remove wire:target="addRole">
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
                                    x-on:click="isModalOpen = false">
                                    Batal
                                </x-button>
                                <x-button class="uppercase rounded-3xl bg-2025-1 hover:bg-coklat-hover text-md" type="submit">
                                    Tambah Role
                                </x-button>
                            </div>

                            <div wire:loading wire:target="addRole" class="text-xs italic text-gary-600">
                                Sedang memproses. Harap menunggu ..
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </x-modal>
    </div>
</div>
