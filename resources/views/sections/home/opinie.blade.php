@php
    $opinie = get_field('opinie');
@endphp

{{-- Opinie Section --}}
@if ($opinie)
<section class="opinieHome">
    {{-- Field: title - {!! $opinie['title'] ?? 'not set' !!} --}}
    {{-- Field: video - {{ isset($opinie['video']) ? $opinie['video']['url'] : 'not set' }} --}}
    {{-- Field: poster - {{ $opinie['poster'] ?? 'not set' }} --}}
    {{-- Field: add_testimonial - {{ isset($opinie['add_testimonial']) ? count($opinie['add_testimonial']) . ' testimonials' : 'not set' }} --}}

    <div class="swiper swiperOpinie">
        <div class="swiper-wrapper">
            @if(isset($opinie['add_testimonial']) && is_array($opinie['add_testimonial']))
                @foreach($opinie['add_testimonial'] as $index => $testimonial)
                    <div class="swiper-slide">
                        {{-- Testimonial {{ $index + 1 }} --}}
                        {{-- Field: description - {!! $testimonial['description'] ?? 'not set' !!} --}}
                        {{-- Field: author - {{ $testimonial['author'] ?? 'not set' }} --}}
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    {{-- Navigation Buttons --}}
    {{-- <button class="swiperOpinie__nav swiperOpinie__nav--prev">Prev</button> --}}
    {{-- <button class="swiperOpinie__nav swiperOpinie__nav--next">Next</button> --}}
</section>
@endif