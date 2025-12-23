@php
    $our_materialy = get_field('our_materialy');
@endphp

@if ($our_materialy && $our_materialy['add_material'])
    <section class="overflow-x-clip our-materialy-section mt-50 lg:mt-120">
        <div class="container mx-auto">
            <div class="lg:text-center mb-30 lg:mb-40 text-h2 text-color-3" data-aos="fade-up" data-aos-delay="100">
                {!! $our_materialy['title'] !!}
            </div>
            <div class="grid grid-cols-1 gap-16 materials-grid lg:grid-cols-2">

                @foreach ($our_materialy['add_material'] as $material)
                    <div
                        class="material-item min-h-360 bg-white shadow-special rounded-32 flex justify-between max-lg:gap-20 overflow-hidden {{ $loop->first ? 'col-span-full' : '' }}" data-aos="fade-up" data-aos-delay="{{ 200 + ($loop->index * 100) }}">
                        <div class="flex flex-col justify-center h-full gap-16 lg:pl-72 max-w-700">
                            @if ($material['title'])
                                <div class="material-title text-h3 text-color-3">
                                    {!! $material['title'] !!}
                                </div>
                            @endif

                            @if ($material['description'])
                                <div class="material-description text-body">
                                    {!! $material['description'] !!}
                                </div>
                            @endif

                            @if ($material['button'])
                                <div class="material-button lg:mt-8">
                                    @php
                                        acf_link($material['button'], 'btn btn--primary');
                                    @endphp
                                </div>
                            @endif
                        </div>

                        @if ($material['image'])
                            @php
                                $imageHeights = ['h-360 lg:mr-151', 'h-345 lg:mr-17 lg:ml-33', 'lg:pt-14 h-329'];
                                $heightClass = $imageHeights[$loop->index] ?? 'h-360';
                            @endphp
                            <div
                                class="overflow-y-clip material-image self-end z-10 relative grow-0 shrink-0 {{ $heightClass }}">
                                @if ($loop->index === 0)
                                    @include('partials.decorative-circle', [
                                        'size' => 'size-45',
                                        'bg' => 'bg-color-4',
                                        'position' => '-right-20 top-122',
                                        'animation' => 'zoom-in-left',
                                        'delay' => 300
                                    ])
                                    @include('partials.decorative-circle', [
                                        'size' => 'size-60',
                                        'bg' => 'bg-color-4',
                                        'position' => '-translate-x-full -left-11 bottom-33',
                                        'animation' => 'zoom-in-right',
                                        'delay' => 400
                                    ])
                                    <div
                                        class="absolute -translate-x-1/2 rounded-full left-1/2 size-480 bg-color-3 -bottom-180">
                                    </div>
                                @elseif($loop->index === 1)
                                    @include('partials.decorative-circle', [
                                        'size' => 'size-35',
                                        'bg' => 'bg-color-4',
                                        'position' => 'right-20 top-102',
                                        'animation' => 'zoom-in-left',
                                        'delay' => 400
                                    ])
                                    @include('partials.decorative-circle', [
                                        'size' => 'size-60',
                                        'bg' => 'bg-color-4',
                                        'position' => '-translate-x-full left-0 bottom-16',
                                        'animation' => 'zoom-in-right',
                                        'delay' => 500
                                    ])
                                    <div class="absolute rounded-full -bottom-180 -right-167 size-480 bg-color-3">
                                    </div>
                                @elseif($loop->index === 2)
                                    @include('partials.decorative-circle', [
                                        'size' => 'size-41',
                                        'bg' => 'bg-color-4',
                                        'position' => 'left-1 bottom-56',
                                        'animation' => 'zoom-in-right',
                                        'delay' => 500
                                    ])
                                    @include('partials.decorative-circle', [
                                        'size' => 'size-50',
                                        'bg' => 'bg-color-4',
                                        'position' => 'right-16 top-0',
                                        'animation' => 'zoom-in-left',
                                        'delay' => 600
                                    ])
                                    <div class="absolute rounded-full -bottom-168 -right-180 size-480 bg-color-3 ">
                                    </div>
                                @endif
                                {!! wp_get_attachment_image($material['image'], 'full', false, ['class' => 'h-full w-auto relative z-10']) !!}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
