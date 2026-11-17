<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['eyebrow'])<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h1 class="max-w-4xl text-5xl leading-[1.05] font-semibold sm:text-7xl">{{ $d['title'] }}</h1>
        <div class="mt-10 grid items-end gap-8 border-t pt-8 md:grid-cols-2" style="border-color: var(--ink)">
            @if ($d['subtitle'])<p class="muted text-lg leading-relaxed">{{ $d['subtitle'] }}</p>@endif
            @include('site.partials.hero-buttons', ['class' => 'mt-0! md:justify-end'])
        </div>
        @if ($site->image($d['image']))
            <img src="{{ $site->image($d['image']) }}" alt="" class="mt-14 aspect-[21/9] w-full object-cover">
        @endif
    </div>
</section>
