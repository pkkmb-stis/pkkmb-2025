@error($attributes['name'])
<span {{ $attributes->merge(['class' => 'text-red-600 mt-1 block']) }}>
    {{ $message }}
</span>
@enderror