@php
    $standardy = get_field('standardy');
@endphp

{{-- Standardy Section --}}
{{-- Field: title - {!! $standardy['title'] ?? 'not set' !!} --}}
{{-- Field: wysiwyg - {!! $standardy['wysiwyg'] ?? 'not set' !!} --}}
{{-- Field: background_image - {{ $standardy['background_image'] ?? 'not set' }} --}}
{{-- Field: add_column repeater - {{ isset($standardy['add_column']) ? count($standardy['add_column']) . ' columns' : 'not set' }} --}}

<section class="relative overflow-hidden py-50 lg:py-100">
    <div
        class="absolute flex items-start justify-center mx-auto -translate-x-1/2 w-596 h-444 bg-color-1 left-1/2 lg:pt-100 lg:px-20 ">
        {!! wp_get_attachment_image($standardy['background_image'], 'full', false, [
            'class' => 'object-fit w-full h-full mix-blend-soft-light absolute top-0 left-0',
        ]) !!}
        <div class="relative top-0 z-10 text-center text-white text-h2">
            {!! $standardy['title'] !!}

        </div>
    </div>
    <div class="container relative z-10">
        @if (isset($standardy['add_column']) && is_array($standardy['add_column']))
            <div class="mx-auto w-fit grid lg:gap-60 grid-cols-[repeat(3,_minmax(var(--grid-34e),var(--grid-34e)))]">
                @foreach ($standardy['add_column'] as $index => $column)
                    <div
                        class="flex flex-col p-20 border-dashed-custom lg:p-30 bg-white relative gap-30 {{ $index == 0 ? 'lg:text-right' : '' }} {{ $index == 1 ? 'lg:mt-224' : '' }}">
                        @include('partials.decoration-element', [
                            'size' => 'size-40',
                            'color1' => 'bg-color-5',
                            'color2' => 'bg-color-2',
                            'position' => 'top-0 left-0',
                        ]) 
                        <div class="text-h4">
                            {!! $column['title'] ?? 'not set' !!}
                        </div>
                        <div class="text ">
                            {!! $column['description'] ?? 'not set' !!}
                        </div>
                        <div class="image">
                            {!! wp_get_attachment_image($column['image'], 'full', false, ['class' => 'w-auto max-h-100']) !!}

                        </div>
                    </div>
                @endforeach
        @endif

        {{-- Field: image (logo) - {{ $column['image'] ?? 'not set' }} --}}
        {{-- Column {{ $index + 1 }} --}}
        {{-- Field: title - {{ $column['title'] ?? 'not set' }} --}}
        {{-- Field: description - {!! $column['description'] ?? 'not set' !!} --}}

    </div>
    </div>
</section>
