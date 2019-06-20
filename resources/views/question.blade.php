@extends('layout.layout')

@section('content')

<div class="cont questions card">

<div id="accordion" role="tablist" aria-multiselectable="true">
	@foreach ($questions as $q)
  @if ($q->status)
  <div class="card">
    <div class="card-header" role="tab" id="heading{{ $q->id }}">
      <h5 class="mb-0">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $q->id }}" aria-expanded="true" aria-controls="collapse{{ $q->id }}">
          <i class="far fa-plus"></i>{{ $q->question }}
        </a>
      </h5>
    </div>

    <div id="collapse{{ $q->id }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $q->id }}">
      <div class="card-block">
        {{ $q->ask }}
      </div>
    </div>
  </div>
  @endif
  @endforeach
</div>
<h2 class="mt-3">Задать свой вопрос</h2>
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
        <textarea class="form-control" name="question"></textarea>
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
    fetch('/admin/questions/add',{
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@stop
