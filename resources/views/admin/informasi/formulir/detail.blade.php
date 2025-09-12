<div x-data="{ showModalDetail: @entangle('showModalDetail').live }">
    <div x-cloak x-show="showModalDetail">
        <x-modal>
            <div class="px-5 py-6 bg-white">
                <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Detail Formulir</p>
                <form wire:submit="update" class="text-sm text-gray-700">
                    <div class="mb-3">
                        <x-label-input for="nama_formulir">Nama Formulir</x-label-input>
                        <x-textarea cols="30" rows="2" wire:model="nama_formulir" id="nama_formulir"
                            disabled="{{ !$canUpdate }}" />
                        <x-error-input name="nama_formulir" />
                    </div>

                    <div class="mb-3">
                        <x-label-input for="spreadsheet_id">Spreadsheet ID</x-label-input>
                        <x-textarea name="spreadsheet_id" wire:model="spreadsheet_id" id="spreadsheet_id"
                            cols="30" rows="2" disabled="{{ !$canUpdate }}">
                        </x-textarea>
                        <p class="text-xs">Share akses spreadsheet kepada
                            <span class="italic font-bold">form-pkkmb24@pkkmb24.iam.gserviceaccount.com</span>
                        </p>
                        <x-error-input name="spreadsheet_id" />
                    </div>

                    <div class="mb-3">
                        <x-label-input for="nama_sheet">Nama Sheet</x-label-input>
                        <x-textarea cols="30" rows="2" wire:model="nama_sheet" id="nama_sheet"
                            disabled="{{ !$canUpdate }}" />
                        <x-error-input name="nama_sheet" />
                    </div>

                    <div class="mb-3">
                        <x-label-input for="is_visible">Tampilkan</x-label-input>
                        <label class="flex">
                            <x-input type="checkbox" wire:model="is_visible" id="is_visible"
                                disabled="{{ !$canUpdate }}" />
                            <p class="ml-3 text-justify">Ya</p>
                        </label>
                        <x-error-input name="is_visible" />
                    </div>

                    <div class="mb-3">
                        <x-label-input for="search_range">Posisi Kolom NIMB</x-label-input>
                        <x-textarea cols="30" rows="2" wire:model="search_range" id="search_range"
                            disabled="{{ !$canUpdate }}" />
                        <x-error-input name="search_range" />
                    </div>

                    <div class="mb-3">
                        <x-label-input for="link_form">Link Form</x-label-input>
                        <x-textarea cols="30" rows="2" wire:model="link_form" id="link_form"
                            disabled="{{ !$canUpdate }}" />
                        <x-error-input name="link_form" />
                        <a href="https://s.stis.ac.id/IsiFormulir" target="_blank"
                            class="mt-2 text-sm text-blue-500 hover:underline">
                            Cara mendapatkan Posisi Kolom NIMB dan Spreadsheet ID
                        </a>
                    </div>

                    <div class="flex justify-end mt-4">
                        <div wire:loading.remove wire:target="update">
                            <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                type="button" x-on:click="showModalDetail = false">
                                Batal
                            </x-button>
                            @can(PERMISSION_UPDATE_FORMULIR)
                                <x-button class="uppercase rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 text-md"
                                    type="submit">
                                    Simpan Perubahan
                                </x-button>
                            @endcan
                        </div>

                        <div wire:loading wire:target="update" class="text-xs italic text-gray-600">
                            Sedang memproses. Harap menunggu ..
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
</div>
