<section id="{{ $sectionId }}" class="sec">
    <div class="site-container grid items-center gap-10 md:grid-cols-2 md:gap-16">
        <div>
            @if ($d['title'])<h2 class="sec-title mb-6">{{ $d['title'] }}</h2>@endif
            <div class="prose-site">{!! \Illuminate\Support\Str::markdown($d['body'], ['html_input' => 'strip', 'allow_unsafe_links' => false]) !!}</div>
            @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="btn mt-8">{{ $d['button_label'] }}</a>@endif
        </div>
        <div @class(['md:order-first' => $d['image_position'] === 'left'])>
            @if ($site->image($d['image']))
                <img src="{{ $site->image($d['image']) }}" alt="{{ $d['title'] }}" class="aspect-[4/3] w-full object-cover" style="border-radius: var(--radius)" loading="lazy">
            @else
                <div class="flex aspect-[4/3] w-full items-center justify-center text-6xl font-bold" style="border-radius: var(--radius); background: var(--brand-soft); color: var(--brand); font-family: var(--font-head)">{{ mb_substr($site->get('site_name'), 0, 1) }}</div>
            @endif
        </div>
    </div>
</section>
