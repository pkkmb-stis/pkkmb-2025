<x-modal maxWidth="{{ $maxWidth ?? 'max-w-5xl' }}">
    <div class="px-4 py-6 sm:px-8">
        <!--header-->
        <div class="w-full pb-5 border-b-4 border-solid rounded-t" style="border-color:#1E2A4A">

            <div class="z-0 flex flex-row items-center w-full">
                <div class="w-full">
                    <div class="relative flex flex-row w-full">
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
                </div>
            </div>
        </div>

        <!--body-->
        <div class="flex justify-between p-2 text-xs font-semibold font-nunito sm:text-base md:text-sm"
            style="color: #202020;">
            {{ $icon ?? '' }}
        </div>
        <div
            class="text-xs font-semibold text-justify text-white font-nunito sm:text-base md:text-base">
            {{ $slot }}
        </div>
    </div>
</x-modal>
