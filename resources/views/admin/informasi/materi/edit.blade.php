<div x-cloak x-show="openedit">
  <x-modal>
    <div class="px-5 py-6 bg-white">
      <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Edit Materi</p>
      <form wire:submit.prevent="update">
        <div class="mb-3">
          <x-label-input for="title">Judul Materi</x-label-input>
          <x-input wire:model.defer='title' value="{{ $title ?? '' }}" type="text" class="w-full" />
          <x-error-input name="title" />
        </div>

        <div class="mb-3">
          <x-label-input for="publish_datetime2">Tanggal Publish</x-label-input>
          <x-date-input wire:model.defer='publish_datetime' id='publish_datetime2' />
          <x-error-input name="publish_datetime" />
        </div>

        <div class="mb-3">
          <x-label-input for="link">Link Materi</x-label-input>
          <x-textarea name="link" wire:model.defer="link" id="link" cols="30" rows="8">
          </x-textarea>
          <x-error-input name="link" />
        </div>

        <small class="text-xs italic text-gray-600">Silakan filenya disimpan di google drive dan
          copykan linknya</small>

        <div class="flex justify-end mt-4">
          <div wire:loading.remove wire:target="update">
            <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
              x-on:click="openedit = false" wire:click="resetAll">
              Batal
            </x-button>
            <x-button class="uppercase rounded-3xl bg-2025-2 hover:bg-2025-1 text-md" type="submit">
              Ubah Materi
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
