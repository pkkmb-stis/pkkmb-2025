<div class="pt-12 pb-10">
    <div class="relative h-full w-full">
        <div class="flex justify-center py-2 items-center font-normal text-center bg-biru-main-pattern xl:text-5xl lg:text-5xl text-4xl leading-normal text-white font-caruban" style="border-radius: 1.875rem 1.875rem 0rem 0rem;">
            Agenda
        </div>
    </div>

    <div class="lg:h-24 h-12 gap-4 font-bachelor font-bold text-center flex justify-center items-center lg:text-4xl sm:text-3xl text-2xl"
      style="text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; color: #464646;">
      <img src="{{ asset('img/asset/Jawa.png') }}" alt="Jawa" class="h-full shakeanim">  
      Pra-PKKMB
      <img src="{{ asset('img/asset/Jawa.png') }}" alt="Jawa" class="h-full shakeanim2"> 
    </div>
    <div class="font-poppins my-5 md:gap-4 flex flex-row flex-wrap justify-center">
        @include('home.agenda.pra-mp2k')
    </div>

    <div class="lg:h-24 bg bg-kotak-07 bg-repeat-x text-center flex justify-center items-center font-bachelor text-white font-bold lg:text-4xl sm:text-3xl text-2xl lg:px-8"
      style="text-shadow: -2px -2px 0 #000, 2px -2px 0 #000, -2px 2px 0 #000, 2px 2px 0 #000;">
        PKKMB
    </div>
    <div class="font-poppins my-5 md:gap-4 flex flex-row flex-wrap justify-center w-full">
        @include('home.agenda.mp2k-hari1')
        @include('home.agenda.mp2k-hari2')
        @include('home.agenda.mp2k-hari3')
        @include('home.agenda.mp2k-hari4')
    </div>

    <div class="gap-4 h-12 lg:h-24 font-bachelor font-bold text-center flex justify-center items-center lg:text-4xl sm:text-3xl text-2xl"
      style="text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; color: #464646;">
      <img src="{{ asset('img/asset/Jawa.png') }}" alt="Jawa" class="h-full shakeanim rotate-45">  
        PKBN
      <img src="{{ asset('img/asset/Jawa.png') }}" alt="Jawa" class="h-full shakeanim2 -rotate-45"> 
    </div>
    <div class="font-poppins my-5 md:gap-4 flex flex-row flex-wrap justify-center">
        @include('home.agenda.pra-pkbn')
    </div>
    <div class="font-poppins my-5 md:gap-4 flex flex-row flex-wrap justify-center">
        @include('home.agenda.pkbn-hari1')
        @include('home.agenda.pkbn-hari2')
        @include('home.agenda.pkbn-hari3')
        @include('home.agenda.pkbn-hari4')
    </div>

    <div class="lg:h-24 bg bg-kotak-06 bg-repeat-x text-center flex justify-center items-center font-bachelor text-white font-bold lg:text-4xl sm:text-3xl text-2xl lg:px-8 mb-5"
      style="text-shadow: -2px -2px 0 #000, 2px -2px 0 #000, -2px 2px 0 #000, 2px 2px 0 #000;">
        Inaugurasi
    </div>
    <div class="font-poppins my-5 md:gap-4 flex flex-row flex-wrap justify-center">
        {{-- @include('home.agenda.prainagurasi') --}}
        @include('home.agenda.inagurasi')
    </div>
</div>
