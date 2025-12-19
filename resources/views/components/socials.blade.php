<div {{ $attributes->merge(['class' => 'flex socials']) }}>
    @foreach ($socials as $social)
        <div class="relative social">
            <a target="_blank" class="flex items-center w-40 h-40 transition-all duration-500 ease-in-out rounded-full bg-color-2 hover:opacity-70" href="{{ $social['link'] }}" aria-label="{{ ucfirst(str_replace('-', ' ', $social['icon'])) }}">
                @if (!empty($social['icon']))
                    @php
                        $iconComponent = 'fab-' . $social['icon'];
                    @endphp
                    <x-dynamic-component :component="$iconComponent" class="w-20 h-20 text-white" />
                @endif
            </a>
        </div>
    @endforeach
</div>