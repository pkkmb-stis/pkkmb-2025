<x-home-layout menu="Galeri" title="Galeri Video - PKKMB-PKBN 2024">
  <!-- GALERI VIDEO -->
  <div class="font-archivo px-8 sm:px-8 md:px-12 xl:px-16">

    <div class="grid sm:px-16 md:px-20 xl:px-16 lg:pt-32 md:pt-28 pt-24 md:pb-12 pb-4 px-8 w-full">
      <div class="flex flex-row justify-center items-end gap-4 w-full h-full">
        <img src="{{ asset('img/maskot/kambe galeri.png') }}" alt="wave" class="z-10 sm:w-32 w-24">
        <div class="flex flex-col h-full justify-center items-center">
          <img src="{{ asset('img/asset/2024/Elemen 4.png') }}" alt="Elemen 4">
          <h1
            class="font-thin xl:text-4xl lg:text-3xl text-sm leading-normal text-merah-1 font-aringgo text-center py-3 lg:py-4 px-6 sm:px-12 bg-putih-100 rounded-full align-middle drop-shadow-md">
            GALERI
          </h1>
          <img src="{{ asset('img/asset/2024/Elemen 4.png') }}" alt="Elemen 4" class="rotate-180">
        </div>
        <img src="{{ asset('img/maskot/kambe galeri.png') }}" alt="wave" class="z-10 sm:w-32 w-24 scale-x-[-1]">
      </div>
    </div>

    <div class="font-bohemianSoul grid grid-cols-2 mx-4 gap-x-0 mt-8 mb-12 lg:grid-cols-12">
      <a href="{{ route('home.galeri') }}"
        class="flex justify-center items-center py-1 rounded-l-full col-span-1 border-merah-1 text-merah-1 border-4 hover:text-base-white hover:bg-merah-1 lg:col-start-4 lg:col-end-7">
        <h1 class="lg:text-2xl md:text-xl text-lg">Foto</h1>
      </a>
      <a href="{{ route('home.video') }}"
        class="flex justify-center items-center py-1 rounded-r-full col-span-1 border-merah-1 text-base-white border-4 bg-merah-1 lg:col-start-7 lg:col-end-10">
        <h1 class="lg:text-2xl md:text-xl text-lg">Video</h1>
      </a>
    </div>

    {{-- Video --}}
    <div class="grid grid-cols-12 mt-8 mx-4 gap-y-12 font-archivo sm:gap-6">
      @foreach ($videos as $video)
        <div class="font-aringgo col-span-12 sm:col-span-6 xl:col-span-6 mx-4">
          <div class="flex justify-center items-center">
            <img src="{{ asset('img/asset/2024/sayap.png') }}" alt="sayap" class="w-1/4 -mr-12 mt-10">
            <h2 class="px-3 lg:px-5 py-2 rounded-full bg-coklat-1 text-center text-[10px] sm:text-[10px] md:text-xs lg:text-sm text-putih-100 mx-4 border-4 border-base-orange-500 z-10"
              style="text-align: center;filter: drop-shadow(0 0 0.25rem #000);">{{ $video['title'] }}</h2>
            <img src="{{ asset('img/asset/2024/sayap.png') }}" alt="sayap" class="transform scale-x-[-1] w-1/4 -ml-12 mt-10">
          </div>

          <div class="relative h-0 my-4" style="padding-bottom: 56.25%; padding-top: 25px;">
            <iframe class="absolute top-0 left-0 h-full w-full" src=" {{ $video['filename'] }} "></iframe>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</x-home-layout>
