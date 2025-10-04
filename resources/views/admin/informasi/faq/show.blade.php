<div>
    <x-card x-data="{ showModalDelete: false, 'faqQuestion': '', 'faqId': '' }">
        <div class="flex items-center justify-between mb-3">
            <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">FAQ PKKMB 2025</h5>
            @can(PERMISSION_ADD_FAQ)
                @livewire('admin.informasi.faq.add')
            @endcan
        </div>
        <x-input wire:model.debounce.200ms="search" type="text" placeholder="Cari pertanyaan, jawaban ..."
            class="block w-full mb-3 placeholder-gray-400" />

        <x-table :theads="['Pertanyaan', 'Jawaban', 'Aksi']" :breakpointVisibility="[
            1 => ['xl' => 'hidden'], // Hide jawaban on xl
            2 => ['sm' => 'hidden'], // Hide aksi on sm
        ]">
            @forelse ($faqs as $faq)
                <tr class="{{ $loop->even ? 'bg-gray-50' : '' }} border-b border-gray-200 hover:bg-blueGray-100"
                    x-data="{}"
                    x-on:click="if (window.innerWidth <=640) { $wire.emit('openDetailFaq', {{ $faq->id }})
                    }">
                    <td class="flex items-start justify-between w-[85vw] px-6 py-3 sm:block md:w-96">
                        <div>
                            <span class="font-bold xl:font-semibold">{{ $faq->pertanyaan }}</span>
                            <dl>
                                <dd class="mt-1.5 text-xs italic sm:hidden">
                                    (Click For Detail)
                                </dd>
                                <dd class="mt-1.5 xl:hidden">
                                    {{ $faq->jawaban }}
                                </dd>
                            </dl>
                        </div>
                        <div class="flex items-start ml-auto sm:hidden">
                            @can(PERMISSION_DELETE_GALLERY)
                                <x-button class="mx-0.5 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                    x-on:click.stop="showModalDelete = true; faqQuestion = '{{ $faq->pertanyaan }}'; faqId = '{{ $faq->id }}'">
                                    Delete
                                </x-button>
                            @endcan
                        </div>
                    </td>
                    <td class="hidden px-6 py-3 w-96 xl:table-cell">
                        {{ $faq->jawaban }}
                    </td>
                    <td class="hidden w-48 px-6 py-3 text-center sm:table-cell">
                        <x-button wire:click="$emit('openDetailFaq', {{ $faq->id }})"
                            class="mx-0.5 rounded-3xl bg-2025-1 hover:bg-coklat-hover">
                            Detail
                        </x-button>

                        @can(PERMISSION_DELETE_FAQ)
                            <x-button class="mx-0.5 rounded-3xl bg-merah-700 hover:bg-merah-hover"
                                x-on:click="showModalDelete = true; faqQuestion = '{{ $faq->pertanyaan }}'; faqId = '{{ $faq->id }}'">
                                Delete
                            </x-button>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr class="border-b border-gray-200 hover:bg-blueGray-100">
                    <td colspan="3" class="px-6 py-3 italic text-center text-md">Belum ada FAQ</td>
                </tr>
            @endforelse

        </x-table>

        {{ $faqs->onEachSide(ON_EACH_SIDE)->links(DEFAULT_PAGINATION) }}

        @can(PERMISSION_DELETE_FAQ)
            <div x-cloak x-show="showModalDelete">
                <x-modal>
                    <x-modal.warning>
                        <x-slot name="title">
                            <h5 class="font-bold">Hapus FAQ</h5>
                        </x-slot>

                        <div>
                            Apakah kamu yakin untuk menghapus FAQ <b x-text="faqQuestion"></b>?
                        </div>

                        <x-slot name="footer">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600" :tagA="false"
                                x-on:click="showModalDelete = false">Batal</x-button>
                            <x-button class="rounded-3xl bg-merah-700 hover:bg-merah-hover" :tagA="false"
                                x-on:click="showModalDelete = false; $wire.hapus(faqId)">Ya, yakin</x-button>
                        </x-slot>
                    </x-modal.warning>
                </x-modal>
            </div>
        @endcan
    </x-card>
</div>
