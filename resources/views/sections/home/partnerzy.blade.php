@php
    $partnerzy = get_field('partnerzy');
@endphp

@if ($partnerzy && $partnerzy['add_image'])
    <section class="partnerzy-section lg:my-120 my-50">
        <div class="container mx-auto">
            @if (!empty($partnerzy['title']))
                <div class="section-title text-h2 lg:text-center mb-30 lg:mb-40 text-color-3">
                    {!! $partnerzy['title'] !!}
                </div>
            @endif
            <div class="mx-auto w-fit partners-grid grid grid-cols-[3.69791667rem_1.791666667rem] grid-rows-2 gap-19">
                @foreach ($partnerzy['add_image'] as $index => $partner)
                    @if ($partner['image'])
                        <div class="bg-white shadow-special rounded-16 partner-logo flex items-center justify-center {{ $index === 0 ? 'row-span-2 lg:py-50 lg:px-75 p-20' : 'max-lg:p-20' }} {{ $index === 1 ? 'lg:py-20 lg:px-57' : '' }} {{ $index === 2 ? 'lg:py-43 lg:px-63' : '' }}">
                            {!! wp_get_attachment_image($partner['image'], 'full', false, ['class' => 'w-auto h-auto object-fit']) !!}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endif
