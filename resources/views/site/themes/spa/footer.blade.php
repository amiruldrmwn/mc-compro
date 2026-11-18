<footer class="relative border-t" style="border-color: var(--line); background: var(--surface-alt)">
    <div class="site-container py-16 text-center">
        @include('site.partials.spa-ornament', ['class' => 'mx-auto mb-5 size-14'])
        <div class="text-3xl" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</div>
        @if ($site->get('tagline'))<div class="mt-2 text-xs tracking-[0.3em] uppercase" style="color: var(--brand)">{{ $site->get('tagline') }}</div>@endif
        @if ($site->get('footer_text'))<p class="muted mx-auto mt-5 max-w-xl leading-relaxed">{{ $site->get('footer_text') }}</p>@endif
    </div>
    <div class="site-container grid gap-10 border-t py-12 text-sm md:grid-cols-3" style="border-color: var(--line)">
        <div>
            <div class="spa-label mb-4">Menu</div>
            <nav class="flex flex-col gap-2">
                @foreach ($menu as $item)<a href="{{ $item->url() }}" class="muted hover:text-[var(--brand)]">{{ $item->title }}</a>@endforeach
            </nav>
        </div>
        <div>
            <div class="spa-label mb-4">Kontak</div>
            <div class="muted">@include('site.partials.contact-list', ['class' => 'space-y-2'])</div>
        </div>
        <div>
            <div class="spa-label mb-4">Ikuti Kami</div>
            <div class="muted flex flex-wrap gap-4">@include('site.partials.socials', ['class' => 'hover:text-[var(--brand)]'])</div>
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin reservasi') }}" target="_blank" rel="noopener" class="btn mt-6 text-xs tracking-[0.2em] uppercase">Reservasi Sekarang</a>@endif
        </div>
    </div>
    <div class="site-container muted border-t py-6 text-center text-xs tracking-[0.2em] uppercase" style="border-color: var(--line)">&copy; {{ date('Y') }} {{ $site->get('site_name') }}</div>
</footer>
