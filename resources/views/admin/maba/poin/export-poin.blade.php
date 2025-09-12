<form wire:submit="export" class="text-sm text-gray-700">
    <span wire:loading="export" class="mx-2 italic align-middle">Sedang memproses..</span>
    <div wire:loading.remove wire:target="export">
        <x-button class="uppercase rounded-3xl text-coklat-1 bg-kuning-1 hover:bg-kuning-hover" type="submit">
            Download Rekap Poin
        </x-button>
    </div>
</form>
