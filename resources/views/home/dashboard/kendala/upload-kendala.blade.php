<div class="flex justify-between py-1 items-center">
    <x-label-input for="content" class="mr-2">Foto Kendala</x-label-input>
    <div>
        @if ($fotoKendala)
        <?php
            try {
                $urlKendala = $fotoKendala->temporaryUrl();
                $statusFotoKendala = true;
            }catch (RuntimeException $exception){
                $statusFotoKendala = false;
            }
        ?>
        @if ($statusFotoKendala)
        <p wire:click="$set('fotoKendala', null)"
            class="mr-1 inline-block bg-base-red-500 text-white py-1 px-3 cursor-pointer whitespace-nowrap hover:bg-base-red-600 rounded-md text-xs">
            Hapus
        </p>
        <a target="_blank" href="{{ $urlKendala }}"
            class="mr-2 bg-base-blue-500 text-white py-1 px-3 cursor-pointer whitespace-nowrap hover:bg-base-blue-600 rounded-md text-xs">
            Preview
        </a>
        @endif
        @endif

        <label for="fotoKendala"
            class="bg-base-grey-500 text-base-blue-600 py-1 px-3 cursor-pointer whitespace-nowrap hover:bg-base-grey-600 rounded-md text-xs">Pilih
            Foto</label>

        <div wire:loading wire:target="fotoKendala" class="text-xs text-gray-500">Uploading...
        </div>

        <input type="file" wire:model="fotoKendala" id="fotoKendala" class="hidden">
    </div>
</div>
