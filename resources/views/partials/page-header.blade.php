@php
    $hero = get_field('hero');
    $title = $hero['title'];
@endphp


<section class="relative z-10 pt-40 page-header">
    <div class="container relative z-10">
        <div class="space-y-24 text-center">
            @php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs" class="">', '</p>');
                }
            @endphp
            @if ($hero)
                @if ($title)
                    <div class="text-h1 max-lg:text-h2 text-color-3">
                        {!! $title !!}
                    </div>
                @else
                    <h1 class="text-h1 max-lg:text-h2 text-color-3">
                        {{ get_the_title() }}
                    </h1>
                @endif
            @endif
            <div class="relative h-360 mt-36">
                @include('partials.decorative-circle', [
                    'size' => 'size-82 ',
                    'bg' => 'bg-color-4',
                    'position' => '-bottom-41 -left-17',
                    'hiddenOnMobile' => false,
                    'delay' => 100,
                    'animation' => 'zoom-in-up',
                ])
                @include('partials.decorative-circle', [
                    'size' => 'size-143',
                    'bg' => 'bg-color-4',
                    'position' => '-top-72 -right-62',
                    'hiddenOnMobile' => false,
                    'delay' => 300,
                    'animation' => 'zoom-in-left',
                ])

                {!! wp_get_attachment_image($hero['hero_image'], 'full', false, [
                    'class' => 'object-cover object-center size-full rounded-32 relative z-10 shadow-special',
                    'role' => 'presentation',
                ]) !!}
            </div>
        </div>
    </div>
</section>
