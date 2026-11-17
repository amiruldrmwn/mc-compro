<a href="{{ url('/') }}" class="flex items-center gap-3 {{ $class ?? '' }}">
    @if ($site->url('logo'))
        <img src="{{ $site->url('logo') }}" alt="{{ $site->get('site_name') }}" class="h-10 w-auto max-w-[180px] object-contain">
    @else
        <span class="text-lg font-bold" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</span>
    @endif
</a>
