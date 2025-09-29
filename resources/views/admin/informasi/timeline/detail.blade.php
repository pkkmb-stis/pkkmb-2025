<div x-data="{ showModalDetail: @entangle('showModalDetail') }">
    <div x-cloak x-show="showModalDetail">
        <x-modal>
            <div class="px-5 py-6 bg-white">
                <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Detail Timeline</p>
                <form wire:submit.prevent="update" class="text-sm text-gray-700">
                    <div class="mb-3">
                        <x-label-input for="title2">Judul</x-label-input>
                        <x-input type="text" class="w-full" wire:model.defer="title" id="title2"
                            disabled="{{ !$canUpdate }}" />
                        <x-error-input name="title" />
                    </div>

                    <div class="grid sm:grid-cols-2 sm:gap-6">
                        <div class="mb-3">
                            <x-label-input for="waktuMulai2">Waktu Mulai</x-label-input>
                            <x-date-input wire:model.defer="waktuMulai" id="waktuMulai2" name="waktuMulai"
                                disabled="{{ !$canUpdate }}" />
                            <x-error-input name="waktuMulai" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="waktuAkhir2">Waktu Akhir</x-label-input>
                            <x-date-input wire:model.defer="waktuAkhir" id="waktuAkhir2" name="waktuAkhir"
                                disabled="{{ !$canUpdate }}" />
                            <x-error-input name="waktuAkhir" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <x-label-input for="caption2">Deskripsi</x-label-input>
                        <x-textarea name="caption" wire:model.defer="caption" id="caption2" cols="30"
                            rows="8" disabled="{{ !$canUpdate }}">
                        </x-textarea>
                        <x-error-input name="caption" />
                    </div>

                    <div class="mb-3">
                        <x-label-input for="location2">Lokasi</x-label-input>
                        <x-input type="text" class="w-full" wire:model.defer="location" id="location2"
                            disabled="{{ !$canUpdate }}" />
                        <x-error-input name="location" />
                    </div>

                    <div class="mb-3">
                        <x-label-input for="link2">Link Galeri</x-label-input>
                        <x-input type="text" class="w-full" wire:model.defer="link_gallery" id="link2"
                            disabled="{{ !$canUpdate }}" />
                        <x-error-input name="link_gallery" />
                    </div>

                    <div class="flex justify-end mt-4">
                        <div wire:loading.remove wire:target="update">
                            <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                type="button" x-on:click="showModalDetail = false">
                                Batal
                            </x-button>
                            @can(PERMISSION_UPDATE_TIMELINE)
                                <x-button class="uppercase rounded-3xl bg-2025-2 hover:bg-2025-1 text-md"
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
