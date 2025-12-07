@php
    $custom_nav_walker = new Custom_Nav_Walker();
@endphp
<div class="flex items-center ">
   
    @if (has_nav_menu('primary_navigation'))
    <nav class="items-center justify-start h-full max-lg:hidden lg:flex primary_navigation " aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
        {!! wp_nav_menu([
        'theme_location' => 'primary_navigation', 
        'menu_class' => 'nav flex items-center gap-40', 
        'add_li_class' => ' transition-all duration-500 ease-in-out text-menu',
        'echo' => false,
        'walker' => $custom_nav_walker,
        ])!!}
    </nav>
    @endif


    <div class="grow-[0] lg:hidden w-full flex justify-end">
        <button class="p-12 bg-color-2 rounded-6 js-button " type="button">
            <svg preserveAspectRatio="xMidYMax meet" class="shrink-0 size-24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 6L3 6M21 12L3 12M21 18H3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>   
        </button>
    </div>  
</div>