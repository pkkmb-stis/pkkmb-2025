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

    .faq-container {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .faq-container:hover {
        transform: scale(1.03); 
        z-index: 30; 
        box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.2);
        border-radius: 0.75rem; 
    }

    @media (max-width: 768px) {
        .faq-wrapper {
            width: 90%;
        }

        .faq-question h1 {
            font-size: 1rem; 
        }
        .faq-answer p {
            font-size: 0.875rem; 
        }
    }

    @media (max-width: 640px) {
        .faq-wrapper {
            width: 95%;
        }

        .faq-question img[alt="ornamen"] {
            display: none;
        }

        .faq-question {
            padding-left: 1rem;
            padding-right: 1rem;
            justify-content: center; 
        }

        img[alt="Maleo"] {
            width: 5rem; 
            height: auto;
        }
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

{{-- Container utama dengan background --}}
<div class="w-full relative overflow-hidden pb-6 sm:pb-8 md:pb-12 lg:pb-16"        
     style="background-image: url('{{ asset('img/asset/2025/wafe-panjang.png') }}'); 
            background-size: 100% 100%, cover; 
            background-repeat: no-repeat; 
            background-position: top center; 
            padding-top: 100px;"> 

{{{-- Burung Maleo Kiri (posisi diatur ulang) --}}
    <img src="{{ asset('img/asset/2025/maleo.png') }}" alt="Maleo" 
         class="absolute left-4 top-0 
                w-28 h-32 sm:w-32 md:w-36 lg:w-40 
                z-0 scale-x-[-1]" 
         style="object-fit: contain;">

    {{-- Burung Maleo Kanan (posisi diatur ulang) --}}
    <img src="{{ asset('img/asset/2025/maleo.png') }}" alt="Maleo" 
         class="absolute right-4 top-0 
                w-28 h-32 sm:w-32 md:w-36 lg:w-40 
                z-0" 
         style="object-fit: contain;">

    <div class="faq-wrapper mx-auto w-[80%] sm:w-[75%] md:w-[70%] relative z-10">

    @foreach ($faqs as $faq)
    <div class="faq-container mx-auto w-[80%] my-6 relative z-10">

        {{-- Kotak Pertanyaan --}}
        <div class="relative flex items-center justify-between px-4 py-3 sm:px-6 sm:py-4 bg-gradient-to-b from-[#F4E2CE] to-[#F9C46B] border-2 border-[#A25869] rounded-t-xl rounded-b-md shadow-md mb-[-10px] z-20">
            
        {{-- Ornamen Kiri --}}
            <img src="{{ asset('img/asset/2025/Cempaka_Merah_polos .png') }}" alt="ornamen" class="w-8 h-8 hidden sm:block">

            {{-- Teks Pertanyaan --}}
            <h1 class="flex-grow text-center text-base sm:text-lg text-[#1E2A4A] font-bohemianSoul leading-tight">
                {{ $faq->pertanyaan }}
            </h1>

            {{-- Ornamen Kanan --}}
            <img src="{{ asset('img/asset/2025/Cempaka_Merah_polos .png') }}" alt="ornamen" class="w-8 h-8 hidden sm:block">
        </div>

        {{-- Kotak Jawaban --}}
        <div class="relative bg-gradient-to-b from-[#FFF2E2] to-[#FFE2BF] border-2 border-[#A25869] rounded-b-xl px-4 py-3 sm:px-6 sm:py-4 pt-6 z-10">
            <p class="text-xs sm:text-base text-[#1E2A4A] font-nunito leading-snug">
                {{ $faq->jawaban }}
            </p>
        </div>
    </div>
@endforeach
</x-home-layout>
