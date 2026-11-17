<section id="{{ $sectionId }}" class="relative overflow-hidden">
    <div class="pointer-events-none absolute -top-40 left-1/2 size-[700px] -translate-x-1/2 rounded-full opacity-25 blur-3xl" style="background: radial-gradient(circle, var(--brand), transparent 70%)"></div>
    <div class="site-container relative grid items-center gap-12 py-20 sm:py-28 @if ($site->image($d['image'])) lg:grid-cols-2 @endif">
        <div @class(['text-center mx-auto max-w-3xl' => ! $site->image($d['image'])])>
            @if ($d['eyebrow'])<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="text-4xl leading-[1.1] font-extrabold sm:text-6xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 text-lg leading-relaxed sm:text-xl">{{ $d['subtitle'] }}</p>@endif
            @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="btn mt-9 px-8 py-4">{{ $d['button_label'] }} &rarr;</a>@endif
        </div>
        @if ($site->image($d['image']))
            <img src="{{ $site->image($d['image']) }}" alt="" class="aspect-[4/3] w-full rounded-[2rem] object-cover shadow-2xl">
        @endif
    </div>
</section>
