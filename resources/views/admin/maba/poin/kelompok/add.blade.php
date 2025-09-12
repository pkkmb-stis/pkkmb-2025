<div>
    <div x-data="{ addmodal: false }">
        <x-button class="ml-1 uppercase rounded-full opacity-100 bg-coklat-1 hover:bg-base-brown-600 whitespace-nowrap"
            type="button" x-on:click="addmodal = true;">
            Tambah Jenis Poin Kelompok
        </x-button>
        <div x-cloak x-show="addmodal">
            <x-modal maxWidth="max-w-4xl">
                <div class="px-5 py-6 bg-white">
                    <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Jenis Poin Kelompok
                    </p>
                    <form wire:submit="submit" class="text-sm text-gray-700">
                        <span class="mt-1 text-xs italic text-gray-400">
                            Penentuan jenis poin kelompok terbaik hanya dapat dilakukan sekali dalam satu hari. Jika
                            ingin membatalkan
                            penentuan status kelompok pada hari ini, silakan klik tombol "Batalkan Penentuan Jenis Poin
                            Kelompok".
                        </span>
                        <div class="grid lg:grid-cols-2 lg:gap-6">
                            <div class="mb-3">
                                <x-label-input for="kelompok">Pilih Kelompok</x-label-input>
                                <x-select-form wire:model.blur="kelompok">
                                    <option class="hidden" selected>Pilih kelompok...</option>
                                    @foreach ($kelompoks as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </x-select-form>
                                <x-error-input name="kelompok" />
                            </div>

                            <div class="mb-3">
                                <x-label-input for="jenis_poin">Jenis Poin</x-label-input>
                                <x-select-form wire:model.blur="jenis_poin">
                                    <option class="hidden" selected>Pilih jenis poin kelompok...</option>
                                    @foreach ($jenis_poin_kelompok as $jpk)
                                        <option value="{{ $jpk->id }}">{{ $jpk->nama }}</option>
                                    @endforeach
                                </x-select-form>
                                <x-error-input name="jenis_poin" />
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <div wire:loading.remove wire:target="submit">
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                    type="button" x-on:click='addmodal = false' wire:click="resetAll">
                                    Tutup
                                </x-button>
                                <x-button class="uppercase rounded-3xl bg-coklat-2 hover:bg-coklat-hover text-md"
                                    type="submit">
                                    Submit
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
