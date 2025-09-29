<x-card>
    <form wire:submit.prevent="submit">
        <div class="text-sm text-gray-700">
            <div class="grid sm:grid-cols-2 sm:gap-6">
                <div class="mb-3">
                    <label for="judul" class="block mb-1 font-bold">Judul</label>
                    <x-input type="text" class="w-full" wire:model.defer="judul" id="judul" />
                    <x-error-input name="judul" />
                </div>

                <div class="mb-3">
                    <label for="penulis" class="block mb-1 font-bold">Penulis</label>
                    <x-input type="text" class="w-full" wire:model.defer="penulis" id="penulis" />
                    <x-error-input name="penulis" />
                </div>
            </div>

            <div class="grid sm:grid-cols-2 sm:gap-6">
                <div class="mb-3">
                    <label for="hastags" class="block mb-1 font-bold">Hastags</label>
                    <x-input type="text" class="w-full" wire:model.defer="hastags" id="hastags" />
                </div>

                <div class="mb-3">
                    <x-label-input for="waktuPublish">Waktu Publish</x-label-input>
                    <x-date-input wire:model.defer="waktuPublish" id="waktuPublish" name="waktuPublish" />
                    <x-error-input name="waktuPublish" />
                </div>
            </div>

            <div class="grid sm:grid-cols-2 sm:gap-6">
                <div class="mb-3">
                    <label for="kategori" class="block mb-1 font-bold">Kategori</label>
                    <x-select-form wire:model.defer="kategori" id="kategori">
                        <option>Pilih Kategori</option>
                        <option value="{{ CATEGORY_BERITA_PRA_PKKMB }}">Pra PKKMB</option>
                        <option value="{{ CATEGORY_BERITA_MASA_PKKMB }}">Masa PKKMB</option>
                        <option value="{{ CATEGORY_BERITA_MASA_PKBN }}">Masa PKBN</option>
                        <option value="{{ CATEGORY_BERITA_PASCA_PKKMB }}">Inagurasi</option>
                    </x-select-form>
                    <x-error-input name="kategori" />
                </div>

                <div class="mb-3">
                    <x-label-input>Thumbnails</x-label-input>
                    @if ($thumbnails)
                        <?php
                        try {
                            $url = $thumbnails->temporaryUrl();
                            $status = true;
                        } catch (RuntimeException $exception) {
                            $status = false;
                        }
                        ?>
                        @if ($status)
                            <x-button class="mr-2 bg-yellow-500 rounded-3xl hover:bg-yellow-600" :tagA="true"
                                href="{{ $url }}" target="_blank">Preview
                            </x-button>
                        @endif
                    @endif

                    @if ($thumbnailsLama)
                        <x-button class="mr-2 bg-yellow-500 rounded-3xl hover:bg-yellow-600" :tagA="true"
                            href="{{ $thumbnailsLama }}" target="_blank">Preview
                        </x-button>
                    @endif

                    <x-button x-on:click="$refs.inputFile.click()" class="bg-green-500 rounded-3xl hover:bg-green-600"
                        type="button">Pilih File</x-button>

                    <input type="file" x-ref="inputFile" wire:model="thumbnails" class="hidden" id="thumbnails">
                    <x-error-input name="thumbnails" />

                    <div wire:loading wire:target="thumbnails" class="text-xs text-gray-500">Uploading...
                    </div>
                </div>
            </div>

            <div class="z-0">
                <div x-data="quillEditor()">
                    <input type="hidden" x-ref="input" wire:model.defer="konten">
                    <div wire:ignore>
                        <div x-ref="editor">{!! $konten !!}</div>
                    </div>
                </div>
                <x-error-input name="konten" />
            </div>

            <div class="flex justify-end mt-4">
                <div wire:loading.remove wire:target="submit">
                    <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
                        :tagA="true" href="{{ route('berita') }}">
                        Kembali
                    </x-button>
                    <x-button class="uppercase rounded-3xl bg-2025-2 hover:bg-2025-1 text-md"
                        type="submit" wire:loading.remove wire:target="thumbnails">
                        Simpan Berita
                    </x-button>
                </div>

                <div wire:loading wire:target="submit" class="text-xs italic text-gary-600">
                    Sedang memproses. Harap menunggu ..
                </div>
            </div>
        </div>
    </form>
</x-card>
