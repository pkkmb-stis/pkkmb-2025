<x-guest-layout>


    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>


    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" autofocus />
        </div>

        <div class="flex justify-end mt-4">
            <x-button
                class="mt-4 bg-base-blue-400 opacity-95 hover:opacity-100 w-full text-base transition font-poppins">
                Konfirmasi
            </x-button>
        </div>
    </form>

</x-guest-layout>