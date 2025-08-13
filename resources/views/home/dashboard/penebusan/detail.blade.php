<div x-cloak x-show="showModalDetail">
    @if ($penebusanToShow)
    <x-modal>
        <div class="p-5 bg-white">
            <div class="flex justify-between items-center mb-3">
                <div class="">
                    <p class="font-bold text-sm">
                        Penebusan {{ getTipePenebusan($penebusanToShow->jenispoin->type) }}
                        {{$penebusanToShow->jenispoin->nama}}
                    </p>
                    <p class="text-xs">
                        Poin
                        <x-badge-poin :category='$penebusanToShow->jenispoin->category' />

                        : <span class="font-semibold">{{$penebusanToShow->jenispoin->poin}}</span>
                    </p>
                </div>
                <i class="fa fa-times cursor-pointer" x-on:click="showModalDetail = false"></i>
            </div>


            <div class="mb-3">
                <p class="text-sm font-semibold">
                    Deadline : {{ formatDateIso($penebusanToShow->deadline)}}
                </p>
                <small class="text-xs font-semibold">
                    {{ $penebusanToShow->deadline->locale('id')->diffForHumans()}}
                </small>
            </div>

            <div class="mb-3">
                <p class="text-sm font-semibold">Deskripsi Tugas</p>
                <pre class="font-sans text-sm whitespace-pre-line">{{$penebusanToShow->jenispoin->detail}}</pre>
            </div>


            @if ($penebusanToShow->status == PENEBUSAN_SELESAI)
            <div class="mb-3">
                <p class="text-sm font-semibold">
                    Diselesaikan pada : {{ formatDateIso($penebusanToShow->accepted_at)}}
                </p>
            </div>
            @endif

            @if($penebusanToShow->catatan && $penebusanToShow->status == PENEBUSAN_BUTUH_REVISI)
            <div class="mb-3">
                <p class="text-sm font-semibold">Catatan Revisi</p>
                <pre class="font-sans text-sm whitespace-pre-line">{{$penebusanToShow->catatan}}</pre>
            </div>
            @endif

        </div>
    </x-modal>
    @endif
</div>
