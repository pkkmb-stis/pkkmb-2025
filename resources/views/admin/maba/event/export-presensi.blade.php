<div>
  <div x-data='{isModalOpen: false,}'>
    <x-button class="uppercase rounded-full text-coklat-1 bg-kuning-1 hover:bg-kuning-hover" type="button"
      @click="isModalOpen = true">
      Download Rekap Presensi
    </x-button>
    <div x-cloak x-show="isModalOpen">
      <x-modal maxWidth="max-w-4xl">
        <div class="px-5 py-6 bg-white">
          <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Rekap Presensi</p>
          <form wire:submit.prevent="export" class="text-sm text-gray-700">
            <div class="mb-3">
              <x-label-input for="selectacara">Pilih Acara</x-label-input>
              <div wire:ignore>
                <x-select-multi x-on:change="set($el,'events')" x-init="initSlim" id='selectacara' name="events[]"
                  multiple="multiple">
                  @foreach ($acara as $a)
                    <option value="{{ $a->id }}">{{ $a->title }} |
                      {{ $a->waktu_akhir ? formatDateIso($a->waktu_mulai) . ' WIB' : '-' }}</option>
                  @endforeach
                </x-select-multi>
              </div>
              <x-error-input name="events" />
            </div>
            <div style="height: 50px"></div>
            <div class="flex justify-end mt-4">
                <span wire:loading="export" class="mr-2 italic">Sedang memproses..</span>
                <div wire:loading.remove wire:target="export">
                    <x-button x-on:click="isModalOpen = false;slim.set([]);"
                        class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button">
                        Tutup
                    </x-button>
                    <x-button class="uppercase rounded-3xl bg-2025-2 hover:bg-2025-1 text-md" type="submit">
                        Download Rekap
                    </x-button>
                </div>
            </div>
          </form>
        </div>
      </x-modal>
      @push('script-bottom')
        <script>
          Livewire.on('resetSlim', () => {
            slim.set([]);
          })

          const set = (el, param) => {
            @this.set(param, Array.prototype.map.call(el.selectedOptions, (x) => x.value));
          }

          let slim;
          const initSlim = () => {
            slim = new SlimSelect({
              select: '#selectacara',
              closeOnSelect: true,
              hideSelectedOption: true,
              searchingText: 'Sedang mencari...',
              searchPlaceholder: 'Cari nama acara yang akan di rekap',
              placeholder: 'Presensi Acara yang akan di rekap',
            });
          };
        </script>
      @endpush
    </div>
  </div>
</div>
