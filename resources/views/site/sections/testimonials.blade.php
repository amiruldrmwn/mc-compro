<section id="{{ $sectionId }}" class="sec sec-alt">
    <div class="site-container">
        @if ($d['title'])<div class="sec-head"><h2 class="sec-title">{{ $d['title'] }}</h2></div>@endif
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($d['items'] as $item)
                <figure class="card flex flex-col">
                    <svg class="mb-4 size-8" style="color: var(--brand)" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M9.6 6C6.5 7.4 4.5 10 4.5 13.4V18h6v-6h-3c0-2 1.2-3.6 3.2-4.4L9.6 6Zm9 0c-3.1 1.4-5.1 4-5.1 7.4V18h6v-6h-3c0-2 1.2-3.6 3.2-4.4L18.6 6Z"/></svg>
                    <blockquote class="flex-1 text-lg leading-relaxed">{{ $item['quote'] }}</blockquote>
                    <figcaption class="mt-6">
                        <div class="font-semibold">{{ $item['name'] }}</div>
                        @if ($item['role'])<div class="muted text-sm">{{ $item['role'] }}</div>@endif
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
