@php
    // Default values
    $size = $size ?? 'size-60';
    $color1 = $color1 ?? 'bg-color-5';
    $color2 = $color2 ?? 'bg-color-1';
    $position = $position ?? 'top-0 left-0';

    // Determine clip-path classes based on position
    $clipPaths = [
        'top-0 left-0' => [
            'clip1' => 'clip-top-left-1',
            'clip2' => 'clip-top-left-2',
        ],
        'top-0 right-0' => [
            'clip1' => 'clip-top-right-1',
            'clip2' => 'clip-top-right-2',
        ],
        'bottom-0 left-0' => [
            'clip1' => 'clip-bottom-left-1',
            'clip2' => 'clip-bottom-left-2',
        ],
        'bottom-0 right-0' => [
            'clip1' => 'clip-bottom-right-1',
            'clip2' => 'clip-bottom-right-2',
        ],
        '-top-1 -left-1' => [
            'clip1' => 'clip-top-left-1',
            'clip2' => 'clip-top-left-2',
        ],
        '-top-1 -right-1' => [
            'clip1' => 'clip-top-right-1',
            'clip2' => 'clip-top-right-2',
        ],
        '-bottom-1 -left-1' => [
            'clip1' => 'clip-bottom-left-1',
            'clip2' => 'clip-bottom-left-2',
        ],
        '-bottom-1 -right-1' => [
            'clip1' => 'clip-bottom-right-1',
            'clip2' => 'clip-bottom-right-2',
        ],
    ];

    // Get clip-path classes for current position, fallback to top-left
    $clips = $clipPaths[$position] ?? $clipPaths['top-0 left-0'];
@endphp

<div class="absolute {{ $position }} flex decoration-element {{ $size }}">
    <div class="absolute {{ $color1 }} size-full {{ $clips['clip1'] }}"></div>
    <div class="absolute {{ $color2 }} size-full {{ $clips['clip2'] }}"></div>
</div>
