<x-card>
    <form wire:submit="updateProfil" class="text-sm text-gray-700">
        {{-- Email --}}
        <div class="mb-3">
            <x-label-input for="email">Email</x-label-input>
            <x-input id="email" type="email" class="block w-full mt-1" wire:model="state.email"
                disabled="{{ !$canUpdateBasic }}" />
            <x-error-input name="state.email" />
        </div>

        {{-- Username --}}
        <div class="mb-3">
            <x-label-input for="username">No Ujian</x-label-input>
            <x-input id="username" type="text" class="block w-full mt-1" wire:model="state.username"
                disabled="{{ !$canUpdateBasic }}" />
            <x-error-input name="state.username" />
        </div>

        {{-- Nama --}}
        <div class="mb-3">
            <x-label-input for="name">Nama</x-label-input>
            <x-input type="text" class="w-full" wire:model="state.name" id="name"
                disabled="{{ !$canUpdateTambahan }}" />
            <x-error-input name="state.name" />
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="block mb-1 font-bold">Jenis
                Kelamin</label>
            <x-select-form id="jenis_kelamin" wire:model="state.jenis_kelamin"
                disabled="{{ !$canUpdateTambahan }}">
                <option>Pilih Jenis Kelamin</option>
                <option value="Perempuan">Perempuan</option>
                <option value="Laki-Laki">Laki-Laki</option>
            </x-select-form>
        </div>

        @if ($user->is_maba)
            {{-- Nama Statistik --}}
            <div class="grid mb-3 lg:grid-cols-2 lg:gap-6 gap-y-3">
                <div>
                    <x-label-input for="nimb">NIMB</x-label-input>
                    <x-input type="text" class="w-full" id="nimb" disabled="{{ !$canUpdateTambahan }}"
                        wire:model="state.nimb" />
                    <x-error-input name="state.nimb" />
                </div>

                <div>
                    <x-label-input for="nama-statistik">Nama Khas</x-label-input>
                    <x-input type="text" class="w-full" wire:model="state.nama_statistik"
                        id="nama-statistik" disabled="{{ !$canUpdateTambahan }}" />
                    <x-error-input name="state.nama_statistik" />
                </div>
            </div>

            <div class="mb-3">
                <x-label-input for="kelulusan">Status Kelulusan</x-label-input>
                <x-select-form disabled="{{ !$canUpdateTambahan }}" wire:model="state.status_kelulusan">
                    <option value="0">Pilih Status Kelulusan</option>
                    <option value="{{ STATUS_LULUS_PKKMB_PKBN }}">Lulus PKKMB-PKBN</option>
                    <option value="{{ STATUS_LULUS_PKKMB }}">Lulus PKKMB</option>
                    <option value="{{ STATUS_LULUS_PKBN }}">Lulus PKBN</option>
                    <option value="{{ STATUS_LULUS_BERSYARAT }}">Lulus Bersyarat</option>
                    <option value="{{ STATUS_TIDAK_LULUS }}">Tidak Lulus</option>
                </x-select-form>
                <x-error-input name="state.status_kelulusan" />
            </div>
        @endif

        <div class="flex items-center justify-end mt-5">

            <div wire:loading.remove wire:target="updateProfil">
                <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="true"
                    href="{{ session('previous-url') }}">
                    Kembali
                </x-button>
                @if ($canUpdateBasic || $canUpdateTambahan)
                    <x-button class="cursor-pointer rounded-3xl bg-base-orange-500 hover:bg-base-orange-600">
                        Simpan
                    </x-button>
                @endif
            </div>

            <div wire:loading wire:target="updateProfil" class="text-xs text-gray-500">
                Menyimpan ...
            </div>

        </div>
    </form>
    @if ($user->nimb && $user->nama_statistik)
        <x-button :tagA="true" class="uppercase rounded-3xl bg-base-blue-300 hover:bg-base-blue-400 text-md"
            target="_blank" href="{{ route('home.cocard', ['id' => $user->id]) }}">
            Download CoCard
        </x-button>
    @endif

</x-card>
