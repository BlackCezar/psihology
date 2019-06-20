@extends('layout.layout')

@section('content')
<div class="cont card" style="padding: 1.5vw">
<h2>Добро пожаловать в административную панель!</h2>
<p>Здесь вы можете управлять страницами, отзывами и вопросами</p>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link" id="nav-home-tab" @click="active = 0" :class="{ active: active == 0, show: active == 0}" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Добавить страницу</a>
    <a class="nav-item nav-link" id="nav-home-tab" @click="active = 3" :class="{ active: active == 3, show: active == 0}" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Страницы</a>
    <a class="nav-item nav-link" id="nav-profile-tab" @click="active = 1" :class="{ active: active == 1, show: active == 0}" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Вопросы</a>
    <a class="nav-item nav-link" id="nav-contact-tab" @click="active = 2" :class="{ active: active == 2, show: active == 0}" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Отзывы</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div  class="tab-pane fade  " :class="{ active: active == 0, show: active == 0}" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

  <form>
	<div class="form-group">
		<label class="card-title" for="exampleInputEmail1">Заголовок</label>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="text" class="form-control" aria-describedby="title" name="title" placeholder="">
  	</div>
  	<div class="form-group">
		<label class="card-title "for="exampleInputEmail1">Контент</label>
		<textarea class="form-control" rows="5" name="content" aria-describedby="body"></textarea>
      </div>
      <div class="form-group">
		<label class="card-title "for="exampleInputEmail1">Опубликован</label>
		<input type="checkbox" v-model="checkbox">
      </div>
      <div class="form-group">
		<label class="card-title "for="exampleInputEmail1">Рубрики</label>
		<input type="text" class="form-control" name="rubric">
      </div>
      <div class="form-group">
		<label class="card-title "for="exampleInputEmail1">Изображение</label>
		<input type="file" name="img">
      </div>
  	</form>
  	<button type="submit" onclick="addPage(this)" class="btn btn-primary">Создать</button>

  </div>
  <div :class="{ active: active == 1, show: active == 1}" class="tab-pane fade " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  
  <ul class="list-group">
  <li v-for="q in questions" class="list-group-item list-group-item-action d-flex flex-column">
  	<div class="align-items-center d-flex w-100 justify-content-between">
		<h4 >[( q.question  )]</h4>
  		<div class="btns " style="min-width: 25vw">
		  <button class="btn btn-square" data-type="q" :data-id="q.id" @click="changeStatus($event)">[( (q.status) ? 'Снять' : 'Опубликовать' )]</button>
		  <button class="btn btn-secondary" onclick="editPage(this)">Ответить</button>
		  <button class="btn btn-danger" :data-id="q.id" onclick="removeQ(this)">Удалить</button>
		  <form action="" hidden><input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" :value="q.id"></form>
  		</div>
  	</div>
  	<form class="d-none" action="/admin/pages" method="post">
	  <div class="form-group">
			<label for="exampleInputEmail1">Почта:</label>
			<div class="ss">[( q.email ? q.email : 'Нет почты'  )]</div>
	  	</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Имя:</label>
			<div class="ss">[( q.name ? q.name : 'Не указано' )]</div>
	  	</div>
		  <div class="form-group">
			<label for="exampleInputEmail1">Тема:</label>
			<div class="ss">[( q.subject ? q.subject : 'Не указана' )]</div>
	  	</div>
  		<div class="form-group">
			<label for="exampleInputEmail1">Ответ:</label>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" :value="q.id">
			<textarea class="form-control" name="body" rows="10" aria-describedby="body">[( q.ask )]</textarea>
	  	</div>
	  	<button type="submit" @click="saveIt($event)" :data-id="q.id" class="btn btn-primary">Сохранить</button>
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
  <div :class="{ active: active == 2, show: active == 2}" class="tab-pane fade " id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  <ul class="list-group">
  <li v-for="r in reviews" class="list-group-item list-group-item-action d-flex flex-column">
  	<div class="align-items-center d-flex w-100 justify-content-between">
		<h4>[( r.name )] - [( r.email )] - [( r.subject )]</h4>
  		<div class="btns">
		  <button class="btn btn-link" onclick="this.parentElement.parentElement.nextElementSibling.classList.toggle('d-none');">Прочитать</button>
		  <button class="btn btn-square" data-type="r" :data-id="r.id" @click="changeStatus($event)">[( (r.status) ? 'Снять' : 'Опубликовать' )]</button>
		  <button class="btn btn-danger" :data-id="r.id" @click="removeReview($event)">Удалить</button>
  		</div>
  	</div>
	<div class="d-none">[( r.msg )]</div>
  </li>
</ul>
  
  </div>

  <div :class="{ active: active == 3, show: active == 3}" class="tab-pane fade " id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">


  <ul class="list-group col-9">
  <li v-for="p in pages" class="list-group-item list-group-item-action d-flex flex-column">
  	<div class="align-items-center d-flex w-100 justify-content-between">
		<h4>[( p.title )]</h4>
  		<div class="btns">
		  <a class="btn btn-link" :href="'/page?id=' + p.id">Перейти</a>
		  <button class="btn btn-secondary" onclick="editPage(this)">Редактировать</button>
		  <button class="btn btn-danger" onclick="removeIt(this)">Удалить</button>
  		</div>
  	</div>
  	<form class="d-none" action="/admin/pages" method="post">
  		<div class="form-group">
			<label for="exampleInputEmail1">Заголовок</label>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" :value="p.id">
			<input type="text" class="form-control" aria-describedby="title" name="title" :value="p.title">
	  	</div>
	  	<div class="form-group">
			<label for="exampleInputEmail1">Контент</label>
			<textarea class="form-control" name="body" rows="10" aria-describedby="body">[( p.content )]</textarea>
          </div>
          <div class="form-group">
		<label class="card-title "for="exampleInputEmail1">Опубликован</label>
		<input type="checkbox" name="status">
      </div>
      <div class="form-group">
		<label class="card-title "for="exampleInputEmail1">Рубрики</label>
		<input type="text" class="form-control" name="rubric">
      </div>
      <div class="form-group">
		<label class="card-title "for="exampleInputEmail1">Изображение</label>
		<input type="file" name="img">
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
</div>

<script src="{{ asset('js/vue.js')  }}"></script>
<script>
let admin = new Vue({
    el: '.cont',
    delimiters: ['[(', ')]'],
    data: {
        active: 0,
        pages: [],
		reviews: [],
		questions: [],
		checkbox: false
    }, mounted: function() {
        fetch('/admin/pages').then(r => { return r.json() })
        .then(data => admin.pages = data);
		fetch('/admin/reviews').then(r => { return r.json() })
        .then(data => admin.reviews = data);
		fetch('/admin/questions').then(r => {return r.json()})
		.then(data => admin.questions = data).catch(err => console.log(err));
    }, methods: {
		removeReview: function(ev) {
			console.log(ev.target);
			fetch('/admin/reviews/remove', {
				method: "POST",
				body: JSON.stringify({id: ev.target.dataset.id})
			}).then(r => { return r.json() })
        .then(data => {
			for (el of admin.reviews) { 
				if (el.id == ev.target.dataset.id) { 
				let index = admin.reviews.indexOf(el); 
				console.log(el.id ); 
				admin.reviews.splice(index, 1); 
				} 
			}
		}).catch(err => console.log(err));
		},
		changeStatus: function(ev) {
			if (ev.target.dataset.type == 'r') {
				for (el of admin.reviews) { 
					if (el.id == ev.target.d+ataset.id) { 
						el.status = !el.status;
						fetch('/admin/reviews/changeStatus?id=' + ev.target.dataset.id + '&status=' + el.status)
						.then(r => {return r.json()}).then(r => {
							console.log('OK');
						}).catch(err => console.log(err))
					} 
			}
			} else if (ev.target.dataset.type == 'q') {
				for (el of admin.questions) { 
					if (el.id == ev.target.dataset.id) { 
						el.status = !el.status;
						fetch('/admin/questions/changeStatus?id=' + ev.target.dataset.id + '&status=' + el.status)
						.then(r => {return r.json()}).then(r => {
							console.log('OK');
						}).catch(err => console.log(err))
					} 
			}
			}
			
			
			console.log(ev.target.dataset.id);
		},saveIt : function(ev) {
			ev.preventDefault();
			let data = new FormData();
			let ta = ev.target.previousElementSibling.querySelector('textarea');
			data.append('_token', "{{ csrf_token() }}");
			data.append('ask', ta.value);
			data.append('id', ev.target.dataset.id);
			fetch('/admin/question/save', {
				method: 'POST',
				body: data
			}).then(r => {return r.json()})
			.then(r => console.log(r));
		}
	}
})
function editPage(btn) {
    btn.parentElement.parentElement.nextElementSibling.classList.add('d-block');
}

function sendPage(ev) {
		ev.preventDefault();
		form = ev.target.parentElement;
		let data = new FormData(form);
		fetch('/admin/pages/add',{
			'method': 'post',
			'body': data
		}).then(resp => {return resp.json()})
		.then(resp => {
			console.log(resp);
			form.querySelector('.alert-success').classList.add('d-block');
			setTimeout(()=>{form.querySelector('.alert-success').classList.remove('d-block');}, 2000)
		}).catch(err => {
			console.log(err);
			form.querySelector('.alert-danger').classList.add('d-block');
			setTimeout(()=>{form.querySelector('.alert-success').classList.remove('d-block');}, 2000)
		});
	}
	function removeIt(btn) {
		form = btn.parentElement.parentElement.nextElementSibling;
		let data = new FormData(form);
		fetch('/admin/pages/remove',{
			'method': 'post',
			'body': data
		}).then(resp => resp.text()).then(resp => {
			form.parentElement.remove();
		}).catch(err => {
			console.log(err); 
		});
	}

	function removeQ(btn) {
		form = btn.nextElementSibling;
		let data = new FormData(form);
		fetch('/admin/questions/remove',{
			'method': 'post',
			'body': data
		}).then(resp => resp.text()).then(resp => {
			console.log(form);
			admin.questions.forEach(el => {
				if (el.id == ev.target.dataset.id) { 
				let index = admin.reviews.indexOf(el); 
				console.log(el.id); 
				admin.reviews.splice(index, 1); 
				} 
			})
		}).catch(err => {
			console.log(err); 
		});
	}
	function addPage(btn) {
		let form = btn.previousElementSibling;
		let data = new FormData(form);
		data.append('status', admin.checkbox)
		fetch('/admin/pages/add',{
			'method': 'post',
			'body': data
		}).then(resp => resp.json()).then(resp => {
			console.log(resp);
			data.id = resp;
			admin.pages.push(data);
			form.reset();
		}).catch(err => {
			console.log(err); 
		});
	}

</script>
@stop
