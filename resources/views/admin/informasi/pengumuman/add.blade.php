<div>
    <div x-data="{ isModalOpen: @entangle('isModalOpen') }">
        <x-button class="uppercase rounded-full opacity-100 bg-coklat-1 hover:bg-base-brown-600 whitespace-nowrap"
            type="button" x-on:click="isModalOpen = true">
            Tambah Pengumuman
        </x-button>
        <div x-cloak x-show="isModalOpen">
            <x-modal>
                <div class="px-5 py-6 bg-white">
                    <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Pengumuman</p>
                    <form wire:submit.prevent="submit" class="text-sm text-gray-700">
                        <div class="mb-3">
                            <x-label-input for="title">Judul Pengumuman</x-label-input>
                            <x-jet-input type="text" class="w-full" wire:model.defer="title" id="title" />
                            <x-error-input name="title" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="content">Isi Pengumuman</x-label-input>
                            <div x-data="quillEditor()">
                                <input type="hidden" x-ref="input" wire:model.defer="content">
                                <div wire:ignore>
                                    <div x-ref="editor">{!! $content !!}</div>
                                </div>
                            </div>
                            <x-error-input name="content" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="publish_datetime">Tanggal Publish</x-label-input>
                            <x-date-input wire:model.defer="publish_datetime" id="publish_datetime"
                                name="publish_datetime" x-ref="addDate" />
                            <x-error-input name="publish_datetime" />
                        </div>
                      
                        <div class="mb-3">
                            <x-label-input for="image">Upload Gambar</x-label-input>
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
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                    type="button" wire:click="closeModal">
                                    Batal
                                </x-button>
                                <x-button class="uppercase rounded-3xl bg-coklat-2 hover:bg-coklat-hover text-md"
                                    type="submit">
                                    Tambah Pengumuman
                                </x-button>
                            </div>

                            <div wire:loading wire:target="submit" class="text-xs italic text-gray-600">
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
            const quillEditor = () => {
                return {
                    instance: null,
                    init() {
                        this.$nextTick(() => {
                            this.instance = new Quill(this.$refs.editor, {
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
                                this.$refs.input.dispatchEvent(new CustomEvent('input', {
                                    detail: this.instance.root.innerHTML
                                }));
                            });
                        });
                    }
                }
            }
        </script>
    @endpush
</div>