@php
    // Support both flexible content ($layout passed as $data) and standard fields
    $cta = $data ?? ($layout ?? []);
@endphp

<section class=" cta-section mt-50 lg:mt-120">

    <div class="container mx-auto">
        <div class="relative grid grid-cols-12 gap-16 overflow-hidden text-white bg-color-3 rounded-32 pt-14">

            <div class="absolute z-10 top-77 -right-27">
                <svg class="w-872 h-756" viewBox="0 0 872 756" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="519.5" cy="131.5" r="131.5" fill="#5477AD" data-aos="fade-up"
                        data-aos-delay="500" />
                    <circle cx="688.5" cy="289.5" r="183.5" fill="#BEC6D0" data-aos="fade-left"
                        data-aos-delay="300" />
                    <circle cx="316.5" cy="439.5" r="316.5" fill="#B1BCCC" data-aos="fade-up"
                        data-aos-delay="200" />
                </svg>

            </div>
            <div class="flex flex-col justify-center gap-24 lg:ml-72 cta-content col-span-full lg:col-span-5">
                @if (!empty($cta['title']))
                    <div class="cta-title text-h2" data-aos="fade-up" data-aos-delay="100">
                        {!! $cta['title'] !!}
                    </div>
                @endif

                @if (!empty($cta['description']))
                    <div class="cta-description text-body" data-aos="fade-up" data-aos-delay="200">
                        {!! $cta['description'] !!}
                    </div>
                @endif

                @if (!empty($cta['link']))
                    <div class="cta-button" data-aos="fade-up" data-aos-delay="300">
                        @php
                            acf_link($cta['link'], 'btn btn--primary');
                        @endphp
                    </div>
                @endif
            </div>

            @if (!empty($cta['image']))
                <div class="relative z-10 flex justify-end h-full cta-image col-span-full lg:col-span-6 lg:h-451" data-aos="fade-up">
                    
                    <div class="relative flex w-fit">
                      @include('partials.decorative-circle', [
                        'size' => 'size-82',
                        'bg' => 'bg-color-4',
                        'position' => 'top-109 -right-53',
                        //'hiddenOnMobile' => false,
                        'animation' => 'zoom-in-left',
                        'delay' => 200,
                    ])
                    @include('partials.decorative-circle', [
                        'size' => 'size-82',
                        'bg' => 'bg-color-4',
                        'position' => 'bottom-149 -left-31',
                        //'hiddenOnMobile' => false,
                        'animation' => 'zoom-in-up',
                        'delay' => 400,
                    ])
                    {!! wp_get_attachment_image($cta['image'], 'full', false, ['class' => 'object-center object-contain w-606 h-full relative z-10']) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
