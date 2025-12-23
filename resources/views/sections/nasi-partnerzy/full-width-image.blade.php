@php
    $full_width_image = get_field('full_width_image');
@endphp

@if ($full_width_image && !empty($full_width_image['image']))
    <section class="relative overflow-hidden full-width-image-section mt-50 lg:mt-120">
        <div class="container mx-auto">
            <div class="relative h-560" data-aos="fade-up" data-aos-delay="100">
                {{-- Decorative Circles --}}
                @include('partials.decorative-circle', [
                    'size' => 'size-143',
                    'bg' => 'bg-color-4',
                    'position' => 'top-32 -left-72',
                    'hiddenOnMobile' => false,
                    'animation' => 'zoom-in-right',
                    'delay' => 200,
                ])
                @include('partials.decorative-circle', [
                    'size' => 'size-82',
                    'bg' => 'bg-color-4',
                    'position' => 'bottom-48 -right-41',
                    'hiddenOnMobile' => false,
                    'animation' => 'zoom-in-left',
                    'delay' => 300,
                ])

                {{-- Full Width Image --}}
                {!! wp_get_attachment_image($full_width_image['image'], 'full', false, [
                    'class' => 'object-cover object-center w-full h-560 rounded-32 relative z-10 shadow-special',
                    'role' => 'presentation',
                ]) !!}
            </div>
        </div>
    </section>
@endif
