<div class="h-full">
    {{-- <div class="mb-5"> --}}
    <x-card class="bg-white rounded-xl shadow-md p-4 h-auto" style="border: 4px solid #1E1E1E;">
        <h5 class="mb-4 flex items-center justify-center gap-2 font-brasikaDisplay text-lg font-medium">
            <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" alt="Cempaka Merah"
                class="h-7 w-8">

            <div class="flex justify-center items-center">
                <h2 class="px-5 lg:px-16 py-2 rounded-full text-center text-sm sm:text-sm md:text-sm lg:text-lg text-2025-1 mx-4 z-10 bg-[radial-gradient(circle,#ffffff,#FFD183)]"
                    style="text-align: center; filter: drop-shadow(0 0 0.25rem #000);">
                    Grafik Poin
                </h2>
            </div>

            <img src="{{ asset('img\asset\2025\Cempaka_Merah_polos .png') }}" alt="Cempaka Merah"
                class="h-7 w-8">
        </h5>
        <div class=" w-full flex justify-center relative">
                <div class="w-full h-full size-2 "> 
                    {{-- ubah w-3/4 jadi 75% dari card --}}
                    <x-line-poin id="5" list-poin="{!! $listPoin !!}" />
                </div>
        </div>
    </x-card>
    
        {{-- <x-card>
            <x-line-poin id='5' list-poin="{!! $listPoin !!}" />
        </x-card> --}}
    {{-- </div> --}}

    @if (auth()->user()->is_maba)
        {{-- <div class="mb-3"> --}}
            <x-card>
                <x-bar-poin id="bar" bonus="{{ $poin['bonus'] ?? 0 }}" pelanggaran="{{ $poin['pelanggaran'] ?? 0 }}"
                    penebusan="{{ $poin['penebusan'] ?? 0 }}" />
            </x-card>
        {{-- </div> --}}
        {{-- <div class="mb-5"> --}}
            <x-card>
                <x-doughnut-poin id='donat' poin="{{ $poin['akumulasi'] }}" poin-max="{{ POIN_MAKSIMAL }}"
                    poin-cadangan="{{ $poin['cadangan'] }}" />
            </x-card>
        {{-- </div> --}}
    @endif
</div>
