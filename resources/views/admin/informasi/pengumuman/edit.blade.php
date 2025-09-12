<div x-cloak x-show="openedit">
  <x-modal>
    <div class="px-5 py-6 bg-white">
      <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Edit Pengumuman</p>
      <form wire:submit="update">
        <div class="mb-3">
          <x-label-input for="title">Judul Pengumuman</x-label-input>
          <x-input wire:model='title' value="{{ $title ?? '' }}" type="text" class="w-full" />
          <x-error-input name="title" />
        </div>

        <div class="mb-3">
          <x-label-input for="content">Isi Pengumuman</x-label-input>
          <div x-data="quillEditor2()"
            x-effect="const editor = $refs.editor2.querySelector('.ql-editor'); editor ? editor.innerHTML = '{{ $content }}' : ''">
            <input type="hidden" x-ref="input2" wire:model="content">
            <div wire:ignore>
              <div x-ref="editor2">{!! $content !!}</div>
            </div>
          </div>
          <x-error-input name="content" />
        </div>

        <div class="mb-3">
          <x-label-input for="publish_datetime2">Tanggal Publish</x-label-input>
          <x-date-input wire:model='publish_datetime' id='publish_datetime2' />
          <x-error-input name="publish_datetime" />
        </div>

        <div class="mb-3">
          @if ($image)
            <img src="{{ $image->temporaryUrl() }}" class="w-64 h-auto my-2">
          @else
              @if($filename)
                <img src="{{ asset('storage/images/upload-pengumuman/' . $filename) }}"
                    alt="Image" class="w-64 h-auto my-2">
              @endif
          @endif

          <x-label-input for="image">Ubah Gambar</x-label-input>
          <x-input type="file" name="image" wire:model.live="image" style="border: 1px solid #ccc; padding: 5px; border-radius:5px" />
          <x-error-input name="image" />
          <div wire:loading wire:target="image" class="mt-1 text-lg text-green-600 bold">Uploading...
          </div>
          <span class="block mt-1 text-xs italic text-gray-400">
          Jika tidak ingin mengubah, bisa dikosongi
          </span>
        </div>

        <div class="flex justify-end mt-4">
          <div wire:loading.remove wire:target="update">
            <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
              x-on:click="openedit = false" wire:click="resetAll">
              Batal
            </x-button>
            <x-button class="uppercase rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 text-md" type="submit">
              Edit Pengumuman
            </x-button>
          </div>

          <div wire:loading wire:target="update" class="text-xs italic text-gary-600">
            Sedang memproses. Harap menunggu ..
          </div>
        </div>
      </form>
    </div>
  </x-modal>

  @push('script-bottom')
    <script>
      const quillEditor2 = () => {
        return {
          instance: null,
          init() {
            this.$nextTick(() => {
              this.instance = new Quill(this.$refs.editor2, {
                modules: {
                  'toolbar': [
                    [{
                      'font': []
                    }, {
                      'size': []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                      'color': []
                    }, {
                      'background': []
                    }],
                    [{
                      'header': '1'
                    }, {
                      'header': '2'
                    }, 'blockquote'],
                    [{
                      'list': 'ordered'
                    }, {
                      'list': 'bullet'
                    }, {
                      'indent': '-1'
                    }, {
                      'indent': '+1'
                    }],
                    [{
                      'align': []
                    }],
                    ['link'],
                  ]
                },
                theme: 'snow'
              });

              this.instance.on('text-change', () => {
                this.$refs.input2.dispatchEvent(new CustomEvent('input', {
                  detail: this.instance.root.innerHTML
                }));
              })
            })
          },
        }
      }
    </script>
  @endpush
</div>
