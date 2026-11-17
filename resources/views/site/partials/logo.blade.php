<a href="{{ url('/') }}" class="flex items-center gap-3 {{ $class ?? '' }}">
    @if ($site->get('logo') === \App\Sections\DefaultContent::LOGO)
        {{-- Sample logo: drawn in the site's colour, next to the company name. --}}
        <svg viewBox="0 0 48 48" class="size-10 shrink-0" aria-hidden="true">
            <rect width="48" height="48" rx="12" style="fill: var(--brand)"/>
            <path d="M13 34V14l11 9 11-9v20" fill="none" style="stroke: var(--on-brand)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="24" cy="34" r="2.6" style="fill: var(--on-brand)"/>
        </svg>
        <span class="text-lg leading-tight font-bold" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</span>
    @elseif ($site->url('logo'))
        <img src="{{ $site->url('logo') }}" alt="{{ $site->get('site_name') }}" class="h-10 w-auto max-w-[180px] object-contain">
    @else
        <span class="text-lg font-bold" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</span>
    @endif
</a>
