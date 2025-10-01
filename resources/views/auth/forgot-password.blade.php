<x-guest-layout>


    <div class="mb-4 text-sm text-gray-600">
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
            <x-button class="w-full mt-4 text-lg transition bg-2025-1 hover:bg-2025-2 font-poppins">
                Reset Password
            </x-button>

            <a class="block mt-3 text-sm text-center text-gray-500 cursor-pointer hover:text-base-blue-600"
                href="{{ route('login') }}">
                Halaman Login
            </a>
        </div>

    </form>
</x-guest-layout>
