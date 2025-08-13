<div class="flex justify-between py-1 items-center">
    <x-label-input for="content" class="mr-2">Foto Diri dengan Atribute Lengkap</x-label-input>
    <div>
        @if ($fotoAtribute)
        <?php
            try {
                $urlAtribute = $fotoAtribute->temporaryUrl();
                $statusFotoAtribute = true;
            }catch (RuntimeException $exception){
                $statusFotoAtribute = false;
            }
        ?>
        @if ($statusFotoAtribute)
        <p wire:click="$set('fotoAtribute', null)"
            class="mr-1 inline-block bg-base-red-500 text-base-white py-1 px-3 whitespace-nowrap cursor-pointer hover:bg-base-red-600 rounded-md text-xs">
            Hapus
        </p>

        <a target="_blank" href="{{ $urlAtribute }}"
            class="mr-2 bg-base-blue-500 text-base-white py-1 px-3 cursor-pointer whitespace-nowrap hover:bg-base-blue-600 rounded-md text-xs">
            Preview
        </a>
        @endif
        @endif

        <label for="fotoAtribute"
            class="bg-base-grey-600 text-base-blue-600 py-1 px-3 cursor-pointer hover:bg-base-green-400 rounded-md text-xs whitespace-nowrap">Pilih
            Foto</label>

        <div wire:loading wire:target="fotoAtribute" class="text-xs text-gray-500">Uploading...
        </div>

        <input type="file" wire:model="fotoAtribute" id="fotoAtribute" class="hidden">
    </div>
</div>
