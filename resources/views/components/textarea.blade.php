@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => 'w-full block disabled:bg-gray-200 p-2 border border-gray-300 rounded-md focus:border-base-brown-300 focus:ring focus:ring-base-brown-200 focus:ring-opacity-50 sm:text-sm sm:leading-5']) }}>{{ $slot }}</textarea>
