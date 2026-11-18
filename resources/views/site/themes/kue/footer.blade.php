<footer style="background: var(--brand-dark); color: rgb(255 255 255 / .75)">
    <div class="site-container grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-4">
        <div class="lg:col-span-2">
            <div class="text-2xl font-semibold text-white" style="font-family: var(--font-head)">{{ $site->get('site_name') }}</div>
            @if ($site->get('footer_text'))<p class="mt-3 max-w-md leading-relaxed">{{ $site->get('footer_text') }}</p>@endif
            <div class="mt-5 flex flex-wrap gap-4 font-semibold">@include('site.partials.socials', ['class' => 'hover:text-white'])</div>
        </div>
        <div>
            <div class="mb-3 font-bold text-white">Menu</div>
            <nav class="flex flex-col gap-2">
                @foreach ($menu as $item)<a href="{{ $item->url() }}" class="hover:text-white">{{ $item->title }}</a>@endforeach
            </nav>
        </div>
        <div>
            <div class="mb-3 font-bold text-white">Hubungi Kami</div>
            @include('site.partials.contact-list', ['class' => 'space-y-2'])
        </div>
    </div>
    <div class="border-t" style="border-color: rgb(255 255 255 / .12)">
        <div class="site-container py-5 text-center text-sm">&copy; {{ date('Y') }} {{ $site->get('site_name') }}. Dibuat dengan cinta dan cokelat.</div>
    </div>
</footer>
