@extends('layout.layout-admin')

@section('content')
<div class="wrapper">
<div class="page">
<h1>Страницы</h1>

<div class="card col-9 mb-3 p-3 ">
<form>
	<div class="form-group">
		<label class="card-title" for="exampleInputEmail1">Заголовок</label>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="text" class="form-control" aria-describedby="title" name="title" placeholder="">
  	</div>
  	<div class="form-group">
		<label class="card-title "for="exampleInputEmail1">Контент</label>
		<textarea class="form-control" rows="5" name="body" aria-describedby="body"></textarea>
  	</div>
  	</form>
  	<button type="submit" onclick="addPage(this)" class="btn btn-primary">Создать</button>
</div>

<ul class="list-group col-9">
  <li v-for="p in pages" class="list-group-item list-group-item-action d-flex flex-column">
  	<div class="align-items-center d-flex w-100 justify-content-between">
		<h4>[( p.title )]</h4>
  		<div class="btns">
		  <button class="btn btn-link" onclick="window.location = '/page?id=[( p.id )]'">Перейти</button>
		  <button class="btn btn-secondary" onclick="editPage(this)">Редактировать</button>
		  <button class="btn btn-danger" onclick="removeIt(this)">Удалить</button>
  		</div>
  	</div>
  	<form class="d-none" action="/admin/pages" method="post">
  		<div class="form-group">
			<label for="exampleInputEmail1">Заголовок</label>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" value="[( p.id )]">
			<input type="text" class="form-control" aria-describedby="title" name="title" value="[( p.title )]">
	  	</div>
	  	<div class="form-group">
			<label for="exampleInputEmail1">Контент</label>
			<textarea class="form-control" name="body" rows="10" aria-describedby="body">[( p.content )]</textarea>
	  	</div>
	  	<button type="submit" onclick="sendPage(event)" class="btn btn-primary">Сохранить</button>
	  	<div class="alert alert-success alert-dismissible d-none mt-3" role="alert">
		  <strong>Успешно</strong>
		  <button type="button" class="close" onclick="this.parentElement.classList.remove('d-block')" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="alert alert-danger alert-dismissible d-none mt-3" role="alert">
		  <strong>Что-то пошло не так</strong>
		  <button type="button" class="close" onclick="this.parentElement.classList.remove('d-block')" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
  	</form>
  </li>
</ul>
</div>
</div>

<script>
	function addPage(btn) {
		let form = btn.previousElementSibling;
		let data = new FormData(form);
		fetch('/admin/pages/add',{
			'method': 'post',
			'body': data
		}).then(resp => resp.json()).then(resp => {
			let el = document.createElement('li');
			el.className = 'list-group-item list-group-item-action d-flex flex-column';
			el.innerHTML = `
				<div class="align-items-center d-flex w-100 justify-content-between">
					<h4>${resp.title}</h4>
			  		<div class="btns">
					  <button class="btn btn-link" >Перейти</button>
					  <button class="btn btn-secondary" onclick="editPage(this)">Редактировать</button>
					  <button class="btn btn-danger" onclick="removeIt(this)">Удалить</button>
			  		</div>
			  	</div>
			  	<form class="d-none" action="/admin/pages" method="post">
			  		<div class="form-group">
						<label for="exampleInputEmail1">Заголовок</label>
						<input type="hidden" name="_token" value="${resp._token}">
						<input type="hidden" name="id" value="${resp.id}">
						<input type="text" class="form-control" aria-describedby="title" name="title" value="${resp.title }">
				  	</div>
				  	<div class="form-group">
						<label for="exampleInputEmail1">Контент</label>
						<textarea class="form-control" name="body" rows="10" aria-describedby="body">${resp.body}</textarea>
				  	</div>
				  	<button type="submit" onclick="sendPage(event)" class="btn btn-primary">Сохранить</button>
				  	<div class="alert alert-success alert-dismissible d-none mt-3" role="alert">
					  <strong>Успешно</strong>
					  <button type="button" class="close" onclick="this.parentElement.classList.remove('d-block')" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="alert alert-danger alert-dismissible d-none mt-3" role="alert">
					  <strong>Что-то пошло не так</strong>
					  <button type="button" class="close" onclick="this.parentElement.classList.remove('d-block')" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
			  	</form>
			`;
			document.querySelector('.list-group').insertBefore(el, document.querySelector('.list-group').firstChild);
		}).catch(err => {
			console.log(err); 
		});
	}
	function editPage(btn) {
		btn.parentElement.parentElement.nextElementSibling.classList.add('d-block');
	}
	function sendPage(ev) {
		ev.preventDefault();
		form = ev.target.parentElement;
		let data = new FormData(form);
		fetch('/admin/pages',{
			'method': 'post',
			'body': data
		}).then(resp => resp.text()).then(resp => {
			form.querySelector('.alert-success').classList.add('d-block');
			setTimeout(()=>{form.querySelector('.alert-success').classList.remove('d-block');}, 2000)
		}).catch(err => {<link href="{{ asset('css/app.css') }}" rel="stylesheet">
			console.log(err); <link href="{{ asset('css/app.css') }}" rel="stylesheet">
			form.querySelector('.<link href="{{ asset('css/app.css') }}" rel="stylesheet">alert-danger').classList.add('d-block');
			setTimeout(()=>{form.<link href="{{ asset('css/app.css') }}" rel="stylesheet">querySelector('.alert-success').classList.remove('d-block');}, 2000)
		});<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	}<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	function removeIt(btn) {<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		form = btn.parentElement.<link href="{{ asset('css/app.css') }}" rel="stylesheet">parentElement.nextElementSibling;
		let data = new FormData(f<link href="{{ asset('css/app.css') }}" rel="stylesheet">orm);
		fetch('/admin/pages/remove',{
			'method': 'post',
			'body': data
		}).then(resp => resp.text()).then(resp => {
			form.parentElement.remove();
		}).catch(err => {
			console.log(err); 
		});
	}
</script>

@stop
