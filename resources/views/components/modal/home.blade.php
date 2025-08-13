<x-modal maxWidth="{{ $maxWidth ?? 'max-w-5xl' }}">
    <div class="pb-8 lg:pb-12"
        @click.away="showModalPengumuman = false, showModalMateri = false, showModalPenugasan = false"
        @keydown.window="if (event.key === 'Escape') showModalPengumuman = false, showModalMateri = false, showModalPenugasan = false">
        <div class="bg-kuning-pattern">
            <div class="z-10 flex justify-end rounded-r-lg">
                {{ $closeButton }}
            </div>
            <!--header-->
            <div class="w-full rounded-t pb-5">
                <div class="z-0 flex w-full flex-row items-center">
                    <div class="w-full">
                        <div class="flex flex-row">
                            <div class="flex w-full flex-row items-center justify-between py-4 md:px-12">
                                <img src="img/asset/2024/gendang.png"
                                    class="absolute h-[4rem] translate-x-2 sm:left-0 sm:h-[5rem] sm:translate-x-8">
                                <p
                                    class="w-full text-center font-aringgo text-xl font-bold tracking-wide text-white sm:text-3xl md:text-4xl lg:text-5xl">
                                    {{ $judul }}
                                </p>
                                <img src="img/asset/2024/gendang.png"
                                    class="absolute right-0 h-[4rem] -translate-x-2 scale-x-[-1] sm:h-[5rem] sm:-translate-x-8">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--body-->
        <div class="flex justify-between p-4 font-poppins text-xs font-semibold text-gray-50 sm:text-base md:text-sm">
            {{ $icon ?? '' }}
        </div>
        <div
            class="mx-4 rounded-lg bg-merah-1 text-justify font-poppins text-xs font-normal text-white sm:mx-8 sm:text-base md:text-base">
            {{ $slot }}
        </div>
    </div>
</x-modal>
