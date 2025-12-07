@php
  // Accept field name as parameter, default to 'how_it_works'
  $field_name = $field_name ?? 'how_it_works';
  $how_it_works = get_field($field_name);
@endphp

@if($how_it_works)
  <section class="how-it-works-section">
    <div class="container mx-auto">
      @if($how_it_works['title'])
        <h2 class="section-title text-h2">
          {!! $how_it_works['title'] !!}
        </h2>
      @endif

      @if($how_it_works['add_how_it_works'])
        <div class="steps-grid">
          @foreach($how_it_works['add_how_it_works'] as $index => $step)
            <div class="step-item">
              <div class="step-number text-h3">{{ $index + 1 }}</div>

              @if($step['image'])
                <div class="step-image">
                  {!! wp_get_attachment_image($step['image'], 'medium') !!}
                </div>
              @endif

              @if($step['title'])
                <h3 class="step-title text-h4">
                  {{ $step['title'] }}
                </h3>
              @endif

              @if($step['description'])
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
@endif
