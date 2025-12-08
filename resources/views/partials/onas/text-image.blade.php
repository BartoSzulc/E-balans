@php
  // Support both flexible content ($layout passed as $data) and standard fields
  $text_image = $data ?? $layout ?? [];
  $imageLeft = !empty($text_image['image_left']);
@endphp

<section class="text-image-section">
  <div class="container mx-auto">
    <div class="text-image-wrapper {{ $imageLeft ? 'image-left' : 'image-right' }}">
      @if(!empty($text_image['image']))
        <div class="text-image-image">
          {!! wp_get_attachment_image($text_image['image'], 'large') !!}
        </div>
      @endif

      <div class="text-image-content">
        @if(!empty($text_image['title']))
          <h2 class="section-title text-h2">
            {!! $text_image['title'] !!}
          </h2>
        @endif

        @if(!empty($text_image['description']))
          <div class="section-description text-body">
            {!! $text_image['description'] !!}
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
