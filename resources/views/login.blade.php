@extends('layouts.base')

@section('content')
    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Endereço de email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autofocus required>
            <div id="emailHelp" class="form-text">Nós nunca compartilharemos seus dados com mais ninguém.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Lembrar dos meus dados</label>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
@endsection
