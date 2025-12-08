@php
  // Support both flexible content ($layout passed as $data) and standard fields
  $cta = $data ?? $layout ?? [];
@endphp

<section class="cta-section">
  <div class="container mx-auto">
    <div class="cta-wrapper">
      <div class="cta-content">
        @if(!empty($cta['title']))
          <h2 class="cta-title text-h2">
            {!! $cta['title'] !!}
          </h2>
        @endif

        @if(!empty($cta['description']))
          <div class="cta-description text-body">
            {!! $cta['description'] !!}
          </div>
        @endif

        @if(!empty($cta['link']))
          <div class="cta-button">
            <a
              href="{{ $cta['link']['url'] }}"
              class="button"
              @if(!empty($cta['link']['target'])) target="{{ $cta['link']['target'] }}" @endif
            >
              {{ $cta['link']['title'] }}
            </a>
          </div>
        @endif
      </div>

      @if(!empty($cta['image']))
        <div class="cta-image">
          {!! wp_get_attachment_image($cta['image'], 'large') !!}
        </div>
      @endif
    </div>
  </div>
</section>
