<div>
    @if (!$canAdd)
    @else
        <div x-data="{ addmodal: false }">

            <x-button class="rounded-3xl bg-coklat-1 hover:bg-base-brown-600 uppercase ml-1" type="button"
                x-on:click="addmodal = true">
                Tambah Penebusan
            </x-button>

            <div x-cloak x-show="addmodal">
                <x-modal maxWidth="max-w-3xl">
                    <div class="px-5 py-6 bg-white">
                        <p class="text-lg font-semibold text-gray-700 capitalize leading-3 mb-4">Tambah Penebusan</p>

                        <form wire:submit="submit" class="text-sm text-gray-700">
                            @if ($jenispoins->count() != 0)
                                <div class="mb-3">
                                    <x-select-form wire:model.live="jenispoin">
                                        <option class="hidden" selected="selected">Pilih Jenis Poin Penebusan</option>
                                        @foreach ($jenispoins as $j)
                                            <option value="{{ $j->id }}">
                                                Penebusan
                                                {{ getTipePenebusan($j->type) . ' ' . $j->nama . ' | Poin: ' . $j->poin }}
                                            </option>
                                        @endforeach
                                    </x-select-form>
                                    <x-error-input name="jenispoin" />
                                </div>

                                @if ($deadline)
                                    <div class="mb-3">
                                        <p class="text-sm font-semibold">
                                            Deadline : {{ formatDateIso($deadline) }}
                                        </p>
                                        <small class="text-xs font-semibold">
                                            {{ $deadline->locale('id')->diffForHumans() }}
                                        </small>
                                    </div>

                                    @if ($detailTugas)
                                        <div>
                                            <p class="text-sm font-semibold">Deskripsi Tugas</p>
                                            <pre class="font-sans text-sm whitespace-pre-line">{{ $detailTugas }}</pre>
                                        </div>
                                    @endif
                                @endif

                                <div class="flex justify-end mt-4">
                                    <div wire:loading.remove wire:target="submit">
                                        <x-button
                                            class="rounded-3xl bg-gray-500 hover:bg-gray-600 uppercase text-md mr-2"
                                            type="button" x-on:click='addmodal = false' wire:click="resetAll">
                                            Batal
                                        </x-button>
                                        @if ($deadline)
                                            <x-button
                                                class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover uppercase text-md"
                                                type="submit">
                                                Tambah Penebusan
                                            </x-button>
                                        @endif
                                    </div>

                                    <div wire:loading wire:target="submit" class="text-xs text-gary-600 italic">
                                        Sedang memproses ...
                                    </div>
                                </div>
                            @else
                                <h3 class="italic text-center text-sm py-3">Tidak ada penebusan yang dapat dipilih</h3>
                                <div class="flex justify-end mt-4">
                                    <x-button class="bg-gray-500 hover:bg-gray-600 uppercase text-md mr-2"
                                        type="button" x-on:click='addmodal = false' wire:click="resetAll">
                                        Batal
                                    </x-button>
                                </div>
                            @endif
                        </form>

                    </div>
                </x-modal>
            </div>
        </div>
    @endif
</div>
