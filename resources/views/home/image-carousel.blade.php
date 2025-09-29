<div class="swiper mySwiper" @click.away="showModalImage = false"
     @keydown.window="if (event.key === 'Escape') showModalImage = false">
    
    <div class="swiper-wrapper">
        @foreach ($photos as $p)
            <div class="swiper-slide flex items-center justify-center">

                <div class="flex flex-col items-center w-full">
                    <h1 class="text-center text-lg font-bohemianSoul pb-3 font-bold uppercase text-2025-3 sm:text-lg">
                        {{ $p->title }}
                    </h1>
                    
                    <img class="w-full px-4 sm:w-3/4 md:w-1/2 shadow-none" src="{{ $p->filename }}"
                         alt="Photo {{ $loop->index + 1 }}">
                </div>

            </div>
        @endforeach
    </div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>