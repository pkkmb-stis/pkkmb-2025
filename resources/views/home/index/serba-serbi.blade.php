<div class="w-full px-0 pb-10 overflow-hidden bg-fixed bg-cover opacity" id="serba-serbi">
<!-- ===== HEADER SERBA SERBI ===== -->
<div class="flex justify-center mt-6 sm:mt-10 lg:mt-12">
  <div class="relative w-full">
    <!-- Layer background biru tua -->
    <div class="w-full bg-[#1C2E4A] relative flex items-center justify-center
                h-12 sm:h-14 md:h-16 lg:h-20 xl:h-20">

    <!-- Ornamen kiri -->
<img src="{{ asset('img/asset/2025/ornament serba_serbi.png') }}"
     alt="ornamen kiri"
     class="absolute left-0 z-20 object-contain w-16 -translate-y-1/2 sm:w-20 md:w-28 lg:w-36 xl:w-40 top-1/2" />

<!-- Ornamen kanan -->
<img src="{{ asset('img/asset/2025/ornament serba_serbi.png') }}"
     alt="ornamen kanan"
     class="absolute right-0 object-contain top-1/2 -translate-y-1/2 scale-x-[-1]
            w-16 sm:w-20 md:w-28 lg:w-36 xl:w-40 z-20" />

<!-- Judul di tengah -->
<div class="relative bg-[#8B2F4B] text-[#F9C46B] font-bohemianSoul
            flex items-center justify-center text-center
            h-full w-8/12 sm:w-10/12 md:w-8/12 lg:w-9/12
            text-base sm:text-lg md:text-2xl lg:text-3xl xl:text-4xl
            rounded-lg shadow-lg px-3 sm:px-6 z-10">
  Serba - Serbi
</div>

    </div>
  </div>
</div>


<!-- ===== END HEADER ===== -->

    <!-- ===== VIDEO CAROUSEL ===== -->
    <div class="flex items-center justify-center gap-4 bg-top bg-repeat-x bg-motif1 md:gap-8">
        <div class="relative bg-[#8B2F4B] w-[90%] lg:w-3/4 mt-6 rounded-[1.875rem] overflow-hidden shadow-2xl">

            <!-- ===================== ORNAMEN DEKORASI ===================== -->
            <!-- Kiri Bawah -->
            <img src="{{ asset('img/asset/2025/ornament 3.png') }}"
            alt="Ornamen Kiri Bawah"
            class="absolute object-contain w-16 transform md:w-20 lg:w-24 bottom-4 left-4 -scale-y-100 -rotate-12 -scale-x-100">

            <!-- Ornamen Kanan Atas -->
            <img src="{{ asset('img/asset/2025/ornament 3.png') }}"
            alt="Ornamen Kanan Atas"
            class="absolute object-contain w-16 transform top-4 right-4 md:w-20 lg:w-24 -rotate-12">

            <!-- Ornamen Kiri Atas (Mirror) -->
            <img src="{{ asset('img/asset/2025/ornament 3.png') }}"
            alt="Ornamen Kiri Atas"
            class="absolute object-contain w-16 transform top-4 left-4 md:w-20 lg:w-24 -scale-x-100 rotate-12">


            <!-- Kanan Bawah -->
            <img src="{{ asset('img/asset/2025/ornament 3.png') }}"
            alt="Ornamen Kanan Bawah"
            class="absolute object-contain w-16 transform scale-x-100 -scale-y-100 md:w-20 lg:w-24 bottom-4 right-4 rotate-12">

            <!-- ===================== VIDEO CAROUSEL ===================== -->
            <div class="relative z-10 p-4 owl-carousel serba-carousel">
                @foreach ($video as $v)
                    <div class="p-4">
                        <!-- Judul Video -->
                        <div class="flex justify-center pt-6 pb-4">
                           <p class="w-3/4 py-1 mx-2 text-sm font-medium leading-tight text-center text-white rounded-lg shadow-lg md:py-2 lg:py-3 md:text-lg lg:text-xl bg-merah-1 font-bachelorReg lg:px-10">
                                {{ $v->title }}
                            </p>
                        </div>

                        <!-- Embed Video -->
                        <div class="flex items-center justify-center h-full px-4 lg:px-36">
                            <iframe class="w-full h-40 shadow-xl md:h-80 lg:h-96 rounded-xl"
                                    src="{{ $v->filename }}"
                                    frameborder="0"
                                    allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- ===================== CUSTOM CSS ===================== -->
@push('css')
<style>
    /* Shadow untuk video */
    #serba-serbi .video-serba-serbi {
        box-shadow: 1px 1px 0 #012E4F,
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

    /* Custom dots untuk owl carousel */
    .custom-owl-dots {
        @apply flex justify-center mt-4;
    }
    .custom-owl-dot {
        @apply w-3 h-3 mx-1 bg-gray-300 rounded-full transition duration-300 ease-in-out;
    }
    .custom-owl-dot.active {
        @apply bg-merah-1;
    }
</style>
@endpush

<!-- ===================== OWL CAROUSEL SCRIPT ===================== -->
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
                '<div class="text-white custom-nav-prev">&#10094;</div>',
                '<div class="text-white custom-nav-next">&#10095;</div>'
            ],
            navClass: [
                'custom-owl-prev absolute left-0 transform -translate-y-1/2',
                'custom-owl-next absolute right-0 transform -translate-y-1/2'
            ]
        });
    });
</script>
@endpush
