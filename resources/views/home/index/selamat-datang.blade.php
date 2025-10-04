<header class="w-full h-[125vh] md:h-[130vh] overflow-hidden pt-10 pb-30 p-0 bg-[img/asset/2025/vektor.png] bg-center">

  <div class="absolute inset-0 bg-gradient-to-b from-[#e15586] via-[#8b2f4b] to-[#1e2a4a] bg-center z-0 mix-blend-multiply"></div>
    {{-- desktop --}}
    <div class="relative hidden h-screen w-full md:flex">

            {{-- Elemen Kiri --}}
    <div class="absolute bottom-0 left-4 mb-8 flex flex-row items-end sm:left-6 md:left-10 lg:left-14 xl:left-25 2xl:left-28">
        <img class="h-[120px] sm:h-[160px] md:h-[200px] lg:h-[260px] xl:h-[320px] 2xl:h-[371px] mb-[80px] sm:mb-[120px] md:mb-[175px]"
             src="{{ asset('img/asset/2025/rumah.png') }}"
             alt="Rumah Adat Tongkonan"
             style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade-left">
        <img class="shakeanim z-10 ml-[-100px] sm:ml-[-160px] md:ml-[-180px] lg:ml-[-240px] w-[100px] sm:w-[140px] md:w-[180px] lg:w-[220px] xl:w-[250px] mb-[60px] sm:mb-[90px] md:mb-[125px]"
             src="{{ maskot5 }}" alt="Tora"
             style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade-left">
    </div>
    {{-- Elemen Kiri End --}}

    {{-- Elemen Kanan --}}
    <div class="absolute bottom-0 right-4 mb-8 flex flex-row items-end sm:right-6 md:right-10 lg:right-14 xl:right-25 2xl:right-28">
        <img class="shakeanim2 z-10 mr-[-100px] sm:mr-[-160px] md:mr-[-180px] lg:mr-[-240px] w-[100px] sm:w-[140px] md:w-[180px] lg:w-[220px] xl:w-[250px] mb-[60px] sm:mb-[90px] md:mb-[125px]"
             src="{{ maskot6 }}" alt="Tira"
             style="filter: drop-shadow(0 0 2px #fff);" data-aos="fade-right">
        <img class="h-[120px] sm:h-[160px] md:h-[200px] lg:h-[260px] xl:h-[320px] 2xl:h-[371px] mb-[80px] sm:mb-[120px] md:mb-[175px]"
             src="{{ asset('img/asset/2025/rumah.png') }}"
             alt="Rumah Adat Tongkonan"
             style="filter: drop-shadow(0 0 2px #fff); transform: scaleX(-1);" data-aos="fade-right">
    </div>
    {{-- Elemen Kanan End --}}

                {{-- Elemen Tengah --}}
    <section class="flex flex-col items-center justify-center flex-grow text-center py-10">
            <div class="flex h-full w-full flex-col items-center justify-center text-center">
                <img class="ml-[25px] w-[100px] md:w-[193px] lg:w-[193px] mb-[-80px]" src="{{ LOGO }}" alt="Logo PKKMB-PKBN 2025">
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
    </div>
    </section>

    {{-- mobile --}}
    <div class="relative flex h-screen w-full md:hidden mt-14 sm:mt-24">

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
           <section class="flex flex-col items-center justify-center flex-grow text-center pt-10 mt-[-200px]">
            <div class="flex h-full w-full flex-col items-center justify-center text-center">
                <img class="w-[150px] lg:w-[193px] mb-[-90px] ml-[15px] sm:mb-[-150px] :mb-[]" src="{{ LOGO }}" alt="Logo PKKMB-PKBN 2025">
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
                         class="w-[40px] md:w-[63px]"  alt="elemen1">
                         <span class="text-3xl md-text-7xl lg:text-5xl font-brasikaDisplay text-[#FDE4BB] mt-[-3px]"
                               style="filter: drop-shadow(3px 3px 3px #FFB73E);">
                            67
                         </span>
                    <img src="{{ asset('img/asset/2025/Elemen 1.png') }}" alt="elemen1" class="w-[40px] md:wd-[63px] transform scale-x-[-1]">
                </div>
            </div>
            {{-- Elemen Tengah End --}}
            </section>
        </div>
    </div>

    <div class="-mt-24 sm:-mt-36 md:mt-0">
  <!-- SELENDANG TRANSISI DESKTOP -->
  <div class="relative z-0 w-full h-[80px] lg:h-[133px] md:block bg-[#1e2a4ad8] mt-[-40px] flex items-center justify-center">
    
    <!-- Selendang Atas -->
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-[200px] lg:h-[300px] w-[105%]">
      <div class="absolute w-full h-full animate-swayslow-1">
            <img src="img/asset/2025/selendang 1.png" alt="selendang1" class="w-full h-[200px] lg:h-[300px]" />
      </div>
  </div>
    <!-- Selendang Bawah -->
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-[200px] lg:h-[300px] w-[105%]">
      <div class="absolute w-full h-full animate-swayslow-2 ">
            <img src="img/asset/2025/selendang 2.png" alt="selendang2" class="w-full h-[200px] lg:h-[300px]" />
      </div>
    </div>
  </div>
</div>
</header>
