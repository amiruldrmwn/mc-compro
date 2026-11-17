@extends('site.layout')

@section('content')
    @foreach ($page->sections as $index => $section)
        @includeFirst(["site.themes.{$theme}.sections.{$section['type']}", "site.sections.{$section['type']}"], ['d' => $section['data'], 'sectionId' => $section['id'], 'index' => $index])
    @endforeach
@endsection
