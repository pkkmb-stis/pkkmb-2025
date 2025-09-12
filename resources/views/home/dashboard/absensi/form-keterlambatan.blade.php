<div x-data="{ openFormKeterlambatan: @entangle('openFormKeterlambatan').live }">
    <div x-cloak x-show="openFormKeterlambatan">
        @if ($event)
            <x-modal>
                <div class="p-5 pt-3 bg-white">
                    @if (!eventCanQrCode($event->waktu_mulai, $event->waktu_akhir))
                        <h5 class="font-poppins font-semibold">Presensi Keterlambatan {{ $event->title ?? '' }}</h5>
                        <small class="mb-4">Hanya bisa diisi oleh PK masing masing kelompok</small>
                    @else
                        <h5 class="font-poppins mb-4 font-semibold">Formulir Presensi {{ $event->title ?? '' }}</h5>
                    @endif
                    <div>
                        <form wire:submit="submit" class="text-sm text-gray-700">

                            @can(PERMISSION_ADD_ABSENSI)
                                <div class="mb-3">
                                    <x-label-input for="nama">Nama</x-label-input>
                                    <x-select-multi name="nama" wire:model="nama" id="nama">
                                        <option value="">Pilih Anggota</option>
                                        @forelse ($kelompok as $k)
                                            @forelse ($k->anggota as $anggota)
                                                <option value="{{ $anggota->id }}">{{ $anggota->name }}</option>
                                            @empty
                                                <option value="">Tidak ada anggota</option>
                                            @endforelse
                                        @empty
                                            <option value="">Tidak ada anggota</option>
                                        @endforelse
                                    </x-select-multi>
                                    <x-error-input name="nama" />
                                </div>
                            @endcan

                            @if (auth()->user()->is_maba)
                                @if (auth()->user()->kelompok()->first()->jenis_kelompok)
                                    <div class="mb-3">
                                        <p class="text-sm font-semibold mb-1">Sebelum submit form silakan masuk ke link
                                            zoom
                                            dibawah ini (Link akan hilang setelah form disubmit)
                                        </p>
                                        <x-button class="bg-blue-500 hover:bg-blue-600 uppercase text-md mr-2"
                                            type="button" :tagA="true" target="blank"
                                            href="{{ $event->link_lambat }}">
                                            Zoom Lambat
                                        </x-button>
                                    </div>
                                @endif
                            @endif

                            <div class="flex justify-end mt-4 items-center">
                                <div wire:loading.remove wire:target="submit">
                                    <x-button class="bg-gray-500 hover:bg-gray-600 uppercase text-md mr-2"
                                        type="button" wire:click="resetAll">
                                        Batal
                                    </x-button>

                                    <x-button class="bg-sky-500 hover:bg-sky-600 uppercase text-md" type="submit"
                                        wire:target="fotoBukti" wire:loading.remove>
                                        Submit
                                    </x-button>
                                </div>

                                <div wire:loading wire:target="submit" class="text-xs text-gary-600 italic">
                                    Sedang memproses ...
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </x-modal>
        @endif
    </div>
</div>
