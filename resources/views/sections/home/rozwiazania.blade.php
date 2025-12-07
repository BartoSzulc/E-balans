@php
    $rozwiazania = get_field('rozwiazania');
@endphp

{{-- Rozwiązania Section --}}
{{-- Field: section_id - {{ $rozwiazania['section_id'] ?? 'not set' }} --}}
{{-- Field: title - {!! $rozwiazania['title'] ?? 'not set' !!} --}}
{{-- Field: add_tab repeater - {{ isset($rozwiazania['add_tab']) ? count($rozwiazania['add_tab']) . ' tabs' : 'not set' }} --}}
<section class="">
    <div class="container">
        <div class="w-full text-center">
            {!! $rozwiazania['title'] ?? 'not set' !!}
        </div>
    </div>
</section>
@if(isset($rozwiazania['add_tab']) && is_array($rozwiazania['add_tab']))
    @foreach($rozwiazania['add_tab'] as $tab_index => $tab)
        {{-- Tab {{ $tab_index + 1 }} --}}
        {{-- Field: tab_name - {{ $tab['tab_name'] ?? 'not set' }} --}}
        {{-- Field: title - {!! $tab['title'] ?? 'not set' !!} --}}
        {{-- Field: description - {!! $tab['description'] ?? 'not set' !!} --}}
        {{-- Field: button - {{ $tab['button']['title'] ?? 'not set' }} | URL: {{ $tab['button']['url'] ?? 'not set' }} --}}
        {{-- Field: accordion repeater - {{ isset($tab['accordion']) ? count($tab['accordion']) . ' items' : 'not set' }} --}}
        @if(isset($tab['accordion']) && is_array($tab['accordion']))
            @foreach($tab['accordion'] as $acc_index => $accordion)
                {{-- Accordion Item {{ $acc_index + 1 }} --}}
                {{-- Field: title - {!! $accordion['title'] ?? 'not set' !!} --}}
                {{-- Field: description - {!! $accordion['description'] ?? 'not set' !!} --}}
                {{-- Field: image - {{ $accordion['image'] ?? 'not set' }} --}}
            @endforeach
        @endif
    @endforeach
@endif
