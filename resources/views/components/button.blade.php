@props(['tagA' => false])

@if ($tagA)
<a
    {{ $attributes->merge(['class' => 'rounded p-2 px-3 text-xs transition inline-block font-poppins font-semibold text-white']) }}>
    {{ $slot }}
</a>
@else
<button
    {{ $attributes->merge(['class' => 'rounded cursor-pointer p-2 px-3 text-xs transition inline-block font-poppins font-semibold text-white']) }}>
    {{ $slot }}
</button>
@endif
