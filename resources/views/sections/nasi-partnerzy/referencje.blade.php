@php
    $referencje = get_field('referencje');
    $title = $referencje['title'] ?? 'Referencje';
    $button_text = $referencje['button_text'] ?? 'Załaduj więcej';
@endphp

<section class="relative referencje-section mt-50 lg:mt-120 overflow-x-clip">
    @include('partials.decorative-circle', [
      'size' => 'size-82',
      'bg' => 'bg-color-4',
      'position' => 'top-38 -left-30',
      'animation' => 'zoom-in-right',
      'delay' => 200
    ])
    <div class="container mx-auto">
        {{-- Section Title --}}
        <div class="mb-48 section-title text-h2 lg:mb-76 text-color-3" data-aos="fade-up" data-aos-delay="100">
            {!! $title !!}
        </div>

        {{-- Loading State --}}
        <div class="py-40 text-center" data-loading-state>
            <p>Ładowanie...</p>
        </div>

        {{-- Referencje Grid --}}
        <div class="grid grid-cols-1 gap-16 gap-y-48 lg:gap-y-76 referencje-grid lg:grid-cols-3" data-referencje-container style="display: none;">
        </div>

        {{-- Load More Button --}}
        <div class="text-center mt-30 lg:mt-40" data-load-more-wrapper style="display: none;">
            <button
                class="btn btn--primary load-more-referencje"
                data-loaded="0"
                data-button-text="{{ $button_text }}"
            >
                {{ $button_text }}
            </button>
        </div>
    </div>
</section>
