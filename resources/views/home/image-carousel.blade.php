<div class="swiper mySwiper" @click.away="showModalImage = false"
    @keydown.window="if (event.key === 'Escape') showModalImage = false">
    <div class="swiper-wrapper flex">
        @foreach ($photos as $p)
            <div class="swiper-slide">
                <div class="grid grid-cols-1">
                    <h1 class="text-center text-lg font-bold uppercase text-black sm:text-xl">
                        {{ $p->title }}
                    </h1>
                    <img class="mx-auto w-full px-4 sm:w-3/4 sm:pl-4 sm:pr-0 md:w-1/2" src="{{ $p->filename }}"
                        alt="Photo {{ $loop->index + 1 }}">
                    {{-- <div class="flex w-full flex-col bg-white bg-opacity-70 px-12 py-2 sm:px-4">
                        <h1 class="text-center text-lg font-bold uppercase text-black underline sm:text-xl">
                            {{ $p->title }}
                        </h1>
                        <p class="text-justify text-base text-black sm:text-lg">
                            {{ $p->caption }}
                        </p>
                    </div> --}}
                </div>
            </div>
        @endforeach
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>
