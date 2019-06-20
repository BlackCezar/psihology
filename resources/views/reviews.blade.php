@extends('layout.layout')

@section('content')

<div class="cont reviews card">
    <div class="reviews-bl">
@foreach ($reviews as $r)
    @if ($r->status)
    <div class="r">
        <div class="msg">{{ $r->msg }}</div>
        <div class="name">{{ $r->name }}</div>
        <div class="separator"></div>
    </div>
    @endif
  @endforeach
  </div>
  <h2>Оставить свой отзыв</h2>
    <form action="">
    <div class="form-group">
        <label for="exampleInputEmail1">Ваше имя*</label>
        <input type="text" class="form-control" name="name" placeholder="Иванов Иван">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Ваше почта*</label>
        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="mail@mail.ru">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Тема</label>
        <input type="text" class="form-control" name="subject" placeholder="Благодарность за...">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Сообщение*</label>
        <textarea class="form-control" name="msg"></textarea>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <small id="emailHelp" class="form-text text-muted">* - обязательные поля</small>
    <button type="submit" onclick="sendReview(event)" class="btn btn-primary">Отправить</button>
    </form>
    <div class="alert alert-success col-3 alert-dismissible d-none mt-3" role="alert">
		  <strong>Успешно</strong>
		  <button type="button" class="close" onclick="this.parentElement.classList.toggle('d-none')" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="alert alert-danger colr-3 alert-dismissible d-none mt-3" role="alert">
		  <strong>Что-то пошло не так</strong>
		  <button type="button" class="close" onclick="this.parentElement.classList.toggle('d-none')" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
</div>
<script>
function sendReview(event) {
    btn = event.target;
    event.preventDefault();
    let form = btn.parentElement;
    let data = new FormData(form);
    fetch('/admin/reviews/add',{
        'method': 'post',
        'body': data
    }).then(resp => resp.json()).then(resp => {
        console.log(resp);
        document.querySelector('.alert-success').classList.toggle('d-none');
        form.reset();
    }).catch(err => {
        document.querySelector('.alert-danger').classList.toggle('d-none');
        console.log(err); 
    });
}

</script>
@stop
