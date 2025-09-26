<div class="bg-[#FFEAC8] mix-blend-multiply">
  <div class="pb-40" id="teaser">
    <!-- Teaser Section -->
    <div class="relative"> <!-- relative pindah ke sini -->
      
      <!-- Header -->
      <div class="grid lg:grid-cols-1 grid-cols-1 md:gap-6 h-auto align-items-start lg:align-items-stretch lg:items-center lg:py-0">
        <div class="lg:pl-16 lg:pr-16 md:px-8 sm:px-2 col-span-1 relative lg:pt-20 md:pt-20 pt-12 pb-10 lg:pb-20 lg:block"
             data-aos="zoom-in-up">
          <div class="flex flex-row justify-between items-center rounded-3xl lg:w-full m-auto shadow-xl static bg-[#8B2F4B] overflow-hidden bg-opacity-95 mt-[50px]"
               style="height:7.625rem">
            <div class="flex flex-row lg:pl-7 md:px-4 px-2">
              <img src="{{ elemen1 }}" alt="ornamen kiri" class="h-12 w-auto">
            </div>
            <div class="lg:text-center text-center lg:ml-0 lg:mr-0">
              <h1 class="z-20 font-brasikaDisplay lg:text-4xl md:text-3xl text-2xl leading-none md:mb-1 text-[#F9C46B]">
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

      <!-- Ornamen tambahan -->
      <img src="img/asset/2025/tugu 0 km.png" 
           alt="tugu 0 km" 
           class="absolute bottom-0 left-4 w-[171px] h-[419px] h-auto z-10 mb-[-150px] ml-[50px]">

      <img src="img/asset/2025/maleo.png" 
           alt="burung maleo" 
           class="absolute bottom-0 right-4 w-[155px] h-[194px] z-10 mb-[-180px] mr-[50px]">
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
