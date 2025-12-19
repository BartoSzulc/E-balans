{{--
  Decorative Circle Component

  A reusable decorative circle element for backgrounds and visual effects.

  Usage:
    @include('partials.decorative-circle', [
      'size' => 'size-143',           // Tailwind size class (e.g., size-143, w-100 h-100)
      'bg' => 'bg-color-4',           // Background color class
      'position' => 'top-22 -right-70' // Position classes (top, left, right, bottom, etc.)
    ])

  All parameters are optional and have defaults.
--}}

@php
  $size = $size ?? 'size-100';
  $bg = $bg ?? 'bg-color-4';
  $position = $position ?? '';
  $hiddenOnMobile = $hiddenOnMobile ?? true;
@endphp

<div class="z-1 absolute rounded-full {{ $bg }} {{ $size }} {{ $position }} @if($hiddenOnMobile) hidden lg:block @endif"></div>
