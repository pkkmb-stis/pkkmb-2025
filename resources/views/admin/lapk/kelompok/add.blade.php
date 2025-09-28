<div>
  <div x-data="{ isModalOpen: @entangle('isModalOpen'), search: false }">
    <x-button class="ml-2 uppercase rounded-3xl bg-coklat-1 hover:bg-base-brown-600" type="button"
      x-on:click="isModalOpen = true">
      Tambah kelompok
    </x-button>
    <div x-cloak x-show="isModalOpen">
      <x-modal>
        <div class="px-5 py-6 bg-white">
          <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Kelompok</p>
          <div class="text-sm text-gray-700">

            <div class="mb-3">
              <label for="nama" class="block mb-1 font-bold">Nama Kelompok</label>
              <x-input type="text" class="w-full" wire:model.defer="nama" id="nama" />
              <x-error-input name="nama" />
            </div>

            <div class="mb-3">
              <label for="pendamping" class="block mb-1 font-bold">Pendamping Kelompok</label>
              <x-input type="text" wire:model="search" placeholder="Search user..." x-on:input="search = true"
                class="block w-full" />

              <ul x-show="search" x-on:click.away="search = false"
                class="absolute left-0 right-0 m-2 bg-white border border-gray-200 rounded-md shadow-sm">
                @forelse($users as $u)
                  <li wire:click="selectUser({{ $u }})" x-on:click="search = false"
                    class="px-4 py-2 cursor-pointer hover:bg-gray-200">
                    <p>{{ $u->name }} - <span class="italic">{{ $u->username }}</span> </p>
                  </li>
                @empty
                  <li class="px-4 py-2 italic">
                    <p>No user found</p>
                  </li>
                @endforelse
              </ul>

              <x-error-input name="pendamping" />
            </div>

            <div class="flex justify-end my-3">
              <div wire:loading.remove wire:target="addKelompok">
                <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600"
                  x-on:click="isModalOpen = false; search = false" wire:click="selectUser">
                  Batal
                </x-button>
                <x-button class="rounded-3xl bg-2025-1 hover:bg-coklat-hover" wire:click="addKelompok">
                  Tambah Kelompok
                </x-button>
              </div>
              <div wire:loading wire:target="addKelompok" class="text-xs italic text-gary-600">
                Sedang memproses. Harap menunggu ..
              </div>
            </div>
          </div>
        </div>
      </x-modal>
    </div>
  </div>
</div>
