<x-home-layout menu="Profil_Saya" title="Profil Saya">
      <div class="grid w-full px-8 pb-4 pt-24 sm:px-16 md:px-20 md:pb-5 md:pt-28 lg:pt-32 xl:px-16">
      {{-- Header --}}
          <div class="flex h-full w-full flex-row items-end justify-center gap-4 translate-y-[-10px]">
              <img src="{{ asset('img/maskot/2025/maskot 1.png') }}" alt="wave" class="z-10 w-14 sm:w-24 md:w-28 lg:w-32 lg:-translate-x-4 transform translate-y-[-10px]">
                  <div class="flex h-full flex-col items-center justify-center">
                      <div class="flex flex-row items-center justify-center gap-4 mt-14 transform translate-y-[-10px]">
                          <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                              alt="Elemen 4" class="w-14 sm:w-20 md:w-28 lg:w-28 -mr-14 sm:-mr-20 md:-mr-28 lg:-mr-28 sm:-mt-5 md:-mt-8 lg:-mt-8 z-10">
                          <h1
                              class="flex items-center justify-center rounded-full px-10 py-3 sm:px-8 sm:pb-4 lg:px-16 lg:py-4 lg:pb-6
                                  font-brasikaDisplay text-center text-sm font-thin leading-normal 
                                  drop-shadow-md sm:text-xl lg:text-3xl xl:text-4xl z-0 relative border-4"
                              style="color:#1E2A4A; background-color:#FFF3E6; border-color:#1E2A4A;">
                              PROFIL SAYA
                          </h1>
                          <img src="{{ asset('img/asset/2025/timeline/ornamenjudul1.png') }}" 
                              alt="Elemen 4" class="w-14 sm:w-20 md:w-28 lg:w-28 -ml-14 sm:-ml-20 md:-ml-28 lg:-ml-28 sm:-mt-5 md:-mt-8 lg:-mt-8 z-10 scale-x-[-1]">
                      </div>
                  </div>
              <img src="{{ asset('img/maskot/2025/maskot 4.png') }}" alt="wave" class="z-10 w-14 sm:w-24 md:w-28 lg:w-32 lg:translate-x-4 transform translate-y-[-10px]">
          </div>
      </div>

    <!-- Main Content Section -->
    <div class="my-6 sm:my-8 w-full px-2 sm:px-4">
        <x-card class="mx-auto w-full max-w-7xl rounded-2xl sm:rounded-3xl bg-opacity-40 py-4 sm:py-6 md:py-8 shadow-none">
            <!-- Grid Container dengan panel kiri 28% sesuai permintaan -->
            <div class="grid grid-cols-1 lg:grid-cols-[28%_1fr] gap-0 relative overflow-hidden" x-data="{ menuActive: '{{ $menu }}' }">
                
                <!-- Panel Kiri - Info Profil (28% width) dengan background yang disesuaikan -->
                <div class="col-span-1 rounded-t-lg sm:rounded-t-xl lg:rounded-l-xl lg:rounded-tr-none 
                        pt-4 sm:pt-6 shadow-lg sm:shadow-xl order-1 min-h-[300px] lg:min-h-[500px] 
                        bg-profil-left bg-cover bg-center bg-no-repeat">
                    <!-- Component info profil akan dimuat di sini -->
                    <livewire:home.profil.info />
                </div>


                <!-- Panel Kanan - Konten Utama (72% width) -->
                <div class="col-span-1 bg-gradient-to-br from-amber-50 to-orange-100 
                           p-3 sm:p-4 md:p-6 shadow-lg sm:shadow-xl 
                           rounded-b-lg sm:rounded-b-xl lg:rounded-r-xl lg:rounded-bl-none 
                           order-2 min-h-[400px]">
                    
                    <!-- Tab Navigation dengan spacing yang lebih baik -->
                    <div class="mb-4 sm:mb-6 flex flex-col sm:flex-row justify-center 
                               font-bachelor text-xs sm:text-sm font-normal gap-0">
                        <div class="flex w-full sm:w-auto shadow-md rounded-lg overflow-hidden">
                            <!-- Tab Edit Profil -->
                            <div class="cursor-pointer flex-1 sm:flex-none px-3 sm:px-4 md:px-6 py-2 sm:py-2.5 
                                       text-center transition-all duration-300 ease-in-out border-r border-2025-1/30
                                       hover:scale-[1.02] active:scale-[0.98]"
                                x-on:click="menuActive = 'edit'"
                                x-bind:class="menuActive == 'edit' ? 'text-white bg-2025-1 font-medium' : 'text-2025-1 bg-white/80 hover:bg-white hover:text-2025-1/80'">
                                Edit Profil
                            </div>

                            <!-- Tab Daftar Poin (jika user adalah maba atau panitia) -->
                            @if (auth()->user()->is_maba || auth()->user()->hasRole(ROLE_PANITIA))
                                <div class="cursor-pointer flex-1 sm:flex-none px-3 sm:px-4 md:px-6 py-2 sm:py-2.5 
                                           text-center transition-all duration-300 ease-in-out
                                           {{ auth()->user()->is_maba ? 'border-r border-2025-1/30' : '' }}
                                           hover:scale-[1.02] active:scale-[0.98]"
                                    x-on:click="menuActive = 'poin'"
                                    x-bind:class="menuActive == 'poin' ? 'bg-2025-1 text-white font-medium' : 'text-2025-1 bg-white/80 hover:bg-white hover:text-2025-1/80'">
                                    Daftar Poin
                                </div>
                            @endif

                            <!-- Tab Nilai (hanya untuk maba) -->
                            @if (auth()->user()->is_maba)
                                <div class="cursor-pointer flex-1 sm:flex-none px-3 sm:px-4 md:px-6 py-2 sm:py-2.5 
                                           text-center transition-all duration-300 ease-in-out
                                           hover:scale-[1.02] active:scale-[0.98]"
                                    x-on:click="menuActive = 'nilai'"
                                    x-bind:class="menuActive == 'nilai' ? 'bg-2025-1 text-white font-medium' : 'text-2025-1 bg-white/80 hover:bg-white hover:text-2025-1/80'">
                                    Nilai
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Content Sections dengan animasi smooth -->
                    <!-- Edit Profile Content -->
                    <div class="transition-all duration-500 ease-in-out" x-show="menuActive == 'edit'" x-transition>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 
                                   divide-y-2 lg:divide-y-0 lg:divide-x-2 divide-2025-1/20">
                            <!-- Form Edit Profil -->
                            <div class="pb-4 sm:pb-6 lg:pb-0 lg:pr-4 sm:lg:pr-6">
                                <livewire:home.profil.edit />
                            </div>
                            <!-- Form Password -->
                            <div class="pt-4 sm:pt-6 lg:pt-0 lg:pl-4 sm:lg:pl-6">
                                <livewire:home.profil.password />
                            </div>
                        </div>
                    </div>

                    <!-- Poin Content -->
                    @if (auth()->user()->is_maba || auth()->user()->hasRole(ROLE_PANITIA))
                        <div class="transition-all duration-500 ease-in-out" x-show="menuActive == 'poin'" x-transition>
                            <div class="divide-y-2 divide-2025-1/20">
                                <livewire:home.profil.poin />
                            </div>
                        </div>
                    @endif

                    <!-- Nilai Content -->
                    @if (auth()->user()->is_maba)
                        <div class="w-full transition-all duration-500 ease-in-out" x-show="menuActive == 'nilai'" x-transition>
                            @include('home.profil.nilai')
                        </div>
                    @endif
                </div>
            </div>
        </x-card>
    </div>

    @push('float')
        @livewire('home.dashboard.materi')
        @include('home.dashboard.penugasan')
    @endpush
</x-home-layout>
