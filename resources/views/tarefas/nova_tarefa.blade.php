@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tarefas') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('salvar_tarefa') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="titulo"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Título') }}</label>

                                <div class="col-md-6">
                                    <input id="titulo" type="text"
                                           class="form-control @error('titulo') is-invalid @enderror" name="titulo"
                                           value="{{ old('titulo') }}" required autocomplete="titulo" autofocus>

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
                                           class="date form-control @error('data') is-invalid @enderror" name="data"
                                           value="{{ old('data') }}" onfocusout="verifica_data()" required autocomplete="data">

                                    <span class="invalid-feedback" id="data-invalida" style="display: none;" role="alert">
                                            <strong>Data inválida</strong>
                                    </span>
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
                                    <select id="dono" name="dono_id" class="form-control" aria-label="Dono">          
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($user->id == Auth::user()->id) selected @endif>{{ $user->name }}</option>                                          
                                        @endforeach                                    
                                    </select>                                                                                                    
                                    @error('dono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="pai_id" id="pai_id" value="{{ Auth::user()->id }}" />
                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                                <div class="col-md-6">
                                    <select id="status" name="status" class="form-control" aria-label="Status">
                                      <option value="Aberta" selected>Aberta</option>
                                      <option value="Desenvolvimento">Desenvolvimento</option>
                                      <option value="Concluída">Concluída</option>
                                      <option value="Em atraso">Em atraso</option>
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
                                              autocomplete="descricao" rows="3"></textarea>

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
                                        {{ __('Cadastrar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function verifica_data(){            
            var dateRegex = /^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-.\/])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/;
            if(dateRegex.test($("#data").val()) === false){                
                $("#data-invalida").show();
                $("#data").val("");
                $("#data").focus();
            }else{
                $("#data-invalida").hide();
            }
        }
    </script>
@endsection
