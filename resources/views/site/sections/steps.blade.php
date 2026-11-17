<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif
        <ol @class(['grid gap-8 sm:grid-cols-2', 'lg:grid-cols-4' => count($d['items']) === 4, 'lg:grid-cols-3' => count($d['items']) !== 4])>
            @foreach ($d['items'] as $item)
                <li class="step relative">
                    <div class="step-num mb-5 flex size-14 items-center justify-center text-xl font-bold" style="font-family: var(--font-head)">{{ $loop->iteration }}</div>
                    <h3 class="text-xl font-semibold">{{ $item['title'] }}</h3>
                    @if ($item['text'])<p class="muted mt-2 leading-relaxed">{{ $item['text'] }}</p>@endif
                </li>
            @endforeach
        </ol>
    </div>
</section>
