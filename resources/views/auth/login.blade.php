<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

{{--   [ini comment] Pemberitahuan di login page apabila web sudah di share tapi akun belum dibagikan--}}
{{--        <div class="px-4 py-3 mb-2 font-semibold text-white rounded-md bg-merah-500 opacity-90">--}}
{{--            <div class="flex items-start mb-1">--}}
{{--                <i class="mr-2 mt-0.5 fa-solid fa-exclamation"></i>--}}
{{--                <small class="text-sm">Peserta dapat login setelah pembagian akun sekitar tanggal 11-12 September.</small>--}}
{{--            </div>--}}
{{--            <div class="flex items-start">--}}
{{--                <i class="mr-2 mt-0.5 fa-solid fa-exclamation"></i>--}}
{{--                <small class="text-sm">Saat ini, silakan cek Pengumuman secara berkala.</small>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div>
            <x-label for="username" value="No Ujian / Username" class="mb-2" />
            <input type="text" :value="old('username')"
                class="block w-full px-4 py-2 mt-1 rounded-full bg-white shadow-[0_0_20px_rgba(0,0,0,0.05)] border border-transparent focus:outline-none focus:ring-2 focus:ring-brown-600 focus:border-transparent"
                name="username" required autofocus>
        </div>

        <div class="mt-4" x-data="{ showPassword: false }">
            <x-label for="password" value="{{ __('Password') }}" class="mb-2" />
            <div class="relative flex flex-row items-center">
                <input :type="showPassword ? 'text' : 'password'" id="password"
                    class="block w-full px-4 py-2 mt-1 rounded-full bg-white shadow-[0_0_20px_rgba(0,0,0,0.05)] border border-transparent focus:outline-none focus:ring-2 focus:ring-brown-600 focus:border-transparent"
                    name="password" required autocomplete="current-password">
                <i class="absolute right-0 flex items-center pr-3 mr-2 cursor-pointer fa fa-eye"
                    x-on:click="showPassword = !showPassword" style="z-index: 1;"></i>
                <i class="absolute right-0 flex items-center pr-3 mr-2 cursor-pointer fa fa-eye-slash"
                    x-show="showPassword" x-on:click="showPassword = !showPassword" style="z-index: 1;"></i>
            </div>
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="flex items-center">
                <x-checkbox id="remember_me" name="remember" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

       <div class="flex flex-col items-center mt-3">
        <x-button class="inline-flex items-center justify-center px-8 py-3 text-lg font-bold text-white transition-all rounded-full shadow-lg bg-gradient-to-b from-pink-500 to-indigo-900 hover:brightness-110 hover:scale-105">
        Masuk
    </x-button>

    @if (Route::has('password.request'))
    <a class="mt-3 text-sm text-center text-gray-500 cursor-pointer hover:text-base-blue-600"
    href="{{ route('password.request') }}">
    Lupa Password?
        </a>
        @endif
        </div>
    </form>
</x-guest-layout>
