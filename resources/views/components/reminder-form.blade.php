@props(['id' => 'modal', 'title' => 'Modal Title'])

<div x-data="{ showModal: false }" x-show="showModal" id="{{ $id }}" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div @click.away="showModal = false" class="bg-white rounded-lg shadow-lg max-w-lg w-full">
        <div class="px-4 py-2 flex justify-between items-center">
            <h2 class="text-xl font-semibold">{{ $title }}</h2>
            <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        <div class="px-4 py-2">
            {{ $slot }}
        </div>
        <div class="px-4 py-3 flex justify-end">
            <x-button @click="showModal = false">Tutup</x-button>
        </div>
    </div>
</div>
