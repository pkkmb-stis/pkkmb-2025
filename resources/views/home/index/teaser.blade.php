<div class="bg-[#FFEAC8] mix-blend-multiply">
  <div class="pb-40" id="teaser">
    <div class="relative">

      <!-- ================== HP ================== -->
      <div class="block lg:hidden">
        <!-- Header -->
        <div class="grid grid-cols-1 h-auto py-5" data-aos="zoom-in-up">
          <div class="relative w-[90vw] max-w-sm mx-auto">
        <!-- Ornamen kiri -->
            <img src="img/asset/2025/elemen.png" 
                 alt="ornamen kiri" 
                 class="absolute left-2 top-1/2 -translate-y-1/2 h-[34px] w-auto ml-[-20px] sm:ml-[-50px]">

        <!-- Kontainer judul -->
            <div class="flex items-center justify-center rounded-2xl bg-[#8B2F4B] bg-opacity-95 shadow-xl py-2 px-4">
              <h1 class="font-brasikaDisplay text-sm sm:text-base text-[#F9C46B] text-center">
                Teaser PKKMB-PKBN 2025
              </h1>
            </div>

        <!-- Ornamen kanan -->
            <img src="img/asset/2025/elemen.png" 
                 alt="ornamen kanan" 
                 class="absolute right-2 top-1/2 -translate-y-1/2 h-[34px] w-auto mr-[-20px] sm:mr-[-50px]">
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
      <div class="hidden lg:block relative">
  <div class="grid grid-cols-1 gap-6 h-auto lg:py-0 mt-0 z-0">
    <div class="col-span-1 relative lg:pt-16 pb-10 lg:pb-20" data-aos="zoom-in-up">

      <!-- Kontainer Header Responsive -->
      <div class="relative flex flex-row items-center justify-center rounded-3xl 
                  w-[95vw] sm:w-[85vw] md:w-[80vw] lg:w-[70vw] xl:w-[60vw] 
                  max-w-4xl mx-auto shadow-xl bg-[#8B2F4B] bg-opacity-95 
                  px-4 sm:px-6 py-4">

        <!-- Ornamen kiri -->
        <img src="img/asset/2025/elemen.png" 
             alt="ornamen kiri" 
             class="absolute left-0 -ml-8 sm:-ml-12 md:-ml-16 lg:-ml-20 
                    w-[60px] sm:w-[80px] md:w-[120px] lg:w-[150px] xl:w-[175px] 
                    h-auto z-20">

        <!-- Judul -->
        <h1 class="font-brasikaDisplay text-[#F9C46B] text-center flex-grow 
                   text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl">
          Teaser PKKMB-PKBN 2025
        </h1>

        <!-- Ornamen kanan -->
        <img src="img/asset/2025/elemen.png" 
             alt="ornamen kanan" 
             class="absolute right-0 -mr-8 sm:-mr-12 md:-mr-16 lg:-mr-20 
                    w-[60px] sm:w-[80px] md:w-[120px] lg:w-[150px] xl:w-[175px] 
                    h-auto z-20">
      </div>
    </div>

    <!-- Frame maroon -->
    <div class="relative bg-[#8B1E3F] p-3 mt-10 rounded-lg shadow-lg mx-auto mb-[-75px] lg:w-[620px] lg:h-[415px] xl:w-[799px] xl:h-[493px] mx-auto my-auto">
      <div class="lg:h-[385px] lg:w-[591px] xl:w-[760px] xl:h-[470px] max-w-4xl aspect-video bg-black rounded-md overflow-hidden mx-auto my-auto">
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

  <!-- Ornamen Tugu -->
  <img src="img/asset/2025/tugu 0 km.png"
       alt="tugu 0 km"
       class="hidden sm:block absolute bottom-0 left-4 
            w-[80px] sm:w-[120px] md:w-[150px] lg:w-[171px] 
            h-auto z-10 mb-[-120px] sm:mb-[-180px] md:mb-[-220px] lg:mb-[-240px] ml-[20px] sm:ml-[40px] lg:ml-[50px]">

  <!-- Ornamen Maleo -->
  <img src="img/asset/2025/maleo.png"
       alt="burung maleo"
       class="hidden sm:block absolute bottom-0 right-4 
            w-[80px] lg:w-[150px] xl:w-[200px]
            h-auto z-10 mb-[-120px] sm:mb-[-180px] md:mb-[-240px] lg:mb-[-280px] 
            mr-[10px] sm:mr-[15px] lg:mr-[25px]">
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
