<div>
    <div x-data="{isModalOpen : false, search: false}">
        <x-button class="ml-2 uppercase opacity-100 rounded-3xl bg-coklat-1 hover:bg-base-brown-600" type="button" x-on:click="isModalOpen = true">
            Tambah Admin
        </x-button>
        <div x-cloak x-show="isModalOpen">
            <x-modal>
                <div class="p-5 pb-1 bg-white">
                    <p class="mb-4 text-lg font-semibold leading-3 text-gray-700 capitalize">Tambah Admin</p>
                    <div class="text-sm text-gray-700">
                        <x-input type="text" wire:model.live="search" placeholder="Search user..."
                            x-on:input="search = true" class="block w-full" />

                        <ul x-show="search" x-on:click.away="search = false"
                            class="absolute left-0 right-0 m-2 bg-white border border-gray-200 rounded-md shadow-sm">
                            @forelse($users as $u)
                            <li wire:click="selectUser({{ $u }})" x-on:click="search = false"
                                class="px-4 py-2 cursor-pointer hover:bg-gray-200">
                                <p>{{ $u->name }} - <span class="italic">{{ $u->username }}</span> </p>
                            </li>
                            @empty
                            <li class="px-4 py-2 italic">
                                <p>No user found</p>
                            </li>
                            @endforelse
                        </ul>

                        <div class="flex justify-end my-3">
                            <x-button class="mr-2 bg-gray-500 rounded-3xl hover:bg-gray-600"
                                x-on:click="isModalOpen = false; search = false" wire:click="selectUser">
                                Batal
                            </x-button>
                            <x-button class="rounded-3xl bg-coklat-2 hover:bg-coklat-hover" x-on:click="isModalOpen = false"
                                wire:click="addAdmin">
                                Tambah Admin
                            </x-button>
                        </div>
                    </div>
                </div>
            </x-modal>
        </div>
    </div>
</div>
