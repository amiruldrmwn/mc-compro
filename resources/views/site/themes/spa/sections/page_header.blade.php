<section id="{{ $sectionId }}" class="relative overflow-hidden">
    @if ($site->image($d['image']))
        <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">
    @endif
    <div class="absolute inset-0" style="background: rgb(10 8 6 / .72)"></div>
    <div class="site-container relative py-24 text-center text-white sm:py-32">
        <div class="mb-4 text-xs tracking-[0.35em] uppercase" style="color: var(--brand)">{{ $page?->title }}</div>
        <h1 class="mx-auto max-w-3xl text-5xl font-normal sm:text-6xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="mx-auto mt-5 max-w-2xl text-lg font-light text-white/80">{{ $d['subtitle'] }}</p>@endif
        @include('site.partials.spa-ornament', ['class' => 'mx-auto mt-8 size-10'])
    </div>
</section>
