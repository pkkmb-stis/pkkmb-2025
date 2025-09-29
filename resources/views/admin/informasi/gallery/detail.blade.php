<div x-data="{ showDetailGallery: @entangle('showDetailGallery') }">
    @if ($gallery)
        <div x-cloak x-show="showDetailGallery">
            <x-modal maxWidth="max-w-4xl">
                <div class="px-5 py-6 bg-white">
                    <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Edit
                        {{ getCategoryGallery($gallery->category) }}</p>

                    <form wire:submit.prevent="update" class="text-sm text-gray-700">
                        <div class="grid sm:grid-cols-2 sm:gap-6">
                            <div class="mb-3">
                                <x-label-input for="title">Judul</x-label-input>
                                <x-input type="text" class="w-full" wire:model.defer="title"
                                    disabled="{{ !$canUpdate }}" />
                                <x-error-input name="title" />
                            </div>
                            @if ($gallery->category == CATEGORY_GALLERY_FOTO)
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
                            @else
                                <div class="mb-3">
                                    <x-label-input for="urutan">Urutan di Home</x-label-input>
                                    <x-input type="number" class="w-full" wire:model.defer="urutan" min="0"
                                        disabled="{{ !$canUpdate }}" />
                                    <x-error-input name="urutan" />
                                </div>
                            @endif
                        </div>


                        <div class="grid sm:grid-cols-2 sm:gap-6">
                            <div class="mb-3">
                                @if ($gallery->category == CATEGORY_GALLERY_FOTO)
                                    <div class="mx-auto">
                                        <div for="file" class="flex justify-center cursor-pointer">
                                            <img src="{{ $gallery->filename }}" alt="Foto">
                                        </div>
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <x-label-input for="filename">Link Embbed Youtube</x-label-input>
                                        <x-textarea name="filename" wire:model.defer="filename" cols="30"
                                            rows="8" disabled="{{ !$canUpdate }}">
                                        </x-textarea>
                                        <x-error-input name="filename" />
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- <p class="text-xs text-gray-60">Jika tidak ingin ditampilkan di home maka biarkan
                            urutannya terisi 0</p> --}}

                        {{-- <div class="mb-3">
              <x-label-input for="caption">Caption</x-label-input>
              <x-textarea name="caption" wire:model.defer="caption" id="caption" cols="30" rows="6"
                disabled="{{ !$canUpdate }}">
              </x-textarea>
              <x-error-input name="caption" />
            </div> --}}


                        <div class="flex justify-end mt-4">
                            <div wire:loading.remove wire:target="update">
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                    type="button" x-on:click="showDetailGallery = false">
                                    Batal
                                </x-button>

                                @can(PERMISSION_UPDATE_GALLERY)
                                    <x-button
                                        class="uppercase rounded-3xl bg-2025-2 hover:bg-2025-1 text-md"
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
    @endif
</div>
