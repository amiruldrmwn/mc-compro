<ul class="space-y-3 {{ $class ?? '' }}">
    @if ($site->get('address'))
        <li>{!! nl2br(e($site->get('address'))) !!}</li>
    @endif
    @if ($site->get('contact_phone'))
        <li><a href="tel:{{ preg_replace('/[^0-9+]/', '', $site->get('contact_phone')) }}" class="hover:underline">{{ $site->get('contact_phone') }}</a></li>
    @endif
    @if ($site->get('whatsapp'))
        <li><a href="{{ $site->whatsappUrl() }}" target="_blank" rel="noopener" class="hover:underline">WhatsApp: {{ $site->get('whatsapp') }}</a></li>
    @endif
    @if ($site->get('contact_email'))
        <li><a href="mailto:{{ $site->get('contact_email') }}" class="hover:underline">{{ $site->get('contact_email') }}</a></li>
    @endif
</ul>
