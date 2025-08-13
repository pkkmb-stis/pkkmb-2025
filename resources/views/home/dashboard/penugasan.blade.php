<div x-data="{ showModalPenugasan: false }">
    <div class="w-12 h-12 transition-all transform scale-75 border-2 rounded-full shadow-lg cursor-pointer bg-base-blue-600 border-white-300 md:hover:scale-105 hover:scale-90 md:scale-95"
        x-on:click="showModalPenugasan = true">

        <div class="flex items-center justify-center w-full h-full">
            <i class="text-lg text-white fas fa-pencil-ruler"></i>
        </div>
    </div>

    <div x-cloak x-show="showModalPenugasan">
        <x-modal.home judul="Penugasan">
            <x-slot name="closeButton">
                <div x-on:click="showModalPenugasan = false">
                    <x-close-button />
                </div>
            </x-slot>

            <div class="mt-2 divide-y font-poppins">
                @php
                    $adaPenugasan = false;
                @endphp

                @foreach (collect(getPenugasan())->sortByDesc('waktu-akses') as $p)
                    @if (now() > $p['waktu-akses'])
                        @php
                            $adaPenugasan = true;
                        @endphp
                        <div class="p-2 cursor-pointer">
                            <div
                                class="justify-between p-2 pb-4 sm:flex sm:flex-row sm:items-center sm:p-4 font-mulish hover:bg-blueGray-200 hover:bg-opacity-50">

                                <p class="font-semibold leading-tight font-poppins md:text-lg text-md">
                                    {{ $p['nama'] }}</p>

                                <div class="mt-3 sm:mt-0">
                                    <x-button href="{{ $p['link'] }}"
                                        class="px-5 mr-2 font-bold uppercase rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 text-white-800 text-md"
                                        :tagA=true download="{{ $p['downloadName'] }}">
                                        <i class="mr-1 fas fa-book text-white-800"></i>
                                        <span> Unduh</span>
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if (!$adaPenugasan)
                    <p class="px-6 py-3 text-sm italic text-center">Belum ada penugasan</p>
                @endif
            </div>
        </x-modal.home>
    </div>
</div>

