<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        @if ($d['title'])<div class="sec-head"><h2 class="sec-title">{{ $d['title'] }}</h2></div>@endif
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
            @foreach ($d['items'] as $item)
                @if ($site->image($item['image']))
                    <figure>
                        <img src="{{ $site->image($item['image']) }}" alt="{{ $item['caption'] }}" class="aspect-square w-full object-cover" style="border-radius: var(--radius)" loading="lazy">
                        @if ($item['caption'])<figcaption class="muted mt-2 text-sm">{{ $item['caption'] }}</figcaption>@endif
                    </figure>
                @endif
            @endforeach
        </div>
    </div>
</section>
