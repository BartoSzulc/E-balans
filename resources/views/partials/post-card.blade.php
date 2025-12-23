@php
    // Accept post_id parameter, otherwise use current post
    $post_id = $post_id ?? get_the_ID();
    $aos_delay = $aos_delay ?? 0;
@endphp

<article data-aos="fade-up" data-aos-delay="{{ $aos_delay }}" class="relative z-10 flex flex-col bg-white shadow-special rounded-32 lg:min-h-568">
        <a href="{{ get_permalink($post_id) }}" class="flex px-8 pt-8 group">
            @if (has_post_thumbnail($post_id))
                <div class="relative flex overflow-hidden post-thumbnail h-200 lg:h-280 rounded-32">
                    {!! get_the_post_thumbnail($post_id, 'full', [
                        'class' => 'size-full object-center object-cover transition-transform duration-500 size-full group-hover:scale-105',
                    ]) !!}

                </div>
            @else
                <div class="relative flex overflow-hidden post-thumbnail h-200 lg:h-280 rounded-32">
                    <img src="{{ placeholder(1000, 280, $post_id) }}" alt="{{ get_the_title($post_id) }}"
                        class="object-cover object-center transition-transform duration-500 size-full group-hover:scale-105">
                </div>
        @endif
        </a>
        <div class="flex flex-col gap-16 p-16 lg:p-24 grow">
            <div class="text-h3 text-color-3">
                @if (is_front_page())
                    <h2>{!! get_the_title($post_id) !!}</h2>
                @else
                    <h3>{!! get_the_title($post_id) !!}</h3>
                @endif
            </div>
            <div class="entry-summary grow">
                {{ get_the_excerpt($post_id) }}
            </div>
        <a href="{{ get_permalink($post_id) }}" class="flex items-center space-x-8 transition-all duration-300 ease-in-out group hover:text-color-2"><span>Czytaj dalej</span><svg class="duration-300 size-24 translate-all ease-power1-in group-hover:translate-x-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="12" fill="#E52F3D"/>
                <path d="M16.5 11.134C17.1667 11.5189 17.1667 12.4811 16.5 12.866L10.5 16.3301C9.83333 16.715 9 16.2339 9 15.4641L9 8.5359C9 7.7661 9.83333 7.28497 10.5 7.66987L16.5 11.134Z" fill="white"/>
                </svg>
            </a>
        </div>
    
</article>
