<style>
    .hr {
        display: inline-block;
    }

    .hr::after {
        content: '';
        display: block;
        border-top: 4px solid #000000;
        margin-top: 0.5em;
    }
</style>

<x-home-layout menu="FAQ" title="FAQ">
    <!-- Judul -->
    <div class="grid w-full px-8 pb-4 pt-24 sm:px-16 md:px-20 md:pb-5 md:pt-28 lg:pt-32 xl:px-16">
    {{-- Header --}}
        <div class="flex h-full w-full flex-row items-end justify-center gap-4 translate-y-[-10px]">
            <img src="{{ asset('img/maskot/2025/maskot 0.png') }}" alt="wave" class="z-10 w-14 sm:w-24 md:w-28 lg:w-32 lg:-translate-x-4 transform translate-y-[-10px]">
                <div class="flex h-full flex-col items-center justify-center">
                    <div class="flex flex-row items-center justify-center gap-4 mt-14 transform translate-y-[-10px]">
                        <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                            alt="Elemen 4" class="w-14 sm:w-20 md:w-28 lg:w-28 -mr-14 sm:-mr-20 md:-mr-28 lg:-mr-28 sm:-mt-5 md:-mt-8 lg:-mt-8 z-10">
                        <h1
                            class="flex items-center justify-center rounded-full px-10 py-3 sm:px-8 sm:pb-4 lg:px-16 lg:py-4 lg:pb-6
                                font-brasikaDisplay text-center text-sm font-thin leading-normal 
                                drop-shadow-md sm:text-xl lg:text-3xl xl:text-4xl z-0 relative border-4"
                            style="color:#1E2A4A; background-color:#FFF3E6; border-color:#1E2A4A;">
                            FAQ
                        </h1>
                        <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                            alt="Elemen 4" class="w-14 sm:w-20 md:w-28 lg:w-28 -ml-14 sm:-ml-20 md:-ml-28 lg:-ml-28 sm:-mt-5 md:-mt-8 lg:-mt-8 z-10 scale-x-[-1]">
                    </div>
                </div>
            <img src="{{ asset('img/maskot/2025/maskot 0b.png') }}" alt="wave" class="z-10 w-14 sm:w-24 md:w-28 lg:w-32 lg:translate-x-4 transform translate-y-[-10px]">
        </div>
    </div>

    @foreach ($faqs as $faq)
        {{-- Page tiap pertanyaan kiri --}}
        <div class="mx-auto overflow-hidden w-[80%] rounded-lg my-6">
            <h1 class="indent-8 md:text-lg text-base text-merah-1 font-bohemianSoul hr">{{ $faq->pertanyaan }}</h1>
            <div class="w-full flex justify-start">
                <p class="p-4 bg-2025-1 text-xs md:text-base my-3 rounded-xl shadow-sm w-[97%] text-white text-justify font-nunito"
                    style="box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75)">
                    {{ $faq->jawaban }}</p>
            </div>
        </div>
    @endforeach
    {{-- Page tiap pertanyaan kanan --}}
    {{-- @php
        $i++
        @endphp --}}
    {{-- <div class="mx-auto overflow-hidden w-[90%] rounded-lg font-poppins my-6">
        <div class="w-full flex justify-end">
            <h1 class="indent-8 md:text-lg text-base  text-gray-700 font-bachelorReg hr">{{ pertanyaan()[$i] }}</h1>
        </div>
        <div class="w-full flex justify-start">
            <div class="w-[1.75%] bg-base-theme-100 rounded-l-lg my-3 -mr-1"></div>
            <div class="w-[1.75%] bg-base-theme-400 rounded-l-lg my-3 -mr-1 z-10"></div>
            <p class="p-4 bg-base-theme-500 text-xs md:text-base  my-3 rounded-lg shadow-sm w-[97%] text-gray-100 text-justify">{{ jawaban()[$i] }}</p>
        </div>
    </div> --}}
</x-home-layout>
