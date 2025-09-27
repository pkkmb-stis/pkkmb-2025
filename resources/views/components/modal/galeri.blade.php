<x-modal maxWidth="{{ $maxWidth ?? 'max-w-5xl' }}">
<div class="px-4 py-6 sm:px-8 bg-repeat" 
     style="background-image: url('@/images/pattern/2025/pattern-desktop.png'), linear-gradient(to bottom, rgba(255, 219, 232, 0.6), rgba(163, 95, 119, 0.6)); background-size: 300px;">
        <div class="w-full pb-5 border-b-4 border-solid rounded-t" style="border-color:#1E2A4A">
            <div class="z-0 flex flex-row items-center w-full">
                <div class="w-full">
                    <div class="relative flex justify-center w-full items-center">
                        <h2 class="font-chaTime font-bold px-3 lg:px-5 py-2 rounded-full text-center text-sm sm:text-sm md:text-sm lg:text-lg text-2025-1 mx-4 z-10 bg-[radial-gradient(circle,#ffffff,#FFD183)]"
                            style="text-align: center; filter: drop-shadow(0 0 0.25rem #000);">
                            {{ $judul }}
                        </h2>

                        <div class="absolute inset-y-0 right-0 z-10 flex items-center justify-center rounded-r-lg">
                            {{ $closeButton }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

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