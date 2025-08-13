<x-admin-layout menu="Dashboard" title="Dashboard">
    <div>
        <x-card class="mb-8">
            <div class="flex items-center justify-between">
                <h5 class="text-xl font-normal text-gray-700 font-bohemianSoul">{{ getGreeting().', '.auth()->user()->name }}!</h5>
            </div>
            <hr class="my-3">
            <div>
                <p class="text-base font-semibold font-nunito">{{ getQuotes() }}</p>
            </div>
        </x-card>
    </div>
</x-admin-layout>
