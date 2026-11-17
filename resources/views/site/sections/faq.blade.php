<section id="{{ $sectionId }}" class="sec">
    <div class="site-container max-w-3xl">
        @if ($d['title'])<div class="sec-head"><h2 class="sec-title">{{ $d['title'] }}</h2></div>@endif
        <div class="divide-y" style="border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); --tw-divide-opacity: 1">
            @foreach ($d['items'] as $item)
                <details class="group py-5" style="border-color: var(--line)">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-lg font-semibold [&::-webkit-details-marker]:hidden">
                        {{ $item['question'] }}
                        <span class="shrink-0 text-2xl leading-none transition group-open:rotate-45" style="color: var(--brand)">+</span>
                    </summary>
                    <p class="muted mt-3 leading-relaxed">{!! nl2br(e($item['answer'])) !!}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>
