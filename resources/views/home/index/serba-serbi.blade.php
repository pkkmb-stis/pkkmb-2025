<div class="bg-fixed bg-kuning2-pattern px-0 pb-10 w-full overflow-hidden" id="serba-serbi" style="border-radius: 30px;">
    <div class="flex justify-center m-8">
        <div class="p-0 relative w-full">
            <div class="flex justify-center items-center h-auto w-auto">
                <div class="flex justify-center items-center text-center h-auto w-full">
                    <div class="flex lg:px-40 md:px-28 sm:px-16 px-10 py-1 justify-center items-center font-normal text-center bg-kuning-pattern lg:text-5xl md:text-4xl text-3xl leading-normal text-white font-bohemianSoul w-full" style="border-radius: 30px">
                        Serba - Serbi
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-motif1 bg-repeat-x bg-top flex justify-center items-end md:gap-8 gap-4">
        <div>
            <img src="{{ asset('img/asset/2024/senjata.png') }}" alt="" class="md:w-32 pl-4">
        </div>
        <div class="bg-merah3-pattern lg:w-3/4 w-[80%] mt-6" style="border-radius: 1.875rem;">
            <div class="owl-carousel serba-carousel">
                @foreach ($video as $v)
                <div>
                    <div class="flex justify-center m-auto lg:pt-10 pt-4 pb-4">
                        <p class="text-white text-xs lg:text-4xl font-medium bg-merah-1 mx-6 font-bachelorReg text-md md:text-2xl py-1 lg:px-36 md:py-6 w-full rounded-xl leading-tight text-center">
                            {{ $v->title }}
                        </p>
                    </div>

                    <div class=" flex justify-center items-center m-auto h-full lg:pt-6">
                        <iframe class="drop-shadow-2xl lg:px-36 w-full h-36 md:h-80 lg:h-96 shadow-2xl" src="{{ $v->filename }}"></iframe>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div>
            <img src="{{ asset('img/asset/2024/senjata.png') }}" alt="" class="md:w-32 scale-x-[-1] pl-4">
        </div>
    </div>
</div>

@push('css')
<style>
    #serba-serbi .video-serba-serbi {
        box-shadow: 
        1px 1px 0 #012E4F,
        2px 2px 0 #012E4F,
        3px 3px 0 #012E4F,
        4px 4px 0 #012E4F,
        5px 5px 0 #012E4F,
        6px 6px 0 #012E4F,
        7px 7px 0 #012E4F,
        8px 8px 0 #012E4F,
        9px 9px 0 #012E4F,
        10px 10px 0 #012E4F,
        11px 11px 0 #012E4F,
        12px 12px 0 #012E4F,
        13px 13px 0 #012E4F,
        14px 14px 0 #012E4F,
        15px 15px 0 #012E4F;
    }
</style>
@endpush

@push('script-bottom')
<script type="text/javascript">
    $(document).ready(function() {
        $(".serba-carousel").owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            items: 1,
            dotsClass: "custom-owl-dots",
            dotClass: "custom-owl-dot",
            navText: [
                '<div class="custom-nav-prev text-white">&#10094;</div>',
                '<div class="custom-nav-next text-white">&#10095;</div>'
            ],
            navClass: ['custom-owl-prev absolute left-0 transform -translate-y-1/2', 'custom-owl-next absolute right-0 transform -translate-y-1/2']
        });
    });


</script>
@endpush
