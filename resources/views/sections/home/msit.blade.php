@php
  $msit = get_field('msit');
@endphp

@if($msit)
  <section class="msit-section">
    <div class="container mx-auto">
      <div class="msit-content">
        @if($msit['badge'])
          <div class="msit-badge text-small">
            {{ $msit['badge'] }}
          </div>
        @endif

        @if($msit['title'])
          <h2 class="msit-title text-h2">
            {!! $msit['title'] !!}
          </h2>
        @endif

        @if($msit['image'])
          <div class="msit-image">
            {!! wp_get_attachment_image($msit['image'], 'large') !!}
          </div>
        @endif
      </div>
    </div>
  </section>
@endif
