<header class="w-full overflow-hidden bg-coklat-pattern p-0" style="border-radius: 0 0 90px 90px;">

    {{-- desktop --}}
    <div class="relative hidden h-[90vh] w-full md:flex lg:h-screen">
        <div class="w-full items-center justify-center">
            <img class="absolute left-0 top-0 md:w-[12em] lg:w-[20em]" src="{{ asset('img/asset/2024/Elemen 1.png') }}"
                alt="">
            <img class="absolute right-0 top-0 md:w-[12em] lg:w-[20em]" src="{{ asset('img/asset/2024/Elemen 6.png') }}"
                alt="">
            <img class="absolute bottom-0 left-0 md:w-[12em] lg:w-[20em]"
                src="{{ asset('img/asset/2024/Elemen 2.png') }}" alt="">
            <img class="absolute bottom-0 right-0 rotate-180 md:w-[12em] lg:w-[20em]"
                src="{{ asset('img/asset/2024/Elemen 1.png') }}" alt="">

            <div class="mt-[36px] flex h-full w-full flex-col items-center justify-center text-center text-white">
                <span class="mb-2 font-nunito text-3xl lg:text-4xl">Selamat Datang</span>
                <h1 class="text-center font-bohemianSoul text-5xl lg:text-6xl" style="line-height:1.25">
                    Mahasiswa Baru<br>
                    Angkatan 66
                </h1>
                <span class="mt-2 font-nunito text-3xl lg:text-4xl">Di Politeknik Statistika STIS</span>

                <div class="mt-12 flex w-full items-center justify-center gap-x-4 lg:gap-x-6">
                    <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-24 lg:w-28">
                    <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-24 lg:w-28">
                    <img class="mx-4 w-24 lg:w-28" src="{{ LOGO }}" alt="Logo PKKMB-PKBN 2024">
                    <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-24 lg:w-28">
                    <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-24 lg:w-28">
                </div>
            </div>
        </div>
    </div>

    {{-- mobile --}}
    <div class="relative flex h-full w-full md:hidden">
        <div class="mb-[96px] w-full items-center justify-center">
            <img class="absolute left-0 top-0 w-[8em]" src="{{ asset('img/asset/2024/Elemen 1.png') }}" alt="">
            <img class="absolute right-0 top-0 w-[8em]" src="{{ asset('img/asset/2024/Elemen 6.png') }}"
                alt="">
            <img class="absolute bottom-0 left-0 w-[8em]" src="{{ asset('img/asset/2024/Elemen 2.png') }}"
                alt="">
            <img class="absolute bottom-0 right-0 w-[8em] rotate-180" src="{{ asset('img/asset/2024/Elemen 1.png') }}"
                alt="">

            <div class="mt-16 flex h-full w-full flex-col items-center justify-center px-2 text-center text-white">
                <img class="w-24 lg:w-28" src="{{ LOGO }}" alt="Logo PKKMB-PKBN 2024">
                <span class="mb-2 font-nunito sm:text-3xl text-2xl">Selamat Datang</span>
                <h1 class="text-center font-bohemianSoul sm:text-4xl text-3xl" style="line-height:1.25">
                    Mahasiswa Baru<br>
                    Angkatan 66
                </h1>
                <span class="mt-2 font-nunito sm:text-3xl text-2xl">Di Politeknik Statistika STIS</span>

                <div class="mt-6 flex w-full items-center justify-center gap-x-4 lg:gap-x-6">
                    <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-20 lg:w-24">
                    <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-20 lg:w-24">
                    <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-20 lg:w-24">
                </div>
            </div>
        </div>
    </div>
</header>
