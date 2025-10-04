<x-home-layout menu="Galeri" title="Galeri Foto - PKKMB 2025">
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
        <style>
            body.no-scroll {
                overflow: hidden;
            }
        </style>
    @endpush

    <!-- GALERI FOTO -->
    <div class="px-8 font-archivo sm:px-8 md:px-12 xl:px-16">

        <div class="grid w-full px-8 pt-24 pb-4 sm:px-16 md:px-20 md:pb-5 md:pt-28 lg:pt-32 xl:px-16">
        {{-- Header --}}
            <div class="flex h-full w-full flex-row items-end justify-center gap-4 translate-y-[-10px]">
                <img src="{{ asset('img/maskot/2025/maskot 1.png') }}" alt="wave" class="z-10 w-14 sm:w-20 md:w-24 lg:w-28 mt-8 sm:mt-[34px]sm:mt-[34px] lg:-translate-x-4 transform translate-y-[-10px]">
                    <div class="flex flex-col items-center justify-center h-full">
                        <div class="flex flex-row items-center justify-center gap-4 mt-14 transform translate-y-[-10px]">
                            <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}"
                                alt="Elemen 4" class="z-10 w-14 sm:w-20 md:w-28 lg:w-28 -mr-14 sm:-mr-20 md:-mr-28 lg:-mr-28 sm:-mt-5 md:-mt-8 lg:-mt-8">
                            <h1
                                class="relative z-0 flex items-center justify-center px-10 py-3 text-sm font-thin leading-normal text-center border-4 rounded-full sm:px-8 sm:pb-4 lg:px-16 lg:py-4 lg:pb-6 font-brasikaDisplay drop-shadow-md sm:text-xl lg:text-3xl xl:text-4xl"
                                style="color:#1E2A4A; background-color:#FFF3E6; border-color:#1E2A4A;">
                                GALERI
                            </h1>
                            <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}"
                                alt="Elemen 4" class="w-14 sm:w-20 md:w-28 lg:w-28 -ml-14 sm:-ml-20 md:-ml-28 lg:-ml-28 sm:-mt-5 md:-mt-8 lg:-mt-8 z-10 scale-x-[-1]">
                        </div>
                    </div>
                <img src="{{ asset('img/maskot/2025/maskot 4.png') }}" alt="wave" class="z-10 w-14 sm:w-20 md:w-24 lg:w-28 mt-8 sm:mt-[34px] lg:translate-x-4 transform translate-y-[-10px]">
            </div>
        </div>

        <div class="grid grid-cols-2 mx-4 mt-8 mb-16 gap-x-0 font-bohemianSoul sm:mb-20 lg:grid-cols-12">
            <a href="{{ route('home.galeri') }}"
                class="flex items-center justify-center col-span-1 py-1 border-4 rounded-l-full border-2025-1 bg-2025-1 text-base-white lg:col-start-4 lg:col-end-7">
                <h1 class="text-lg md:text-xl lg:text-2xl">Foto</h1>
            </a>
            <a href="{{ route('home.video') }}"
                class="flex items-center justify-center col-span-1 py-1 border-4 rounded-r-full border-2025-1 text-2025-1 hover:bg-2025-1 hover:text-base-white lg:col-start-7 lg:col-end-10">
                <h1 class="text-lg md:text-xl lg:text-2xl">Video</h1>
            </a>
        </div>

        @php
            $i = 0;
        @endphp
        @forelse ($timelines as $t)
            @php
                $isEven = $i % 2 == 0;
                $photos = \App\Models\Gallery::foto()
                    ->where('event_id', $t->id)
                    ->orderByDesc('id')
                    ->limit(6)
                    ->get();
            @endphp
            <div
                class="relative mb-20 flex w-full flex-col items-center justify-around gap-4 rounded-[38px] bg-2025-1 p-6 sm:gap-8 sm:p-8">

                <div class="absolute inset-0 rounded-[38px] bg-motif3-pattern bg-repeat bg-[size:400px] opacity-25"></div>

                <div class="relative w-full">

                    <h5 class="flex items-center justify-center gap-2 mb-4 text-lg font-medium font-brasikaDisplay">
                        <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" alt="Cempaka Merah"
                            class="w-8 h-7">

                        <div class="flex items-center justify-center">
                            <h2 class="px-3 lg:px-5 py-2 rounded-full text-center text-sm sm:text-sm md:text-sm lg:text-lg text-2025-1 mx-4 z-10 bg-[radial-gradient(circle,#ffffff,#FFD183)]"
                                style="text-align: center; filter: drop-shadow(0 0 0.25rem #000);">
                                {{ $t->title }}
                            </h2>
                        </div>

                        <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" alt="Cempaka Merah"
                            class="w-8 h-7">
                    </h5>

                    <div x-data="{ showModalImage: false }" class="grid grid-cols-2 gap-4 lg:grid-cols-3">
                        @foreach ($photos as $p)
                            <div x-data="{ hovered: false, width: window.innerWidth }" x-init="window.addEventListener('resize', () => {
                                width = window.innerWidth;
                            });" @mouseenter="hovered = true"
                                @mouseleave="hovered = false" @click="showModalImage = true"
                                class="relative flex flex-col items-center justify-center bg-base-grey-700">
                                <img x-cloak class="w-full object-cover shadow-xl hover:scale-[1.05] custom-shadow-hover"
                                    src="{{ $p->filename }}" alt="Photo {{ $loop->index + 1 }}"
                                    :style="(width >= 640) ? 'aspect-ratio: 16/9' : 'aspect-ratio: 1/1'">
                            </div>
                        @endforeach

                        <div x-cloak x-show="showModalImage" x-init="$watch('showModalImage', value => document.body.classList.toggle('no-scroll', value))">
                            <x-modal.galeri judul="{{ $t->title }}">
                                <x-slot name="closeButton">
                                    <div x-on:click="showModalImage = false">
                                        <x-close-button />
                                    </div>
                                </x-slot>

                                @include('home.image-carousel', ['photos' => $photos])
                            </x-modal.galeri>
                        </div>
                    </div>

                </div> </div>
            @php
                $i++;
            @endphp

        @empty
            <div class="mb-20 flex w-full flex-col items-center justify-center rounded-[38px] bg-merah3-pattern">
                <div class="flex items-center justify-center w-full h-32 p-6 bg-white bg-opacity-30 sm:p-8">
                    <span
                        class="text-lg tracking-wider text-center text-white uppercase font-bohemianSoul sm:text-2xl">Belum
                        ada gambar yang tersedia</span>
                </div>
            </div>
        @endforelse
    </div>

    @push('script-bottom')
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <script>
            var mySwiper = new Swiper('.mySwiper', {
                loop: true,
                speed: 1000,
                autoplay: {
                    delay: 5000,
                },
                effect: 'coverflow',
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: 1,
                initialSlide: 0,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

            });
        </script>
    @endpush
</x-home-layout>
