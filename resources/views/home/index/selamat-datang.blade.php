<header class="w-full overflow-hidden bg-merah4-pattern p-0">

    {{-- desktop --}}
    <div class="relative hidden h-screen w-full md:flex">
        <div class="w-full">
            <img class="absolute inset-x-0 bottom-0 z-10 h-[105px] w-full"
                src="{{ asset('images/pattern/2024/hero-wave.png') }}" alt="wave">

            {{-- Elemen Kiri --}}
            <div class="absolute bottom-0 left-6 mb-[54px] flex flex-row items-end lg:left-12 xl:left-20 2xl:left-28">
                <img class="h-[25rem] lg:h-[30rem] 2xl:h-[40rem]" src="{{ asset('img/asset/2024/jam-gadang.png') }}"
                    alt="Jam Gadang" style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade left">
                <img class="shakeanim z-10 -ml-8 w-32 lg:w-40 2xl:w-48" src="{{ maskot1 }}" alt="Kambe"
                    style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade left">
            </div>
            {{-- Elemen Kiri End --}}

            {{-- Elemen Kanan --}}
            <div
                class="absolute bottom-0 right-6 mb-[54px] flex flex-row items-end lg:right-12 xl:right-20 2xl:right-28">
                <img class="shakeanim2 z-10 -mr-8 w-32 lg:w-40 2xl:w-48" src="{{ maskot2 }}" alt="Pika"
                    style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade right">
                <img class="h-[25rem] lg:h-[30rem] 2xl:h-[40rem]" src="{{ asset('img/asset/2024/jam-gadang.png') }}"
                    alt="Jam Gadang" style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade right">
            </div>
            {{-- Elemen Kanan End --}}

            <div class="flex h-full w-full flex-col items-center justify-center text-center text-white">
                <div class="mb-4 flex items-center justify-center">
                    <img src="{{ asset('img/asset/2024/sayap.png') }}" alt="sayap"
                        class="-mr-12 mt-10 w-1/4 2xl:-mr-5">
                    <span
                        class="z-10 rounded-full border-4 border-base-orange-500 bg-white px-8 py-2 text-center font-bohemianSoul text-2xl text-coklat-2 2xl:text-4xl"
                        style="filter: drop-shadow(0 0 0.25rem #000);">Selamat Datang</span>
                    <img src="{{ asset('img/asset/2024/sayap.png') }}" alt="sayap"
                        class="-ml-12 mt-10 w-1/4 scale-x-[-1] transform 2xl:-ml-5">
                </div>
                <h1 class="text-center font-aringgo text-3xl lg:text-4xl 2xl:text-6xl"
                    style="line-height:1.25; filter: drop-shadow(0 2px 2px rgba(255, 255, 255, 0.5));">
                    Mahasiswa Baru<br>
                    Angkatan 66
                </h1>
                <span class="mt-2 font-bohemianSoul text-2xl lg:text-3xl 2xl:text-5xl"
                    style="filter: drop-shadow(0 2px 2px rgba(255, 255, 255, 0.5));">Politeknik Statistika STIS</span>

                <img class="mt-12 w-32 lg:w-36 2xl:w-48" src="{{ LOGO }}" alt="Logo PKKMB-PKBN 2024">
            </div>
        </div>
    </div>

    {{-- mobile --}}
    <div class="relative flex h-screen w-full md:hidden">
        <div class="w-full">
            <img class="absolute inset-x-0 bottom-0 z-10 h-[105px] w-full"
                src="{{ asset('images/pattern/2024/hero-wave.png') }}" alt="wave">

            {{-- Elemen Kiri --}}
            <div class="absolute -left-20 bottom-0 mb-4 flex flex-row items-end">
                <img class="z-[1] h-[25rem] lg:h-[30rem]" src="{{ asset('img/asset/2024/jam-gadang.png') }}"
                    alt="Jam Gadang" style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade left">
                <img class="shakeanim z-10 -ml-16 w-28 sm:w-32" src="{{ maskot1 }}" alt="Kambe"
                    style="filter: drop-shadow(0 0 2px #fff);">
            </div>
            {{-- Elemen Kiri End --}}

            {{-- Elemen Kanan --}}
            <div class="absolute -right-20 bottom-0 mb-4 flex flex-row items-end">
                <img class="shakeanim2 z-10 -mr-16 w-28 sm:w-32" src="{{ maskot2 }}" alt="Pika"
                    style="filter: drop-shadow(0 0 2px #fff);">
                <img class="z-[1] h-[25rem] lg:h-[30rem]" src="{{ asset('img/asset/2024/jam-gadang.png') }}"
                    alt="Jam Gadang" style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade right">
            </div>
            {{-- Elemen Kanan End --}}

            <div
                class="absolute bottom-0 top-20 mt-12 flex w-full flex-col items-center justify-start text-center text-white">
                <img class="mb-6 w-[90px] sm:w-[110px]" src="{{ LOGO }}" alt="Logo PKKMB-PKBN 2024">
                <div class="mb-4 flex items-center justify-center">
                    <img src="{{ asset('img/asset/2024/sayap.png') }}" alt="sayap" class="-mr-12 mt-10 w-1/4">
                    <span
                        class="z-10 rounded-full border-4 border-base-orange-500 bg-white px-8 py-2 text-center font-bohemianSoul text-lg text-coklat-2 sm:text-2xl"
                        style="filter: drop-shadow(0 0 0.25rem #000);">Selamat Datang</span>
                    <img src="{{ asset('img/asset/2024/sayap.png') }}" alt="sayap"
                        class="-ml-12 mt-10 w-1/4 scale-x-[-1] transform">
                </div>
                <h1 class="text-center font-aringgo text-xl sm:text-3xl"
                    style="line-height:1.25; filter: drop-shadow(0 2px 2px rgba(255, 255, 255, 0.5));">
                    Mahasiswa Baru<br>
                    Angkatan 66
                </h1>
                <span class="mt-2 font-bohemianSoul text-lg sm:text-2xl"
                    style="filter: drop-shadow(0 2px 2px rgba(255, 255, 255, 0.5));">Politeknik Statistika STIS</span>
            </div>
        </div>
    </div>

    <div class="absolute inset-x-0">
        <div class="w-full translate-y-[-2px] bg-gradient-to-b from-base-orange-500 to-[rgba(255,255,255,1)]">
            <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28 " preserveAspectRatio="none">
                <defs>
                    <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
                    </path>
                </defs>
                <g class="wave1">
                    <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
                    </use>
                </g>
                <g class="wave2">
                    <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
                    </use>
                </g>
                <g class="wave3">
                    <use xlink:href="#wave-path" x="50" y="9" fill="rgba(255,255,255, .2)">
                    </use>
                </g>
            </svg>
        </div>
        <div class="h-[50px] w-full translate-y-[-2px] bg-gradient-to-b from-white to-[rgba(255,255,255,0)]">
        </div>
    </div>
</header>
