@php
    $socials = get_field('socials', 'option');
    // Get the selected navigation menu, default to 'primary_navigation'
    $selected_menu = get_field('navigation_menu') ?: 'primary_navigation';
    $custom_nav_walker = new Custom_Nav_Walker();

@endphp

<aside class="fixed top-0 right-0 w-full h-full mobile-menu">
    <div class="flex justify-end w-full h-full lg:mx-auto lg:px-24 ">
        <div class="relative z-10 w-full h-full mt-20 lg:border-r lg:mt-40 mobile-menu__content lg:border-color-2/50">
            <div class="relative z-10 flex flex-col w-full h-full max-w-[720px] mx-auto max-lg:px-15">
                <div class="flex items-center justify-between">
                    <a class="brand" href="{{ home_url('/') }}">
                        @svg('resources.images.icons.logo', 'h-50 lg:h-100')
                    </a>
                    <button class="p-12 bg-color-1 rounded-6 js-button " type="button">
                        <svg preserveAspectRatio="xMidYMax meet" class="shrink-0 size-24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 6L3 6M21 12L3 12M21 18H3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>   
                    </button>
                </div>
                
                @if (has_nav_menu($selected_menu))
                    <nav class="mt-20 nav-secondary" aria-label="{{ wp_get_nav_menu_name($selected_menu) }}">
                        <div class="hover-line"></div>
                        {!! wp_nav_menu([
                            'theme_location' => $selected_menu, 
                            'menu_class' => 'nav flex flex-col gap-20', 
                            'add_li_class' => 'text-h5',
                            'echo' => false,
                            'walker' => $custom_nav_walker
                        ]) !!}
                    </nav>
                @endif
                
                <div class="flex flex-col items-end justify-center pt-30 pb-30 pr-15">
                    <x-socials :socials="$socials" class="socials socials--header" />
                </div>
            </div>
        </div>
    </div>
</aside>