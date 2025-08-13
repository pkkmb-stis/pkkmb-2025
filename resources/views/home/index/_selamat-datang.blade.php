<header class="w-full overflow-hidden bg-coklat-pattern p-5 pt-20 sm:px-16 md:p-0 md:pb-5"
    style="border-radius: 0 0 90px 90px;">

    {{-- desktop --}}
    <div class="hidden h-full w-full pt-6 md:flex 2xl:h-screen">
        <div
            class="mx-4 mt-[48px] grid w-full grid-cols-2 items-center justify-center gap-2 text-white md:mx-8 lg:gap-4">
            <div class="flex flex-col gap-y-4 lg:gap-y-8">
                <h1 class="font-bohemianSoul text-[2em] uppercase lg:text-[2.625em]">
                    <span id="welcome1"></span><br>
                    <span id="polstat1"></span>
                </h1>
                <div class="mt-8 flex flex-row gap-x-4 lg:gap-x-8">
                    <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-24 lg:w-32">
                    <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-24 lg:w-32">
                    <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-24 lg:w-32">
                </div>
            </div>
            <div class="flex w-full flex-row justify-end">
                <img src="{{ asset('img/asset/2024/jam-gadang kambe.png') }}" alt="Kambe with Jam Gadang"
                    class="h-[22.5em] w-auto lg:h-[30em] xl:h-[35em]" data-aos="fade left"
                    style="filter: drop-shadow(0 0 3px #000);">
                <img src="{{ asset('img/asset/2024/jam-gadang pika.png') }}" alt="Pika with Jam Gadang"
                    class="h-[22.5em] w-auto lg:h-[30em] xl:h-[35em]" data-aos="fade right"
                    style="filter: drop-shadow(0 0 3px #000);">
            </div>
        </div>
    </div>

    {{-- mobile --}}
    <div class="flex h-full w-full pt-6 md:hidden">
        <div class="flex w-full flex-col">
            <div class="block">
                <div class="flex w-full flex-col items-center justify-center font-bohemianSoul text-base-white">
                    <h1 class="text-shadow text-center text-2xl" id="welcome2"></h1>
                    <h2 class="text-shadow text-center text-2xl" id="polstat2"></h2>
                </div>
                <div class="my-8 grid grid-cols-12 items-end gap-[0.5rem]">
                    <div class="col-span-3">
                        <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="Jam Gadang"
                            style="filter: drop-shadow(0 0 3px #000);">
                    </div>
                    <div class="col-span-3">
                        <img src="{{ maskot1 }}" class="w-32" alt="Kambe"
                            style="filter: drop-shadow(0 0 3px #000);">
                    </div>
                    <div class="col-span-3">
                        <img src="{{ maskot2 }}" class="w-32" alt="Pika"
                            style="filter: drop-shadow(0 0 3px #000);">
                    </div>
                    <div class="col-span-3">
                        <img src="{{ asset('img/asset/2024/jam-gadang.png') }}" alt="Jam Gadang"
                            style="filter: drop-shadow(0 0 3px #000);">
                    </div>
                </div>
                <div class="mb-6 flex items-center justify-center gap-x-12">
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-36">
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-44">
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('img/asset/2024/Elemen 3.png') }}" alt="Elemen 3" class="spinspin w-36">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
