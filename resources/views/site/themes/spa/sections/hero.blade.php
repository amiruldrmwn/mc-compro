<section id="{{ $sectionId }}" class="relative flex min-h-[86vh] items-center overflow-hidden">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">
    @endif
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at center, rgb(10 8 6 / .55), rgb(10 8 6 / .85))"></div>
    <div class="site-container relative py-24 text-center text-white">
        @include('site.partials.spa-ornament', ['class' => 'mx-auto mb-6 size-20'])
        @if ($d['eyebrow'])<div class="mb-5 text-xs tracking-[0.35em] uppercase" style="color: var(--brand)">{{ $d['eyebrow'] }}</div>@endif
        <h1 class="mx-auto max-w-4xl text-5xl leading-[1.05] font-normal sm:text-7xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed font-light text-white/80">{{ $d['subtitle'] }}</p>@endif
        @include('site.partials.hero-buttons', ['class' => 'justify-center', 'secondary' => 'btn-ghost-light'])
    </div>
    <div class="absolute inset-x-0 bottom-0 h-px" style="background: linear-gradient(90deg, transparent, var(--brand), transparent)"></div>
</section>
