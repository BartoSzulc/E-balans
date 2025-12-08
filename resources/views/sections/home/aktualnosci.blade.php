@php
  $aktualnosci = get_field('aktualnosci');
@endphp

@if($aktualnosci)
  <section class="aktualnosci-section">
    <div class="container mx-auto">
      @if($aktualnosci['title'])
        <h2 class="section-title text-h2">
          {!! $aktualnosci['title'] !!}
        </h2>
      @endif

      @if($aktualnosci['posts'])
        <div class="posts-grid">
          @foreach($aktualnosci['posts'] as $post_id)
            @php
              $post = get_post($post_id);
            @endphp
            <article class="post-card">
              @if(has_post_thumbnail($post_id))
                <div class="post-thumbnail">
                  {!! get_the_post_thumbnail($post_id, 'medium') !!}
                </div>
              @endif
              <h3 class="post-title text-h3">
                <a href="{{ get_permalink($post_id) }}">{{ get_the_title($post_id) }}</a>
              </h3>
              <div class="post-excerpt text-body">
                {{ get_the_excerpt($post_id) }}
              </div>
            </article>
          @endforeach
        </div>
      @endif

      @if($aktualnosci['button'])
        <div class="section-button">
          <a
            href="{{ $aktualnosci['button']['url'] }}"
            class="button"
            @if($aktualnosci['button']['target']) target="{{ $aktualnosci['button']['target'] }}" @endif
          >
            {{ $aktualnosci['button']['title'] }}
          </a>
        </div>
      @endif
    </div>
  </section>
@endif
