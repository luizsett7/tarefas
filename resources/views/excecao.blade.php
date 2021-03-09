@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Desculpe pelo transtorno</h3>
        <h4>Ocorreu o erro: {{ $excecao }}</h4>
        <h5>Por favor entre em contato com o suporte: <a href="mailto:teste@teste.com">enviar e-mail </a></h5>
    </div>
@endsection
