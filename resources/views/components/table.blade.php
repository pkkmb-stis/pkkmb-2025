@props(['theads', 'overflow' => 'true', 'maxHeight' => '', 'breakpointVisibility' => []])

<div {{ $attributes->merge(['class' => 'custom-scroll mb-5']) }}>
    <div class="overflow-auto {{ $maxHeight }}">
        <table class="{{ $overflow == true ? 'min-w-max' : '' }} w-full table-auto">
            <thead class="font-poppins">
                <tr
                    class="font-sans text-xs leading-normal text-gray-600 capitalize border-b bg-blueGray-50 font-bohemianSoul">
                    @foreach ($theads as $index => $thead)
                        @php
                            // Determine visibility classes for each column based on the provided breakpoints
                            $visibilityClass = '';
                            if (isset($breakpointVisibility[$index])) {
                                foreach ($breakpointVisibility[$index] as $breakpoint => $visibility) {
                                    $visibilityClass .= "$visibility $breakpoint:table-cell ";
                                }
                                $visibilityClass = rtrim($visibilityClass); // Clean up trailing spaces
                            }
                        @endphp
                        <th class="px-6 py-3 text-center {{ $visibilityClass }}">
                            {{ $thead }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-sm font-medium text-base-blue-400">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
