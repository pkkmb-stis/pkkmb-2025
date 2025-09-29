<div class="bg-[#FFEAC8] mix-blend-multiply">
  <div class="pb-20 lg:pb-40" id="teaser">
    <div class="relative">

      <!-- ================== HP ================== -->
      <div class="block lg:hidden">
        <!-- Header -->
        <div class="grid grid-cols-1 gap-4 h-auto py-5" data-aos="zoom-in-up">
          <div class="col-span-1 relative">
            <div class="flex items-center justify-between rounded-2xl bg-[#8B2F4B] bg-opacity-95 shadow-xl py-3 px-6 w-[90vw] max-w-sm mx-auto">
              <img src="{{ elemen1 }}" alt="ornamen kiri" class="h-10 w-auto">
              <h1 class="font-brasikaDisplay text-sm xs:text-base sm:text-lg text-[#F9C46B] text-center">
                Teaser PKKMB-PKBN 2025
              </h1>
              <img src="{{ elemen1 }}" alt="ornamen kanan" class="h-10 w-auto">
            </div>
          </div>

          <!-- Frame maroon -->
          <div class="relative bg-[#8B1E3F] p-2 mt-4 rounded-lg shadow-lg w-[92vw] mx-auto">
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
        <div class="grid grid-cols-1 gap-6 h-auto mt-[-20px]">
          <div class="col-span-1 relative lg:pt-16 pb-10" data-aos="zoom-in-up">
            <div class="flex flex-row justify-between items-center rounded-3xl max-w-4xl w-[90vw] mx-auto shadow-xl bg-[#8B2F4B] bg-opacity-95 px-6 py-4">
              <img src="{{ elemen1 }}" alt="ornamen kiri" class="h-12 w-auto">
              <h1 class="font-brasikaDisplay text-2xl md:text-3xl lg:text-4xl text-[#F9C46B] text-center">
                Teaser PKKMB-PKBN 2025
              </h1>
              <img src="{{ elemen1 }}" alt="ornamen kanan" class="h-12 w-auto">
            </div>
          </div>

          <!-- Frame maroon -->
          <div class="relative bg-[#8B1E3F] p-3 mt-[-50px] rounded-lg shadow-lg w-[90vw] max-w-5xl mx-auto">
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

        <!-- Ornamen -->
        <img src="img/asset/2025/tugu 0 km.png"
             alt="tugu 0 km"
             class="absolute bottom-0 left-4 w-[120px] md:w-[150px] lg:w-[150px] h-[300px] lg:h-[250px] z-10 mb-[-180px] lg:mb-[-240px] ml-[5%] lg:ml-[-25px]">
        <img src="img/asset/2025/maleo.png"
             alt="burung maleo"
             class="absolute bottom-0 right-4 w-[120px] md:w-[160px] lg:w-[200px] h-auto z-10 mb-[-200px] lg:mb-[-280px] mr-[20px] lg:mr-[25px]">
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
