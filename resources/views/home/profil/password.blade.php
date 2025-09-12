<form wire:submit="ubahPassword" class="w-full max-w-2xl text-gray-900">

    <div class="mb-6 md:flex md:items-center">

        <div class="md:w-1/3">
            <x-label-input for="password_lama"
                class="block py-2 pr-4 mb-1 md:text-left md:mb-0 font-bohemianSoul ">Password
                Lama</x-label-input>
        </div>
        <div class="md:w-2/3">
            <x-input wire:model="password_lama" type="password" class="w-full rounded-lg shadow-lg" />
            <x-error-input name="password_lama" />
        </div>

    </div>
    <div class="mb-6 md:flex md:items-center">
        <div class="md:w-1/3">
            <x-label-input for="password_baru"
                class="block py-2 pr-4 mb-1 md:text-left md:mb-0 font-bohemianSoul ">Password
                Baru</x-label-input>
        </div>
        <div class="md:w-2/3">
            <x-input wire:model="password_baru" type="password" class="w-full rounded-lg shadow-lg" />
            <x-error-input name="password_baru" />
        </div>
    </div>
    <div class="mb-6 md:flex md:items-center">
        <div class="md:w-1/3">
            <x-label-input for="password_baru_confirmation"
                class="block pr-4 mb-1 md:text-left md:mb-0 font-bohemianSoul ">Konfirmasi Password
                Baru</x-label-input>
        </div>
        <div class="md:w-2/3">
            <x-input wire:model="password_baru_confirmation" type="password"
                class="w-full rounded-lg shadow-lg" />
            <x-error-input name="password_baru_confirmation" />
        </div>
    </div>

    <div class="flex items-center justify-between mt-4">
        <p class="mr-2 text-xs italic text-gray-600">Jika kamu lupa password lama
            silakan
            gunakan fitur lupa password di halaman login</p>
        <x-button class="text-sm capitalize bg-merah-1 hover:bg-merah-2 whitespace-nowrap rounded-2xl" type="submit">
            Ubah Password
        </x-button>
    </div>
</form>
