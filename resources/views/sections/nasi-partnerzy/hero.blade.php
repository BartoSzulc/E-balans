@php
    $hero = get_field('hero');
    $title = $hero['title'] ?? '';
    $partner_logos = $hero['partner_logos'] ?? [];
@endphp

<section class="relative z-10 pt-40 page-header">
    <div class="container relative z-10">
        <div class="space-y-24 text-center">
            {{-- Breadcrumbs --}}
            @php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs" class="">', '</p>');
                }
            @endphp

            {{-- Title --}}
            @if ($title)
                <div class="text-h1 max-lg:text-h2 text-color-3" data-aos="fade-up" data-aos-delay="100">
                    {!! $title !!}
                </div>
            @else
                <h1 class="text-h1 max-lg:text-h2 text-color-3" data-aos="fade-up" data-aos-delay="100">
                    {{ get_the_title() }}
                </h1>
            @endif

            {{-- Partner Logos Grid --}}
            @if (!empty($partner_logos))
                <div class="relative mt-16">
                    {{-- @include('partials.decorative-circle', [
                        'size' => 'size-82',
                        'bg' => 'bg-color-4',
                        'position' => 'top-0 -left-17',
                        'hiddenOnMobile' => false,
                        'animation' => 'zoom-in-up',
                        'delay' => 200,
                    ])
                    @include('partials.decorative-circle', [
                        'size' => 'size-143',
                        'bg' => 'bg-color-4',
                        'position' => 'top-50 -right-62',
                        'hiddenOnMobile' => false,
                        'animation' => 'zoom-in-left',
                        'delay' => 400,
                    ]) --}}

                    <div class="relative z-10 mx-auto w-fit partners-grid grid grid-cols-[3.69791667rem_1.791666667rem] grid-rows-2 gap-19" data-aos="fade-up" data-aos-delay="300">
                        @foreach ($partner_logos as $index => $partner)
                            @if ($partner['image'])
                                <div class="bg-white shadow-special rounded-16 partner-logo flex items-center justify-center {{ $index === 0 ? 'row-span-2 lg:py-50 lg:px-75 p-20' : 'max-lg:p-20' }} {{ $index === 1 ? 'lg:py-20 lg:px-57' : '' }} {{ $index === 2 ? 'lg:py-43 lg:px-63' : '' }}" data-aos="fade-up" data-aos-delay="{{ 400 + ($index * 100) }}">
                                    {!! wp_get_attachment_image($partner['image'], 'full', false, ['class' => 'w-auto h-auto object-fit']) !!}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
