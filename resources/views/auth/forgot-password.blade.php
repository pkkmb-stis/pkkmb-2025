<x-guest-layout>


    <div class="mb-4 text-sm text-gray-600 font-poppins text-xs">
        Lupa password? Silakan masukkan nomor ujian kamu dan kami akan mengirimkan link melalui email
        yang kamu gunakan ketika mendaftar di STIS.
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="block">
            <x-label for="username" value="No Ujian / Username" class="mb-2" />
            <x-input id="username" class="block w-full mt-1" type="text" name="username" :value="old('username')"
                required autofocus />
        </div>

        <div class="mt-3">
            <x-button class="w-full mt-4 text-lg transition bg-gradient-to-b from-pink-500 to-indigo-900 hover:brightness-110 hover:scale-105 font-poppins">
                Reset Password
            </x-button>

            <a class="block mt-3 text-xs text-center text-gray-500 cursor-pointer hover:text-base-blue-600 font-poppins"
                href="{{ route('login') }}">
                Halaman Login
            </a>
        </div>

    </form>
</x-guest-layout>
