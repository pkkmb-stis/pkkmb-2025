@props(['buttonText' => 'Opsi','id' => Str::random(5), 'child' => false])
<div>
    <button @tippyclose.window="$el._tippy.hide()" x-init="$refs.{{$id}}_opsi.firstElementChild.classList.add('rounded-t');$refs.{{$id}}_opsi.lastElementChild.classList.add('rounded-b');tippy($el,{
        theme : 'menu',
        hideOnClick : true,
        arrow : false,
        trigger : 'click',
        interactive : true,
        allowHTML : true,
        content : $refs.{{$id}}_opsi.innerHTML,
        placement: 'right',
    })" {{ $attributes->merge(['class' => ($child) ? 'text-sm w-full hover:bg-blue-400 hover:text-white px-3 py-1' : 'rounded p-2 px-3 text-xs transition font-poppins font-semibold text-white']) }}>
        <i class='fa fa-angle-down mr-2 pl-0'></i><span>{{ $buttonText }}</span></button>
        <div class="hidden" x-ref='{{$id}}_opsi'>
            {{ $slot }}
        </div>
</div>
