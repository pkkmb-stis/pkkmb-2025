<div class="inline" x-data="{showModalAddAbsensi : @entangle('showModalAddAbsensi')}">
    <div x-cloak x-show="showModalAddAbsensi" class="inline">
        <x-modal>
            <div class="p-5 bg-white">
                @if ($user)
                <div class="flex items-center justify-between">
                    <div class="text-left">
                        <h5 class="text-xl">
                            {{ $user->name }}
                        </h5>
                        <small class="text-xs italic text-gray-600">
                            {{ $user->username }} {{ $user->kelompok->nama ?? '' }}
                        </small>
                    </div>
                    <i class="cursor-pointer fa fa-times" x-on:click="showModalAddAbsensi = false"></i>
                </div>

                <div class="mt-2">
                    <form wire:submit.prevent="addAbsensi" class="mt-3 text-sm text-gray-700">
                        <div class="mb-3">
                            <x-label-input for="keterangan">Status Absensi</x-label-input>
                            <x-select-form wire:model.defer="statusAbsensi">
                                <option>Pilih Status</option>
                                @foreach ([0, 1, 2, 3, 4] as $status)
                                <option value="{{ $status }}">{{ getStatusAbsensi($status) }}</option>
                                @endforeach
                            </x-select-form>
                            <x-error-input name="statusAbsensi" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="keterangan">Keterangan</x-label-input>
                            <x-textarea name="keterangan" wire:model.defer="keterangan" id="keterangan" cols="30"
                                rows="4">
                            </x-textarea>
                        </div>

                        <div class="text-xs leading-tight text-red-500">
                            Mengubah status presensi tidak akan menambahkan poin kepada yang bersangkutan
                        </div>

                        <div class="flex justify-end mt-4">
                            <div wire:loading.remove wire:target="addAbsensi">
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
                                    wire:click="resetAll">
                                    Batal
                                </x-button>
                                <x-button class="uppercase rounded-3xl bg-coklat-2 hover:bg-coklat-hover text-md" type="submit">
                                    Ubah Status Presensi
                                </x-button>
                            </div>

                            <div wire:loading wire:target="addAbsensi" class="text-xs italic text-gary-600">
                                Sedang memproses. Harap menunggu ..
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </x-modal>
    </div>
</div>
