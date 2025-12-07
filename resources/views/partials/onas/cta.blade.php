@php
  $layout = $layout ?? [];
@endphp

<section class="cta-section">
  <div class="container mx-auto">
    <div class="cta-wrapper">
      <div class="cta-content">
        @if(!empty($layout['title']))
          <h2 class="cta-title text-h2">
            {!! $layout['title'] !!}
          </h2>
        @endif

        @if(!empty($layout['description']))
          <div class="cta-description text-body">
            {!! $layout['description'] !!}
          </div>
        @endif

        @if(!empty($layout['link']))
          <div class="cta-button">
            <a
              href="{{ $layout['link']['url'] }}"
              class="button"
              @if(!empty($layout['link']['target'])) target="{{ $layout['link']['target'] }}" @endif
            >
              {{ $layout['link']['title'] }}
            </a>
          </div>
        @endif
      </div>

      @if(!empty($layout['image']))
        <div class="cta-image">
          {!! wp_get_attachment_image($layout['image'], 'large') !!}
        </div>
      @endif
    </div>
  </div>
</section>
