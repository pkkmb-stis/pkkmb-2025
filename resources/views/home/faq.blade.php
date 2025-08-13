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
    <div class="grid lg:pt-32 md:pt-28 pt-24">
        <div class="sm:px-16 md:px-20 xl:px-16 md:pb-12 pb-4 px-8 w-full">
            <div class="flex flex-row justify-center items-end gap-4 w-full h-full">
                <img src="{{ asset('img/maskot/kambe faq.png') }}" alt="wave" class="z-10 sm:w-32 w-24">
                <div class="flex flex-col h-full justify-center items-center">
                    <img src="{{ asset('img/asset/2024/Elemen 4.png') }}" alt="Elemen 4">
                    <h1 class="font-thin xl:text-4xl lg:text-3xl text-sm leading-normal text-merah-1 font-aringgo text-center py-3 lg:py-4 px-6 sm:px-12 bg-putih-100 rounded-full align-middle drop-shadow-md"
                        >
                        FAQ
                    </h1>
                    <img src="{{ asset('img/asset/2024/Elemen 4.png') }}" alt="Elemen 4" class="rotate-180">
                </div>
                <img src="{{ asset('img/maskot/kambe faq.png') }}" alt="wave"
                    class="z-10 sm:w-32 w-24 scale-x-[-1]">
            </div>
        </div>
    </div>

    @foreach ($faqs as $faq)
        {{-- Page tiap pertanyaan kiri --}}
        <div class="mx-auto overflow-hidden w-[80%] rounded-lg my-6">
            <h1 class="indent-8 md:text-lg text-base text-merah-1 font-bohemianSoul hr">{{ $faq->pertanyaan }}</h1>
            <div class="w-full flex justify-start">
                <p class="p-4 bg-coklat-2 text-xs md:text-base my-3 rounded-xl shadow-sm w-[97%] text-white text-justify font-nunito"
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
