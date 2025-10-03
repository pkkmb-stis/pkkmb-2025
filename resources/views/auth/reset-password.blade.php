<x-guest-layout>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="block">
            <x-label for="email" value="{{ __('Email') }}" />
            <input id="email" class="block w-full px-4 py-2 mt-1 rounded-full bg-white shadow-[0_0_20px_rgba(0,0,0,0.05)] border border-transparent focus:outline-none focus:ring-2 focus:ring-brown-600 focus:border-transparent font-poppins" type="email" name="email"
                :value="old('email', $request->email)" required autofocus />
        </div>

        <div class="mt-4">
            <x-label for="password" value="{{ __('Password') }}" />
            <input id="password" class="block w-full px-4 py-2 mt-1 rounded-full bg-white shadow-[0_0_20px_rgba(0,0,0,0.05)] border border-transparent focus:outline-none focus:ring-2 focus:ring-brown-600 focus:border-transparent font-poppins" type="password" name="password" required
                autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <input id="password_confirmation" class="block w-full px-4 py-2 mt-1 rounded-full bg-white shadow-[0_0_20px_rgba(0,0,0,0.05)] border border-transparent focus:outline-none focus:ring-2 focus:ring-brown-600 focus:border-transparent font-poppin" type="password"
                name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex flex-col items-center mt-3">
            <x-button class="mt-4 items-center justify-center px-8 py-3 text-lg font-bold text-white transition-all rounded-full shadow-lg bg-gradient-to-b from-pink-500 to-indigo-900 hover:brightness-110 hover:scale-105 font-poppins">
            Reset Password
            </x-button>
        </div>
    </form>
</x-guest-layout>
