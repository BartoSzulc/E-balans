@php
  $aktualnosci = get_field('aktualnosci');

  // If no posts selected in relationship field, query latest posts
  $posts_to_display = $aktualnosci['posts'] ?? [];
  if (empty($posts_to_display)) {
    $latest_posts = get_posts([
      'numberposts' => 3,
      'post_status' => 'publish',
      'orderby' => 'date',
      'order' => 'DESC'
    ]);
    $posts_to_display = array_map(fn($post) => $post->ID, $latest_posts);
  }

  // Use ACF title if available, otherwise use default
  $section_title = $aktualnosci['title'] ?? 'Aktualności';
@endphp

@if($aktualnosci || $posts_to_display)
  <section class="aktualnosci-section mt-50 lg:mt-120 overflow-x-clip">
    <div class="container">
      <div class="lg:text-center section-title text-h2 mb-30 lg:mb-40 text-color-3">
        {!! $section_title !!}
      </div>

      @if($posts_to_display)
        <div class="relative grid grid-cols-1 gap-16 posts-grid lg:grid-cols-3">
           @include('partials.decorative-circle', [
              'size' => 'size-143',
              'bg' => 'bg-color-4',
              'position' => '-top-49 -right-63'
              
            ])
             @include('partials.decorative-circle', [
              'size' => 'size-143',
              'bg' => 'bg-color-4',
              'position' => 'bottom-58 -left-58'
              
            ])
          @foreach($posts_to_display as $post_id)
            @include('partials.post-card', ['post_id' => $post_id])
          @endforeach
        </div>
      @endif

      @if($aktualnosci['button'])
        <div class="text-center section-button mt-30 lg:mt-40">
          @php
          acf_link($aktualnosci['button'], 'btn btn--primary');
          @endphp
        </div>
      @endif
    </div>
  </section>
@endif
