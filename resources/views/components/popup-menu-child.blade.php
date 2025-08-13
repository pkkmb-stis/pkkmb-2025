@props(['tag' => 'div'])
<{{$tag}} {{$attributes}} x-on:click = "$dispatch('tippyclose');" class="text-sm w-full hover:bg-blue-400 hover:text-white px-3 py-1">
    {{$slot}}
</{{$tag}}>
