@php
    $hero = get_field('hero');
    $subtitle = $hero['subtitle'] ?? null;
    $title = $hero['title'] ?? null;
@endphp


<section class="relative z-10 page-header pb-60 pt-110">
    <div class="absolute inset-0 bottom-0 z-0 bg-color-2"></div>
    <div class="container relative z-10">
        <div class="gap-24 grid-grid-cols-12">
            @if ($hero)
                @if ($subtitle)
                    <div class="mb-20 font-extrabold text-h3 lg:mb-25">
                        {!! $subtitle !!}
                    </div>
                @endif
                @if ($title)
                    <h1 class="font-extrabold text-h1 lg:text-h2">
                        {!! $title !!}
                    </h1>
                @endif
            @endif
            @php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs" class="lg:mt-80">','</p>' );
            }
            @endphp 
        </div>
    </div>
</section>