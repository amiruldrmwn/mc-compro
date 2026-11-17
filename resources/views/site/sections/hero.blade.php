{{-- Fallback hero; each theme has its own in themes/<theme>/sections/hero.blade.php. --}}
<section id="{{ $sectionId }}" class="sec">
    <div class="site-container text-center">
        @if ($d['eyebrow'])<span class="eyebrow">{{ $d['eyebrow'] }}</span>@endif
        <h1 class="text-4xl font-bold sm:text-5xl">{{ $d['title'] }}</h1>
        @if ($d['subtitle'])<p class="sec-sub mx-auto max-w-2xl">{{ $d['subtitle'] }}</p>@endif
        @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="btn mt-8">{{ $d['button_label'] }}</a>@endif
    </div>
</section>
