@php
    $about_us = get_field('about_us');
@endphp

{{-- About Us Section --}}
{{-- Field: section_id - {{ $about_us['section_id'] ?? 'not set' }} --}}
{{-- Field: add_column repeater - {{ isset($about_us['add_column']) ? count($about_us['add_column']) . ' columns' : 'not set' }} --}}
@if (isset($about_us['add_column']) && is_array($about_us['add_column']))
    <section class="relative bg-color-5 py-50 lg:py-100">
        <div class="container">
            <div class="grid grid-cols-4 gap-x-76 gap-y-30">
                @foreach ($about_us['add_column'] as $index => $column)
                    {{-- Column {{ $index + 1 }} --}}
                    {{-- Field: image - {{ $column['image'] ?? 'not set' }} --}}
                    {{-- Field: logo - {{ $column['logo'] ?? 'not set' }} --}}
                    {{-- Field: title - {{ $column['title'] ?? 'not set' }} --}}
                    {{-- Field: description - {!! $column['description'] ?? 'not set' !!} --}}

                    <div class="relative flex flex-col items-center p-16 border-dashed lg:p-30 border-dashed-custom {{ $index % 2 === 0 ? 'lg:-bottom-30' : 'lg:-top-30' }}">
                        @include('partials.decoration-element', [
                            'size' => 'size-40',
                            'color1' => 'bg-color-5',
                            'color2' => 'bg-color-2',
                            'position' => '-top-1 -right-1',
                        ])
                        <div class="flex flex-wrap items-center gap-20 lg:gap-30">
                            @if (!empty($column['image']))
                                {!! wp_get_attachment_image($column['image'], 'full', false, ['class' => 'size-40 lg:size-80']) !!}
                            @endif
                            @if (!empty($column['logo']))
                                {!! wp_get_attachment_image($column['logo'], 'full', false, ['class' => 'object-fit size-auto max-h-40']) !!}
                            @endif
                        </div>
                        @if (!empty($column['title']))
                            <div class="text-h5">
                                {!! $column['title'] !!}
                            </div>
                        @endif
                        @if (!empty($column['description']))
                            <div class="mt-10">
                                {!! $column['description'] !!}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endif
