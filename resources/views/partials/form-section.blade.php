@php
    $form_section = get_field('form_section');
@endphp

@if ($form_section)
    <section class="relative form-section mt-50 lg:mt-120 overflow-x-clip">
        @include('partials.decorative-circle', [
                        'size' => 'size-82',
                        'bg' => 'bg-color-4',
                        'position' => 'top-6 right-40',
                        'hiddenOnMobile' => false,
                        'animation' => 'zoom-in-right',
                        'delay' => 500,
                    ])
                   
        <div class="container mx-auto">
            {{-- Title and Description --}}
            <div class="mx-auto text-center max-w-954 mb-30 lg:mb-40">
                @if (!empty($form_section['title']))
                    <div class="mb-16 section-title text-h2 text-color-3" data-aos="fade-up" data-aos-delay="100">
                        {!! $form_section['title'] !!}
                    </div>
                @endif

                @if (!empty($form_section['description']))
                    <div class="section-description text-body" data-aos="fade-up" data-aos-delay="200">
                        {!! $form_section['description'] !!}
                    </div>
                @endif
            </div>

            {{-- Contact Form --}}
            @if (!empty($form_section['form_shortcode']))
                <div class="relative z-10 p-20 mx-auto bg-white lg:py-56 lg:px-40 mb-30 max-w-954 lg:mb-40 shadow-special-1 rounded-32" data-aos="fade-up" data-aos-delay="300">
                    {!! do_shortcode($form_section['form_shortcode']) !!}
                </div>
            @endif

            {{-- Full Width Image --}}
            @if (!empty($form_section['image']))
                <div class="relative lg:-mt-205" data-aos="fade-up" data-aos-delay="400">
                    
                    {!! wp_get_attachment_image($form_section['image'], 'full', false, [
                        'class' => 'object-cover object-center w-full lg:h-800 rounded-32 relative z-2 shadow-special-1',
                        'role' => 'presentation',
                    ]) !!}
                </div>
            @endif
        </div>
    </section>
@endif
