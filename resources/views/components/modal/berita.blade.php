<x-modal maxWidth="{{ $maxWidth ?? 'max-w-5xl' }}">
    <div class="relative px-4 py-6 sm:px-8" @click.away="showModalBerita = false" @keydown.window="if (event.key === 'Escape') showModalBerita = false">
        <!--header-->
        <div class="w-full rounded-t border-b-4 border-solid pb-5" style="border-color:#8B4513">
            <div class="z-0 flex w-full flex-row items-center">
                <div class="w-full">
                    <div class="relative flex w-full flex-row">
                        <div class="w-full rounded-lg bg-kuning-pattern py-4 md:px-12">
                            <p class="text-center font-bachelor text-base font-bold md:text-xl lg:text-2xl"
                                style="color: #ECECEC;">
                                {{ $judul }}
                            </p>
                        </div>
                        <div class="absolute inset-y-0 right-0 z-10 flex items-center justify-center rounded-r-lg">
                            {{ $closeButton }}
                        </div>
                    </div>
                    <div class="mx-auto mt-4 h-auto overflow-hidden bg-cover"
                        style="border-radius: 2.5rem 2.5rem 0rem 0rem; border: 3px solid #8B4513; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); width: fit-content">
                        <img src="{{ $image ?? '' }}" alt="" class="object-cover">
                    </div>
                </div>
            </div>
        </div>

        <!--body-->
        <div class="flex justify-between p-4 font-nunito text-xs font-semibold sm:text-base md:text-sm"
            style="color: #202020;">
            {{ $icon ?? '' }}
        </div>
        <div
            class="bg-kuning-pattern text-justify font-nunito text-xs font-semibold text-white sm:text-base md:text-base">
            {{ $slot }}
        </div>
    </div>
</x-modal>
