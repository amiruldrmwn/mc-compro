<section id="{{ $sectionId }}" class="sec">
    <div class="site-container max-w-3xl">
        @if ($d['title'])<h2 class="sec-title mb-6">{{ $d['title'] }}</h2>@endif
        <div class="prose-site">{!! \Illuminate\Support\Str::markdown($d['body'], ['html_input' => 'strip', 'allow_unsafe_links' => false]) !!}</div>
    </div>
</section>
