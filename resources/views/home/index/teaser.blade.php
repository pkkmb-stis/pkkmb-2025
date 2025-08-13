<div>
  <div class="pb-40" id="teaser">
    <!-- Header -->
    <div
      class="grid lg:grid-cols-1 grid-cols-1 md:gap-6 h-auto align-items-start lg:align-items-stretch lg:items-center lg:py-0">
      <div class="lg:pl-16 lg:pr-16 md:px-8 sm:px-2 col-span-1 relative lg:pt-20 md:pt-20 pt-12 pb-10 lg:pb-20 lg:block"
        data-aos="zoom-in-up">
        <div
          class="flex flex-row justify-between items-center rounded-3xl lg:w-full m-auto shadow-xl static bg-kuning-pattern overflow-hidden bg-opacity-95"
          style="height:7.625rem">
          <div class="flex flex-row lg:pl-7 md:px-4 px-2">
            <img src="img/asset/2024/gendang.png" class="h-[7rem] lg:absolute lg:left-0 lg:translate-x-8">
          </div>
          <div class="lg:text-center text-center lg:ml-0 lg:mr-0">
            <h1 class="z-20 font-bohemianSoul lg:text-4xl md:text-3xl text-2xl leading-none md:mb-1 text-base-white">
              Teaser PKKMB-PKBN 2024
            </h1>
          </div>
          <div class="flex flex-row lg:pr-7 md:px-4 px-2">
            <img src="img/asset/2024/gendang.png" class="h-[7rem] lg:absolute lg:right-0 lg:-translate-x-8 scale-x-[-1]">
          </div>
        </div>
      </div>
      <div class="lg:w-full lg:h-72 h-72 lg:pl-16 lg:pr-16">
        <div class="h-80 lg:grid-cols-1 grid-cols-1">
          <div class="h-80 lg:grid-cols-1 grid-cols-1">
            <div class="flex lg:w-full m-auto justify-center items-center col-span-1 z-10 lg:mt-0 mt-8 teaser">
              <div id="video-selamat-datang" data-aos="zoom-in-down">
                <iframe class="h-full w-full teaser" width="560" height="315"
                  src="https://www.youtube.com/embed/56hq1-sRfHg" title="YouTube video player" frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
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
