<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PKKMB 2025</title>
    <link rel="shortcut icon" href="{{ LOGO }}" type="image/x-icon">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="antialiased text-gray-900 font-mulishzw">
        <x-toast classStart="top-8" classEnd="top-16" />
        <div class="flex w-full h-screen bg-2025-login">
            <div class="hidden w-1/3 md:block md:col-span-4">
                <div class="flex flex-col items-center justify-center h-full -mt-8">
                    <img src="{{ LOGO }}" alt="Logo" class="relative w-56 mb-4">
                    <div class="text-center md:px-8 2xl:px-20">
                        <p class="text-base font-semibold text-2025-1 font-poppins">
                            Menyiapkan Mahasiswa Kedinasan yang Unggul secara Akademis, BerAKHLAK, Berintegritas, Resilien, Ramah, serta Memegang Nilai-Nilai Luhur Bangsa dan Agama
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center w-full col-span-8 md:w-2/3 md:col-span-4 bg-login-kanan md:bg-login-kanan bg-no-repeat bg-cover">
                <div class="flex items-center justify-center w-full h-screen">
                    <div class="md:w-3/4 w-[90%] md:h-3/4 rounded-3xl shadow-[0_0_20px_rgb(60,60,60)]">
                        <div class="relative flex items-center justify-center w-full h-full col-span-12 md:col-span-7 bg-putih-500 rounded-3xl">
                            <div class="top-0 right-0 hidden px-6 md:absolute md:block">
                                <a href="{{ route('home.index') }}" class="inline-block mt-2 text-center hover:text-base-blue-600 text-base-blue-400">
                                    <img src="{{ LOGO }}" alt="Logo" class="w-20 mx-auto rounded-full">
                                </a>
                            </div>
                            <x-card class="w-3/4 h-full md:h-auto bg-transparent border-none shadow-none">
                                <div class="block w-full my-4 md:hidden rounded-xl">
                                    <div class="flex flex-col items-center justify-center h-full">
                                        <img src="{{ LOGO }}" alt="Logo" class="w-48 mb-2 ">
                                    </div>
                                </div>
                                {{ $slot }}
                            </x-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>