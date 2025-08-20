@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-base-brown-300
focus:ring focus:ring-base-brown-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:opacity-50']) !!}>
