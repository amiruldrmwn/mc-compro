<header class="border-b" style="border-color: var(--line)">
    <div class="site-container flex items-center justify-between gap-6 py-6">
        @include('site.partials.logo')
        <nav class="hidden items-center gap-10 md:flex">
            @include('site.partials.menu', ['class' => 'tracking-wide uppercase text-xs'])
        </nav>
        @include('site.partials.mobile-menu')
    </div>
</header>
