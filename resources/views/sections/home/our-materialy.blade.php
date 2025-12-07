@php
  $our_materialy = get_field('our_materialy');
@endphp

@if($our_materialy && $our_materialy['add_material'])
  <section class="our-materialy-section">
    <div class="container mx-auto">
      <div class="materials-grid">
        @foreach($our_materialy['add_material'] as $material)
          <div class="material-item">
            @if($material['image'])
              <div class="material-image">
                {!! wp_get_attachment_image($material['image'], 'medium') !!}
              </div>
            @endif

            @if($material['title'])
              <h3 class="material-title text-h3">
                {{ $material['title'] }}
              </h3>
            @endif

            @if($material['description'])
              <div class="material-description text-body">
                {!! $material['description'] !!}
              </div>
            @endif

            @if($material['button'])
              <div class="material-button">
                <a
                  href="{{ $material['button']['url'] }}"
                  class="button"
                  @if($material['button']['target']) target="{{ $material['button']['target'] }}" @endif
                >
                  {{ $material['button']['title'] }}
                </a>
              </div>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endif
