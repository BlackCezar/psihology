@extends('layout.layout')

@section('content')

<div class="cont card">
@foreach ($pages as $page)
<div class="new">
	<div class="date">{{ substr($page->date, 0, 10) }}</div>
	<h2 class="new-title">{{ $page->title }}</h2>
	<div class="new-header"><div class="author">Автор: {{ $page->author }}</div><div class="rubric">Рубрики: {{ $page->rubric }}</div></div>
	<div class="new-img"><img src="{{ $page->img }}" alt=""></div>
	<div class="new-body">{!! $page->content !!}</div>
	<a href="/page?id={{ $page->id }}">Подробнее</a>
</div>
@endforeach
<div class="paginate">
{{ $pages->render() }}
</div>

</div>
@stop
