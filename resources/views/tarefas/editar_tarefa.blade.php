@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tarefas') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/update/{{ $tarefa->id }}">
                            @csrf

                            <div class="form-group row">
                                <label for="titulo"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Título') }}</label>

                                <div class="col-md-6">
                                    <input id="titulo" type="text"
                                           class="form-control @error('titulo') is-invalid @enderror" name="titulo"
                                           value="{{ $tarefa->titulo }}" required autocomplete="titulo" autofocus>

                                    @error('titulo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="data"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Data Conclusão') }}</label>

                                <div class="col-md-6">
                                    <input id="data" type="data"
                                           class="form-control @error('data') is-invalid @enderror" name="data"
                                           value="{{ $tarefa->data }}" required autocomplete="data">

                                    @error('data')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dono"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Dono da tarefa') }}</label>

                                <div class="col-md-6">
                                    <select id="dono_id" name="dono_id" class="form-control" aria-label="Dono">          
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($user->id == $id_user) selected @endif>{{ $user->name }}</option>                                          
                                        @endforeach                                    
                                    </select>                                                                                                   
                                    @error('dono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                                <div class="col-md-6">
                                    <select id="status" name="status" class="form-control" aria-label="Status">
                                        <option value="Aberta" @if ($tarefa->status == "aberta") selected @endif>Aberta</option>
                                        <option value="Desenvolvimento" @if ($tarefa->status == "desenvolvimento") selected @endif>Desenvolvimento</option>
                                        <option value="Concluída" @if ($tarefa->status == "concluída") selected @endif>Concluída</option>
                                        <option value="Em atraso" @if ($tarefa->status == "em atraso") selected @endif>Em atraso</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descricao"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                                <div class="col-md-6">
                                    <textarea id="descricao" type="descricao"
                                              class="form-control @error('descricao') is-invalid @enderror"
                                              name="descricao" value="{{ old('descricao') }}" required
                                              autocomplete="descricao" rows="3">{{ $tarefa->descricao }}</textarea>

                                    @error('descricao')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Atualizar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
