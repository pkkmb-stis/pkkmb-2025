<img style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;" src="{{ auth()->user()->profile_photo_url }}"
    alt="{{ auth()->user()->name }}" class="cursor-pointer" x-on:click="dropDownOpen = true">
