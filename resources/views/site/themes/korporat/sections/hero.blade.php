<section id="{{ $sectionId }}" class="relative overflow-hidden" style="background: var(--brand-dark); color: #fff">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-30">
    @endif
    <div class="site-container relative py-24 sm:py-32">
        <div class="max-w-3xl">
            @if ($d['eyebrow'])<span class="mb-4 inline-block border-l-4 pl-3 text-sm font-semibold tracking-wide uppercase" style="border-color: var(--brand)">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="text-4xl leading-tight font-bold sm:text-5xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="mt-5 text-lg leading-relaxed text-white/85 sm:text-xl">{{ $d['subtitle'] }}</p>@endif
            @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="btn mt-8">{{ $d['button_label'] }}</a>@endif
        </div>
    </div>
</section>
