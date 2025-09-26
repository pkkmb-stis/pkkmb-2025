<div>
    <div>
        <div class="w-full text-center">
            <img wire:loading wire:target="show,edit" src="{{ asset('/img/icon/loading-ring.svg') }}" class="h-10 my-0"
                alt="">
        </div>
        <x-card class="mb-8">
            <div class="flex items-center justify-between mb-5">
                <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">Daftar Jumlah Penghargaan dan Pelanggaran
                    Tiap User</h5>
                <div class="flex flex-row-reverse">
                    @livewire('admin.maba.poin.user.rekap-harian')
                </div>
            </div>
            <div class="grid lg:grid-cols-2 lg:gap-6">
                <div class="mb-3">
                    <x-select-form name="jenisUser" id="jenisUser" wire:model.lazy="jenisUser">
                        <option value="semua">Maba dan Panitia</option>
                        <option value="maba">Maba</option>
                        <option value="panitia">Panitia</option>
                    </x-select-form>
                </div>
                <div class="mb-3">
                    <x-select-form name="tipePoin" id="tipePoin" wire:model.lazy="tipePoin">
                        <option value="-1">Semua Tipe Poin</option>
                        <option value="{{ CATEGORY_JENISPOIN_PENGHARGAAN }}">Penghargaan</option>
                        <option value="{{ CATEGORY_JENISPOIN_PELANGGARAN }}">Pelanggaran</option>
                        <option value="{{ CATEGORY_JENISPOIN_PENEBUSAN }}">Penebusan</option>
                    </x-select-form>
                </div>
            </div>
            <div class="grid lg:grid-cols-2 lg:gap-6">
                <div class="mb-3">
                    <select wire:model.lazy="selected_day_user" id="selected_day_user" name="selected_day_user" 
                        class="w-full block px-3 py-2.5 text-base border border-gray-300 rounded-md focus:border-base-brown-300 focus:ring focus:ring-base-brown-200 focus:ring-opacity-50 sm:text-sm sm:leading-5">
                        <option value="">Semua Hari</option>
                        @foreach(\App\Models\Day::getDropdownOptionsWithDescription() as $name => $description)
                            <option value="{{ $name }}">{{ $description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <x-input wire:model.debounce.200ms="search" type="text" placeholder="Cari Nama"
                        class="block w-full mb-3 placeholder-gray-400" />
                </div>
            </div>

            <x-table :theads="['Nama', 'Kategori', 'Jumlah Pelanggaran', 'Jumlah Poin', 'Terakhir Update']" class="mb-3" :breakpointVisibility="[
                3 => ['lg' => 'hidden'], // Hide terakhir update on lg
                1 => ['md' => 'hidden'], // Hide kategori on md
            ]">
                <slot>
                    @forelse ($poin_user as $pk)
                        <tr
                            class="border-b border-gray-200 hover:bg-blueGray-100 {{ $loop->even ? 'bg-gray-50' : '' }}">
                            <td class="px-6 py-3 text-left lg:text-center">
                                {{ $pk->name }}
                                <dl class="-ml-0.5">
                                    <dd class="ml-0.5 mt-1 md:hidden ">
                                        <x-badge-poin :category="$pk->kategori" />
                                    </dd>
                                    <dd class="lg:hidden mt-1 ml-0.5 text-xs italic">
                                        Diupdate pada {{ $pk->terakhir_update }}
                                    </dd>
                                </dl>
                            </td>
                            <td class="hidden px-6 py-3 text-center md:table-cell">
                                <x-badge-poin :category="$pk->kategori" />
                            </td>
                            <td class="px-6 py-3 text-center">{{ $pk->kategori_count }}</td>
                            <td class="px-6 py-3 text-center">{{ $pk->poin_sum }}</td>
                            <td class="hidden px-6 py-3 text-center lg:table-cell">{{ $pk->terakhir_update }}</td>
                        </tr>
                    @empty
                        <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                            <td colspan="6" class="px-6 py-3 italic text-center text-md">Empty</td>
                        </tr>
                    @endforelse
                </slot>
            </x-table>

            {{ $poin_user->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}
        </x-card>
    </div>
</div>
