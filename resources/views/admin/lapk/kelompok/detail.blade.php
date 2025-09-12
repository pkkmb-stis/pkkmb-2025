<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <div>
        <x-card>
            <form wire:submit="updateKelompok">

                <div class="text-gray-700">
                    <div class="mb-3">
                        <label for="judul" class="block mb-1 font-bold">Pendamping Kelompok</label>
                        <a class="italic hover:text-base-brown-500"
                            href="{{ route('user.detail', ['id' => $kelompok->pendamping->id]) }}">
                            {{ $kelompok->pendamping->name }} - {{ $kelompok->pendamping->username }}
                        </a>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="block mb-1 font-bold">Nama Kelompok</label>
                        <x-input type="text" class="w-full" wire:model="nama"
                            disabled="{{ !$canUpdateKelompok }}" />
                        <x-error-input name="nama" />
                    </div>

                    <div class="mb-3">
                        <label for="linkWa" class="block mb-1 font-bold">Link Group WA</label>
                        <x-input type="text" class="w-full" wire:model="linkWa"
                            disabled="{{ !$canUpdateKelompok }}" />
                    </div>

                    <div class="mb-3">
                        <label for="linkZoom" class="block mb-1 font-bold">Link Zoom</label>
                        <x-input type="text" class="w-full" wire:model="linkZoom"
                            disabled="{{ !$canUpdateKelompok }}" />
                    </div>

                    <div class="mb-3">
                        <label for="linkZoom" class="block mb-1 font-bold">Link Classroom</label>
                        <x-input type="text" class="w-full" wire:model="linkClassroom"
                            disabled="{{ !$canUpdateKelompok }}" />
                    </div>

                    <div class="mb-3">
                        <label for="linkWa" class="block mb-1 font-bold">Deskripsi</label>
                        <x-textarea class="w-full" wire:model="deskripsi" rows="6"
                            disabled="{{ !$canUpdateKelompok }}" />
                    </div>

                    <div class="mb-3">
                        <label for="warnaCoCard" class="block mb-1 font-bold">Warna Co Card</label>
                        <x-input type="color" class="w-full" wire:model="warnaCoCard"
                            disabled="{{ !$canUpdateKelompok }}" />
                    </div>

                    <div class="mb-3">
                        <label for="jenisKelompok" class="block mb-1 font-bold">Jenis Kelompok</label>
                        <x-select-multi name="jenisKelompok" wire:model="jenisKelompok" id="jenisKelompok">
                            <option value="">Pilih jenis kelompok</option>
                            <option {{ $jenisKelompok == 1 ? 'selected' : '' }} value="1">Online</option>
                            <option {{ $jenisKelompok == 0 ? 'selected' : '' }} value="0">Offline</option>
                        </x-select-multi>
                        <x-error-input name="jenisKelompok" />
                    </div>

                    @if ($canAddDeleteAnggota)
                        <div x-data="{ search: false }">
                            <div class="mb-3">
                                <label for="anggota" class="block mb-1 font-bold">Tambah Anggota Kelompok</label>
                                <div class="relative">
                                    <x-input type="text" wire:model.live="search" placeholder="Search user..."
                                        x-on:input="search = true" class="block w-full" wire:focus="removeSearch" />

                                    <ul x-cloak x-show="search" x-on:click.away="search = false"
                                        class="absolute left-0 right-0 m-2 bg-white border border-gray-200 rounded-md shadow-sm">
                                        @forelse($users as $u)
                                            <li wire:click="selectUser({{ $u }})"
                                                x-on:click="search = false"
                                                class="px-4 py-2 cursor-pointer hover:bg-gray-200">
                                                <p>{{ $u->name }} - <span
                                                        class="italic">{{ $u->username }}</span> </p>
                                            </li>
                                        @empty
                                            <li class="px-4 py-2 italic">
                                                <p>No user found</p>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex justify-end my-3">

                    <div wire:loading.remove wire:target="addAnggota">
                        <div wire:loading.remove wire:target="updateKelompok">
                            @if ($canAddDeleteAnggota)
                                <x-button type="button" class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover"
                                    wire:click="addAnggota">
                                    Tambah Anggota
                                </x-button>
                            @endif

                            @if ($canUpdateKelompok)
                                <x-button type="submit"
                                    class="rounded-3xl bg-base-orange-500 hover:bg-base-orange-600 mx-0.5 mr-1">
                                    Update Kelompok
                                </x-button>
                            @endif

                            <x-button class="mt-3 mr-1 bg-gray-500 md:mt-0 hover:bg-gray-600 rounded-3xl"
                                :tagA="true" href="{{ route('lapk.kelompok') }}">
                                Kembali
                            </x-button>

                        </div>
                    </div>

                    <div wire:loading wire:target="updateKelompok" class="text-xs italic text-gary-600">
                        Sedang memproses. Harap menunggu ..
                    </div>

                    <div wire:loading wire:target="addAnggota" class="text-xs italic text-gary-600">
                        Sedang memproses. Harap menunggu ..
                    </div>
                </div>
            </form>

        </x-card>
    </div>
    <div>
        @include('admin.lapk.kelompok.anggota-table')
    </div>
</div>

@push('script-bottom')
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
@endpush
