<x-home-layout menu="Galeri" title="Galeri Foto - PKKMB-PKBN 2024">
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

        <div class="grid w-full px-8 pb-4 pt-24 sm:px-16 md:px-20 md:pb-12 md:pt-28 lg:pt-32 xl:px-16">
            <div class="flex h-full w-full flex-row items-end justify-center gap-4">
                <img src="{{ asset('img/maskot/2025/maskot 1.png') }}" alt="wave" class="z-10 w-24 sm:w-28 -translate-x-6 translate-y-5">
                    <div class="flex h-full flex-col items-center justify-center">
                        <div class="flex flex-row items-center justify-center gap-4 mt-14">
                            <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                                alt="Elemen 4" class="w-24 sm:w-28 -mr-28 z-10 -mt-8">
                            <h1
                                class="flex items-center justify-center rounded-full px-10 py-3 sm:px-16 lg:py-4 lg:pb-6
                                    font-brasikaDisplay text-center text-sm font-thin leading-normal 
                                    drop-shadow-md sm:text-2xl lg:text-3xl xl:text-4xl z-0 relative border-4"
                                style="color:#1E2A4A; background-color:#FFF3E6; border-color:#1E2A4A;">
                                GALERI
                            </h1>
                            <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                                alt="Elemen 4" class="w-24 sm:w-28 -ml-28 z-10 -mt-8 scale-x-[-1]">
                        </div>
                    </div>
                <img src="{{ asset('img/maskot/2025/maskot 4.png') }}" alt="wave" class="z-10 w-24 sm:w-28 translate-x-6 translate-y-5">
            </div>
        </div>

        <div class="mx-4 mb-16 mt-8 grid grid-cols-2 gap-x-0 font-bohemianSoul sm:mb-20 lg:grid-cols-12">
            <a href="{{ route('home.galeri') }}"
                class="col-span-1 flex items-center justify-center rounded-l-full border-4 border-merah-1 bg-merah-1 py-1 text-base-white lg:col-start-4 lg:col-end-7">
                <h1 class="text-lg md:text-xl lg:text-2xl">Foto</h1>
            </a>
            <a href="{{ route('home.video') }}"
                class="col-span-1 flex items-center justify-center rounded-r-full border-4 border-merah-1 py-1 text-merah-1 hover:bg-merah-1 hover:text-base-white lg:col-start-7 lg:col-end-10">
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
                class="mb-20 flex w-full flex-col items-center justify-around gap-4 rounded-[38px] bg-merah3-pattern p-6 sm:gap-8 sm:p-8">
                <div class="{{ $isEven ? 'bg-event-odd' : 'bg-event-even' }} -mt-12 flex w-full items-center justify-center bg-white bg-repeat-x px-10 py-2 text-center font-bohemianSoul text-3xl font-normal leading-normal text-merah-2 sm:-mt-16 sm:px-16 md:px-28 md:py-4 md:text-4xl lg:px-40 lg:text-5xl"
                    style="border-radius: 30px;">
                    <span>
                        <img src="{{ asset('img/asset/2024/Elemen 5.png') }}" alt=""
                            style="filter: drop-shadow(0 0 2px #fff);">
                    </span>
                    <span class="mx-4 text-base text-coklat-2 sm:text-2xl"
                        style="filter: drop-shadow(2px 2px orange);">{{ $t->title }}</span>
                    <span>
                        <img class="scale-x-[-1]" src="{{ asset('img/asset/2024/Elemen 5.png') }}" alt=""
                            style="filter: drop-shadow(0 0 4px #fff);">
                    </span>
                </div>
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

                            <!-- Overlay yang muncul saat hover -->
                            {{-- <div x-cloak :class="{ 'inset-0': hovered, 'bottom-0 inset-x-0': !hovered }"
                                class="absolute flex flex-col items-center justify-center bg-black bg-opacity-70">
                                <span
                                    class="w-[90%] break-all text-center font-bohemianSoul text-sm font-bold uppercase tracking-wide text-white sm:text-lg"
                                    style="filter: drop-shadow(4px 4px #000);">
                                    {{ $p->title }}
                                </span>
                                <p :class="{ '': hovered, 'hidden': !hovered }"
                                    class="w-[90%] break-all font-nunito text-white">{{ $p->caption }}</p>
                            </div> --}}
                        </div>
                    @endforeach

                    <!-- Modal Image -->
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

                {{-- Tampilkan bila sudah login --}}
                @auth
                    @if (!empty($t->link_gallery))
                        <div class="flex w-full items-center justify-end">
                            <x-button :tagA='true' href="{{ $t->link_gallery }}" target="_blank"
                                class="rounded-3xl bg-base-orange-500 text-sm hover:bg-base-orange-600 sm:text-base">
                                Selengkapnya
                            </x-button>
                        </div>
                    @endif
                @endauth
            </div>
            @php
                $i++;
            @endphp

        @empty
            <div class="mb-20 flex w-full flex-col items-center justify-center rounded-[38px] bg-merah3-pattern">
                <div class="flex h-32 w-full items-center justify-center bg-white bg-opacity-30 p-6 sm:p-8">
                    <span
                        class="text-center font-bohemianSoul text-lg uppercase tracking-wider text-white sm:text-2xl">Belum
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
