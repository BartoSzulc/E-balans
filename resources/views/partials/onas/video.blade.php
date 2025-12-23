@php
    // Support both flexible content ($layout passed as $data) and standard fields
    $video = $data ?? ($layout ?? []);

@endphp

<section class="video-section lg:mt-120 mt-50">
    <div class="container mx-auto">
        @if (!empty($video['title']))
            <div class="text-center mb-30 lg:mb-64 section-title text-h2 text-color-3" data-aos="fade-up" data-aos-delay="100">
                {!! $video['title'] !!}
            </div>
        @endif


        <div class="relative mx-auto max-w-1198 video-wrapper h-674" data-aos="fade-up" data-aos-delay="200">

            <a href="{{ $video['video_url'] }}" class="glightbox video-link group" data-gallery="video-gallery">
                @if (!empty($video['poster']))
                    <div class="relative video-poster">
                        {!! wp_get_attachment_image($video['poster'], 'full', false, [
                            'class' => 'rounded-32 shadow-special w-full h-full object-center object-full relative z-10',
                        ]) !!}
                        <div class="absolute inset-0 z-20 flex items-center justify-center">
                            <svg class="transition-all duration-500 size-120 ease-power1-in group-hover:scale-120" viewBox="0 0 120 120" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="60" cy="60" r="60" fill="#E52F3D" />
                                <path
                                    d="M82.9401 56.6613C85.3361 58.2423 85.3361 61.7577 82.9401 63.3387L52.203 83.6199C49.5435 85.3747 46 83.4674 46 80.2812L46 39.7188C46 36.5326 49.5435 34.6253 52.203 36.3801L82.9401 56.6613Z"
                                    fill="white" />
                            </svg>


                        </div>
                        @include('partials.decorative-circle', [
                            'size' => 'size-146',
                            'bg' => 'bg-color-4',
                            'position' => '-top-32  -left-94',
                            'hiddenOnMobile' => false,
                            'animation' => 'zoom-in-up',
                            'delay' => 200,
                        ])
                        @include('partials.decorative-circle', [
                            'size' => 'size-146',
                            'bg' => 'bg-color-4',
                            'position' => 'bottom-32 -right-73',
                            'animation' => 'zoom-in-left',
                            'delay' => 400,
                        ])
                    </div>
                @else
                    <div class="flex items-center justify-center bg-gray-200 video-placeholder aspect-video">
                        <svg class="w-20 h-20 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </div>
                @endif
            </a>
        </div>
    </div>
</section>
