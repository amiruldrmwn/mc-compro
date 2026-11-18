<header class="sticky top-0 z-30 shadow-[0_1px_0_var(--line)]" style="background: var(--surface)">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-7 md:flex">
            @include('site.partials.menu', ['class' => 'font-bold'])
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl('Halo, saya ingin memesan') }}" target="_blank" rel="noopener" class="btn px-5! py-2! text-sm">Pesan Sekarang</a>@endif
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
