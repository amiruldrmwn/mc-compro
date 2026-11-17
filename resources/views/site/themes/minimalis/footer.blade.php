<footer class="border-t" style="border-color: var(--line)">
    <div class="site-container grid gap-10 py-16 md:grid-cols-2">
        <div>
            <div class="text-3xl" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</div>
            @if ($site->get('footer_text'))<p class="muted mt-4 max-w-md leading-relaxed">{{ $site->get('footer_text') }}</p>@endif
        </div>
        <div class="grid grid-cols-2 gap-8 text-sm">
            <nav class="flex flex-col gap-2">
                @foreach ($menu as $item)<a href="{{ $item->url() }}" class="muted hover:underline">{{ $item->title }}</a>@endforeach
            </nav>
            <div class="muted">
                @include('site.partials.contact-list', ['class' => 'space-y-2'])
                <div class="mt-4 flex flex-wrap gap-3">@include('site.partials.socials', ['class' => 'underline underline-offset-4'])</div>
            </div>
        </div>
    </div>
    <div class="site-container muted border-t py-6 text-xs tracking-wide uppercase" style="border-color: var(--line)">&copy; {{ date('Y') }} {{ $site->get('site_name') }}</div>
</footer>
