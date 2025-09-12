<div x-data="{ showDetailKendala: @entangle('showDetailKendala').live }" x-cloak x-show="showDetailKendala">
    @if ($kendala)
        <x-modal maxWidth="max-w-2xl">
            <div class="p-5 pb-3 bg-white">
                <div class="mb-1">
                    <h5 class="text-xl leading-none">
                        {{ $kendala->user->name }}
                    </h5>
                    <small class="text-xs italic text-gray-600">
                        @if ($kendala->user->is_maba)
                            {{ $kendala->user->nimb ?? '-' }} | {{ $kendala->user->kelompok->nama ?? '' }}
                        @else
                            {{ $kendala->user->username }}
                        @endif
                    </small>
                </div>

                <div class="mb-5 leading-tight">
                    <p class="text-sm">
                        Memiliki <b>kendala {{ getJenisKendala($kendala->category) }}</b> yang diajukan pada
                        {{ formatDateIso($kendala->created_at, 'dddd, D MMMM YYYY HH:mm:ss') }}. Kendala terjadi pada
                        {{ formatDateIso($kendala->waktu_kendala) }}
                    </p>
                    <p class="mt-1 mb-3 text-sm">{{ $kendala->content }}</p>
                    <div>
                        @if ($kendala->foto_kendala)
                            <x-button class="mr-2 text-xs bg-base-blue-300 hover:bg-base-blue-400" :tagA="true"
                                target="_blank" href="{{ storage($kendala->foto_kendala) }}">Foto Kendala</x-button>
                        @endif
                        @if ($kendala->foto_atribute)
                            <x-button class="mr-2 text-xs bg-base-blue-300 hover:bg-base-blue-400" :tagA="true"
                                target="_blank" href="{{ storage($kendala->foto_atribute) }}">Foto Atribute</x-button>
                        @endif
                        @if ($kendala->foto_perlengkapan)
                            <x-button class="text-xs bg-base-blue-300 hover:bg-base-blue-400" :tagA="true"
                                target="_blank" href="{{ storage($kendala->foto_perlengkapan) }}">Foto
                                Perlengkapan</x-button>
                        @endif
                    </div>
                </div>

                <form wire:submit="ubah">
                    <div class="mb-3">
                        <x-select-form wire:model="status" disabled="{{ !$canEdit }}">
                            @foreach ([0, 1, 2] as $jenisStatus)
                                <option value="{{ $jenisStatus }}">{{ getStatusKendala($jenisStatus) }}</option>
                            @endforeach
                        </x-select-form>
                    </div>

                    <div class="mb-3">
                        <x-label-input for="tanggapan">Tanggapan</x-label-input>
                        <x-textarea name="tanggapan" wire:model="tanggapan" id="tanggapan" cols="30"
                            rows="4" disabled="{{ !$canEdit }}">
                        </x-textarea>
                    </div>

                    <div class="flex justify-end mt-4">
                        <div wire:loading.remove wire:target="ubah">
                            <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                type="button" wire:click="resetAll">
                                Batal
                            </x-button>
                            @if ($canEdit)
                                <x-button
                                    class="px-5 uppercase rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 text-md"
                                    type="submit">
                                    Ubah
                                </x-button>
                            @endif
                        </div>

                        <div wire:loading wire:target="ubah" class="text-xs italic text-gary-600">
                            Sedang memproses. Harap menunggu ..
                        </div>
                    </div>
                </form>
            </div>
        </x-modal>
    @endif
</div>
