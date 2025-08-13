@props(['maxWidth' => 'max-w-xl'])

<div class="fixed inset-0 z-30 flex items-center justify-center bg-black bg-opacity-50 custom-scroll"
    x-on:click="showModalDetail = false">
    <div class="w-full m-4 overflow-y-auto bg-white rounded-xl shadow-md {{ $maxWidth }} max-h-custom bg-putih-pattern"
        role="dialog" x-on:click.stop>
        <div class="relative">
            {{ $slot }}
        </div>
    </div>
</div>
