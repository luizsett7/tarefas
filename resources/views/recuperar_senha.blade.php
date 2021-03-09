@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Esqueci minha senha') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="container">
                            <form method="POST" action="{{ route('enviar_email') }}">
                                @csrf
                                    <div class="row">
                                    <div class="col-sm">
                                        <label for="cpf" class="col-form-label text-md-right">{{ __('CPF') }}</label>                                            
                                            <input id="cpf" class="form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}" required autocomplete="cpf">
                                            @error('cpf')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group row mb-0" style="margin-top: 35px">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Enviar') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>                            
                                    </div>
                            </form>
                          </div>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function cadastrar(){
        window.location.href = "http://localhost:8000/register";
    }
    function recuperar_senha(){
        window.location.href = "http://localhost:8000/recuperar";
    }
</script>
@endsection
