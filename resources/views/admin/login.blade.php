@extends('layout.layout')

@section('content')
<div class="page card m-3">
    <h1 class="h1 mt-3 ml-3">Авторизация</h1>
<form method="POST" action="/auth/register" class="col-6 d-flex flex-column m-3">
  {!! csrf_field() !!}
    <div class="form-group d-flex flex-column">
        <label for="exampleInputEmail1">E-mail</label>
        <input type="text" class="col-6" name="name" value="{{ old('name') }}">
    </div>
    <div class="form-group d-flex flex-column">
        <label for="exampleInputEmail1">Пароль</label>
        <input type="text" class="col-6" name="name" value="{{ old('name') }}">
    </div>
    <div class="form-group d-flex flex-column">
        <label for="exampleInputEmail1"><input type="checkbox" name="remember"> Remember Me</label>
    </div>
  
    <button type="submit" class="btn btn-primary col-6">Войти</button>
</form>
</div>
@stop