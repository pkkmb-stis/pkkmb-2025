<div class="flex w-47/100 items-center justify-center md:w-1/3 lg:w-2/9 md:flex-col">
    <div class="flex relative z-10 h-auto w-full">
        <div class="flex flex-col bg-merah-1 rounded-bl-lg content-center">
            <img class="h-auto w-full bg-card-profile bg-cover group-hover:hidden" src="{{ $m['foto'] }}"
                alt="Foto Koordinator">
            <div class="flex justify-center items-center text-center h-8 sm:h-12 md:h-8 xl:h-12 px-1 my-1 md:my-0.5 lg:my-1 font-nunito text-[#F5F5DC] text-[11px] sm:text-base md:text-xs leading-normal lg:text-xs xl:text-base">
                {{ $m['nama'] }}
            </div>
        </div>
        <div class="flex flex-col justify-between bg-merah-2 rounded-tr-lg rounded-br-lg">
            @php
                $words = explode(' ', $m['jabatan']);
            @endphp
            @if(count($words) == 2)
                <div class="triangle-top-long"></div>
                <div class="flex justify-between">
                    <div class="self-center flex font-bohemianSoul text-center text-[9px] text-white sm:text-base md:text-[11px] lg:text-[8px] xl:text-xs text-jabatan pl-1 xl:pl-2 ">
                        <h1 class="verticaltext z-10 text-center jabatanKoor leading-normal">
                            {{ $words[0] }}
                        </h1>
                    </div>
                    <div class="self-center flex font-bohemianSoul text-center text-[9px] text-white sm:text-base md:text-[11px] lg:text-[8px] xl:text-xs text-jabatan pr-1 xl:pr-2 ">
                        <h1 class="verticaltext z-10 text-center jabatanKoor leading-normal">
                            {{ $words[1] }}
                        </h1>
                    </div>
                </div>
                <div class="triangle-bottom-long"></div>
            @else
                <div class="triangle-top"></div>
                <div class="self-center flex font-bohemianSoul text-center text-[10px] text-white sm:text-base md:text-xs lg:text-[11px] xl:text-xs text-jabatan px-1 xl:px-2 ">
                    <h1 class="verticaltext z-10 text-center jabatanKoor">
                        {{ $m['jabatan'] }}
                    </h1>
                </div>
                <div class="triangle-bottom"></div>
            @endif
        </div>
    </div>
</div>
