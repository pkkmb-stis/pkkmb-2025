<div x-cloak x-show="openedit">
  <x-modal maxWidth="max-w-4xl">
    <div class="px-5 py-6 bg-white">
      <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Edit Materi</p>
      <form wire:submit.prevent="update">
        <div class="grid mb-8 sm:grid-cols-2 sm:gap-6 gap-y-6">
          <div>
            <div class="mb-3">
              <x-label-input for="title2">Judul Acara</x-label-input>
              <x-input type="text" class="w-full" wire:model.defer="title" id="title2" />
              <x-error-input name="title" />
            </div>

            <div class="mb-3">
              <label for="is_pasca2" class="block mb-1 font-bold">Rentang Acara</label>
              <x-select-form wire:model.defer="is_pasca" id="is_pasca2">
                <option>Pilih Rentang Acara</option>
                <option value="0">Masa PKKMB</option>
                <option value="1">Pasca PKKMB</option>
              </x-select-form>
              <x-error-input name="is_pasca" />
            </div>

            <div class="mb-3">
              <x-label-input for="caption">Keterangan Acara</x-label-input>
              <x-textarea name="caption" wire:model.defer="caption" id="caption2" cols="30" rows="8">
              </x-textarea>
              <x-error-input name="caption" />
            </div>
          </div>
          <div>

            <div class="mb-3">
              <x-label-input for="link2">Link Zoom Utama</x-label-input>
              <x-textarea wire:model.defer="link" id="link2" cols="30" rows="4"></x-textarea>
              <x-error-input name="link" />
            </div>

            <div class="mb-3">
              <x-label-input for="link3">Link Zoom Lambat</x-label-input>
              <x-textarea wire:model.defer="link_lambat" id="link3" cols="30" rows="4"></x-textarea>
              <x-error-input name="link_lambat" />
            </div>

            <div class="mb-3">
              <x-label-input for="waktu_mulai2">Tanggal Mulai Acara</x-label-input>
              <x-date-input wire:model.defer='waktu_mulai' id='waktu_mulai2' />
              <x-error-input name="waktu_mulai" />
            </div>

            <div class="mb-3">
              <x-label-input for="waktu_akhir2">Tanggal Akhir Acara</x-label-input>
              <x-date-input wire:model.defer='waktu_akhir' id='waktu_akhir2' />
              <x-error-input name="waktu_akhir" />
            </div>

          </div>
        </div>

        <div class="flex justify-end mt-4">
          <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
            wire:click="resetAll">
            Batal
          </x-button>
          <x-button class="uppercase rounded-3xl bg-coklat-2 hover:bg-coklat-hover text-md" type="submit">
            Ubah Acara
          </x-button>
        </div>
      </form>
    </div>
  </x-modal>
</div>
