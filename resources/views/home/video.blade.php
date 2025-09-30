<x-home-layout menu="Galeri" title="Galeri Video - PKKMB-PKBN 2024">
  <!-- GALERI VIDEO -->
  <div class="font-archivo px-8 sm:px-8 md:px-12 xl:px-16">

      <div class="grid w-full px-8 pb-4 pt-24 sm:px-16 md:px-20 md:pb-5 md:pt-28 lg:pt-32 xl:px-16">
      {{-- Header --}}
          <div class="flex h-full w-full flex-row items-end justify-center gap-4 translate-y-[-10px]">
              <img src="{{ asset('img/maskot/2025/maskot 1.png') }}" alt="wave" class="z-10 w-14 sm:w-20 md:w-24 lg:w-28 mt-8 lg:-translate-x-4 transform translate-y-[-10px]">
                  <div class="flex h-full flex-col items-center justify-center">
                      <div class="flex flex-row items-center justify-center gap-4 mt-14 transform translate-y-[-10px]">
                          <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                              alt="Elemen 4" class="w-14 sm:w-20 md:w-28 lg:w-28 -mr-14 sm:-mr-20 md:-mr-28 lg:-mr-28 sm:-mt-5 md:-mt-8 lg:-mt-8 z-10">
                          <h1
                              class="flex items-center justify-center rounded-full px-10 py-3 sm:px-8 sm:pb-4 lg:px-16 lg:py-4 lg:pb-6
                                  font-brasikaDisplay text-center text-sm font-thin leading-normal 
                                  drop-shadow-md sm:text-xl lg:text-3xl xl:text-4xl z-0 relative border-4"
                              style="color:#1E2A4A; background-color:#FFF3E6; border-color:#1E2A4A;">
                              VIDEO
                          </h1>
                          <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                              alt="Elemen 4" class="w-14 sm:w-20 md:w-28 lg:w-28 -ml-14 sm:-ml-20 md:-ml-28 lg:-ml-28 sm:-mt-5 md:-mt-8 lg:-mt-8 z-10 scale-x-[-1]">
                      </div>
                  </div>
              <img src="{{ asset('img/maskot/2025/maskot 4.png') }}" alt="wave" class="z-10 w-14 sm:w-20 md:w-24 lg:w-28 mt-8 lg:translate-x-4 transform translate-y-[-10px]">
          </div>
      </div>

    <div class="font-bohemianSoul grid grid-cols-2 mx-4 gap-x-0 mt-8 mb-12 lg:grid-cols-12">
      <a href="{{ route('home.galeri') }}"
        class="flex justify-center items-center py-1 rounded-l-full col-span-1 border-2025-1 text-2025-1 border-4 hover:text-base-white hover:bg-2025-1 lg:col-start-4 lg:col-end-7">
        <h1 class="lg:text-2xl md:text-xl text-lg">Foto</h1>
      </a>
      <a href="{{ route('home.video') }}"
        class="flex justify-center items-center py-1 rounded-r-full col-span-1 border-2025-1 text-base-white border-4 bg-2025-1 lg:col-start-7 lg:col-end-10">
        <h1 class="lg:text-2xl md:text-xl text-lg">Video</h1>
      </a>
    </div>

    {{-- Video --}}
    <div
    class="relative mb-20 flex w-full flex-col items-center justify-around gap-4 rounded-[38px] bg-2025-1 p-6 sm:gap-8 sm:p-8">

    <div class="absolute inset-0 rounded-[38px] bg-motif3-pattern bg-repeat bg-[size:400px] opacity-25"></div>
    <div class="relative w-full">
        <div class="grid grid-cols-12 mt-8 mx-4 gap-y-12 font-archivo sm:gap-6">
          @foreach ($videos as $video)
            <div class="font-chaTime col-span-12 sm:col-span-6 xl:col-span-6 mx-4">
              <div class="relative h-0 my-4" style="padding-bottom: 56.25%; padding-top: 25px;">
                <iframe class="absolute top-0 left-0 h-full w-full" src=" {{ $video['filename'] }} "></iframe>
              </div>
              <div class="flex justify-center items-center">
                  <h2 class="px-3 lg:px-5 py-2 rounded-full text-center text-sm sm:text-sm md:text-sm lg:text-lg text-2025-1 mx-4 z-10 bg-[radial-gradient(circle,#ffffff,#FFD183)]"
                      style="text-align: center; filter: drop-shadow(0 0 0.25rem #000);">
                      {{ $video['title'] }}
                  </h2>
              </div>
            </div>
          @endforeach
        </div>
    </div> </div>
  </div>
</x-home-layout>
