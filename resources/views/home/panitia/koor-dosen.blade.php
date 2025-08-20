<div class="flex w-3/4 items-center justify-center md:w-1/3 lg:w-2/9 md:flex-col">
    <div class="flex relative z-10 h-auto w-2/3 md:w-full">
        <div class="flex flex-col bg-merah-1 rounded-bl-lg content-center">
            <img class="h-auto w-full bg-card-profile bg-cover group-hover:hidden" src="{{ $koordinator['foto'] }}"
                alt="Foto Koordinator">
            <div class="flex justify-center items-center text-center h-8 sm:h-12 md:h-8 xl:h-12 px-1 my-1 md:my-0.5 lg:my-1 font-nunito text-[#F5F5DC] text-xs sm:text-base md:text-xs md:leading-normal lg:text-xs xl:text-base">
                {{ $koordinator['nama'] }}
            </div>
        </div>
        <div class="flex flex-col justify-between bg-merah-2 rounded-tr-lg rounded-br-lg">
            <div class="triangle-top"></div>
            <div class="self-center flex font-bohemianSoul text-center text-[9px] text-white sm:text-base md:text-[11px] lg:text-[8px] xl:text-xs text-jabatan px-1 xl:px-2 ">
                <h1 class="verticaltext z-10 text-center jabatanKoor">{{ $koordinator['jabatan'] }}</h1>
            </div>
            <div class="triangle-bottom"></div>
        </div>
    </div>
</div>
