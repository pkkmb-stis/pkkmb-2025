<header class="w-full overflow-hidden bg-background1-pattern bg-center bg-no-repeat p-0">

    {{-- desktop --}}
    <div class="relative hidden h-screen w-full md:flex">

            {{-- Elemen Kiri --}}
            <div class="absolute bottom-0 left-6 mb-[54px] flex flex-row items-end lg:left-10 xl:left-18 2xl:left-26">
                <img class="h-[200px] lg:h-[200px] 2xl:h-[371px] mb-[175px]" src="{{ asset('img/asset/2025/rumah.png') }}"
                    alt="Rumah Adat Tongkonan" style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade left">
                <img class="shakeanim z-10 ml-[-240px] w-[180px] lg:w-[180px] 2xl:w-[250px] mb-[125px]" src="{{ maskot5 }}" alt="Tora"
                    style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade left">
            </div>
            {{-- Elemen Kiri End --}}

            {{-- Elemen Kanan --}}
            <div class="absolute bottom-0 right-6 mb-[54px] flex flex-row items-end lg:right-10 xl:right-18 2xl:right-26">
                <img class="shakeanim2 z-10 mr-[-240px] w-[180px] lg:w-[180px] 2xl:w-[250px] mb-[125px]" src="{{ maskot6 }}" alt="Tira"
                    style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade right">
                <img class="h-[200px] lg:h-[200px] 2xl:h-[371px] mb-[175px]" src="{{ asset('img/asset/2025/rumah.png') }}"
                    alt="Rumah Adat Tongkonan" style="filter: drop-shadow(0 0 2px #fff); transform: scaleX(-1);" data-aos="fade right">
            </div>
            {{-- Elemen Kanan End --}}

            {{-- Elemen Tengah --}}
            <section class="flex flex-col items-center justify-center flex-grow text-center py-10">    
            <div class="flex h-full w-full flex-col items-center justify-center text-center">
                <img class="w-32 md:w-[212px] lg:w-[193px] mb-[-80px]" src="{{ LOGO }}" alt="Logo PKKMB-PKBN 2025">
                <svg viewBox="0 -100 750 300" class="flex w-auto h-auto md:w-96 overflow-visible mb-2 items-center justify-center ml-[15px]">
                    <defs>
                        <path id="curveDown" d="M 50 200 Q 360 120 667 200" fill="tranparent"/>
                    </defs>
                    <text fill="#FFEAC8" font-size="80" font-weight="700" class="font-poppins" style="filter: drop-shadow(0 10px 10px #855910)">
                         <textpath xlink:href="#curveDown" startOffset="50%" text-anchor="middle">
                            Selamat Datang    
                         </textpath>
                    </text>
                </svg>

                <h1 class="text-[#FFDBE8] font-brasikaDisplay text-4xl md:text-5xl lg:text-6xl mb-2 flex items-center justify-center"
                    style="line-height:1.25; filter: drop-shadow(0 0 14px #FF3B7F);">
                    Mahasiswa Baru
                </h1>
                <span class="text-[#FFFFFF] mt-2 font-chaTime text-2xl lg:text-2xl 2xl:text-4xl flex items-center justify-center"
                    style="filter: drop-shadow(0 5px 6px #FF3B7F);">Politeknik Statistika STIS</span>
                <p class="text-[#FFE1AF] mt-2 font-chaTime text-2xl lg:text-2xl 2xl:text-3xl flex items-center justify-center"
                    style="filter: drop-shadow(0 0.97 0.97 #FFE1AF);">Angkatan</p>
                <div class="flex item-center justify-center space-x-7 mb-12">
                    <img src="{{ asset('img/asset/2025/Elemen 1.png') }}"
                         class="w-[63px] md:w-[63px]">
                         <span class="text-3xl md-text-7xl lg:text-5xl font-brasikaDisplay text-[#FDE4BB] mb-[-5px]"
                               style="filter: drop-shadow(3px 3px 3px #FFB73E);">
                            67
                         </span>
                    <img src="{{ asset('img/asset/2025/Elemen 1.png') }}" class="w-[63px] md:wd-[63px] transform scale-x-[-1]">
                </div>
            </div>
            {{-- Elemen Tengah End --}}
            </section>

             {{-- Elemen Bawah --}}
              <div class="absolute bottom-0 left-0 w-full h-20 bg-no-repeat bg-center bg-cover">
                <img src = "resources/images/pattern/2025/motif_.jpg">
              </div>
            {{-- Elemen Bawah End --}}
        </div>
    </div>

    {{-- mobile --}}
    <div class="relative flex h-screen w-full md:hidden">

            {{-- Elemen Kiri --}}
            <div class="absolute bottom-0 left-6 mb-[54px] flex flex-row items-end lg:left-10 xl:left-18 2xl:left-26">
              <img class="h-[136px] lg:h-[200px] 2xl:h-[371px] mb-[175px]" src="{{ asset('img/asset/2025/rumah.png') }}"
                    alt="Rumah Adat Tongkonan" style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade left">
                <img class="shakeanim z-10 ml-[-120px] w-[122px] lg:w-[136px] mb-[150px]" src="{{ maskot5 }}" alt="Tora"
                    style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade left">
            </div>
            {{-- Elemen Kiri End --}}

            {{-- Elemen Kanan --}}
             <div class="absolute bottom-0 right-6 mb-[54px] flex flex-row items-end lg:right-10 xl:right-18 2xl:right-26">
                <img class="shakeanim2 z-10 mr-[-120px] w-[122px] lg:w-[136px] mb-[150px]" src="{{ maskot6 }}" alt="Tira"
                    style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade right">
                <img class="h-[136px] lg:h-[200px] 2xl:h-[371px] mb-[175px]" src="{{ asset('img/asset/2025/rumah.png') }}"
                    alt="Rumah Adat Tongkonan" style="filter: drop-shadow(0 0 2px #fff); transform: scaleX(-1);" data-aos="fade right">
            </div>
            {{-- Elemen Kanan End --}}

            {{-- Elemen Tengah --}}
           <section class="flex flex-col items-center justify-center flex-grow text-center py-10 mt-[-200px]">    
            <div class="flex h-full w-full flex-col items-center justify-center text-center">
                <img class="w-[100px] md:w-[212px] lg:w-[193px] mb-[-80px]" src="{{ LOGO }}" alt="Logo PKKMB-PKBN 2025">
                <svg viewBox="0 -100 750 300" class="flex w-auto h-auto md:w-96 overflow-visible mb-[-5px] items-center justify-center ml-[15px]">
                    <defs>
                        <path id="curveDown" d="M 50 200 Q 360 120 667 200" fill="tranparent"/>
                    </defs>
                    <text fill="#FFEAC8" font-size="50" font-weight="700" class="font-poppins" style="filter: drop-shadow(0 10px 10px #855910)">
                         <textpath xlink:href="#curveDown" startOffset="50%" text-anchor="middle">
                            Selamat Datang    
                         </textpath>
                    </text>
                </svg>

                <h1 class="text-[#FFDBE8] font-brasikaDisplay text-4xl md:text-5xl lg:text-6xl mb-2 flex items-center justify-center"
                    style="line-height:1.25; filter: drop-shadow(0 0 14px #FF3B7F);">
                    Mahasiswa Baru
                </h1>
                <span class="text-[#FFFFFF] mt-2 font-chaTime text-2xl lg:text-2xl 2xl:text-4xl flex items-center justify-center"
                    style="filter: drop-shadow(0 5px 6px #FF3B7F);">Politeknik Statistika STIS</span>
                <p class="text-[#FFE1AF] mt-2 font-chaTime text-2xl lg:text-2xl flex items-center justify-center"
                    style="filter: drop-shadow(0 0.97 0.97 #FFE1AF);">Angkatan</p>
                <div class="flex item-center justify-center space-x-7 mb-12">
                    <img src="{{ asset('img/asset/2025/Elemen 1.png') }}"
                         class="w-[40px] md:w-[63px]">
                         <span class="text-3xl md-text-7xl lg:text-5xl font-brasikaDisplay text-[#FDE4BB] mt-[-3px]"
                               style="filter: drop-shadow(3px 3px 3px #FFB73E);">
                            67
                         </span>
                    <img src="{{ asset('img/asset/2025/Elemen 1.png') }}" class="w-[40px] md:wd-[63px] transform scale-x-[-1]">
                </div>
            </div>
            {{-- Elemen Tengah End --}}
            </section>

            {{-- Elemen Bawah --}}

            {{-- Elemen Bawah End --}}
        </div>
    </div>
</header>
