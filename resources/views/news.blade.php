@extends('layout.layout')

@section('content')
<div class="wrapper">
	<h2>Новости</h2>
	<div class="news">
	@foreach ($news as $new) 
	    <div class="new">
		<div class="row">
		    <div class="date">{{ $new->date }}</div><div class="theme">{{ $new->title }}</div>
		</div>
		<div class="desc">{{ $new->body }}</div>
		<a href="/news/{{$new->id}}">Подробнее</a>
	    </div>
	@endforeach
	</div>
</div>


@stop
