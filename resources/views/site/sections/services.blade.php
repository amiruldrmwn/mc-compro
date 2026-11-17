<section id="{{ $sectionId }}" class="sec sec-alt">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($d['items'] as $item)
                <div class="card">
                    @if ($site->image($item['image']))
                        <img src="{{ $site->image($item['image']) }}" alt="{{ $item['title'] }}" class="mb-5 aspect-video w-full object-cover" style="border-radius: calc(var(--radius) * .75)" loading="lazy">
                    @else
                        <div class="mb-5 flex size-12 items-center justify-center text-lg font-bold" style="border-radius: calc(var(--radius) * .75); background: var(--brand-soft); color: var(--brand)">{{ str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}</div>
                    @endif
                    <h3 class="text-xl font-semibold">{{ $item['title'] }}</h3>
                    @if ($item['text'])<p class="muted mt-2 leading-relaxed">{{ $item['text'] }}</p>@endif
                </div>
            @endforeach
        </div>
    </div>
</section>
