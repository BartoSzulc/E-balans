@php
  $layout = $layout ?? [];

  // Extract video ID from YouTube or Vimeo URL
  $videoId = null;
  $videoType = null;

  if (!empty($layout['video_url'])) {
    $url = $layout['video_url'];

    // YouTube
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $matches)) {
      $videoId = $matches[1];
      $videoType = 'youtube';
    } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $matches)) {
      $videoId = $matches[1];
      $videoType = 'youtube';
    }
    // Vimeo
    elseif (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
      $videoId = $matches[1];
      $videoType = 'vimeo';
    }
  }
@endphp

<section class="video-section">
  <div class="container mx-auto">
    @if(!empty($layout['title']))
      <h2 class="section-title text-h2">
        {!! $layout['title'] !!}
      </h2>
    @endif

    @if($videoId && $videoType)
      <div class="video-wrapper">
        @if($videoType === 'youtube')
          <iframe
            src="https://www.youtube.com/embed/{{ $videoId }}"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            class="video-iframe"
          ></iframe>
        @elseif($videoType === 'vimeo')
          <iframe
            src="https://player.vimeo.com/video/{{ $videoId }}"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
            allowfullscreen
            class="video-iframe"
          ></iframe>
        @endif
      </div>
    @elseif(!empty($layout['poster']))
      <div class="video-poster">
        {!! wp_get_attachment_image($layout['poster'], 'large') !!}
      </div>
    @endif
  </div>
</section>
