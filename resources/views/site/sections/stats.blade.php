<section id="{{ $sectionId }}" class="sec" style="background: var(--brand); color: var(--on-brand)">
    <div class="site-container">
        @if ($d['title'])<h2 class="sec-title mb-10 text-center" style="color: inherit">{{ $d['title'] }}</h2>@endif
        <div @class(['grid gap-8 text-center', [1 => '', 2 => 'sm:grid-cols-2', 3 => 'sm:grid-cols-3'][count($d['items'])] ?? 'sm:grid-cols-2 lg:grid-cols-4'])>
            @foreach ($d['items'] as $item)
                <div>
                    <div class="text-4xl font-bold sm:text-5xl" style="font-family: var(--font-head)">{{ $item['value'] }}</div>
                    <div class="mt-2 opacity-80">{{ $item['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
