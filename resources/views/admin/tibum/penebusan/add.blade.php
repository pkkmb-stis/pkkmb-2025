<div>
    <div x-data="{ addmodal: false, status: '', isUploading: false, progress: 0, }" x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">

        <x-button class="uppercase rounded-3xl bg-coklat-1 hover:bg-base-brown-600" type="button"
            x-on:click="addmodal = true; slim.set([])">
            Tambah Penebusan
        </x-button>

        <div x-cloak x-show="addmodal">
            <x-modal>
                <div class="px-5 py-6 bg-white">
                    <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Penebusan</p>
                    <form wire:submit="submit" class="text-sm text-gray-700">
                        <div class="mb-3">
                            <x-label-input for="selectusers">Pilih Maba/Panitia</x-label-input>
                            <div wire:ignore>
                                <x-select-multi x-on:change="$wire.set('users', $el.value)" x-init="initSlim"
                                    id='selectusers'>
                                    @foreach ($allMaba as $maba)
                                        <option value="{{ $maba->id }}">{{ $maba->name }} |
                                            {{ $maba->username }}</option>
                                    @endforeach
                                </x-select-multi>
                            </div>
                            <x-error-input name="users" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="jenispoin">Jenis Poin</x-label-input>
                            <div wire:ignore>
                                <select id="selectjenispoin" x-on:change="$wire.set('jenispoin', $el.value)"
                                    x-init="initSlimJenispoin">
                                    <option class="hidden" selected="selected">Pilih jenis poin...</option>
                                    @foreach ($jenispoins as $j)
                                        <option value="{{ $j->id }}">Penebusan {{ getTipePenebusan($j->type) }}
                                            {{ $j->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-error-input name="jenispoin" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="status">Status</x-label-input>
                            <x-select-form id='sele' wire:model="status">
                                <option value="" class="hidden" selected="selected">Pilih status...</option>
                                @foreach (MAP_CATEGORY['penebusan_user'] as $j)
                                    <option value="{{ $j }}">{{ $j }}</option>
                                @endforeach
                            </x-select-form>
                            <x-error-input name="status" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="deadline1">Deadline</x-label-input>
                            <x-date-input wire:model="deadline" id="deadline1" name="deadline" />
                            <x-error-input name="deadline" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="file">Tugas</x-label-input>

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
                                    class="px-3 py-1 text-xs cursor-pointer rounded-3xl bg-base-grey-500 text-base-blue-600 hover:bg-base-grey-600">Pilih
                                    File</label>

                                @if ($file && $statusFile)
                                    <a href="{{ $urlAtribute }}"
                                        class="px-3 py-1 ml-2 text-xs text-white cursor-pointer rounded-3xl bg-base-blue-500 hover:bg-base-blue-600"
                                        download>Preview</a>
                                @endif
                            </div>

                            <p class="mt-2 text-xs text-gray-600">
                                File maksimal <b>2MB</b>. Prioritaskan file dalam bentuk pdf tapi jika file lebih dari 1
                                maka gunakan format zip
                            </p>


                            <input type="file" wire:model.live="file" id="fileUpload" class="hidden">
                            <x-error-input name="file" />

                            <div x-show="isUploading">
                                <img wire:loading src="{{ asset('/img/icon/loading-ring-bg-white.svg') }}"
                                    class="h-10 my-0" alt="">
                                Uploading: <span x-text="progress"></span>%
                            </div>

                        </div>

                        <div class="flex justify-end mt-4">
                            <div wire:loading.remove wire:target="submit">
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                    type="button" @click="status=''; addmodal = false;" wire:click="resetAll">
                                    Tutup
                                </x-button>
                                <x-button class="uppercase rounded-3xl bg-coklat-2 hover:bg-coklat-hover text-md"
                                    type="submit" wire:loading.remove wire:target="file">
                                    Tambah Penebusan
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
            let slim, slimJenispoin;
            const initSlim = () => {
                slim = new SlimSelect({
                    select: '#selectusers',
                    closeOnSelect: true,
                    hideSelectedOption: true,
                    searchingText: 'Sedang mencari...',
                    searchPlaceholder: 'Cari berdasarkan nama atau NIMB ..',
                    placeholder: 'Cari maba',
                });
            };

            const initSlimJenispoin = () => {
                slimJenispoin = new SlimSelect({
                    select: '#selectjenispoin',
                    closeOnSelect: true,
                    hideSelectedOption: true,
                    searchingText: 'Sedang mencari...',
                    searchPlaceholder: 'Cari jenis poin..',
                    placeholder: 'Pilih jenis poin',
                });
            };
        </script>
    @endpush
</div>
