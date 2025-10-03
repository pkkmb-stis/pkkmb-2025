<x-modal maxWidth="{{ $maxWidth ?? 'max-w-5xl' }}">
    <div class="relative px-4 py-6 sm:px-8" @click.away="showModalBerita = false" @keydown.window="if (event.key === 'Escape') showModalBerita = false">
        <!--header-->
        <div class="w-full pb-5 border-b-4 border-solid rounded-t" style="border-color:#8B4513">
            <div class="z-0 flex flex-row items-center w-full">
                <div class="w-full">
                    <div class="relative flex flex-row w-full  ">
                        <div class="w-full py-4 rounded-lg bg-background1-pattern md:px-12">
                            <p class="text-base font-bold text-center font-bachelor md:text-xl lg:text-2xl"
                                style="color: #ECECEC;">
                                {{ $judul }}
                            </p>
                        </div>
                        <div class="absolute inset-y-0 right-0 z-10 flex items-center justify-center rounded-r-lg">
                            {{ $closeButton }}
                        </div>
                    </div>
                    <div class="h-auto mx-auto mt-4 overflow-hidden bg-cover"
                        style="border-radius: 2.5rem 2.5rem 0rem 0rem; border: 3px solid #8B4513; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); width: fit-content">
                        <img src="{{ $image ?? '' }}" alt="" class="object-cover">
                    </div>
                </div>
            </div>
        </div>

        <!--body-->
        <div class="flex justify-between p-4 text-xs font-semibold font-nunito sm:text-base md:text-sm"
            style="color: #202020;">
            {{ $icon ?? '' }}
        </div>
        <div
            class="text-xs font-semibold text-justify text-white bg-background1-pattern font-nunito sm:text-base md:text-base">
            {{ $slot }}
        </div>
    </div>
</x-modal>
