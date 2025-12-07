@php
    $socials = get_field('socials', 'option');
@endphp

<header class="relative main-header z-999 ">
    <div class="container relative z-10 ">
        <div class="relative flex justify-between gap-20 py-20">
            {{-- @if (!is_front_page())
            <div class="absolute bottom-0 w-full h-1 bg-color-5">
              
            </div>
            
            @endif --}}
            <div class="flex items-center col-span-full lg:col-span-3">
                <a class="brand" href="{{ home_url('/') }}">
                    @svg('resources.images.icons.logo', 'h-50 lg:h-100')
                </a>
            </div>
            <div class="flex items-center right">
                
                <div class="relative flex items-center h-full menu-header lg:mr-50 max-lg:order-last">
                    @include('partials.header.menu')
                </div>
                <div class="relative flex items-center justify-center max-lg:hidden">
                  <div class="flex self-stretch w-1 h-40 mr-20 lg:h-60 divider bg-color-4"></div>

                  <x-socials :socials="$socials" class="socials socials--header" />
                </div>
                
                <div class="flex items-center justify-center">
                    <div class="flex self-stretch w-1 h-40 mx-10 max-lg:hidden lg:mx-20 lg:h-60 divider bg-color-4"></div>
                    <a href="tel:+48794310528"
                        class="flex items-center h-full transition-all duration-500 ease-in-out group shrink-0 grow-0">
                        <div class="left">
                            @svg('resources.images.icons.phone-call', 'size-40')
                        </div>
                        <span class="font-bold transition-all duration-300 text-color-1 max-lg:hidden ease-power1-in group-hover:text-color-2">+48 22
                            775 11 75</span>
                    </a>
                </div>
                <div class="flex items-center justify-center">
                  <div class="flex self-stretch w-1 h-40 mx-10 lg:mx-20 lg:h-60 divider bg-color-4"></div>

                  <button class="toggleDarkMode contrast-switcher" title="Toggle Dark Mode">

                    <svg class="size-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M15 0C6.71573 0 0 6.71573 0 15C0 23.2843 6.71573 30 15 30C23.2843 30 30 23.2843 30 15C30 6.71573 23.2843 0 15 0ZM15 28.125C7.75126 28.125 1.875 22.2487 1.875 15C1.875 7.75126 7.75126 1.875 15 1.875C22.2487 1.875 28.125 7.75126 28.125 15C28.125 22.2487 22.2487 28.125 15 28.125Z" fill="#71849A"/>
                      <path d="M14.9975 4.22656C9.0477 4.22774 4.22538 9.05197 4.22656 15.0018C4.22774 20.9499 9.04937 25.7715 14.9975 25.7727C15.4486 25.7727 15.8143 25.407 15.8143 24.956V5.04332C15.8143 4.59224 15.4486 4.22656 14.9975 4.22656Z" fill="#0F529E"/>
                    </svg>
                      
                  </button>
                </div>
                <div class="flex items-center justify-center max-lg:mr-10 ">
                  <div class="flex self-stretch w-1 h-40 mx-10 lg:mx-20 lg:h-60 divider bg-color-4"></div>
                  {{-- here language --}}
                  @php
                    $current_lang = pll_current_language();
                    $translations = pll_the_languages(['raw' => 1]);
                  @endphp
                  @if($translations)
                    @foreach($translations as $lang)
                      @if(!$lang['current_lang'])
                        <a href="{{ $lang['url'] }}" class="relative flex items-center justify-center transition-all duration-300 size-30 lg:size-40 text-button text-color-1 hover:text-color-2">
                          {{ strtoupper($lang['slug']) }}
                          <div class="absolute -translate-x-1/2 -translate-y-1/2 border-2 rounded-full left-1/2 top-1/2 border-color-5 size-30 lg:size-40"></div>
                        </a>
                      @endif
                    @endforeach
                  @endif
                </div>
                

            </div>
        </div>
    </div>
</header>
<div class="fixed top-0 w-full transition-all duration-500 ease-in-out transform -translate-y-full bg-white opacity-0 rounded-b-20 lg:rounded-b-40 border-b-1 border-color-4 banner main-header--sticky z-999">
  <div class="container relative z-10 ">
      <div class="relative flex justify-between gap-20 py-20">
          {{-- @if (!is_front_page())
          <div class="absolute bottom-0 w-full h-1 bg-color-5">
            
          </div>
          
          @endif --}}
          <div class="flex items-center col-span-full lg:col-span-3">
              <a class="brand" href="{{ home_url('/') }}">
                  @svg('resources.images.icons.logo', 'h-50 lg:h-100')
              </a>
          </div>
          <div class="flex items-center right">
              
              <div class="relative flex items-center h-full menu-header lg:mr-50 max-lg:order-last">
                  @include('partials.header.menu')
              </div>
              <div class="relative flex items-center justify-center max-lg:hidden">
                <div class="flex self-stretch w-1 h-40 mr-20 lg:h-60 divider bg-color-4"></div>

                <x-socials :socials="$socials" class="socials socials--header" />
              </div>
              
              <div class="flex items-center justify-center">
                  <div class="flex self-stretch w-1 h-40 mx-10 max-lg:hidden lg:mx-20 lg:h-60 divider bg-color-4"></div>
                  <a href="tel:+48794310528"
                      class="flex items-center h-full transition-all duration-500 ease-in-out group shrink-0 grow-0">
                      <div class="left">
                          @svg('resources.images.icons.phone-call', 'size-40')
                      </div>
                      <span class="font-bold transition-all duration-300 text-color-1 max-lg:hidden ease-power1-in group-hover:text-color-2">+48 22
                          775 11 75</span>
                  </a>
              </div>
              <div class="flex items-center justify-center">
                <div class="flex self-stretch w-1 h-40 mx-10 lg:mx-20 lg:h-60 divider bg-color-4"></div>

                <button class="toggleDarkMode contrast-switcher" title="Toggle Dark Mode">

                  <svg class="size-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 0C6.71573 0 0 6.71573 0 15C0 23.2843 6.71573 30 15 30C23.2843 30 30 23.2843 30 15C30 6.71573 23.2843 0 15 0ZM15 28.125C7.75126 28.125 1.875 22.2487 1.875 15C1.875 7.75126 7.75126 1.875 15 1.875C22.2487 1.875 28.125 7.75126 28.125 15C28.125 22.2487 22.2487 28.125 15 28.125Z" fill="#71849A"/>
                    <path d="M14.9975 4.22656C9.0477 4.22774 4.22538 9.05197 4.22656 15.0018C4.22774 20.9499 9.04937 25.7715 14.9975 25.7727C15.4486 25.7727 15.8143 25.407 15.8143 24.956V5.04332C15.8143 4.59224 15.4486 4.22656 14.9975 4.22656Z" fill="#0F529E"/>
                  </svg>
                    
                </button>
              </div>
              <div class="flex items-center justify-center max-lg:mr-10 ">
                <div class="flex self-stretch w-1 h-40 mx-10 lg:mx-20 lg:h-60 divider bg-color-4"></div>
                {{-- here language --}}
                @php
                  $current_lang = pll_current_language();
                  $translations = pll_the_languages(['raw' => 1]);
                @endphp
                @if($translations)
                  @foreach($translations as $lang)
                    @if(!$lang['current_lang'])
                      <a href="{{ $lang['url'] }}" class="relative flex items-center justify-center transition-all duration-300 size-30 lg:size-40 text-button text-color-1 hover:text-color-2">
                        {{ strtoupper($lang['slug']) }}
                        <div class="absolute -translate-x-1/2 -translate-y-1/2 border-2 rounded-full left-1/2 top-1/2 border-color-5 size-30 lg:size-40"></div>
                      </a>
                    @endif
                  @endforeach
                @endif
              </div>
              

          </div>
      </div>
  </div>
</div>

@include('partials.header.menu-mobile')
