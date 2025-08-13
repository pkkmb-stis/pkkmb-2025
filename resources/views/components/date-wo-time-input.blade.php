@props(['opt' => "{dateFormat:'Y-m-d',altInput: true,
altFormat: 'F j, Y'}", 'disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} x-ref='{{ $attributes['id'] ?? 'inputDate' }}'
    x-effect="flatpickr($refs.{{ $attributes['id'] ?? 'inputDate' }}, {{$opt}});" type="text" {{ $attributes->merge(['class' => 'w-full block disabled:bg-gray-200 px-3 py-2.5 text-base border border-gray-300 rounded-md focus:border-base-brown-300 focus:ring focus:ring-base-brown-200 focus:ring-opacity-50 sm:text-sm sm:leading-5']) }} />
