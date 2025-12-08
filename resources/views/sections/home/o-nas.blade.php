@php
  $o_nas = get_field('o_nas');
@endphp

@if($o_nas)
  <section class="o-nas-section">
    <div class="container mx-auto">
      @if($o_nas['images'])
        <div class="images-gallery">
          @foreach($o_nas['images'] as $image_item)
            @if($image_item['image'])
              <div class="gallery-item">
                {!! wp_get_attachment_image($image_item['image'], 'medium') !!}
              </div>
            @endif
          @endforeach
        </div>
      @endif

      <div class="o-nas-content">
        @if($o_nas['title'])
          <h2 class="section-title text-h2">
            {!! $o_nas['title'] !!}
          </h2>
        @endif

        @if($o_nas['description'])
          <div class="section-description text-body">
            {!! $o_nas['description'] !!}
          </div>
        @endif

        @if($o_nas['button'])
          <div class="section-button">
            <a
              href="{{ $o_nas['button']['url'] }}"
              class="button"
              @if($o_nas['button']['target']) target="{{ $o_nas['button']['target'] }}" @endif
            >
              {{ $o_nas['button']['title'] }}
            </a>
          </div>
        @endif

        @if($o_nas['add_services'])
          <div class="services-grid">
            @foreach($o_nas['add_services'] as $service)
              <div class="service-item">
                @if($service['image'])
                  <div class="service-icon">
                    {!! wp_get_attachment_image($service['image'], 'thumbnail') !!}
                  </div>
                @endif
                @if($service['text'])
                  <div class="service-text text-body">
                    {!! $service['text'] !!}
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </section>
@endif
