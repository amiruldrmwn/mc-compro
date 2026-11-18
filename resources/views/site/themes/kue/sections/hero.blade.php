<section id="{{ $sectionId }}" class="pt-6 pb-4 sm:pt-8">
    <div class="site-container">
        <div class="relative overflow-hidden rounded-[2rem]" style="background: var(--brand-soft)">
            @if ($site->image($d['image']))
                <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">
                <div class="absolute inset-0" style="background: linear-gradient(90deg, rgb(30 15 8 / .78) 0%, rgb(30 15 8 / .45) 55%, transparent 100%)"></div>
            @endif
            <div @class(['relative max-w-2xl px-7 py-20 sm:px-14 sm:py-28', 'text-white' => $site->image($d['image'])])>
                @if ($d['eyebrow'])<span class="mb-5 inline-block rounded-full px-4 py-1.5 text-sm font-bold" style="background: var(--brand); color: var(--on-brand)">{{ $d['eyebrow'] }}</span>@endif
                <h1 class="text-4xl leading-tight font-semibold sm:text-6xl">{{ $d['title'] }}</h1>
                @if ($d['subtitle'])<p @class(['mt-5 text-lg leading-relaxed', 'text-white/85' => $site->image($d['image']), 'muted' => ! $site->image($d['image'])])>{{ $d['subtitle'] }}</p>@endif
                @include('site.partials.hero-buttons', ['primary' => $site->image($d['image']) ? 'btn-light' : '', 'secondary' => $site->image($d['image']) ? 'btn-ghost-light' : 'btn-outline'])
            </div>
        </div>
    </div>
</section>
