<div x-data="{ showModalMateri: false, hover: false, show: true }">

    <div class="bg-base-red-600 rounded-full border-2 shadow-lg cursor-pointer border-white-300 h-12 w-12 transform md:hover:scale-105 hover:scale-90 md:scale-95 scale-75 transition-all"
        x-on:click="showModalMateri = true" x-on:mouseover="hover = true; show = false"
        x-on:mouseleave="show = true; hover = false" wire:mouseover="$refresh">

        <div class="flex justify-center items-center h-full w-full">
            <div x-cloak x-show="show">
                <i class="fa-solid fa-book text-lg text-white"></i>
            </div>
            <div x-cloak x-show="hover" class="text-white text-center font-poppins font-bold text-2xl mr-3 ml-3">
                <h1>
                    {{ $count ?? '0' }}
                </h1>
            </div>
        </div>
    </div>

    <div x-cloak x-show="showModalMateri">
        <x-modal.home judul="Materi">
            <x-slot name="closeButton">
                <div x-on:click="showModalMateri = false">
                    <x-close-button />
                </div>
            </x-slot>

            <div class="font-poppins mt-2 divide-y">
                @forelse ($contents as $content)
                    <div class="p-2 cursor-pointer">
                        <div
                            class="lg:flex justify-between lg:items-center lg:p-4 p-2 pb-4 font-mulish hover:bg-blueGray-200 group hover:bg-opacity-50">

                            <p class=" font-poppins text-gray-50 lg:text-lg text-md font-semibold leading-tight">
                                {{ $content->title }}</p>

                            <div class="sm:mt-0 mt-3">
                                {{-- <x-button href="{{ storage($content->link) }}"
                            class="bg-blue-500 hover:bg-blue-600 uppercase text-md mr-2" :tagA=true
                            download="{{ renameToDownload($content->title, $content->link) }}">
                            <i class="fa-solid fa-book text-white"></i>
                            <span> Unduh</span>
                            </x-button> --}}
                                <x-button href="{{ $content->link }}"
                                    class="rounded-3xl bg-2025-2 hover:bg-2025-1 text-white-800 font-bold uppercase text-md mr-2"
                                    :tagA=true target="blank">
                                    <i class="fa-solid fa-book text-white-800"></i>
                                    <span> Lihat Materi</span>
                                </x-button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center italic text-sm py-3 px-6">Belum ada materi</p>
                @endforelse
            </div>
        </x-modal.home>
    </div>
</div>
