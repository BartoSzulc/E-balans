<div {{ $attributes->merge(['class' => 'flex socials']) }}>
    @foreach ($socials as $social)
        <div class="relative social" >
            <a target="_blank" class="flex items-center transition-all duration-500 ease-in-out" href="{{ $social['link'] }}">
                @if (!empty($social['icon']))
                    @if ($social['icon_type'] === 'svg')
                        {!! $social['icon_content'] !!}
                    @else
                        <img src="{{ $social['icon']['url'] }}" alt="{{ $social['icon']['alt'] ?? '' }}">
                    @endif
                @endif
            </a>
        </div>
    @endforeach
</div>