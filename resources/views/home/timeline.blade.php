<x-home-layout menu="Timeline" title="Timeline - PKKMB-PKBN 2024">
    <div class="mb-10 grid h-auto w-auto grid-cols-1 justify-items-center px-2 pb-8 pt-24 font-poppins sm:px-12 md:px-16 md:pb-10 md:pt-28 lg:px-24 lg:pb-12 lg:pt-32 xl:pb-14"
        x-data="{ width: window.innerWidth }" x-init="window.addEventListener('resize', () => {
            width = window.innerWidth;
        });">
        {{-- Header --}}
        <div class="w-full px-8 pb-4 sm:px-16 md:px-20 md:pb-12 xl:px-16">
            <div class="flex h-full w-full flex-row items-end justify-center gap-4">
                <img src="{{ asset('img/maskot/kambe timeline.png') }}" alt="wave" class="z-10 w-24 sm:w-32">
                <div class="flex h-full flex-col items-center justify-center">
                    <img src="{{ asset('img/asset/2024/Elemen 4.png') }}" alt="Elemen 4">
                    <h1
                        class="rounded-full bg-putih-100 px-6 py-3 text-center align-middle font-aringgo text-sm font-thin leading-normal text-merah-1 drop-shadow-md sm:px-12 lg:py-4 lg:text-3xl xl:text-4xl">
                        TIMELINE
                    </h1>
                    <img src="{{ asset('img/asset/2024/Elemen 4.png') }}" alt="Elemen 4" class="rotate-180">
                </div>
                <img src="{{ asset('img/maskot/pika timeline.png') }}" alt="wave" class="z-10 w-24 sm:w-32">
            </div>
        </div>

        @php
            $i = 0;
        @endphp
        <div class="mx-auto mb-0 mt-4 flex w-[90%] justify-center overflow-hidden rounded-lg sm:my-4">
            <div class="ml-4">
                @foreach ($timeline as $t)
                    @php
                        $isLast = $i === count($timeline) - 1;

                        $startDate = Carbon\Carbon::parse($t->waktu_mulai->format('Y-m-d'));
                        $endDate = $t->waktu_akhir
                            ? Carbon\Carbon::parse($t->waktu_akhir->format('Y-m-d'))
                            : $startDate;
                        $today = Carbon\Carbon::today();

                        $color = 'bg-white'; // Default color
                        if (!empty($t->waktu_akhir)) {
                            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                                if ($date->lt($today)) {
                                    $color = 'bg-green-500'; // Sudah terlewati
                                } elseif ($date->eq($today)) {
                                    $color = 'bg-blue-500'; // Sama dengan hari ini
                                }
                            }
                        } else {
                            if ($startDate->lt($today)) {
                                $color = 'bg-green-500'; // Sudah terlewati
                            } elseif ($startDate->eq($today)) {
                                $color = 'bg-blue-500'; // Sama dengan hari ini
                            }
                        }
                    @endphp
                    <div class="relative mt-[-4px] w-full">
                        <div class="{{ $isLast ? 'ml-1' : 'pb-6 border-l-4 border-solid border-black' }} px-4">
                            <h1 class="mb-2 font-bohemianSoul text-lg font-bold text-coklat-1">{{ $t->title }}</h1>
                            <div
                                class="{{ $i % 2 === 0 ? 'bg-coklat-1' : 'bg-merah-1' }} rounded-lg px-4 py-2 font-nunito text-white">
                                <div class="font-bohemianSoul tracking-wide text-kuning-1">
                                    {{ formatDateIso($t->waktu_mulai, 'D MMMM YYYY') }}
                                    @if ($t->waktu_akhir)
                                        <span x-cloak :class="(width < 512) ? '' : 'hidden'"><br></span>
                                        - {{ formatDateIso($t->waktu_akhir, 'D MMMM YYYY') }}
                                    @endif
                                </div>
                                <div class="my-2 w-full border-b-4 border-kuning-1"></div>
                                <p>{{ $t->caption != '-' ? $t->caption : '' }}</p>

                                {{-- Lokasi --}}
                                <div class="text-white">
                                    @if (!empty($t->location))
                                        <div class="my-2 flex flex-row items-center">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <div class="ml-2">{{ $t->location }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div
                            class="{{ $color }} absolute top-0 ml-[-8px] mt-[4px] h-5 w-5 rounded-full border-2 border-solid border-black">
                        </div>
                    </div>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </div>
        </div>
    </div>
</x-home-layout>
