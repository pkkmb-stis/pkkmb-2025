<x-home-layout menu="Panitia" title="Panitia Dosen/Tendik - PKKMB-PKBN 2024">
    <div class="px-8 pt-24 pb-20 font-bohemianSoul sm:px-8 md:px-12 md:pt-28 lg:pt-32 xl:px-16">

        <div class="grid w-full px-8 pb-4 sm:px-16 md:px-20 md:pb-12 xl:px-16">
            <div class="flex flex-row items-end justify-center w-full h-full gap-4">
                <img src="{{ asset('img/maskot/kambe panitia.png') }}" alt="wave" class="z-10 w-24 sm:w-32">
                <div class="flex flex-col items-center justify-center h-full">
                    <img src="{{ asset('img/asset/2024/Elemen 4.png') }}" alt="Elemen 4">
                    <h1
                        class="px-6 py-3 text-sm font-thin leading-normal text-center align-middle rounded-full bg-putih-100 drop-shadow-md lg:py-4 font-aringgo text-merah-1 sm:px-12 lg:text-3xl xl:text-4xl">
                        PROFIL PANITIA
                    </h1>
                    <img src="{{ asset('img/asset/2024/Elemen 4.png') }}" alt="Elemen 4" class="rotate-180">
                </div>
                <img src="{{ asset('img/maskot/pika panitia.png') }}" alt="wave" class="z-10 w-24 sm:w-32">
            </div>
        </div>

        <div class="grid grid-cols-2 mx-4 mt-8 mb-12 gap-x-0 font-bohemianSoul lg:grid-cols-12">
            <a href="{{ route('home.ppo') }}"
                class="flex items-center justify-center col-span-1 py-1 border-4 rounded-l-full border-merah-1 text-merah-1 hover:bg-merah-1 hover:text-base-white lg:col-start-4 lg:col-end-7">
                <h1 class="text-base md:text-xl lg:text-2xl">PPO</h1>
            </a>
            <a href="{{ route('home.dosen') }}"
                class="flex items-center justify-center col-span-1 py-1 border-4 rounded-r-full border-merah-1 bg-merah-1 text-base-white lg:col-start-7 lg:col-end-10">
                <h1 class="text-base md:text-xl lg:text-2xl">Dosen/Tendik</h1>
            </a>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Pelindung
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- Pelindung --}}
        <div class="w-full my-10">
            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($pelindung as $m)
                    <div class="flex w-3/4 items-center justify-center md:w-1/3 lg:w-2/9 md:flex-col">
                        <div class="flex relative z-10 h-auto w-2/3 md:w-full">
                            <div class="flex flex-col content-center rounded-bl-lg bg-merah-1">
                                <img class="w-full h-auto bg-card-profile bg-cover group-hover:hidden" src="{{ $m['foto'] }}"
                                    alt="Foto Koordinator">
                                <div
                                    class="flex justify-center items-center text-center h-8 sm:h-12 md:h-8 xl:h-12 px-1 my-1 md:my-0.5 lg:my-1 font-nunito text-[#F5F5DC] text-xs sm:text-base md:text-xs lg:text-xs xl:text-base">
                                    {{ $m['nama'] }}
                                </div>
                            </div>
                            <div class="flex flex-col justify-between rounded-tr-lg rounded-br-lg bg-merah-2">
                                <div class="triangle-top"></div>
                                <div
                                    class="self-center flex font-bohemianSoul text-center text-[10px] text-white sm:text-base md:text-[11px] lg:text-[8px] xl:text-xs text-jabatan px-1 xl:px-2 ">
                                    <h1 class="z-10 text-center verticaltext jabatanKoor">{{ $m['jabatan'] }}</h1>
                                </div>
                                <div class="triangle-bottom"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Pengarah
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- Pengarah --}}
        <div class="w-full my-10">
            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($pengarah as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                    @endphp
                    @include('home.panitia.panit-wo-koor-dosen', ['m' => $m, 'isEven' => $isEven])
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Pembina
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- Pembina --}}
        <div class="w-full my-10">
            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($pembina as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                    @endphp
                    @include('home.panitia.panit-wo-koor-dosen', ['m' => $m, 'isEven' => $isEven])
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Penanggung Jawab
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- Penanggung Jawab --}}
        <div class="w-full my-10">
            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($penanggung_jawab as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                    @endphp
                    @include('home.panitia.panit-wo-koor-dosen', ['m' => $m, 'isEven' => $isEven])
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Pengawas
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- Pengawas --}}
        <div class="w-full my-10">
            <div class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 sm:px-10 lg:px-28">
                @php
                    $koordinator = collect($pengawas)->firstWhere('jabatan', 'Koordinator');
                @endphp
                @if ($koordinator)
                    @include('home.panitia.koor-dosen', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-10 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($pengawas as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor-dosen', ['m' => $m, 'isEven' => $isEven])
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Badan Pengurus Harian
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- BPH --}}
        <div class="w-full my-10">
            <div
            class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 lg:md-gap-1 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($bph as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                    @endphp
                    @if ($m['jabatan'] === 'Ketua Pelaksana' || $m['jabatan'] === 'Wakil Ketua')
                        @include('home.panitia.panit-bph-dosen', ['m' => $m, 'isEven' => $isEven])
                    @endif
                @endforeach
            </div>
            <div
            class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 lg:md-gap-1 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($bph as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                    @endphp
                    @if ($m['jabatan'] === 'Koor Bendahara' || $m['jabatan'] === 'Bendahara')
                        @include('home.panitia.panit-bph-dosen', ['m' => $m, 'isEven' => $isEven])
                    @endif
                @endforeach
            </div>
            <div
            class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 lg:md-gap-1 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($bph as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                    @endphp
                    @if ($m['jabatan'] === 'Koor Sekretariat' || $m['jabatan'] === 'Sekretariat')
                        @include('home.panitia.panit-bph-dosen', ['m' => $m, 'isEven' => $isEven])
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Seksi Acara
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- Acara --}}
        <div class="w-full my-10">
            <div class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 sm:px-10 lg:px-28">
                @php
                    $koordinator = collect($acara)->firstWhere('jabatan', 'Koordinator');
                @endphp
                @if ($koordinator)
                    @include('home.panitia.koor-dosen', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-10 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($acara as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor-dosen', ['m' => $m, 'isEven' => $isEven])
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Seksi LAPK
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- LAPK --}}
        <div class="w-full my-10">
            <div class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 sm:px-10 lg:px-28">
                @php
                    $koordinator = collect($lapk)->firstWhere('jabatan', 'Koordinator');
                @endphp
                @if ($koordinator)
                    @include('home.panitia.koor-dosen', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-10 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($lapk as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor-dosen', ['m' => $m, 'isEven' => $isEven])
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Seksi HPD
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- HPD --}}
        <div class="w-full my-10">
            <div class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 sm:px-10 lg:px-28">
                @php
                    $koordinator = collect($hpd)->firstWhere('jabatan', 'Koordinator');
                @endphp
                @if ($koordinator)
                    @include('home.panitia.koor-dosen', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-10 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($hpd as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor-dosen', ['m' => $m, 'isEven' => $isEven])
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Seksi Gramti
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- Gramti --}}
        <div class="w-full my-10">
            <div class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 sm:px-10 lg:px-28">
                @php
                    $koordinator = collect($gramti)->firstWhere('jabatan', 'Koordinator');
                @endphp
                @if ($koordinator)
                    @include('home.panitia.koor-dosen', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-10 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($gramti as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor-dosen', ['m' => $m, 'isEven' => $isEven])
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Seksi Tibum
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- Tibum --}}
        <div class="w-full my-10">
            <div class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 sm:px-10 lg:px-28">
                @php
                    $koordinator = collect($tibum)->firstWhere('jabatan', 'Koordinator');
                @endphp
                @if ($koordinator)
                    @include('home.panitia.koor-dosen', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-10 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($tibum as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor-dosen', ['m' => $m, 'isEven' => $isEven])
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Seksi PPM
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- PPM --}}
        <div class="w-full my-10">
            <div class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 sm:px-10 lg:px-28">
                @php
                    $koordinator = collect($ppm)->firstWhere('jabatan', 'Koordinator');
                @endphp
                @if ($koordinator)
                    @include('home.panitia.koor-dosen', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-10 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($ppm as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor-dosen', ['m' => $m, 'isEven' => $isEven])
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex justify-center">
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div class="flex flex-col justify-between mt-8">
                <div class="self-center px-5 text-center font-bohemianSoul text-[12px] text-merah-1 md:text-lg">
                    Seksi Umum
                </div>
                <div class="h-1 bg-coklat-2"></div>
            </div>
            <div>
                <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="wave" class="z-10 h-20">
                <div class="h-1 bg-coklat-2"></div>
            </div>
        </div>

        {{-- Umum --}}
        <div class="w-full my-10">
            <div class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 sm:px-10 lg:px-28">
                @php
                    $koordinator = collect($umum)->firstWhere('jabatan', 'Koordinator');
                @endphp
                @if ($koordinator)
                    @include('home.panitia.koor-dosen', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-10 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:gap-y-12 md:px-4 lg:px-28">
                @foreach ($umum as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor-dosen', ['m' => $m, 'isEven' => $isEven])
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</x-home-layout>
