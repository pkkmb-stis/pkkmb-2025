<div>
  <div x-data="{ isModalOpen: @entangle('isModalOpen') }">
    <x-button class="ml-2 uppercase rounded-full opacity-100 bg-coklat-1 hover:bg-base-brown-600" type="button"
      x-on:click="isModalOpen = true">
      Tambah User
    </x-button>
    <div x-cloak x-show="isModalOpen">
      <x-modal>
        <div class="px-5 py-6 bg-white">
          <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah User</p>
          <form wire:submit.prevent="submit" class="text-sm text-gray-700">
            <div class="mb-3">
              <x-label-input for="nim">NIM</x-label-input>
              <x-input type="text" class="w-full" wire:model.defer="nim" id="nim" />
              <x-error-input name="nim" />
            </div>

            <div class="mb-3">
              <x-label-input for="nama">Nama</x-label-input>
              <x-input type="text" class="w-full" wire:model.defer="nama" id="nama" />
              <x-error-input name="nama" />
            </div>

            <div class="mb-3">
              <x-label-input for="email">Email</x-label-input>
              <x-input type="email" class="w-full" wire:model.defer="email" id="email" />
              <x-error-input name="email" />
            </div>

            <div class="mb-3">
              <x-label-input for="password">Password</x-label-input>
              <x-input type="password" class="w-full" wire:model.defer="password" id="password" />
              <x-error-input name="password" />
            </div>

            <div class="flex justify-end mt-4">
              <div wire:loading.remove wire:target="submit">
                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
                  wire:click="closeModal">
                  Batal
                </x-button>
                <x-button class="uppercase rounded-3xl bg-coklat-2 hover:bg-coklat-hover text-md" type="submit">
                  Tambah User
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
