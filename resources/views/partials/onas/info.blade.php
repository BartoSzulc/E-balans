@php
  $layout = $layout ?? [];
@endphp

<section class="info-section">
  <div class="container mx-auto">
    @if(!empty($layout['title']))
      <h2 class="section-title text-h2">
        {!! $layout['title'] !!}
      </h2>
    @endif

    @if(!empty($layout['description']))
      <div class="section-description text-body">
        {!! $layout['description'] !!}
      </div>
    @endif

    @if(!empty($layout['add_columns']))
      <div class="columns-grid">
        @foreach($layout['add_columns'] as $column)
          <div class="column-item">
            @if(!empty($column['icon']))
              <div class="column-icon">
                {!! wp_get_attachment_image($column['icon'], 'thumbnail') !!}
              </div>
            @endif

            @if(!empty($column['title']))
              <h3 class="column-title text-h4">
                {{ $column['title'] }}
              </h3>
            @endif

            @if(!empty($column['description']))
              <div class="column-description text-body">
                {!! $column['description'] !!}
              </div>
            @endif
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
