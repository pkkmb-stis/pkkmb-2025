<div class="inline" x-data="{showModalDetail : @entangle('showModalDetail')}">
    <div x-cloak x-show="showModalDetail" class="inline">
        <x-modal>
            <div class="p-5 bg-white">
                @if ($user)
                <div class="flex items-center justify-between">
                    <div class="text-left">
                        <h5 class="text-xl">
                            {{ $user->name }}
                            <x-status-absensi status="{{$statusAbsensi}}" />
                        </h5>
                        <small class="text-xs italic text-gray-600">
                            {{ $user->username }} {{ $user->kelompok->nama ?? '' }}
                        </small>
                    </div>
                    <i class="cursor-pointer fa fa-times" x-on:click="showModalDetail = false"></i>
                </div>

                <div class="mt-2">
                    <span class="text-xs">
                        Melakukan presensi pada
                        <b>{{ $createdAt }}</b>
                    </span>

                    <form wire:submit.prevent="update" class="mt-3 text-sm text-gray-700">
                        <div class="mb-3">
                            <x-label-input for="keterangan">Status Presensi</x-label-input>
                            <x-select-form wire:model.defer="statusAbsensi" disabled="{{ !$canEdit }}">
                                @foreach ([0, 1, 2, 3, 4] as $status)
                                <option value="{{ $status }}">{{ getStatusAbsensi($status) }}</option>
                                @endforeach
                            </x-select-form>
                        </div>

                        <div class="mb-3">
                            <x-label-input for="keterangan">Keterangan</x-label-input>
                            <x-textarea name="keterangan" wire:model.defer="keterangan" id="keterangan" cols="30"
                                rows="4" disabled="{{ !$canEdit }}">
                            </x-textarea>
                        </div>

                        @if ($bukti)
                        <div class="mb-3">
                            <x-button class="mr-2 uppercase bg-blue-500 hover:bg-blue-600 text-md" type="button"
                                :tagA="true" target="blank" href="{{ storage($bukti) }}">
                                Bukti Keterlambatan
                            </x-button>
                        </div>
                        @endif

                        @if ($canEdit)
                        <div class="text-xs leading-tight text-red-500">
                            Mengubah status presensi tidak akan menambahkan poin kepada yang bersangkutan
                        </div>
                        @endif

                        <div class="flex justify-end mt-4">
                            <div wire:loading.remove wire:target="update">
                                <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
                                    wire:click="$set('showModalDetail', false)">
                                    Batal
                                </x-button>
                                @if ($canEdit)
                                <x-button class="px-5 uppercase rounded-3xl bg-2025-1 hover:bg-coklat-hover text-md" type="submit">
                                    Ubah
                                </x-button>
                                @endif
                            </div>

                            <div wire:loading wire:target="update" class="text-xs italic text-gary-600">
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
