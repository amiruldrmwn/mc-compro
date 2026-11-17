<footer class="px-4 pb-6">
    <div class="mx-auto max-w-6xl overflow-hidden rounded-[2rem] px-6 py-12 sm:px-12" style="background: linear-gradient(135deg, var(--brand-dark), var(--brand)); color: var(--on-brand)">
        <div class="grid gap-10 md:grid-cols-[2fr_1fr_1fr]">
            <div>
                <div class="text-2xl font-extrabold">{{ $site->get('site_name') }}</div>
                @if ($site->get('footer_text'))<p class="mt-3 max-w-md opacity-85">{{ $site->get('footer_text') }}</p>@endif
            </div>
            <nav class="flex flex-col gap-2 opacity-90">
                @foreach ($menu as $item)<a href="{{ $item->url() }}" class="hover:underline">{{ $item->title }}</a>@endforeach
            </nav>
            <div class="opacity-90">
                @include('site.partials.contact-list', ['class' => 'space-y-2'])
            </div>
        </div>
        <div class="mt-10 flex flex-col justify-between gap-4 border-t border-white/20 pt-6 text-sm opacity-80 sm:flex-row">
            <span>&copy; {{ date('Y') }} {{ $site->get('site_name') }}</span>
            <div class="flex flex-wrap gap-4">@include('site.partials.socials', ['class' => 'hover:underline'])</div>
        </div>
    </div>
</footer>
