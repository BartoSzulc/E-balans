@php
    $msit = get_field('msit');
@endphp

@if ($msit)
    <section class="msit-section mt-50 lg:mt-120">
        <div class="container mx-auto">
            <div
                class="relative flex items-center justify-between gap-20 py-32 overflow-hidden text-white pr-42 pl-72 msit-content bg-color-3 rounded-32 max-lg:flex-wrap">
                <div class="absolute right-238 top-32">
                    <svg class="w-622 h-539" viewBox="0 0 622 539" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="370.384" cy="93.7546" r="93.7546" data-aos="fade-up" data-aos-delay="200" fill="#5477AD" />
                        <circle cx="490.875" cy="206.403" r="130.829" data-aos="fade-up" data-aos-delay="400" fill="#BEC6D0" />
                        <circle cx="225.653" cy="313.347" r="225.653" data-aos="fade-up" data-aos-delay="600" fill="#B1BCCC" />
                    </svg>

                </div>
                <div class="flex flex-col">
                    @if ($msit['badge'])
                        <div class="msit-badge text-small" data-aos="fade-up" data-aos-delay="100">
                            {{ $msit['badge'] }}
                        </div>
                    @endif

                    @if ($msit['title'])
                        <h2 class="mt-24 msit-title text-h2" data-aos="fade-up" data-aos-delay="200">
                            {!! $msit['title'] !!}
                        </h2>
                    @endif
                </div>

                @if ($msit['image'])
                    <div class="relative z-10 msit-image" data-aos="fade-left" data-aos-delay="300">
                        <div class="relative z-10 bg-white px-75 py-45 rounded-32">
                            {!! wp_get_attachment_image($msit['image'], 'full', false, ['class' => 'object-fit']) !!}
                        </div>

                        @include('partials.decorative-circle', [
                            'size' => 'size-82',
                            'bg' => 'bg-color-4',
                            'position' => '-bottom-14 -left-65',
                            'animation' => 'zoom-in-up',
                            'delay' => 400
                        ])
                        @include('partials.decorative-circle', [
                            'size' => 'size-82',
                            'bg' => 'bg-color-4',
                            'position' => '-top-18 -right-34',
                            'animation' => 'zoom-in-left',
                            'delay' => 500
                        ])
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
