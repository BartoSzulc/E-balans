@php
  // Support both flexible content ($layout passed as $data) and standard fields
  $info = $data ?? $layout ?? [];
@endphp

<section class="relative info-section mt-50 lg:mt-120">
  <div class="container mx-auto">
    <div class="grid grid-cols-12 gap-16">
      <div class="flex flex-col justify-center col-span-full lg:col-span-4 lg:mr-48">
      @if(!empty($info['title']))
      <div class="text-h2 text-color-3" data-aos="fade-up" data-aos-delay="100">
        {!! $info['title'] !!}
      </div>
    @endif

    @if(!empty($info['description']))
      <div class="mt-24 text-body" data-aos="fade-up" data-aos-delay="200">
        {!! $info['description'] !!}
      </div>
    @endif
    </div>

      @if(!empty($info['add_columns']))
        <div class="lg:pt-75 lg:pb-50 bg-white columns-grid lg:col-span-8 col-span-full rounded-32 shadow-special-1 grid grid-cols-1 gap-16 lg:gap-151 lg:grid-cols-[repeat(2,_minmax(1.859375rem,1.859375rem))]" data-aos="fade-left" data-aos-delay="300">
          @foreach($info['add_columns'] as $index => $column)
            <div class="column-item {{ $index == 0 ? 'lg:ml-55' : '' }} flex flex-col  gap-16" data-aos="fade-up" data-aos-delay="{{ 400 + ($index * 100) }}">
              @if(!empty($column['icon']))
                <div class="flex items-center justify-center mb-4 rounded-full column-icon bg-color-2 size-72">
                  {!! wp_get_attachment_image($column['icon'], 'full', false, ['class' => 'size-32']) !!}
                </div>
              @endif

              @if(!empty($column['title']))
                <div class="column-title text-h3 text-color-3">
                  {!! $column['title'] !!}
                </div>
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
  </div>
</section>
