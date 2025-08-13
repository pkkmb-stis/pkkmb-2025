<div>
  <div x-data="{ addmodal: false }">
    <x-button class="ml-1 uppercase rounded-full opacity-100 bg-coklat-1 hover:bg-base-brown-600" type="button"
      x-on:click="addmodal = true; slimJenisPoin.set([])">
      Tambah Poin
    </x-button>
    <div x-cloak x-show="addmodal">
      <x-modal maxWidth="max-w-4xl">
        <div class="px-5 py-6 bg-white">
          <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Poin</p>
          <form wire:submit.prevent="submit" class="text-sm text-gray-700">

            <div class="mb-3">
              <x-label-input for="selectusers">Pilih Maba/Panitia</x-label-input>
              <div wire:ignore>
                <x-select-multi x-on:change="set($el,'users')" x-init="initSlimUsers" id='selectusers' name="users[]"
                  multiple="multiple">
                  @foreach ($allMaba->groupBy('kelompok.nama') as $kelompok => $maba)
                    <optgroup label="{{ ucwords($kelompok) }}">
                      @foreach ($maba as $m)
                        <option value="{{ $m->id }}">{{ $m->name }} |
                          {{ $m->nimb ?? '-' }}</option>
                      @endforeach
                    </optgroup>
                  @endforeach
                  <optgroup label="Panitia">
                    @foreach ($allPanitia as $panitia)
                      <option value="{{ $panitia->id }}">{{ $panitia->name }} |
                        {{ $panitia->username }}</option>
                    @endforeach
                  </optgroup>
                </x-select-multi>
              </div>
              <x-error-input name="users" />
            </div>

            <div class="mb-3">
              <x-label-input for="jenispoin">Jenis Poin</x-label-input>
              <div wire:ignore>
                <select id="jenisPoinSelect" class="w-full" wire:model.lazy="jenispoin">
                  <option class="hidden" selected>Pilih jenis poin...</option>
                  @foreach ($jenispoins as $j)
                    <option value="{{ $j->category * 1000 + $j->id }}">
                      {{ MAP_CATEGORY['jenis_poin'][$j->category] . ' ' . $j->nama }}
                    </option>
                  @endforeach
                </select>
              </div>
              <x-error-input name="jenispoin" />
            </div>

            <div class="grid lg:grid-cols-2 lg:gap-6">
              <div class="mb-3">
                <x-label-input for="poin">Poin</x-label-input>
                <x-jet-input type="number" class="w-full" wire:model.defer="poin" />
                <x-error-input name="poin" />
              </div>
              <div class="mb-3">
                <x-label-input for="urutan_input">Waktu Terkena Poin</x-label-input>
                <x-date-input wire:model.defer="urutan_input" id="urutan_input" name="urutan_input" x-ref="addDate" />
                <x-error-input name="urutan_input" />
                <span class="mt-1 text-xs italic text-gray-400">
                  Akan digunakan tanggal dan waktu ini untuk perhitungan poin. Jika dikosongkan maka
                  akan
                  otomatis bernilai waktu ketika form disubmit
                </span>
              </div>
            </div>

            <div class="mb-3">
              <x-label-input for="alasan">Alasan Pemberian Poin</x-label-input>
              <x-textarea name="alasan" wire:model.defer="alasan" cols="30" rows="8"></x-textarea>
              <x-error-input name="alasan" />
            </div>

            <div class="mb-3"
              x-show="
                          $wire.jenispoin > {{ CATEGORY_JENISPOIN_PELANGGARAN * 1000 }} &&
                          $wire.jenispoin < {{ (CATEGORY_JENISPOIN_PELANGGARAN + 1) * 1000 }}">
              <x-label-input for="image">Upload Bukti</x-label-input>
              <small class="block">Opsional (Jika ada bukti)</small>
              @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="w-64 h-auto my-2">
              @endif
              <input type="file" name="image" id="{{ $rand }}" accept="image/*" wire:model.defer="image"
                style="border: 1px solid #ccc; padding: 5px; border-radius:5px">
              <x-error-input name="image" />
              <div wire:loading wire:target="image" class="mt-1 text-lg text-green-600 bold">Uploading...
              </div>
              <span class="block mt-1 text-xs italic text-gray-400">
                Maksimal ukuran gambar adalah 2 MB
              </span>
            </div>

            <div class="flex justify-end mt-4">
              <div wire:loading.remove wire:target="submit">
                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
                  x-on:click='addmodal = false' wire:click="resetAll">
                  Tutup
                </x-button>
                <x-button class="uppercase rounded-3xl bg-coklat-2 hover:bg-coklat-hover text-md" type="submit">
                  Tambah Poin
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

  @push('script-bottom')
    <script>
      Livewire.on('resetSlim', () => {
        slimUsers.set([]);
      })

      const set = (el, param) => {
        @this.set(param, Array.prototype.map.call(el.selectedOptions, (x) => x.value));
      }

      let slimUsers;
      const initSlimUsers = () => {
        slimUsers = new SlimSelect({
          select: '#selectusers',
          closeOnSelect: false,
          hideSelectedOption: true,
          searchingText: 'Sedang mencari...',
          searchPlaceholder: 'Cari berdasarkan nim panitia atau nimb maba ..',
          placeholder: 'Maba atau Panitia',
          selectByGroup: true
        });
      };

      let slimJenisPoin;
      document.addEventListener('DOMContentLoaded', function() {
        slimJenisPoin = new SlimSelect({
          select: '#jenisPoinSelect',
          searchingText: 'Sedang mencari...',
          searchPlaceholder: 'Cari jenis poin...',
          placeholder: 'Pilih jenis poin...',
        });
      });
    </script>
  @endpush
</div>
