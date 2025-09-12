<div>
    <div x-data="{modalPoinOtomatis: @entangle('modalPoinOtomatis').live}">
        <x-button class="ml-1 uppercase rounded-full opacity-100 bg-coklat-1 hover:bg-base-brown-600" type="button"
            x-on:click="modalPoinOtomatis = true" wire:click="setWaktu">
            Generate Poin
        </x-button>

        <div x-cloak x-show="modalPoinOtomatis">
            <x-modal>
                <x-modal.warning>
                    <x-slot name="title">
                        <h5 class="font-bold">Generate Poin Penghargaan Otomatis</h5>
                    </x-slot>
                    <div>
                        <p>Pastikan bahwa seluruh poin pelanggaran telah dimasukkan.</p>
                        <p>Silakan pilih poin penghargaan yang akan digenerate.</p>
                        <div class="pl-5">
                            <x-checkbox id="genPoint1" class="cursor-pointer" type="checkbox"
                                wire:model="isPatuhAtribut"/>
                            <span><label for="genPoint1" class="cursor-pointer">
                                Atribut lengkap dan rapi
                            </label></span>
                        </div>
                        <div class="pl-5">
                            <x-checkbox id="genPoint2" class="cursor-pointer" type="checkbox"
                                wire:model="isPatuhKuliahUmum"/>
                            <span><label for="genPoint2" class="cursor-pointer">
                                Tertib mengikuti kegiatan pembekalan
                            </label></span>
                        </div>
                        <div class="pl-5">
                            <x-checkbox id="genPoint3" class="cursor-pointer" type="checkbox"
                                wire:model="isPatuhHariIni"/>
                            <span><label for="genPoint3" class="cursor-pointer">
                                Tidak melanggar peraturan dalam sehari
                            </label></span>
                        </div>
                        <div class="pl-5">
                            <x-checkbox id="genPoint4" class="cursor-pointer" type="checkbox"
                                wire:model="isPatuhTugas"/>
                            <span><label for="genPoint4" class="cursor-pointer">
                                Tugas harian lengkap dan tepat waktu
                            </label></span>
                        </div>
                        <div class="pl-5">
                            <x-checkbox id="genPoint5" class="cursor-pointer" type="checkbox"
                                wire:model="isPatuhAtributPKBN"/>
                            <span><label for="genPoint5" class="cursor-pointer">
                                Perlengkapan PKBN lengkap
                            </label></span>
                        </div>
                        <p class="mt-3">
                            Silakan pilih rentang waktu pemberian poin pelanggaran yang menjadi acuan
                        </p>

                        <div class="justify-between w-full md:flex md:gap-4">
                            <div class="w-full">
                                <x-label-input for="waktu_awal">Waktu Awal</x-label-input>
                                <x-date-input wire:model="waktuAwal" id="waktu_awal" name="waktu_awal"
                                    x-ref="addDate" />
                                <x-error-input class='text-sm' name="waktuAwal" />
                            </div>
                            <div class="w-full">
                                <x-label-input for="waktu_akhir">Waktu Akhir</x-label-input>
                                <x-date-input wire:model="waktuAkhir" id="waktu_akhir" name="waktu_akhir"
                                    x-ref="addDate" />
                                <x-error-input class='text-sm' name="waktuAkhir" />
                            </div>
                        </div>

                        <div class="mt-3">
                            <x-label-input for="password">Password Kamu</x-label-input>
                            <x-input type="password" class="w-full" wire:model="password" />
                            <x-error-input name="password" />
                        </div>
                    </div>
                    <x-slot name="footer">
                        <div wire:loading.remove wire:target="submit">
                            <x-button class="mr-1 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="modalPoinOtomatis = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hove" :tagA="false" wire:click="submit">Ya, yakin
                            </x-button>
                        </div>
                        <div wire:loading wire:target="submit" class="text-xs italic text-gary-600">
                            Sedang memproses. Harap menunggu ..
                        </div>
                    </x-slot>
                </x-modal.warning>
            </x-modal>
        </div>
    </div>

    @push('script-bottom')
    <script>
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });

    document.querySelector('#urutan_input').value = new Date().toDateInputValue();
    </script>
    @endpush
</div>
