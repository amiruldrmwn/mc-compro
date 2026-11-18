@php
    $withPhotos = collect($d['items'])->contains(fn ($item) => $site->image($item['image']));
    $order = $d['order_button'] === 'yes';
@endphp
<section id="{{ $sectionId }}" class="sec pricelist">
    <div class="site-container">
        @if ($d['title'] || $d['subtitle'])
            <div class="sec-head">
                @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
                @if ($d['subtitle'])<p class="sec-sub">{{ $d['subtitle'] }}</p>@endif
            </div>
        @endif

        @if ($withPhotos)
            {{-- Product cards --}}
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($d['items'] as $item)
                    <div class="card product-card flex flex-col overflow-hidden p-0!">
                        @if ($site->image($item['image']))
                            <div class="overflow-hidden"><img src="{{ $site->image($item['image']) }}" alt="{{ $item['name'] }}" class="aspect-square w-full object-cover transition duration-500 hover:scale-105" loading="lazy"></div>
                        @endif
                        <div class="flex flex-1 flex-col p-5">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                                @if ($item['info'])<span class="price-info shrink-0 text-xs">{{ $item['info'] }}</span>@endif
                            </div>
                            @if ($item['description'])<p class="muted mt-1.5 flex-1 text-sm leading-relaxed">{{ $item['description'] }}</p>@else<div class="flex-1"></div>@endif
                            <div class="mt-4 flex items-center justify-between gap-3">
                                @if ($item['price'])<span class="price text-lg font-bold">{{ $item['price'] }}</span>@endif
                                @if ($order && $site->whatsappUrl())
                                    <a href="{{ $site->whatsappUrl('Halo, saya ingin memesan '.$item['name']) }}" target="_blank" rel="noopener" class="btn px-4! py-2! text-sm">Pesan</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Price list --}}
            <div class="price-list mx-auto max-w-3xl">
                @foreach ($d['items'] as $item)
                    <div class="price-row py-4">
                        <div class="flex items-baseline gap-3">
                            <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                            <span class="price-dots flex-1"></span>
                            @if ($item['info'])<span class="price-info shrink-0 text-sm">{{ $item['info'] }}</span>@endif
                            @if ($item['price'])<span class="price shrink-0 text-lg font-semibold">{{ $item['price'] }}</span>@endif
                        </div>
                        @if ($item['description'])<p class="muted mt-1 text-sm leading-relaxed">{{ $item['description'] }}</p>@endif
                    </div>
                @endforeach
            </div>
        @endif

        @if ($d['note'] || ($order && $site->whatsappUrl() && ! $withPhotos))
            <div class="mt-10 flex flex-col items-center gap-5 text-center">
                @if ($d['note'])<p class="muted text-sm italic">{{ $d['note'] }}</p>@endif
                @if ($order && $site->whatsappUrl() && ! $withPhotos)
                    <a href="{{ $site->whatsappUrl('Halo, saya ingin reservasi') }}" target="_blank" rel="noopener" class="btn">Reservasi via WhatsApp</a>
                @endif
            </div>
        @endif
    </div>
</section>
