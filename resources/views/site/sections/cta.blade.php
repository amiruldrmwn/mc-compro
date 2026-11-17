<section id="{{ $sectionId }}" class="sec">
    <div class="site-container">
        <div class="px-6 py-14 text-center sm:px-12" style="background: var(--brand); color: var(--on-brand); border-radius: var(--radius)">
            <h2 class="text-3xl font-bold sm:text-4xl">{{ $d['title'] }}</h2>
            @if ($d['text'])<p class="mx-auto mt-4 max-w-2xl text-lg opacity-90">{{ $d['text'] }}</p>@endif
            @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="btn btn-light mt-8">{{ $d['button_label'] }}</a>@endif
        </div>
    </div>
</section>
