@php
  // Support both flexible content ($layout passed as $data) and standard fields
  $text_image = $data ?? $layout ?? [];
  $imageLeft = !empty($text_image['image_left']);
@endphp

<section class="relative text-image-section mt-50 lg:mt-120" >
  <div class="container mx-auto">
    <div class="grid grid-cols-12 gap-16 ">
      @if(!empty($text_image['image']))
        <div class="relative col-span-full lg:col-span-6 {{ $imageLeft ? 'lg:mr-73 ' : 'lg:ml-73 lg:order-last' }}" data-aos="{{ $imageLeft ? 'fade-right' : 'fade-left' }}" data-aos-delay="100">
          {!! wp_get_attachment_image($text_image['image'], 'full', false, ['class' => 'rounded-32 size-full object-center object-cover relative z-10 shadow-special']) !!}
          @include('partials.decorative-circle', [
            'size' => 'size-102',
            'bg' => 'bg-color-4',
            'position' => $imageLeft ? 'top-64 -right-72' : 'bottom-64 -left-72',
            'animation' => $imageLeft ? 'zoom-in-left' : 'zoom-in-up',
            'delay' => 300
          ])
        </div>
      @endif

      <div class="flex flex-col justify-center lg:col-span-6 col-span-full gap-16 {{ $imageLeft ? 'lg:ml-73' : 'lg:mr-73' }}">
        @if(!empty($text_image['title']))
          <div class="section-title text-color-3 text-h2" data-aos="fade-up" data-aos-delay="200">
            {!! $text_image['title'] !!}
          </div>
        @endif

        @if(!empty($text_image['description']))
          <div class="section-description text-body" data-aos="fade-up" data-aos-delay="300">
            {!! $text_image['description'] !!}
          </div>
        @endif
       @if($text_image['add_buttons'])
            <div class="flex flex-wrap gap-16 buttons" data-aos="fade-up" data-aos-delay="400">
              @foreach($text_image['add_buttons'] as $button_item)
                @if($button_item['button'])
                  @php
                    $btnClass = $loop->odd ? 'btn btn--primary' : 'btn btn--secondary';
                    acf_link($button_item['button'], $btnClass);
                  @endphp
                @endif
              @endforeach
            </div>
          @endif
      </div>
    </div>
  </div>
</section>
