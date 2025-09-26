<x-home-layout menu="Panitia" title="Panitia Pelaksana Operasional - PKKMB-PKBN 2024">
    <div class="px-8 pt-24 pb-20 sm:px-8 md:px-12 md:pt-28 lg:pt-32 xl:px-16">

        <div class="grid w-full px-8 pb-4 sm:px-16 md:px-20 md:pb-12 xl:px-16">
            <div class="flex flex-row items-end justify-center w-full h-full gap-4">
                <img src="{{ asset('img/maskot/2025/maskot 5.png') }}" alt="wave" class="z-10 w-36 sm:w-48 -translate-x-6">
                    <div class="flex h-full flex-col items-center justify-center">
                        <div class="flex flex-row items-center justify-center gap-4 mt-14">
                            <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                                alt="Elemen 4" class="w-24 sm:w-28 -mr-28 z-10 -mt-8">
                            <h1
                                class="flex items-center justify-center rounded-full px-10 py-3 sm:px-16 lg:py-4 lg:pb-6
                                    font-brasikaDisplay text-center text-sm font-thin leading-normal 
                                    drop-shadow-md sm:text-2xl lg:text-3xl xl:text-4xl z-0 relative border-4"
                                style="color:#1E2A4A; background-color:#FFF3E6; border-color:#1E2A4A;">
                                PROFIL PANITIA
                            </h1>
                            <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                                alt="Elemen 4" class="w-24 sm:w-28 -ml-28 z-10 -mt-8 scale-x-[-1]">
                        </div>
                    </div>
                <img src="{{ asset('img/maskot/2025/maskot 2.png') }}" alt="wave" class="z-10 w-32 sm:w-40 translate-x-6">
            </div>
        </div>

        <div class="grid grid-cols-2 mx-4 mt-8 mb-12 gap-x-0 font-bohemianSoul lg:grid-cols-12">
            <a href="{{ route('home.ppo') }}"
                class="flex items-center justify-center col-span-1 py-1 border-4 rounded-l-full border-merah-1 bg-merah-1 text-base-white lg:col-start-4 lg:col-end-7">
                <h1 class="text-base md:text-xl lg:text-2xl">PPO</h1>
            </a>
            <a href="{{ route('home.dosen') }}"
                class="flex items-center justify-center col-span-1 py-1 border-4 rounded-r-full border-merah-1 text-merah-1 hover:bg-merah-1 hover:text-base-white lg:col-start-7 lg:col-end-10">
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
                    @if ($m['jabatan'] === 'KPO' || $m['jabatan'] === 'WKPO')
                        @include('home.panitia.panit-wo-koor')
                    @endif
                @endforeach
            </div>
            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 lg:md-gap-1 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($bph as $i => $m)
                    @if ($m['jabatan'] === 'Sekretaris I' || $m['jabatan'] === 'Sekretaris II')
                        @include('home.panitia.panit-wo-koor')
                    @endif
                @endforeach
            </div>
            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 lg:md-gap-1 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($bph as $i => $m)
                    @if ($m['jabatan'] === 'Bendahara I' || $m['jabatan'] === 'Bendahara II')
                        @include('home.panitia.panit-wo-koor')
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
                <div class="text-card-profile self-center px-5 text-center font-bohemianSoul text-[12px] md:text-lg">
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
                    @include('home.panitia.koor', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($acara as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor')
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
                <div class="text-card-profile self-center px-5 text-center font-bohemianSoul text-[12px] md:text-lg">
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
                    @include('home.panitia.koor', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($lapk as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor')
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
                <div class="text-card-profile self-center px-5 text-center font-bohemianSoul text-[12px] md:text-lg">
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
                    @include('home.panitia.koor', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($gramti as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor')
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
                <div class="text-card-profile self-center px-5 text-center font-bohemianSoul text-[12px] md:text-lg">
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
                    @include('home.panitia.koor', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($hpd as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor')
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
                <div class="text-card-profile self-center px-5 text-center font-bohemianSoul text-[12px] md:text-lg">
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
                    @include('home.panitia.koor', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($ppm as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor')
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
                <div class="text-card-profile self-center px-5 text-center font-bohemianSoul text-[12px] md:text-lg">
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
                    @include('home.panitia.koor', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($tibum as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor')
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
                <div class="text-card-profile self-center px-5 text-center font-bohemianSoul text-[12px] md:text-lg">
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
                    @include('home.panitia.koor', ['koordinator' => $koordinator])
                @endif
            </div>

            <div
                class="flex flex-row flex-wrap justify-center w-full mt-5 gap-x-4 md:gap-x-9 xl:gap-x-11 2xl:gap-x-16 gap-y-7 sm:px-10 md:mt-10 md:gap-y-12 md:px-10 lg:px-28">
                @foreach ($umum as $i => $m)
                    @php
                        $isEven = $i % 2 === 0;
                        $isKoordinator = $m['jabatan'] === 'Koordinator';
                    @endphp
                    @if ($i > 0)
                        @include('home.panitia.panit-w-koor')
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</x-home-layout>
