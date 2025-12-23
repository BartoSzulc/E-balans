@php
  $testimonials = get_field('testimonials');
  $selected_opinie = $testimonials['opinie'] ?? [];

  // If no opinie selected, load 3 latest
  if (empty($selected_opinie)) {
    $opinie_query = new WP_Query([
      'post_type' => 'opinie',
      'posts_per_page' => 3,
      'orderby' => 'date',
      'order' => 'DESC',
    ]);
    $opinie_posts = $opinie_query->posts;
    wp_reset_postdata();
  } else {
    $opinie_posts = array_map(fn($id) => get_post($id), $selected_opinie);
  }
@endphp

@if($testimonials && !empty($opinie_posts))
  <section class="relative overflow-x-clip testimonials-section mt-50 lg:mt-120">
    @include('partials.decorative-circle', [
      'size' => 'size-82',
      'bg' => 'bg-color-4',
      'position' => 'top-38 -left-30',
      'animation' => 'zoom-in-right',
      'delay' => 200
    ])
    <div class="container">
      @if($testimonials['title'])
        <div class="relative z-10 mb-48 section-title text-h2 lg:mb-76 text-color-3" data-aos="fade-up" data-aos-delay="100">
          {!! $testimonials['title'] !!}
        </div>
      @endif

      @if($opinie_posts)
        <div class="relative grid grid-cols-1 gap-16 gap-y-48 lg:grid-cols-3">
          @if (is_front_page())
            @include('partials.decorative-circle', [
              'size' => 'size-82',
              'bg' => 'bg-color-4',
              'position' => '-bottom-26 -right-41',
              'animation' => 'zoom-in-left',
              'delay' => 500
            ])
          @endif
          @foreach($opinie_posts as $opinia)
            @php
              $excerpt = $opinia->post_excerpt;
              $content = $opinia->post_content;
              $has_content = !empty($content);
            @endphp

            <div class="relative z-10 p-20 bg-white pt-38 testimonial-card rounded-32 shadow-special lg:pt-55 lg:pb-32 lg:px-32"
                 x-data="{ expanded: false }" data-aos="fade-up" data-aos-delay="{{ 200 + ($loop->index * 100) }}">
              {{-- Quote Icon --}}
              <div class="absolute top-0 -translate-y-1/2 left-20 lg:left-32 size-36 lg:size-72">

 <svg class="size-full" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="36" cy="36" r="36" fill="#E52F3D"/>
            <path d="M29.292 25.386C29.7167 24.8307 30.1577 24.5203 30.615 24.455C31.105 24.3897 31.5133 24.4877 31.84 24.749C32.1993 24.9777 32.3953 25.337 32.428 25.827C32.4933 26.2843 32.2973 26.7907 31.84 27.346C31.1867 28.1627 30.7293 28.9793 30.468 29.796C30.2393 30.6127 30.125 31.3477 30.125 32.001L29.929 30.384C31.0723 30.384 31.987 30.7107 32.673 31.364C33.3917 32.0173 33.751 32.8993 33.751 34.01C33.751 35.0553 33.4243 35.921 32.771 36.607C32.1177 37.2603 31.2357 37.587 30.125 37.587C28.9817 37.587 28.0833 37.195 27.43 36.411C26.7767 35.627 26.45 34.5327 26.45 33.128C26.45 32.344 26.5153 31.5437 26.646 30.727C26.8093 29.8777 27.1033 29.012 27.528 28.13C27.9527 27.248 28.5407 26.3333 29.292 25.386ZM38.847 25.386C39.2717 24.8307 39.7127 24.5203 40.17 24.455C40.66 24.3897 41.0683 24.4877 41.395 24.749C41.7543 24.9777 41.9503 25.337 41.983 25.827C42.0483 26.2843 41.8523 26.7907 41.395 27.346C40.7417 28.1627 40.2843 28.9793 40.023 29.796C39.7943 30.6127 39.68 31.3477 39.68 32.001L39.484 30.384C40.6273 30.384 41.542 30.7107 42.228 31.364C42.9467 32.0173 43.306 32.8993 43.306 34.01C43.306 35.0553 42.9793 35.921 42.326 36.607C41.6727 37.2603 40.7907 37.587 39.68 37.587C38.5367 37.587 37.6383 37.195 36.985 36.411C36.3317 35.627 36.005 34.5327 36.005 33.128C36.005 32.344 36.0703 31.5437 36.201 30.727C36.3643 29.8777 36.6583 29.012 37.083 28.13C37.5077 27.248 38.0957 26.3333 38.847 25.386Z" fill="white"/>
            </svg>

              </div>

              {{-- Title (Author Name) --}}
              @if($opinia->post_title)
                <h3 class="mb-16 text-h3 text-color-3">
                  {!! $opinia->post_title !!}
                </h3>
              @endif

              {{-- Excerpt --}}
              @if($excerpt)
                <div class="@if($has_content) mb-16 @endif testimonial-excerpt text-body">
                  {!! apply_filters('the_content', $excerpt) !!}
                </div>
              @endif

              {{-- Full Content (Expandable) --}}
              @if($has_content)
                <div x-ref="content"
                     x-show="expanded"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform -translate-y-4 max-h-0"
                     x-transition:enter-end="opacity-100 transform translate-y-0 max-h-[2000px]"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-y-0 max-h-[2000px]"
                     x-transition:leave-end="opacity-0 transform -translate-y-4 max-h-0"
                     class="overflow-hidden testimonial-content text-body">
                  {!! apply_filters('the_content', $content) !!}
                </div>

                {{-- Rozwiń Button --}}
                <button @click="expanded = !expanded"
                        class="flex items-center mt-16 space-x-8 transition-all duration-300 ease-in-out cursor-pointer group hover:text-color-2">
                  <span x-text="expanded ? 'Zwiń' : 'Rozwiń'">Rozwiń</span>
                  <svg class="transition-all duration-300 size-24 ease-power1-in"
                       :class="expanded ? '-rotate-90' : 'group-hover:translate-x-2'"
                       viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="#E52F3D" />
                    <path
                      d="M16.5 11.134C17.1667 11.5189 17.1667 12.4811 16.5 12.866L10.5 16.3301C9.83333 16.715 9 16.2339 9 15.4641L9 8.5359C9 7.7661 9.83333 7.28497 10.5 7.66987L16.5 11.134Z"
                      fill="white" />
                  </svg>
                </button>
              @endif
            </div>
          @endforeach
        </div>
      @endif

      @if($testimonials['button'])
        <div class="text-center section-button mt-30 lg:mt-40" data-aos="fade-up" data-aos-delay="600">
          @php
          acf_link($testimonials['button'], 'btn btn--primary');
          @endphp
        </div>
      @endif
    </div>
  </section>
@endif
