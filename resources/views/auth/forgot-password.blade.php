<x-guest-layout>


    <div class="mb-4 text-sm text-gray-600 font-poppins text-xs">
        Lupa password? Silakan masukkan nomor ujian kamu dan kami akan mengirimkan link melalui email
        yang kamu gunakan ketika mendaftar di STIS.
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-label for="username" value="No Ujian / Username" class="mb-2 font-poppins" />
            <input type="text" :value="old('username')"
                class="block w-full px-4 py-2 mt-1 rounded-full bg-white shadow-[0_0_20px_rgba(0,0,0,0.05)] border border-transparent focus:outline-none focus:ring-2 focus:ring-brown-600 focus:border-transparent"
                name="username" required autofocus>
        </div>

        <div class="flex flex-col items-center mt-4">
            <x-button class="inline-flex items-center justify-center px-8 py-3 text-lg font-bold text-white transition-all rounded-full shadow-lg bg-gradient-to-b from-pink-500 to-indigo-900 hover:brightness-110 hover:scale-105 font-poppins">
                Reset Password
            </x-button>

            <a class="block mt-3 text-xs text-center text-gray-500 cursor-pointer hover:text-base-blue-600 font-poppins"
                href="{{ route('login') }}">
                Halaman Login
            </a>
        </div>

    </form>
</x-guest-layout>
