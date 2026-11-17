<section id="{{ $sectionId }}" class="pt-16 sm:pt-24">
    <div class="site-container">
        <span class="eyebrow">{{ $page?->title }}</span>
        <h1 class="max-w-4xl text-5xl leading-[1.05] font-semibold sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="muted mt-6 max-w-2xl border-t pt-6 text-lg leading-relaxed" style="border-color: var(--ink)">{{ $d['subtitle'] }}</p>@endif
        @if ($site->image($d['image']))
            <img src="{{ $site->image($d['image']) }}" alt="" class="mt-12 aspect-[21/8] w-full object-cover">
        @endif
    </div>
</section>
