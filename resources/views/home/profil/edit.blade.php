<form wire:submit.prevent="update" class="w-full max-w-2xl text-gray-800">
    <div class="mb-4 md:flex md:items-center">
        <div class="md:w-1/3">
            <x-label-input for="jurusan"
                class="block py-2 pr-4 mb-1 md:text-left md:mb-0 font-poppins font-semibold text-gray-700">Jurusan</x-label-input>
        </div>
        <div class="md:w-2/3">
            <x-select-form id="jurusan" wire:model.defer="user.prodi" class="w-full rounded-xl shadow-md border-2 border-gray-200 focus:border-amber-400 2xl:-ml-5">
                <option>Silahkan Pilih Jurusan</option>
                @foreach (getJurusan() as $jurusan)
                    <option value="{{ $jurusan }}">{{ $jurusan }}</option>
                @endforeach
            </x-select-form>
        </div>
    </div>

    <div class="mb-4 md:flex md:items-center">
        <div class="md:w-1/3">
            <x-label-input for="nowa" class="block py-2 pr-4 mb-1 md:text-left md:mb-0 font-poppins font-semibold text-gray-700">No WA</x-label-input>
        </div>
        <div class="md:w-2/3">
            <x-input wire:model.defer="user.nowa" type="text" class="w-full rounded-xl shadow-md border-2 border-gray-200 focus:border-amber-400 2xl:-ml-5"
                placeholder="Isi nomor wa format 62..." />
            <x-error-input name="user.nowa" />
        </div>
    </div>

    <div class="mb-4 md:flex md:items-center">
        <div class="md:w-1/3">
            <label for="jenis_kelamin" class="block py-2 pr-4 mb-1 md:text-left md:mb-0 font-poppins font-semibold text-gray-700">Jenis
                Kelamin</label>
        </div>
        <div class="md:w-2/3">
            <x-select-form id="jenis_kelamin" wire:model.defer="user.jenis_kelamin"
                class="w-full rounded-xl shadow-md border-2 border-gray-200 focus:border-amber-400 2xl:-ml-5">
                <option>Silahkan Pilih Jenis Kelamin</option>
                <option value="Perempuan">Perempuan</option>
                <option value="Laki-Laki">Laki-Laki</option>
            </x-select-form>
        </div>
    </div>
    @if ($provinsiUser == 999)
        <div class="mb-4 md:flex md:items-center">
            <div class="md:w-1/3">
                <label for="kabkot_id"
                    class="block py-2 pr-4 mb-1 md:text-left md:mb-0 font-poppins font-semibold text-gray-700">Negara</label>
            </div>
            <div class="md:w-2/3">
                <x-select-form wire:model.defer="user.kabkot_id" id="kabkot_id" disabled="{{ !$kabupatenActive }}"
                    class="w-full rounded-xl shadow-md border-2 border-gray-200 focus:border-amber-400 2xl:-ml-5">
                    <option>Silahkan Pilih Negara</option>
                    @foreach ($kabupaten as $k)
                        <option value="{{ $k->kabkot_id }}">{{ $k->nama }}</option>
                    @endforeach
                </x-select-form>
                <x-error-input name="user.kabkot_id" />
            </div>
        </div>
    @else
        <div class="mb-4 md:flex md:items-center">
            <div class="md:w-1/3">
                <label for="himada" class="block py-2 pr-4 mb-1 md:text-left md:mb-0 font-poppins font-semibold text-gray-700">Himada</label>
            </div>
            <div class="md:w-2/3">
                <x-select-form wire:model.defer="user.himada" id="himada"
                    class="w-full rounded-xl shadow-md border-2 border-gray-200 focus:border-amber-400 2xl:-ml-5">
                    <option>Silahkan Pilih Himada</option>
                    @foreach (getHimada() as $himada)
                        <option value="{{ $himada }}">{{ $himada }}</option>
                    @endforeach
                </x-select-form>
            </div>
        </div>
        <div class="mb-4 md:flex md:items-center">
            <div class="md:w-1/3">
                <label for="provinsi"
                    class="block py-2 pr-4 mb-1 md:text-left md:mb-0 font-poppins font-semibold text-gray-700">Provinsi</label>
            </div>
            <div class="md:w-2/3">
                <x-select-form id="provinsi" wire:model.lazy="provinsiUser" wire:ignore
                    class="w-full rounded-xl shadow-md border-2 border-gray-200 focus:border-amber-400 2xl:-ml-5">
                    <option>Silahkan Pilih Provinsi</option>

                    @foreach ($provinsi as $p)
                        @if ($p->prov_id == 999)
                            @continue
                        @endif
                        <option value="{{ $p->prov_id }}">{{ $p->nama }}</option>
                    @endforeach
                </x-select-form>
            </div>
        </div>
        <div class="mb-4 md:flex md:items-center">
            <div class="md:w-1/3">
                <label for="kabkot_id" class="block pr-4 mb-1 md:text-left md:mb-0 font-poppins font-semibold text-gray-700">Kab/Kota</label>
            </div>
            <div class="md:w-2/3">
                <x-select-form wire:model.defer="user.kabkot_id" id="kabkot_id" disabled="{{ !$kabupatenActive }}"
                    class="w-full rounded-xl shadow-md border-2 border-gray-200 focus:border-amber-400 2xl:-ml-5">
                    <option>Pilih Kab/Kota</option>
                    @foreach ($kabupaten as $k)
                        <option value="{{ $k->kabkot_id }}">{{ $k->nama }}</option>
                    @endforeach
                </x-select-form>
                <x-error-input name="user.kabkot_id" />
            </div>
        </div>
    @endif
    <div class="mb-4 md:flex md:items-start">
        <div class="md:w-1/3">
            <x-label-input for="alamat" class="block pr-4 mb-1 md:text-left md:mb-0 font-poppins font-semibold text-gray-700">Alamat
                Lengkap</x-label-input>
        </div>
        <div class="md:w-2/3">
            <x-textarea wire:model.defer="user.alamat" cols="30" rows="6"
                class="w-full rounded-xl shadow-md border-2 border-gray-200 focus:border-amber-400 2xl:-ml-5" placeholder="Tuliskan alamat lengkap">{{ $alamat ?? '' }}
            </x-textarea>
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mt-6 gap-3">
        <p class="text-xs italic text-gray-500 font-poppins">Silakan klik foto untuk mengubah foto profil dan pastikan file tidak melebihi 1MB</p>
        <x-button class="px-6 py-2 text-sm font-semibold bg-amber-500 hover:bg-amber-600 text-white rounded-2xl shadow-md transition-colors whitespace-nowrap" type="submit">
            Simpan Perubahan
        </x-button>
    </div>

</form>
