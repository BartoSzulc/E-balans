@php
  $partnerzy = get_field('partnerzy');
@endphp

@if($partnerzy && $partnerzy['add_image'])
  <section class="partnerzy-section">
    <div class="container mx-auto">
      <div class="partners-grid">
        @foreach($partnerzy['add_image'] as $partner)
          @if($partner['image'])
            <div class="partner-logo">
              {!! wp_get_attachment_image($partner['image'], 'medium') !!}
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </section>
@endif
