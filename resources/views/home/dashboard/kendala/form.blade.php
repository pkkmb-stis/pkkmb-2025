<div x-data="{ showModalKendala: @entangle('showModalKendala').live }">
    <div class="fixed z-10 p-4 transition-all transform scale-75 border-2 rounded-full shadow-lg cursor-pointer bottom-6 md:right-16 right-6 bg-base-brown-400 md:hover:scale-105 hover:scale-90 md:scale-95 border-base-brown-600"
        x-on:click="showModalKendala = true">
        <i class="fa-solid fa-envelope-open-text fa-2x text-base-brown-950"></i>
    </div>

    <div x-cloak x-show="showModalKendala">
        <x-modal maxWidth="max-w-2xl">
            <div class="p-5 bg-white">
                <h5 class="mr-3 text-lg font-medium font-poppins">Halo <i>{{ auth()->user()->name }}</i>. Silakan isi
                    laporan kamu.</h5>
                <p class="my-2 text-xs text-justify text-gray-500">
                    Laporanmu hanya bisa dilihat oleh Badan Pengurus Harian Panitia Pelaksana Operasional. Kamu bisa
                    melaporkan tiga jenis persoalan, yaitu kinerja Panitia Pelaksana Operasional, evaluasi situs web
                    PKKMB, serta praduga adanya unsur kekerasan, perpeloncoan, KKN, asusila, dan kriminal pada kegiatan
                    PKKMB. Silakan isi laporan dengan lengkap dan sesuai kenyataan agar laporan dapat ditindaklanjuti.
                </p>
                <form wire:submit="submit" class="text-sm text-gray-700">

                    <div class="grid lg:grid-cols-2 lg:gap-6">
                        <div class="mb-3">
                            <x-label-input for="category">Kategori Pengaduan</x-label-input>
                            <x-select-form wire:model="category" id="category">
                                <option>Pilih Jenis Pengaduan</option>
                                <option value="1">Kinerja PPO</option>
                                <option value="2">Praduga unsur kekerasan, perpeloncoan, dsb</option>
                                <option value="3">Evaluasi Website</option>
                            </x-select-form>
                            <x-error-input name="category" />
                        </div>

                        <div class="mb-3">
                            <x-label-input for="waktuKendala">Waktu Kejadian</x-label-input>
                            <x-date-input wire:model="waktuKendala" id="waktuKendala" name="waktuKendala" />
                            <x-error-input name="waktuKendala" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <x-label-input for="content">Deskripsi Kejadian</x-label-input>
                        <x-textarea name="content" wire:model="content" id="content" cols="30"
                            rows="5">
                        </x-textarea>
                        <x-error-input name="content" />
                    </div>
                    <label class="flex mb-3">
                        <x-input type="checkbox" name="konfirmasi" wire:model="konfirmasi"
                            class="mt-1 border-2 border-gray-800 rounded-full" />
                        <p class="ml-3 text-justify">Laporan ini saya buat sesuai dengan kejadian yang sebenarnya tanpa
                            dikurangi atau dilebihkan. Apabila suatu saat ditemukan bahwa laporan saya tidak sesuai
                            dengan kejadian yang sebenarnya, saya bersedia menerima konsekuensi atas laporan tersebut.
                        </p>
                        <x-error-input name="konfirmasi" />
                    </label>

                    {{-- <div class="divide-y">
                        @include('home.dashboard.kendala.upload-kendala')
                        @include('home.dashboard.kendala.upload-atribute')
                        @include('home.dashboard.kendala.upload-perlengkapan')
                    </div> --}}

                    {{-- <x-error-input name="fotoKendala" />
                    <x-error-input name="fotoAtribute" />
                    <x-error-input name="fotoPerlengkapan" /> --}}

                    <div class="flex justify-end mt-4">
                        <div wire:loading.remove wire:target="submit">
                            <x-button class="mr-2 uppercase bg-gray-500 rounded-3xl hover:bg-gray-600 text-md"
                                type="button" wire:click="resetAll">
                                Batal
                            </x-button>
                            <x-button class="uppercase rounded-3xl bg-coklat-2 hover:bg-coklat-hover text-md"
                                type="submit" wire:loading.remove>
                                Kirim
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
