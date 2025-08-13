<x-modal maxWidth="{{ $maxWidth ?? 'max-w-5xl' }}">
    <div class="px-4 py-6 sm:px-8">
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
                </div>
            </div>
        </div>

        <!--body-->
        <div class="flex justify-between p-2 font-nunito text-xs font-semibold sm:text-base md:text-sm"
            style="color: #202020;">
            {{ $icon ?? '' }}
        </div>
        <div
            class="text-justify font-nunito text-xs font-semibold text-white sm:text-base md:text-base">
            {{ $slot }}
        </div>
    </div>
</x-modal>
