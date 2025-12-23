@php
/*

  Template Name: Aktualnosci

*/
@endphp

@extends('layouts.app')

@section('content')
  <section class="aktualnosci-archive ">
    <div class="container mx-auto">
      <h1 class="mb-40 text-h1 lg:mb-60">Aktualności</h1>

      @php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = [
          'post_type' => 'post',
          'post_status' => 'publish',
          'posts_per_page' => 9,
          'paged' => $paged,
          'orderby' => 'date',
          'order' => 'DESC'
        ];
        $posts_query = new WP_Query($args);
      @endphp

      @if($posts_query->have_posts())
        <div class="grid grid-cols-1 gap-16 posts-grid lg:grid-cols-3">
          @while($posts_query->have_posts())
            @php($posts_query->the_post())
            @include('partials.post-card')
          @endwhile
        </div>

        @if($posts_query->max_num_pages > 1)
          <div class="mt-40 pagination lg:mt-60">
            {!! paginate_links([
              'total' => $posts_query->max_num_pages,
              'current' => $paged,
              'prev_text' => '&larr; Poprzednie',
              'next_text' => 'Następne &rarr;',
            ]) !!}
          </div>
        @endif

        @php(wp_reset_postdata())
      @else
        <p>Brak artykułów do wyświetlenia.</p>
      @endif
    </div>
  </section>
@endsection
