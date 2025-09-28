<x-card class="w-full mt-2 mb-3 text-gray-700">
    <div class="flex items-center mb-3">
        <img class="w-20 h-20 rounded-full" src="{{ $user->profile_photo_url }}" alt="">
        <div class="flex w-full ml-3">
            <div class="mx-4 mb-2">
                <h6 class="mb-1 font-bold">Nama Khas</h6>
                <p>{{ $user->nama_statistik ? $user->nama_statistik : '-' }}</p>
            </div>
            <div class="mx-4 mb-2">
                <h6 class="mb-1 font-bold">Kelompok</h6>
                <p>{{ $user->kelompok->nama ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="flex w-full mb-2">
        <div class="mb-2 mr-4">
            <h6 class="mb-1 font-bold">No Wa</h6>
            <p>{{ $user->nowa ? $user->nowa : '-' }}</p>
        </div>
        <div class="mb-2">
            <h6 class="mb-1 font-bold">Prodi</h6>
            <p>{{ $user->prodi ? $user->prodi : '-' }}</p>
        </div>
    </div>

    <div class="flex w-full mb-2">
        <div class="mb-2 mr-4">
            <h6 class="mb-1 font-bold">Provinsi</h6>
            <p>{{ $user->kabupaten ? $user->kabupaten->provinsi->nama : '-' }}</p>
        </div>
        <div class="mb-2 mr-4">
            <h6 class="mb-1 font-bold">Kabupaten</h6>
            <p>{{ $user->kabupaten ? $user->kabupaten->nama : '-' }}</p>
        </div>
        <div class="mb-2">
            <h6 class="mb-1 font-bold">Himada</h6>
            <p>{{ $user->himada ? $user->himada : '-' }}</p>
        </div>
    </div>

    <div class="mb-3">
        <h6 class="mb-1 font-bold">Alamat</h6>
        <p>{{ $user->alamat ? $user->alamat : '-'}}</p>
    </div>
</x-card>

@if ($user->is_maba || $user->hasRole(ROLE_PANITIA))
<x-card>
    <x-table :theads="['Info Poin', '#']">
        <tr class="border-b border-gray-200 hover:bg-blueGray-100">
            <td class="px-6 py-3">Akumulasi Poin</td>
            <td class="px-6 py-3 text-center"> {{ $poins['akumulasi'] }} </td>
        </tr>
        <tr class="border-b border-gray-200 hover:bg-blueGray-100">
            <td class="px-6 py-3">Poin Cadangan</td>
            <td class="px-6 py-3 text-center"> {{ $poins['cadangan'] }} </td>
        </tr>
        <tr class="border-b border-gray-200 hover:bg-blueGray-100 bg-gray-50">
            <td class="px-6 py-3">Banyak Pelanggaran</td>
            <td class="px-6 py-3 text-center"> {{ $poins['pelanggaran'] }} </td>
        </tr>
        @if ($user->is_maba)
        <tr class="border-b border-gray-200 hover:bg-blueGray-100">
            <td class="px-6 py-3">Banyak Penghargaan</td>
            <td class="px-6 py-3 text-center"> {{ $poins['bonus'] }} </td>
        </tr>
        <tr class="border-b border-gray-200 hover:bg-blueGray-100 bg-gray-50">
            <td class="px-6 py-3">Banyak Penebusan</td>
            <td class="px-6 py-3 text-center"> {{ $poins['penebusan'] }} </td>
        </tr>
        @endif
    </x-table>
    <div class="flex justify-end">
        <x-button class="rounded-3xl bg-2025-1 hover:bg-coklat-hover" :tagA="true"
            href="{{ route('user.detail.poin', ['id' => $user->id]) }}">
            Detail
        </x-button>
    </div>
</x-card>
@endif
