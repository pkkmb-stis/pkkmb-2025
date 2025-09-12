<div class="flex justify-between py-1 items-center">
    <x-label-input for="content" class="mr-2">Foto Perlengkapan Harian</x-label-input>
    <div>
        @if ($fotoPerlengkapan)
        <?php
            try {
                $urlPerlengkapan = $fotoPerlengkapan->temporaryUrl();
                $statusFotoPerlengkapan = true;
            }catch (RuntimeException $exception){
                $statusFotoPerlengkapan = false;
            }
        ?>
        @if ($statusFotoPerlengkapan)
        <p wire:click="$set('fotoPerlengkapan', null)"
            class="mr-1 inline-block bg-base-red-500 text-white py-1 px-3 cursor-pointer whitespace-nowrap hover:bg-base-red-600 rounded-md text-xs">
            Hapus
        </p>
        <a target="_blank" href="{{ $urlPerlengkapan }}"
            class="mr-2 bg-base-blue-500 text-white py-1 px-3 cursor-pointer whitespace-nowrap hover:bg-base-blue-600 rounded-md text-xs">
            Preview
        </a>
        @endif
        @endif

        <label for="fotoPerlengkapan"
            class="bg-base-grey-500 text-base-blue-600 py-1 px-3 cursor-pointer whitespace-nowrap hover:bg-base-grey-600 rounded-md text-xs">Pilih
            Foto</label>

        <div wire:loading wire:target="fotoPerlengkapan" class="text-xs text-gray-500">Uploading...
        </div>

        <input type="file" wire:model.live="fotoPerlengkapan" id="fotoPerlengkapan" class="hidden">
    </div>
</div>
