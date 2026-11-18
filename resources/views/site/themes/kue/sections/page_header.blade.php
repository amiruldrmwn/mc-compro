<section id="{{ $sectionId }}" class="pt-6 sm:pt-8">
    <div class="site-container">
        <div class="relative overflow-hidden rounded-[2rem] text-center" style="background: var(--brand-soft)">
            @if ($site->image($d['image']))
                <img src="{{ $site->image($d['image']) }}" alt="" class="absolute inset-0 size-full object-cover">
                <div class="absolute inset-0" style="background: rgb(30 15 8 / .6)"></div>
            @endif
            <div @class(['relative px-6 py-16 sm:py-24', 'text-white' => $site->image($d['image'])])>
                <h1 class="text-4xl font-semibold italic sm:text-5xl">{{ $d['title'] }}</h1>
                @if ($d['subtitle'])<p class="mx-auto mt-4 max-w-2xl text-lg opacity-85">{{ $d['subtitle'] }}</p>@endif
            </div>
        </div>
    </div>
</section>
