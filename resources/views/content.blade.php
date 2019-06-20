@extends('layout.layout')

@section('content')
<div class="cont card">
<div class="new">
	<div class="date">{{ substr($page->date, 0, 10) }}</div>
	<h2 class="new-title">{{ $page->title }}</h2>
	<div class="new-header"><div class="author">Автор: {{ $page->author }}</div><div class="rubric">Рубрики: {{ $page->rubric }}</div></div>
	<div class="new-img"><img src="{{ $page->img }}" alt=""></div>
	<div class="new-body full">{!! $page->content !!}</div>
	<a href="/">Назад</a>
</div>
</div>


@stop







