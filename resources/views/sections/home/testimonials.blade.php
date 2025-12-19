@php
  $testimonials = get_field('testimonials');
  $selected_referencje = $testimonials['referencje'] ?? [];

  // If no referencje selected, load 3 latest
  if (empty($selected_referencje)) {
    $referencje_query = new WP_Query([
      'post_type' => 'referencje',
      'posts_per_page' => 3,
      'orderby' => 'date',
      'order' => 'DESC',
    ]);
    $referencje_posts = $referencje_query->posts;
    wp_reset_postdata();
  } else {
    $referencje_posts = array_map(fn($id) => get_post($id), $selected_referencje);
  }
@endphp

@if($testimonials && !empty($referencje_posts))
  <section class="testimonials-section mt-50 lg:mt-120">
    <div class="container">
      @if($testimonials['title'])
        <div class="section-title text-h2 mb-30 lg:mb-40 text-color-3">
          {!! $testimonials['title'] !!}
        </div>
      @endif

      @if($referencje_posts)
        <div class="grid grid-cols-1 gap-16 lg:grid-cols-3">
          @foreach($referencje_posts as $referencja)
            @php
              $excerpt = $referencja->post_excerpt;
              $content = $referencja->post_content;
              $has_content = !empty($content);
            @endphp

            <div class="testimonial-card bg-white rounded-32 shadow-special p-20 lg:pt-55 lg:pb-32 lg:px-32"
                 x-data="{ expanded: false }">
              {{-- Quote Icon --}}
              <div class="mb-16">
                <svg class="w-48 h-48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="24" cy="24" r="24" fill="#E52F3D"/>
                  <path d="M17 29V21C17 18.2386 19.2386 16 22 16H23C23.5523 16 24 16.4477 24 17C24 17.5523 23.5523 18 23 18H22C20.3431 18 19 19.3431 19 21V22H22C23.6569 22 25 23.3431 25 25V27C25 28.6569 23.6569 30 22 30H19C17.8954 30 17 29.1046 17 29ZM26 29V21C26 18.2386 28.2386 16 31 16H32C32.5523 16 33 16.4477 33 17C33 17.5523 32.5523 18 32 18H31C29.3431 18 28 19.3431 28 21V22H31C32.6569 22 34 23.3431 34 25V27C34 28.6569 32.6569 30 31 30H28C26.8954 30 26 29.1046 26 29Z" fill="white"/>
                </svg>
              </div>

              {{-- Title (Author Name) --}}
              @if($referencja->post_title)
                <h3 class="mb-16 text-h3 text-color-3">
                  {!! $referencja->post_title !!}
                </h3>
              @endif

              {{-- Excerpt --}}
              @if($excerpt)
                <div class="mb-16 testimonial-excerpt text-body">
                  {!! apply_filters('the_content', $excerpt) !!}
                </div>
              @endif

              {{-- Full Content (Expandable) --}}
              @if($has_content)
                <div x-show="expanded"
                     x-collapse
                     class="mb-16 testimonial-content text-body">
                  {!! apply_filters('the_content', $content) !!}
                </div>

                {{-- Rozwiń Button --}}
                <button @click="expanded = !expanded"
                        class="flex items-center space-x-8 transition-all duration-300 ease-in-out group hover:text-color-2">
                  <span x-text="expanded ? 'Zwiń' : 'Rozwiń'">Rozwiń</span>
                  <svg class="duration-300 size-24 transition-all ease-power1-in"
                       :class="expanded ? 'rotate-90' : 'group-hover:translate-x-2'"
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
        <div class="text-center section-button mt-30 lg:mt-40">
          @php
          acf_link($testimonials['button'], 'btn btn--primary');
          @endphp
        </div>
      @endif
    </div>
  </section>
@endif
