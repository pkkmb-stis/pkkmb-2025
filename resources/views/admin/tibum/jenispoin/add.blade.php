<div>
    <div x-data="{isModalOpen : false, showTipe: false,}">
        <x-button class="rounded-3xl bg-coklat-1 hover:bg-base-brown-600 uppercasee" type="button" x-on:click="isModalOpen = true">
            Tambah Jenis Poin
        </x-button>
        <div x-cloak x-show="isModalOpen">
            <x-modal>
                <div class="px-5 py-6 bg-white">
                    <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Jenis Poin</p>
                    <form wire:submit.prevent="submit" class="text-sm text-gray-700">
                        <div class="mb-3">
                            <x-label-input for="nama">Nama Poin</x-label-input>
                            <x-input type="text" class="w-full" wire:model.defer="nama" />
                            <x-error-input name="nama" />
                        </div>
                        <div class="mb-3">
                            <x-label-input for="category">Tipe Poin</x-label-input>
                            <x-select-form name="category" wire:model.lazy="category"
                                @change='showTipe = ($el.value == {{CATEGORY_JENISPOIN_PENEBUSAN}})'>
                                <option class="hidden" selected>Pilih Kategori Poin</option>
                                @foreach (MAP_CATEGORY['jenis_poin'] as $i => $c)
                                <option value="{{$i}}">{{$c}}</option>
                                @endforeach
                            </x-select-form>
                            <x-error-input name="category" />
                        </div>

                        <div x-show='showTipe' class="mb-3">
                            <x-label-input for="type">Tipe Penebusan</x-label-input>
                            <x-select-form name="type" wire:model="type">
                                <option class="hidden" selected>Pilih Tipe Penebusan...</option>
                                @foreach (MAP_CATEGORY['tipe_poin'] as $i => $t)
                                <option value="{{$i}}">{{$t}}</option>
                                @endforeach
                            </x-select-form>
                            <x-error-input name="type" />
                        </div>
                        <div class="w-full mb-3" x-show="$wire.category == {{CATEGORY_JENISPOIN_PELANGGARAN}}">
                            <x-input id="is_bintang" class="cursor-pointer" type="checkbox" class="" wire:model.defer="is_bintang" />
                            <span>
                                <label for="is_bintang" class="cursor-pointer">Pelanggaran per elemen</label>
                            </span>
                        </div>
                        <div class="mb-3">
                            <x-label-input for="poin">Poin</x-label-input>
                            <x-input type="number" class="w-full" min="0" wire:model="poin" />
                        </div>
                        <div class="mb-3">
                            <x-label-input for="detail">Detail Jenis Poin</x-label-input>
                            <x-textarea name="detail" wire:model.defer="detail" cols="30" rows="6">
                            </x-textarea>
                        </div>
                        <div class="w-full mb-3" x-show="$wire.category == {{CATEGORY_JENISPOIN_PELANGGARAN}}">
                            <x-label-input for="alasan_template">Template Alasan</x-label-input>
                            <x-textarea name="alasan_template" wire:model.defer="alasan_template" cols="30" rows="6">
                            </x-textarea>
                        </div>
                        <div class="flex justify-end mt-4">
                            <div wire:loading.remove wire:target="submit">
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
                                    @click="isModalOpen=false" wire:click="closeModal">
                                    Tutup
                                </x-button>
                                <x-button class="uppercase rounded-3xl bg-2025-1 hover:bg-coklat-hover text-md" type="submit">
                                    Tambah Jenis Poin
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
