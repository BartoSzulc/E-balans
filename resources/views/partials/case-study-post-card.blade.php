<div class="relative z-10 flex flex-col p-10 bg-white border lg:p-20 border-color-4/50 rounded-20 lg:rounded-40 case-study-item group" data-aos="fade-up" data-aos-delay="100">
    @if(has_post_thumbnail())
        <div class="relative mb-10 overflow-hidden lg:mb-20 bg-color-4 rounded-20 lg:rounded-40 h-200 lg:h-340">
            <a href="{{ get_permalink() }}">
                {!! get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'duration-500 ease-power1-in group-hover:scale-110 size-full object-cover object-center rounded-20 lg:rounded-40']) !!}
            </a>
            @php
                $logo_klienta = get_field('logo_klienta');
            @endphp
            @if($logo_klienta)
                <div class="absolute flex items-center justify-center px-20 bg-white top-10 left-10 w-100 lg:w-230 h-50 lg:h-120 rounded-20 lg:rounded-40" data-aos="fade">
                    {!! wp_get_attachment_image($logo_klienta, 'medium', false, ['class' => 'object-contain max-h-120 aspect-1/1']) !!}
                </div>
            @endif
        </div>
    @endif
    <div class="flex flex-col p-10 gap-15 lg:gap-30 grow shrink">
        <h3 class="transition-colors duration-500 text-h4 ease-power1-in group-hover:text-color-1">
            <a href="{{ get_permalink() }}">{!! get_the_title() !!}</a>
        </h3>
        <div class="text">
            {!! wp_trim_words(get_the_excerpt(), 20, '...') !!}
        </div>
        <div class="inline-flex mt-auto mb-10">
            <a href="{{ get_permalink() }}" class="btn btn--white !min-w-260">{!! __('Zobacz szczegóły') !!}</a>
        </div>
    </div>
</div>