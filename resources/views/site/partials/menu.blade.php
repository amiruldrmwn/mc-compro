@foreach ($menu as $item)
    <a href="{{ $item->url() }}" class="nav-link {{ $class ?? '' }}" @if ($page && $page->id === $item->id) aria-current="page" @endif>{{ $item->title }}</a>
@endforeach
