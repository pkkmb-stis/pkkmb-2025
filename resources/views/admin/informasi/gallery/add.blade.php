<div>
    <div x-data="{ isModalOpen: @entangle('isModalOpen') }">
        <x-button class="uppercase rounded-full opacity-100 bg-coklat-1 hover:bg-base-brown-600 whitespace-nowrap"
            type="button" x-on:click="isModalOpen = true">
            Tambah Gallery
        </x-button>
        <div x-cloak x-show="isModalOpen">
            <x-modal maxWidth="max-w-4xl">
                <div class="px-5 py-6 bg-white">
                    <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Gallery</p>
                    <form wire:submit.prevent="submit" class="text-sm text-gray-700">
                        <div class="grid sm:grid-cols-2 sm:gap-6">
                            <div class="mb-3">
                                <x-label-input for="title">Judul</x-label-input>
                                <x-input type="text" class="w-full" wire:model.defer="title" id="title" />
                                <x-error-input name="title" />
                            </div>

                            <div class="mb-3">
                                <x-label-input for="category">Kategori</x-label-input>
                                <x-select-form wire:model.lazy="category" id="category">
                                    <option value="0">Pilih Kategori</option>
                                    <option value="1">Foto</option>
                                    <option value="2">Video</option>
                                </x-select-form>
                                <x-error-input name="category" />
                            </div>
                        </div>

                        @if ($category)
                            <div class="grid sm:grid-cols-2 sm:gap-6">
                                <div class="mb-3">
                                    @if ($category == CATEGORY_GALLERY_FOTO)
                                        <div class="mx-auto">
                                            <x-label-input for="file" class="flex justify-center cursor-pointer">
                                                @if ($file)
                                                    <?php
                                                    try {
                                                        $url = $file->temporaryUrl();
                                                        $status = true;
                                                    } catch (RuntimeException $exception) {
                                                        $status = false;
                                                    }
                                                    ?>
                                                    @if ($status)
                                                        <img src="{{ $url }}" alt="Foto">
                                                    @endif
                                                @else
                                                    <img src="https://dummyimage.com/300x300/15a19c/ffffff.png&text=Upload"
                                                        alt="Foto">
                                                @endif
                                            </x-label-input>
                                            <input type="file" class="hidden" id="file" wire:model="file">
                                            <x-error-input name="file" />
                                            <div wire:loading wire:target="file" class="text-xs text-gray-500">
                                                Uploading...
                                            </div>
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <x-label-input for="link">Link Embbed Youtube</x-label-input>
                                            <x-textarea name="link" wire:model.defer="link" id="link"
                                                cols="30" rows="8">
                                            </x-textarea>
                                            <x-error-input name="link" />
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    @if ($category == CATEGORY_GALLERY_FOTO)
                                        <div class="mb-3">
                                            <x-label-input for="event_id">Pilih Timeline</x-label-input>
                                            <x-select-form wire:model.defer="event_id" id="event_id">
                                                <option value="">Pilih Timeline</option>
                                                @foreach ($events as $event)
                                                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                                                @endforeach
                                            </x-select-form>
                                            <x-error-input name="event_id" />
                                        </div>

                                        <p class="text-xs text-gray-60">Sangat
                                            diharapkan ukuran file gambar yang diupload sudah dikecilkan terlebih
                                            dahulu.
                                            Batas
                                            ukuran file adalah 2MB</p>
                                    @else
                                        <div class="mb-3">
                                            <x-label-input for="urutan">Urutan di Gallery</x-label-input>
                                            <x-input type="number" class="w-full" wire:model.defer="urutan"
                                                id="urutan" min="0" />
                                            <x-error-input name="urutan" />
                                        </div>

                                        {{-- <div class="mb-3">
                                        <x-label-input for="caption">Caption</x-label-input>
                                        <x-textarea name="caption" wire:model.defer="caption" id="caption"
                                            cols="30" rows="6">
                                        </x-textarea>
                                        <x-error-input name="caption" />
                                    </div> --}}

                                    @endif
                                </div>
                            </div>
                        @endif


                        <div class="flex justify-end mt-4">
                            <div wire:loading.remove wire:target="submit">
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                    type="button" wire:click="resetAll">
                                    Batal
                                </x-button>
                                <x-button class="uppercase rounded-3xl bg-2025-1 hover:bg-coklat-hover text-md"
                                    type="submit" wire:loading.remove wire:target="file">
                                    Tambah Gallery
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
