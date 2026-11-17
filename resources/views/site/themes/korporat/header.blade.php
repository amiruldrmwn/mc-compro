<header class="sticky top-0 z-30 bg-white shadow-sm">
    @if ($site->get('contact_phone') || $site->get('contact_email'))
        <div class="hidden text-sm sm:block" style="background: var(--brand-dark); color: #fff">
            <div class="site-container flex items-center justify-between py-2">
                <div class="flex gap-6 opacity-90">
                    @if ($site->get('contact_phone'))<span>Telp: {{ $site->get('contact_phone') }}</span>@endif
                    @if ($site->get('contact_email'))<span>{{ $site->get('contact_email') }}</span>@endif
                </div>
                <div class="flex gap-4 opacity-90">@include('site.partials.socials', ['class' => 'hover:underline'])</div>
            </div>
        </div>
    @endif
    <div class="site-container flex h-18 items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-8 md:flex">
            @include('site.partials.menu')
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl() }}" target="_blank" rel="noopener" class="btn px-5 py-2 text-sm">Hubungi Kami</a>@endif
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
