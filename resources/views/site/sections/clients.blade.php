<section id="{{ $sectionId }}" class="border-b py-12" style="border-color: var(--line)">
    <div class="site-container">
        @if ($d['title'])<p class="muted mb-8 text-center text-sm font-semibold tracking-wide uppercase">{{ $d['title'] }}</p>@endif
        <div class="flex flex-wrap items-center justify-center gap-x-12 gap-y-6">
            @foreach ($d['items'] as $item)
                @if ($site->image($item['logo']))
                    <img src="{{ $site->image($item['logo']) }}" alt="{{ $item['name'] }}" class="h-10 w-auto object-contain opacity-70 grayscale transition hover:opacity-100 hover:grayscale-0" loading="lazy">
                @else
                    <span class="client-name flex items-center gap-2 text-xl font-bold opacity-60" style="font-family: var(--font-head)">
                        <span class="inline-block size-6 rotate-45 rounded-sm" style="background: var(--brand)"></span>{{ $item['name'] }}
                    </span>
                @endif
            @endforeach
        </div>
    </div>
</section>
