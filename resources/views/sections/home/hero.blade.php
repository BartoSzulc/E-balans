@php
  $hero = get_field('hero');
@endphp

@if($hero)
  <section class="relative overflow-hidden hero-section mt-33">
    @include('partials.decorative-circle', [
              'size' => 'size-82',
              'bg' => 'bg-color-4',
              'position' => 'top-1/2 -translate-y-1/2 -left-35'
              
            ])
    <div class="container">
      <div class="grid grid-cols-12 gap-16 gap-y-24">
      <div class="relative z-10 flex flex-col justify-center col-span-full lg:col-span-4 lg:mr-30">
          @if($hero['title'])
            <div class="hero-title text-h1 text-color-3">
              {!! $hero['title'] !!}
            </div>
          @endif

          @if($hero['description'])
            <div class="mt-24 lg:mt-40 hero-description text-body">
              {!! $hero['description'] !!}
          </div>
          @endif

          @if($hero['add_buttons'])
            <div class="flex flex-wrap gap-16 mt-24 hero-buttons">
              @foreach($hero['add_buttons'] as $button_item)
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

        @if($hero['hero_image'])
          <div class="relative hero-image col-span-full lg:col-span-8 lg:min-h-650 rounded-32 shadow-special">
            @include('partials.decorative-circle', [
              'size' => 'size-50 lg:size-143',
              'bg' => 'bg-color-4',
              'position' => 'top-22 -left-95',
              'hiddenOnMobile' => false
            ])
             @include('partials.decorative-circle', [
              'size' => 'size-50',
              'bg' => 'bg-color-4',
              'position' => 'top-184 -left-25'
              
            ])
            {!! wp_get_attachment_image($hero['hero_image'], 'full', false, [
                'class' => 'object-cover object-center size-full rounded-32 relative z-10',
                'alt' => '',
                'role' => 'presentation',
            ]) !!}
          </div>
        @endif
      </div>
    </div>
  </section>
@endif
