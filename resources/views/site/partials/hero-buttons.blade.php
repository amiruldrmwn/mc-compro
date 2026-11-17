@if (($d['button_label'] && $d['button_url']) || ($d['button2_label'] && $d['button2_url']))
    <div class="mt-9 flex flex-wrap gap-3 {{ $class ?? '' }}">
        @if ($d['button_label'] && $d['button_url'])<a href="{{ $d['button_url'] }}" class="btn {{ $primary ?? '' }}">{{ $d['button_label'] }}</a>@endif
        @if ($d['button2_label'] && $d['button2_url'])<a href="{{ $d['button2_url'] }}" class="btn {{ $secondary ?? 'btn-outline' }}">{{ $d['button2_label'] }}</a>@endif
    </div>
@endif
