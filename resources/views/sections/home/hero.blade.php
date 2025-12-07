@php
    $hero = get_field('hero');
@endphp

{{-- Hero Section --}}
{{-- Field: title - {!! $hero['title'] ?? 'not set' !!} --}}
{{-- Field: description - {!! $hero['description'] ?? 'not set' !!} --}}
{{-- Field: add_button repeater - {{ isset($hero['add_button']) ? count($hero['add_button']) . ' buttons' : 'not set' }} --}}
@if (isset($hero['add_button']) && is_array($hero['add_button']))
    {{-- @foreach ($hero['add_button'] as $button) --}}
    {{-- Button: {{ $button['link']['title'] ?? 'not set' }} | URL: {{ $button['link']['url'] ?? 'not set' }} --}}
    <div class="relative w-full hero h-952 bg-color-1 text-color-5">
        
        <div class="container relative flex items-center h-full">
            <div class="absolute bottom-0 flex items-center justify-center bg-white left-24 w-148 h-110">
                <svg class="size-44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23.8307 2.2915H20.1641C13.3441 2.2915 7.78906 7.8465 7.78906 14.6665V29.3332C7.78906 36.1532 13.3441 41.7082 20.1641 41.7082H23.8307C30.6507 41.7082 36.2057 36.1532 36.2057 29.3332V14.6665C36.2057 7.8465 30.6507 2.2915 23.8307 2.2915ZM33.4557 29.3332C33.4557 34.6315 29.1291 38.9582 23.8307 38.9582H20.1641C14.8657 38.9582 10.5391 34.6315 10.5391 29.3332V14.6665C10.5391 9.36817 14.8657 5.0415 20.1641 5.0415H23.8307C29.1291 5.0415 33.4557 9.36817 33.4557 14.6665V29.3332ZM28.4691 24.6948C29.0007 25.2265 29.0007 26.1065 28.4691 26.6382L22.9691 32.1382C22.6941 32.4132 22.3457 32.5415 21.9974 32.5415C21.6491 32.5415 21.3007 32.4132 21.0257 32.1382L15.5257 26.6382C14.9941 26.1065 14.9941 25.2265 15.5257 24.6948C16.0574 24.1632 16.9374 24.1632 17.4691 24.6948L20.6224 27.8482V12.8332C20.6224 12.0815 21.2457 11.4582 21.9974 11.4582C22.7491 11.4582 23.3724 12.0815 23.3724 12.8332V27.8482L26.5257 24.6948C27.0574 24.1632 27.9374 24.1632 28.4691 24.6948Z" fill="#66B0C0"/>
                </svg>
            </div>
            <div class="grid grid-cols-12 gap-20">
                <div class="col-span-full lg:col-span-4">
                    <div class="flex flex-col gap-30 lg:gap-80">
                        <div class="text-h2 lg:text-h1">
                            {!! $hero['title'] ?? '' !!}
                        </div>
                        <div class="text-h5 ">
                            {!! $hero['description'] ?? '' !!}
                        </div>
                        <div class="flex items-center gap-20 max-lg:flex-col max-lg:justify-center max-md">
                            @foreach ($hero['add_button'] as $index => $button)
                                <div class="inline-flex">
                                    <a href="{{ $button['link']['url'] ?? '#' }}" class="btn {{ $index === 0 ? 'btn--primary' : 'btn--secondary' }}">
                                        {{ $button['link']['title'] ?? 'Learn More' }}
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="relative col-span-full lg:col-span-8">
                    @if (!empty($hero['animated']) && $hero['animated'] && isset($hero['animated_images']) && is_array($hero['animated_images']))
                    <div class="flex items-center justify-center w-full mx-auto lg:absolute lg:h-662 lg:py-92">
                        @foreach ($hero['animated_images'] as $index => $image)
                            <div class="relative h-478 w-448 transition-opacity duration-1000 ease-in-out {{ $index === 1 ? '-ml-56 -mr-50' : '' }}" data-hero-slide>
                                {!! wp_get_attachment_image($image, 'full', false, ['class' => 'size-fit']) !!}
                            </div>
                        @endforeach
                    @endif        
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endforeach --}}
@endif
{{-- Field: animated - {{ $hero['animated'] ?? 'not set' }} --}}
{{-- Field: animated_images - {{ isset($hero['animated_images']) ? count($hero['animated_images']) . ' images' : 'not set' }} --}}
