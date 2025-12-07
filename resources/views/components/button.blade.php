@props([
    'variant' => 'primary', // primary, secondary, accent, outline
    'border' => 'dashed', // dashed, solid
    'size' => 'medium', // small, medium, large
    'icon' => null,
    'iconPosition' => 'right', // left, right
    'href' => null,
    'type' => 'button',
])

@php
    // Variant styles
    $variants = [
        'primary' => 'border-color-1 text-color-1 hover:bg-color-1 hover:text-white',
        'secondary' => 'border-color-2 text-color-2 hover:bg-color-2 hover:text-white',
        'accent' => 'border-color-3 text-color-3 hover:bg-color-3 hover:text-color-1',
        'outline' => 'border-color-1 text-color-1 bg-transparent hover:bg-color-1 hover:text-white',
    ];

    // Size styles
    $sizes = [
        'small' => 'px-24 py-12 text-menu-stopka',
        'medium' => 'px-40 py-20 text-button',
        'large' => 'px-60 py-24 text-h5',
    ];

    // Border styles
    $borderStyle = $border === 'dashed' ? 'border-dashed' : 'border-solid';

    // Combine classes
    $classes = sprintf(
        'flex items-center gap-16 border-1 %s %s %s font-semibold transition-all duration-300 hover:border-solid active:scale-95 focus:outline-none focus:ring-2 focus:ring-offset-2',
        $borderStyle,
        $variants[$variant] ?? $variants['primary'],
        $sizes[$size] ?? $sizes['medium']
    );

    // Merge with additional classes from $attributes
    $classes = $attributes->merge(['class' => $classes])->get('class');
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'left')
            {!! $icon !!}
        @endif
        <span>{{ $slot }}</span>
        @if($icon && $iconPosition === 'right')
            {!! $icon !!}
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon && $iconPosition === 'left')
            {!! $icon !!}
        @endif
        <span>{{ $slot }}</span>
        @if($icon && $iconPosition === 'right')
            {!! $icon !!}
        @endif
    </button>
@endif
