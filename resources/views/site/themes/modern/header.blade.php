<header class="sticky top-0 z-30 border-b border-white/40 bg-white/75 backdrop-blur-lg">
    <div class="site-container flex items-center justify-between gap-6 py-4">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-2 rounded-full bg-slate-100/80 p-1.5 md:flex">
            @include('site.partials.menu', ['class' => 'rounded-full px-4 py-1.5 hover:bg-white'])
        </nav>
        <div class="flex items-center gap-2">
            @if ($site->whatsappUrl())<a href="{{ $site->whatsappUrl() }}" target="_blank" rel="noopener" class="btn hidden px-5 py-2 text-sm sm:inline-flex">Mulai Diskusi</a>@endif
            @include('site.partials.mobile-menu')
        </div>
    </div>
</header>
