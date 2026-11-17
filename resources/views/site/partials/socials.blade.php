@php($labels = ['instagram' => 'Instagram', 'facebook' => 'Facebook', 'linkedin' => 'LinkedIn', 'youtube' => 'YouTube', 'tiktok' => 'TikTok', 'x' => 'X'])
@foreach ($site->socials() as $network => $link)
    <a href="{{ $link }}" target="_blank" rel="noopener" class="{{ $class ?? '' }}">{{ $labels[$network] }}</a>
@endforeach
