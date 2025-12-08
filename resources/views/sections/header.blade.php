@php
    $header = get_field('header', 'option');
    $socials = $header['socials'] ?? [];
@endphp

{{-- Skip Navigation Link for Accessibility --}}
<a href="#main-content"
    class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[10000] focus:px-16 focus:py-8 focus:bg-color-1 focus:text-white focus:rounded-4">
    Skip to main content
</a>

<header class="relative w-full py-20 lg:py-32 main-header z-999" role="banner">
    <div class="container relative">
        <div class="relative flex items-center justify-between gap-60">
            {{-- Logo on the left --}}
            <div class="flex items-center self-start w-300">
                <a class="brand" href="{{ home_url('/') }}" aria-label="E-balans - Strona główna">
                    <img src="@asset('resources/images/icons/logo.svg')" class="h-48" alt="E-balans Logo">
                </a>
            </div>

            {{-- Menu centered --}}
            <div class="relative flex items-center justify-end flex-1 h-full lg:justify-center menu-header">
                @include('partials.header.menu')
            </div>

            {{-- Socials on the right --}}
            <div class="flex items-center justify-end gap-24 max-lg:hidden w-300">
                <x-socials :socials="$socials" class="socials socials--header" />
            </div>
        </div>
    </div>
</header>

{{-- Sticky Header --}}
<div class="fixed top-0 w-full py-20 transition-all duration-500 ease-in-out transform -translate-y-full bg-white opacity-0 lg:py-32 banner main-header--sticky z-999"
    role="banner" aria-label="Sticky navigation">
    <div class="container relative z-10">
        <div class="relative flex items-center justify-between gap-60">
            {{-- Logo on the left --}}
            <div class="flex items-center self-start w-300">
                <a class="brand" href="{{ home_url('/') }}" aria-label="E-balans - Strona główna">
                    <img src="@asset('resources/images/icons/logo.svg')" class="h-48" alt="E-balans Logo">
                </a>
            </div>

            {{-- Menu centered --}}
            <div class="relative flex items-center justify-end flex-1 h-full lg:justify-center menu-header">
                @include('partials.header.menu')
            </div>

            {{-- Socials on the right --}}
            <div class="flex items-center justify-end gap-24 max-lg:hidden w-300">
                <x-socials :socials="$socials" class="socials socials--header" />
            </div>
        </div>
    </div>
</div>

@include('partials.header.menu-mobile')
