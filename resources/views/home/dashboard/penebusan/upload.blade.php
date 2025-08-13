<div x-data="{ openedit: @entangle('openedit'), isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
  x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
  x-on:livewire-upload-progress="progress = $event.detail.progress">

  <div x-cloak x-show="openedit">
    @if ($selected)
      <x-modal>
        <div class="px-5 py-6 bg-white">
          <div class="mb-4">
            <h5 class="font-poppins font-semibold">Penebusan {{ $selected->jenispoin->nama }}</h5>
            <p class="text-xs text-gray-500">
              File maksimal <b>2MB</b>. Prioritaskan file dalam bentuk pdf tapi jika file lebih dari 1
              maka
              gunakan format zip
            </p>
          </div>

          <form wire:submit.prevent="update">
            <div class="mb-3">
              @if ($file)
                <?php
                try {
                    $urlAtribute = $file->temporaryUrl();
                    $statusFile = true;
                } catch (RuntimeException $exception) {
                    $statusFile = false;
                }
                ?>
              @endif

              <div class="flex items-center">
                <label for="fileUpload"
                  class="bg-base-blue-500 text-white py-1 px-3 cursor-pointer hover:bg-base-blue-600 rounded-md text-xs">Pilih
                  File</label>

                @if ($file && $statusFile)
                  <a href="{{ $urlAtribute }}"
                    class="bg-base-grey-500 text-white py-1 px-3 ml-2 cursor-pointer hover:bg-base-grey-600 rounded-md text-xs"
                    download>Preview</a>
                @endif
              </div>


              <input type="file" wire:model="file" id="fileUpload" class="hidden">
              <x-error-input name="file" />

              <div x-show="isUploading">
                <img wire:loading src="{{ asset('/img/icon/loading-ring-bg-white.svg') }}" class="h-10 my-0"
                  alt="">
                Uploading: <span x-text="progress"></span>%
              </div>


            </div>

            <div class="flex justify-end mt-4">
              <x-button class="bg-gray-500 hover:bg-gray-600 uppercase text-md mr-2" type="button"
                x-on:click="openedit = false" wire:click="resetAll">
                Batal
              </x-button>

              <x-button class="bg-sky-500 hover:bg-sky-600 uppercase text-md" type="submit" wire:loading.remove
                wire:target="file">
                Simpan
              </x-button>
            </div>

          </form>
        </div>
      </x-modal>
    @endif
  </div>

</div>
