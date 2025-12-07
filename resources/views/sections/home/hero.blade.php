@php
  $hero = get_field('hero');
@endphp

@if($hero)
  <section class="hero-section">
    <div class="container mx-auto">
      <div class="hero-content">
        @if($hero['title'])
          <h1 class="hero-title text-h1">
            {!! $hero['title'] !!}
          </h1>
        @endif

        @if($hero['description'])
          <div class="hero-description text-body">
            {!! $hero['description'] !!}
          </div>
        @endif

        @if($hero['add_buttons'])
          <div class="hero-buttons">
            @foreach($hero['add_buttons'] as $button_item)
              @if($button_item['button'])
                <a
                  href="{{ $button_item['button']['url'] }}"
                  class="button"
                  @if($button_item['button']['target']) target="{{ $button_item['button']['target'] }}" @endif
                >
                  {{ $button_item['button']['title'] }}
                </a>
              @endif
            @endforeach
          </div>
        @endif

        @if($hero['hero_image'])
          <div class="hero-image">
            {!! wp_get_attachment_image($hero['hero_image'], 'full') !!}
          </div>
        @endif
      </div>
    </div>
  </section>
@endif
