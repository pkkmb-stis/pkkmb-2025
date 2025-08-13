@if (session()->has('success') || session()->has('error')|| session()->has('status') || $errors->any())
<div class="fixed {{ $classStart }} z-50 lg:right-10 right-5 transition-all duration-500 ease-in"
    x-data="{show : false}" x-cloak
    x-init="setTimeout(() => {show = true; setTimeout(() => {show = false; setTimeout(() => {$el.remove()}, 600)}, 2500)}, 50)"
    x-show="show" x-transition:enter-start="{{ $classEnd }} opacity-0"
    x-transition:enter-end="{{ $classStart }} opacity-100" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">

    @if (session()->has('success'))
    <x-toast.success>
        {{ session()->get('success') }}
    </x-toast.success>
    @endif

    @if (session()->has('status'))
    <x-toast.success>
        {{ session()->get('status') }}
    </x-toast.success>
    @endif

    @if (session()->has('error'))
    <x-toast.error>
        {{ session()->get('error') }}
    </x-toast.error>
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <x-toast.error>
        {{ $error }}
    </x-toast.error>
    @endforeach
    @endif
</div>
@endif
