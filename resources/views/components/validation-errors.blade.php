@if ($errors->any())
<div {{ $attributes }}>
    @foreach ($errors->all() as $error)
    <p class="mt-3 text-sm text-red-600">{{ $error }}</p>
    @endforeach
</div>
@endif
