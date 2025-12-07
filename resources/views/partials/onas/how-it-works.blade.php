@php
  $layout = $layout ?? [];
@endphp

<section class="how-it-works-section">
  <div class="container mx-auto">
    @if(!empty($layout['title']))
      <h2 class="section-title text-h2">
        {!! $layout['title'] !!}
      </h2>
    @endif

    @if(!empty($layout['add_how_it_works']))
      <div class="steps-grid">
        @foreach($layout['add_how_it_works'] as $index => $step)
          <div class="step-item">
            <div class="step-number text-h3">{{ $index + 1 }}</div>

            @if(!empty($step['image']))
              <div class="step-image">
                {!! wp_get_attachment_image($step['image'], 'medium') !!}
              </div>
            @endif

            @if(!empty($step['title']))
              <h3 class="step-title text-h4">
                {{ $step['title'] }}
              </h3>
            @endif

            @if(!empty($step['description']))
              <div class="step-description text-body">
                {!! $step['description'] !!}
              </div>
            @endif
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
