@php
  // Support both flexible content ($layout passed as $data) and standard fields
  $video = $data ?? $layout ?? [];

  // Extract video ID from YouTube or Vimeo URL
  $videoId = null;
  $videoType = null;

  if (!empty($video['video_url'])) {
    $url = $video['video_url'];

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
    @if(!empty($video['title']))
      <h2 class="section-title text-h2">
        {!! $video['title'] !!}
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
    @elseif(!empty($video['poster']))
      <div class="video-poster">
        {!! wp_get_attachment_image($video['poster'], 'large') !!}
      </div>
    @endif
  </div>
</section>
