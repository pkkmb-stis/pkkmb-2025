<div class="bg-[#FFEAC8] mix-blend-multiply">
  <div class="pb-40" id="teaser">
    <div class="relative">

      <!-- ================== HP ================== -->
      <div class="block lg:hidden">
        <!-- Header -->
        <div class="grid grid-cols-1 md:gap-6 h-auto align-items-start py-5 pb-5" data-aos="zoom-in-up">
          <div class="col-span-1 relative">
            <img src="{{ elemen1 }}" alt="ornamen kiri" class="mt-[10px] h-12 w-[50px] left-4 absolute">
            <div class="flex flex-col items-center justify-center rounded-2xl bg-[#8B2F4B] bg-opacity-95 shadow-xl py-4 items-center w-[379px] mx-auto">
              <h1 class="font-brasikaDisplay text-[14px] text-[#F9C46B] text-center">
                Teaser PKKMB-PKBN 2025
              </h1>
            <img src="{{ elemen1 }}" alt="ornamen kanan" class="mt-[10px] h-12 w-[50px] absolute right-4">
            </div>
          </div>

          <!-- Frame maroon -->
          <div class="relative bg-[#8B1E3F] p-2 mt-6 rounded-lg shadow-lg w-[95vw] mx-auto mb-[-50px]">
            <div class="aspect-video bg-black rounded-md overflow-hidden">
              <iframe class="w-full h-full"
                      src="https://www.youtube.com/embed/56hq1-sRfHg"
                      title="Teaser Video"
                      frameborder="0"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                      allowfullscreen>
              </iframe>
            </div>
          </div>
        </div>
      </div>

      <!-- ================== PC/Laptop ================== -->
      <div class="hidden lg:block">
        <!-- Header -->
        <div class="grid lg:grid-cols-1 grid-cols-1 md:gap-6 h-auto align-items-start lg:py-0 mt-[-20px]">
          <div class="lg:pl-16 lg:pr-16 col-span-1 relative lg:pt-20 pb-10 lg:pb-20 lg:block"
               data-aos="zoom-in-up">
            <div class="flex flex-row justify-between items-center rounded-3xl lg:w-full m-auto shadow-xl static bg-[#8B2F4B] overflow-hidden bg-opacity-95 mt-[50px]"
                 style="height:7.625rem">
              <div class="flex flex-row lg:pl-7 md:px-4 px-2">
                <img src="{{ elemen1 }}" alt="ornamen kiri" class="h-12 w-auto">
              </div>
              <div class="text-center">
                <h1 class="font-brasikaDisplay text-4xl md:text-3xl text-2xl text-[#F9C46B]">
                  Teaser PKKMB-PKBN 2025
                </h1>
              </div>
              <div class="flex flex-row lg:pr-7 md:px-4 px-2">
                <img src="{{ elemen1 }}" alt="ornamen kanan" class="h-12 w-auto">
              </div>
            </div>
          </div>

          <!-- Frame maroon -->
          <div class="relative bg-[#8B1E3F] p-3 mt-10 rounded-lg shadow-lg w-fit mx-auto mb-[-75px]">
            <div class="w-[90vw] max-w-4xl aspect-video bg-black rounded-md overflow-hidden">
              <iframe class="w-full h-full"
                      src="https://www.youtube.com/embed/56hq1-sRfHg"
                      title="Teaser Video"
                      frameborder="0"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                      allowfullscreen>
              </iframe>
            </div>
          </div>
        </div>

        <!-- Ornamen -->
        <img src="img/asset/2025/tugu 0 km.png"
             alt="tugu 0 km"
             class="absolute bottom-0 left-4 w-[171px] h-[419px] z-10 mb-[-240px] ml-[50px]">
        <img src="img/asset/2025/maleo.png"
             alt="burung maleo"
             class="absolute bottom-0 right-4 w-[200px] h-[239px] z-10 mb-[-280px] mr-[50px]">
      </div>
    </div>
  </div>
</div>

@push('css')
  <style>
    .teaser {
      height: 25.625rem;
      width: 38.875rem;
    }

    @media screen and (max-width: 1200px) {
      .teaser {
        height: 25.625rem;
        width: 38.875rem;
      }
    }

    @media screen and (max-width: 768px) {
      .teaser {
        height: 24.625rem;
        width: 34.875rem;
      }
    }

    @media screen and (max-width: 592px) {
      .teaser {
        height: 98%;
        width: 98%;
        margin-top: 0px;
      }

      #teaser {
        padding-bottom: 1rem;
      }
    }
  </style>
@endpush
