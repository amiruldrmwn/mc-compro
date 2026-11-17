<footer class="bg-slate-900 text-slate-300">
    <div class="site-container grid gap-10 py-14 md:grid-cols-3">
        <div>
            <div class="text-lg font-bold text-white">{{ $site->get('site_name') }}</div>
            @if ($site->get('footer_text'))<p class="mt-3 leading-relaxed">{{ $site->get('footer_text') }}</p>@endif
        </div>
        <div>
            <div class="mb-3 font-semibold text-white">Menu</div>
            <nav class="flex flex-col gap-2">
                @foreach ($menu as $item)<a href="{{ $item->url() }}" class="hover:text-white">{{ $item->title }}</a>@endforeach
            </nav>
        </div>
        <div>
            <div class="mb-3 font-semibold text-white">Kontak</div>
            @include('site.partials.contact-list')
            <div class="mt-4 flex flex-wrap gap-4">@include('site.partials.socials', ['class' => 'hover:text-white'])</div>
        </div>
    </div>
    <div class="border-t border-slate-800">
        <div class="site-container py-5 text-sm text-slate-400">&copy; {{ date('Y') }} {{ $site->get('site_name') }}. Hak cipta dilindungi.</div>
    </div>
</footer>
