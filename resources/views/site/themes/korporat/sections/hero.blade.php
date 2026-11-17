<section id="{{ $sectionId }}" class="relative overflow-hidden" style="background: var(--brand-dark); color: #fff">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">
        <div class="absolute inset-0" style="background: linear-gradient(90deg, color-mix(in oklab, var(--brand-dark) 95%, transparent) 0%, color-mix(in oklab, var(--brand-dark) 75%, transparent) 50%, transparent 100%)"></div>
    @endif
    <div class="site-container relative py-28 sm:py-40">
        <div class="max-w-2xl">
            @if ($d['eyebrow'])<span class="mb-5 inline-block border-l-4 pl-3 text-sm font-semibold tracking-wide uppercase" style="border-color: var(--brand)">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="text-4xl leading-tight font-bold sm:text-6xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="mt-6 text-lg leading-relaxed text-white/85 sm:text-xl">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['secondary' => 'btn-ghost-light'])
        </div>
    </div>
</section>
