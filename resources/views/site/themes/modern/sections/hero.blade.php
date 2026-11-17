@php($img = $site->image($d['image']))
<section id="{{ $sectionId }}" class="relative overflow-hidden">
    <div class="pointer-events-none absolute -top-40 left-1/3 size-[700px] -translate-x-1/2 rounded-full opacity-25 blur-3xl" style="background: radial-gradient(circle, var(--brand), transparent 70%)"></div>
    <div @class(['site-container relative grid items-center gap-12 py-16 sm:py-24', 'lg:grid-cols-[1.1fr_1fr]' => $img])>
        <div @class(['mx-auto max-w-3xl text-center' => ! $img])>
            @if ($d['eyebrow'])<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
            <h1 class="text-4xl leading-[1.1] font-extrabold sm:text-5xl xl:text-6xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="muted mt-6 text-lg leading-relaxed sm:text-xl">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['class' => $img ? '' : 'justify-center'])
        </div>
        @if ($img)
            <div class="relative">
                <div class="absolute -inset-3 rotate-3 rounded-[2.25rem] opacity-30" style="background: linear-gradient(135deg, var(--brand), transparent)"></div>
                <img src="{{ $img }}" alt="" class="relative aspect-[4/5] w-full rounded-[2rem] object-cover shadow-2xl sm:aspect-[4/3] lg:aspect-[4/5]">
            </div>
        @endif
    </div>
</section>
