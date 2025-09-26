<div class="grid grid-cols-1 items-center justify-center gap-x-2 gap-y-6 sm:grid-cols-2 lg:grid-cols-1">
    {{-- <div class="mb-5"> --}}
    <x-card class="bg-white rounded-xl shadow-md p-4" style="border: 4px solid #1E1E1E;">
        <div class="w-full h-full">
            <x-line-poin id="5" list-poin="{!! $listPoin !!}" />
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
