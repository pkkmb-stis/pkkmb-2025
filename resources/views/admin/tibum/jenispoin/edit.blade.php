<div x-cloak x-show="openedit">
    <x-modal>
        <div class="px-5 py-6 bg-white">
            <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Edit Jenis Poin</p>
            <form wire:submit.prevent="update">
                <div class="mb-3">
                    <x-label-input for="nama">Nama Poin</x-label-input>
                    <x-input type="text" class="w-full" wire:model.defer="nama" />
                    <x-error-input name="nama" />
                </div>
                <div class="mb-3">
                    <x-label-input for="category">Tipe Poin</x-label-input>
                    <x-select-form name="category" wire:model.lazy="category">
                        @foreach (MAP_CATEGORY['jenis_poin'] as $i => $c)
                        <option value="{{$i}}">{{$c}}</option>
                        @endforeach
                    </x-select-form>
                    <x-error-input name="category" />
                </div>
                <div class="mb-3" x-show="$wire.category == {{CATEGORY_JENISPOIN_PENEBUSAN}}">
                    <x-label-input for="type">Tipe Penebusan</x-label-input>
                    <x-select-form name="type" wire:model="type">
                        @foreach (MAP_CATEGORY['tipe_poin'] as $i => $t)
                        <option value="{{$i}}">{{$t}}</option>
                        @endforeach
                    </x-select-form>
                    <x-error-input name="type" />
                </div>
                <div class="mb-3" x-show="$wire.category == {{CATEGORY_JENISPOIN_PELANGGARAN}}">
                    <x-input id="edit_is_bintang" class="cursor-pointer" type="checkbox" wire:model.defer="is_bintang" />
                    <span>
                        <label for="edit_is_bintang" class="cursor-pointer">Pelanggaran per elemen</label>
                    </span>
                </div>
                <div class="mb-3">
                    <x-label-input for="poin">Poin</x-label-input>
                    <x-input type="number" class="w-full" wire:model.defer="poin" />
                </div>
                <div class="mb-3">
                    <x-label-input for="detail">Detail Jenis Poin</x-label-input>
                    <x-textarea name="detail" wire:model.defer="detail" cols="30" rows="6">
                    </x-textarea>
                </div>
                <div class="mb-3" x-show="$wire.category == {{CATEGORY_JENISPOIN_PELANGGARAN}}">
                    <x-label-input for="alasan_template">Template Alasan</x-label-input>
                    <x-textarea name="alasan_template" wire:model.defer="alasan_template" cols="30" rows="6">
                    </x-textarea>
                </div>
                <div class="flex justify-end mt-4">
                    <div wire:loading.remove wire:target="update">
                        <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
                            @click="openedit=false" wire:click="resetAll">
                            Batal
                        </x-button>
                        <x-button class="uppercase rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 text-md" type="submit">
                            Edit Jenis Poin
                        </x-button>
                    </div>

                    <div wire:loading wire:target="update" class="text-xs italic text-gary-600">
                        Sedang memproses. Harap menunggu ..
                    </div>
                </div>
            </form>
        </div>
    </x-modal>
</div>
