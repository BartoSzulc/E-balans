<article  data-aos="fade-up">
    <a href="{{ get_permalink() }}" class="group">
        @if(has_post_thumbnail())
            <div class="relative flex overflow-hidden post-thumbnail lg:max-h-396 max-h-245 rounded-12">
                {!! get_the_post_thumbnail(null, 'full', ['class' => 'size-full object-center object-cover transition-transform duration-500 size-full group-hover:scale-105']) !!}
                <div class="absolute transition-opacity duration-500 ease-in-out opacity-0 pointer-events-none bottom-16 right-16 group-hover:opacity-100">
                    <svg preserveAspectRatio="xMidYMax meet" class="size-56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="56" height="56" rx="4" fill="#DDC4FC"/>
                        <path d="M25.5 23L30.5 28L25.5 33" stroke="#1B0A40" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                        
                </div>
            </div>
        @endif
        <div class="py-24 bg-color-2 lg:py-32">
            <div class="flex flex-wrap gap-8 mb-16 lg:mb-24">
            
                <span class="px-12 py-6 text-sm text-purple800 bg-purple rounded-4">
                    @php($categories = get_the_category())
                    {{ !empty($categories) ? esc_html($categories[0]->name) : '' }}
                </span>
                @if (get_field('reading_time'))
                    <span class="px-12 py-6 text-sm text-purple800 bg-color-2 rounded-4">
                        <?php echo get_field('reading_time'); ?> czytania
                    </span>
                @endif

            </div>
            <header>
                <h2 class="mb-16 text-h5 lg:  text-color-1">
                    {!! get_the_title() !!}
                </h2>
            </header>
            <div class="entry-summary line-clamp-3">
                @php(the_excerpt())
            </div>
        </div>
    </a>
</article>