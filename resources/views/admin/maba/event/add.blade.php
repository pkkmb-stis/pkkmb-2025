<div>
  <div x-data="{ isModalOpen: @entangle('isModalOpen').live }">
    <x-button class="ml-2 uppercase rounded-full opacity-100 bg-coklat-1 hover:bg-base-brown-600" type="button"
      x-on:click="isModalOpen = true">
      Tambah Acara
    </x-button>
    <div x-cloak x-show="isModalOpen">
      <x-modal maxWidth="max-w-4xl">
        <div class="px-5 py-6 bg-white">
          <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Acara</p>
          <form wire:submit="submit" class="text-sm text-gray-700">
            <div class="grid mb-8 sm:grid-cols-2 sm:gap-6 gap-y-6">
              <div>
                <div class="mb-3">
                  <x-label-input for="title">Judul Acara</x-label-input>
                  <x-input type="text" class="w-full" wire:model="title" id="title" />
                  <x-error-input name="title" />
                </div>

                <div class="mb-3">
                  <x-label-input for="is_pasca">Rentang Acara</x-label-input>
                  <x-select-form wire:model="is_pasca" id="is_pasca">
                    <option>Pilih Rentang Acara</option>
                    <option value="0" selected>Masa PKKMB</option>
                    <option value="1">Pasca PKKMB</option>
                  </x-select-form>
                  <x-error-input name="is_pasca" />
                </div>

                <div class="mb-3">
                  <x-label-input for="caption">Keterangan Acara</x-label-input>
                  <x-textarea name="caption" wire:model="caption" id="caption" cols="30" rows="8">
                  </x-textarea>
                  <x-error-input name="caption" />
                </div>
              </div>
              <div>
                <div class="mb-3">
                  <x-label-input for="link">Link Zoom Utama</x-label-input>
                  <x-textarea name="link" wire:model="link" id="link" cols="30" rows="4">
                  </x-textarea>
                  <x-error-input name="link" />
                </div>

                <div class="mb-3">
                  <x-label-input for="link_lambat">Link Zoom Lambat</x-label-input>
                  <x-textarea name="link_lambat" wire:model="link_lambat" id="link_lambat" cols="30"
                    rows="4">
                  </x-textarea>
                  <x-error-input name="link_lambat" />
                </div>

                <div class="mb-3">
                  <x-label-input for="waktu_mulai">Waktu Mulai Absensi</x-label-input>
                  <x-date-input wire:model="waktu_mulai" id="waktu_mulai" name="waktu_mulai" />
                  <x-error-input name="waktu_mulai" />
                </div>

                <div class="mb-3">
                  <x-label-input for="waktu_akhir">Waktu Akhir Absensi</x-label-input>
                  <x-date-input wire:model="waktu_akhir" id="waktu_akhir" name="waktu_akhir" />
                  <x-error-input name="waktu_akhir" />
                </div>
              </div>
            </div>

            <div class="flex justify-end mt-4">
              <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
                wire:click="closeModal">
                Batal
              </x-button>
              <x-button class="uppercase rounded-3xl bg-coklat-2 hover:bg-coklat-hover text-md" type="submit">
                Tambah Acara
              </x-button>
            </div>
          </form>
        </div>
      </x-modal>
    </div>
  </div>
</div>
