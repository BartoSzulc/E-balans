@php
  $layout = $layout ?? [];
  $imageLeft = !empty($layout['image_left']);
@endphp

<section class="text-image-section">
  <div class="container mx-auto">
    <div class="text-image-wrapper {{ $imageLeft ? 'image-left' : 'image-right' }}">
      @if(!empty($layout['image']))
        <div class="text-image-image">
          {!! wp_get_attachment_image($layout['image'], 'large') !!}
        </div>
      @endif

      <div class="text-image-content">
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
      </div>
    </div>
  </div>
</section>
