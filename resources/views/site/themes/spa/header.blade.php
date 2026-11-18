<header class="sticky top-0 z-30 border-b backdrop-blur" style="background: color-mix(in oklab, var(--surface) 88%, transparent); border-color: var(--line)">
    <div class="site-container flex items-center justify-between gap-6 py-5">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-9 md:flex">
            @include('site.partials.menu', ['class' => 'text-xs tracking-[0.2em] uppercase'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin reservasi') }}" target="_blank" rel="noopener" class="btn btn-outline px-5! py-2! text-xs tracking-[0.2em] uppercase">Reservasi</a>@endif
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
