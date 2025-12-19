@php
    // Support both flexible content ($data) and standard fields (get_field)
    // When used in flexible content, pass ['data' => $layout]
    // When used as standard section, it will use get_field automatically
    $how_it_works = $data ?? (get_field('how_it_works') ?? []);
@endphp

@if ($how_it_works)
    <section class="how-it-works-section mt-50 lg:mt-120">
        <div class="container mx-auto">
            @if (!empty($how_it_works['title']))
                <div class="section-title text-h2 lg:text-center mb-30 lg:mb-40 text-color-3">
                    {!! $how_it_works['title'] !!}
                </div>
            @endif

            @if (!empty($how_it_works['add_how_it_works']))
                <div class="grid grid-cols-1 gap-x-86 gap-y-24 lg:grid-cols-3 steps-grid">
                    @foreach ($how_it_works['add_how_it_works'] as $index => $step)
                        <div class="relative flex flex-col items-center gap-24 text-center step-item">

                            @if (!empty($step['image']))
                                <div class="relative step-image">
                                    {!! wp_get_attachment_image($step['image'], 'false', false, [
                                        'class' => 'size-200 object-cover object-center rounded-full',
                                    ]) !!}
                                    @if ($loop->index === 0)
                                        @include('partials.decorative-circle', [
                                            'size' => 'size-38',
                                            'bg' => 'bg-color-4',
                                            'position' => 'top-24 left-0',
                                        ])
                                    @elseif($loop->index === 1)
                                        @include('partials.decorative-circle', [
                                            'size' => 'size-38',
                                            'bg' => 'bg-color-4',
                                            'position' => 'right-20 bottom-0',
                                        ])
                                    @elseif($loop->index === 2)
                                        @include('partials.decorative-circle', [
                                            'size' => 'size-38',
                                            'bg' => 'bg-color-4',
                                            'position' => '-left-19 bottom-45',
                                        ])
                                    @endif
                                </div>
                            @endif

                            @if (!empty($step['title']))
                                <div class="step-title text-h3 lg:mt-16 text-color-3">
                                    {{ $step['title'] }}
                                </div>
                            @endif

                            @if (!empty($step['description']))
                                <div class="step-description text-body">
                                    {!! $step['description'] !!}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endif
