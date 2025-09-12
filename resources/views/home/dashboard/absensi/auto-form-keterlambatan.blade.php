<div>
    <div x-data="{ open: @entangle('openAutoFormKeterlambatan').live }">
        <div x-show="open">
            @if ($event && $user)
            <x-modal>
                <div class="p-5 pt-3 bg-white">
                    <h5 class="font-semibold font-poppins">Presensi Keterlambatan {{ $event->title ?? '' }}</h5>
                    <small class="mb-4">Diperuntukkan untuk presensi keterlambatan</small>

                    <div>
                        <form wire:submit="submit" class="text-sm text-gray-700">
                            <div class="mb-3">
                                <x-label-input for="nama">Nama</x-label-input>
                                <x-input id="nama" name="nama" type="text" value="{{ $user->name }}" class="w-full" readonly />
                            </div>

                            <div class="mb-3">
                                <x-label-input>Kehadiran</x-label-input>
                                <div class="flex flex-col space-y-2">
                                    <label class="inline-flex items-center">
                                        <x-radio-button type="radio" wire:click="setKehadiran('tepat_waktu')" name="kehadiran" value="tepat_waktu" />
                                        <span class="ml-2">Datang Tepat Waktu</span>
                                    </label>
                                    @if ($isPanitia)
                                        <label class="inline-flex items-center">
                                            <x-radio-button type="radio" wire:click="setKehadiran('terlambat_0_10')" name="kehadiran" value="terlambat_0_10" />
                                            <span class="ml-2">Terlambat 0-10 Menit</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <x-radio-button type="radio" wire:click="setKehadiran('terlambat_10_15')" name="kehadiran" value="terlambat_10_15" />
                                            <span class="ml-2">Terlambat 10-15 Menit</span>
                                        </label>
                                    @else
                                        <label class="inline-flex items-center">
                                            <x-radio-button type="radio" wire:click="setKehadiran('terlambat_0_15')" name="kehadiran" value="terlambat_0_15" />
                                            <span class="ml-2">Terlambat 0-15 Menit</span>
                                        </label>
                                    @endif
                                    <label class="inline-flex items-center">
                                        <x-radio-button type="radio" wire:click="setKehadiran('terlambat_15_30')" name="kehadiran" value="terlambat_15_30"/>
                                        <span class="ml-2">Terlambat 15-30 Menit</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <x-radio-button type="radio" wire:click="setKehadiran('terlambat_lebih_30')" name="kehadiran" value="terlambat_lebih_30" />
                                        <span class="ml-2">Terlambat > 30 Menit</span>
                                    </label>
                                </div>

                                <x-error-input name="kehadiran" />
                            </div>

                            @if ($kehadiran !== 'tepat_waktu')
                                <div class="mb-3">
                                    <x-label-input for="alasan">Alasan</x-label-input>
                                    <x-textarea name="alasan" wire:model="alasan" id="alasan" cols="30" rows="6"></x-textarea>
                                    <x-error-input name="alasan" />
                                </div>
                            @endif

                            <div class="mb-3">
                                @if ($fotoBukti)
                                <?php
                                    try {
                                        $urlFotoBukti = $fotoBukti->temporaryUrl();
                                        $statusFotoBukti = true;
                                    }catch (RuntimeException $exception){
                                        $statusFotoBukti = false;
                                    }
                                ?>
                                @if ($statusFotoBukti)
                                <p wire:click="$set('fotoBukti', null)"
                                    class="inline-block px-3 py-1 mr-1 text-xs text-white rounded-md cursor-pointer bg-base-red-500 hover:bg-base-red-600">
                                    Hapus
                                </p>
                                <a target="_blank" href="{{  $urlFotoBukti }}"
                                    class="px-3 py-1 mr-2 text-xs text-white rounded-md cursor-pointer bg-base-blue-500 hover:bg-base-blue-600">
                                    Preview
                                </a>
                                @endif
                                @endif

                                <label for="fotoBukti"
                                    class="px-3 py-1 text-xs text-white rounded-md cursor-pointer bg-base-green-300 hover:bg-base-green-400">Foto
                                    Bukti</label>

                                <div wire:loading wire:target="fotoBukti" class="text-xs text-gray-500">Uploading...
                                </div>
                                <input type="file" wire:model.live="fotoBukti" id="fotoBukti" class="hidden">
                                <x-error-input name="fotoBukti" />
                            </div>

                            <p class="mb-3 text-xs text-justify text-gray-500">
                                Batas presensi tepat waktu hanya sampai jam
                                {{ formatDateIso($event->waktu_akhir, 'HH:mm') }} WIB. Silakan isikan alasan
                                keterlambatanmu dan submit form ini. Form ini hanya akan bisa disubmit sampai jam
                                {{ formatDateIso($event->waktu_akhir->addHour(1), 'HH:mm') }}
                            </p>

                            <div class="flex items-center justify-end mt-4">
                                <div wire:loading.remove wire:target="submit">
                                    <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md" type="button"
                                        wire:click="resetAll">
                                        Batal
                                    </x-button>

                                    <x-button class="uppercase rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 text-md" type="submit"
                                        wire:target="fotoBukti" wire:loading.remove>
                                        Submit
                                    </x-button>
                                </div>

                                <div wire:loading wire:target="submit" class="text-xs italic text-gray-600">
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
</div>
