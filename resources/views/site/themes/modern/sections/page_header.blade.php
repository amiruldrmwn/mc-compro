<section id="{{ $sectionId }}" class="px-4 pt-4">
    <div class="relative mx-auto max-w-6xl overflow-hidden rounded-[2rem]" style="background: linear-gradient(135deg, var(--brand-dark), var(--brand)); color: var(--on-brand)">
        @if ($site->image($d['image']))
            <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover opacity-25 mix-blend-luminosity">
        @endif
        <div class="relative px-6 py-20 text-center sm:px-12 sm:py-24">
            <h1 class="text-4xl font-extrabold sm:text-6xl">{{ $d['title'] }}</h1>
            @if ($d['subtitle'])<p class="mx-auto mt-5 max-w-2xl text-lg opacity-90">{{ $d['subtitle'] }}</p>@endif
        </div>
    </div>
</section>
