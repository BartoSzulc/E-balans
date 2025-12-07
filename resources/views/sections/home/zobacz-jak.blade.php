@php
    $zobacz_jak = get_field('zobacz_jak');
@endphp

{{-- Zobacz Jak Section --}}
@if ($zobacz_jak)
<section class="zobaczJakHome">
    {{-- Field: title - {!! $zobacz_jak['title'] ?? 'not set' !!} --}}
    {{-- Field: source_type - {{ $zobacz_jak['source_type'] ?? 'not set' }} --}}

    <div class="swiper swiperZobaczJak">
        <div class="swiper-wrapper">
            @if($zobacz_jak['source_type'] === 'cpt')
                {{-- CPT Case Studies --}}
                {{-- Field: case_studies - {{ isset($zobacz_jak['case_studies']) ? count($zobacz_jak['case_studies']) . ' case studies selected' : 'not set' }} --}}
                @if(isset($zobacz_jak['case_studies']) && is_array($zobacz_jak['case_studies']))
                    @foreach($zobacz_jak['case_studies'] as $post_id)
                        <div class="swiper-slide">
                            {{-- Case Study ID: {{ $post_id }} --}}
                            {{-- Title: {{ get_the_title($post_id) }} --}}
                        </div>
                    @endforeach
                @endif
            @else
                {{-- Manual Case Studies --}}
                {{-- Field: manual_case_studies - {{ isset($zobacz_jak['manual_case_studies']) ? count($zobacz_jak['manual_case_studies']) . ' manual case studies' : 'not set' }} --}}
                @if(isset($zobacz_jak['manual_case_studies']) && is_array($zobacz_jak['manual_case_studies']))
                    @foreach($zobacz_jak['manual_case_studies'] as $case_index => $case_study)
                        <div class="swiper-slide">
                            {{-- Case Study {{ $case_index + 1 }} --}}
                            {{-- Field: image - {{ $case_study['image'] ?? 'not set' }} --}}
                            {{-- Field: title - {{ $case_study['title'] ?? 'not set' }} --}}
                            {{-- Field: nazwa_firmy - {{ $case_study['nazwa_firmy'] ?? 'not set' }} --}}
                            {{-- Field: logo_firmy - {{ $case_study['logo_firmy'] ?? 'not set' }} --}}
                            {{-- Field: dodaj_blok_tekstowy - {{ isset($case_study['dodaj_blok_tekstowy']) ? count($case_study['dodaj_blok_tekstowy']) . ' text blocks' : 'not set' }} --}}
                            @if(isset($case_study['dodaj_blok_tekstowy']) && is_array($case_study['dodaj_blok_tekstowy']))
                                @foreach($case_study['dodaj_blok_tekstowy'] as $block_index => $block)
                                    {{-- Text Block {{ $block_index + 1 }} --}}
                                    {{-- Field: title - {!! $block['title'] ?? 'not set' !!} --}}
                                    {{-- Field: description - {!! $block['description'] ?? 'not set' !!} --}}
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                @endif
            @endif
        </div>
    </div>

    {{-- Navigation Buttons --}}
    {{-- <button class="swiperZobaczJak__nav swiperZobaczJak__nav--prev">Prev</button> --}}
    {{-- <button class="swiperZobaczJak__nav swiperZobaczJak__nav--next">Next</button> --}}
</section>
@endif
