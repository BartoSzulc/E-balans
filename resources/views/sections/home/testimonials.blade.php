@php
  $testimonials = get_field('testimonials');
@endphp

@if($testimonials && $testimonials['add_testimonial'])
  <section class="testimonials-section">
    <div class="container mx-auto">
      <div class="testimonials-wrapper">
        @foreach($testimonials['add_testimonial'] as $testimonial)
          <div class="testimonial-item">
            @if($testimonial['description'])
              <div class="testimonial-description text-quote">
                {!! $testimonial['description'] !!}
              </div>
            @endif
            @if($testimonial['author'])
              <div class="testimonial-author text-body">
                {!! $testimonial['author'] !!}
              </div>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endif
