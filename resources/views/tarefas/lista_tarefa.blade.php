@extends('layouts.app')

@section('content')
<style>.container{max-width: 1400px;}</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tarefas') }}</div>

                    <div class="card-body">
                        Tarefas do Colaborador: {{ Auth::user()->name }}
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Título</th>
                            <th scope="col">Data</th>
                            <th scope="col">Status</th>
                            <th scope="col">Colaborador</th>
                            <th scope="col">Detalhes</th>
                            <th scope="col">Alterar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tarefas as $tarefa)
                            <tr>
                                <th scope="row">{{ $tarefa->id }}</th>
                                <td>{{ $tarefa->titulo }}</td>
                                <td>{{ $tarefa->data }}</td>
                                <td>
                                    <select id="status" name="status" class="form-control" aria-label="Status">                                        
                                        <option value="Aberta" @if ($tarefa->status == "aberta") selected @endif>Aberta</option>
                                        <option value="Desenvolvimento" @if ($tarefa->status == "desenvolvimento") selected @endif>Desenvolvimento</option>
                                        <option value="Concluída" @if ($tarefa->status == "Concluída") selected @endif>Concluída</option>
                                        <option value="Em atraso" @if ($tarefa->status == "Em atraso") selected @endif>Em atraso</option>
                                      </select>                                    
                                </td>
                                <td>
                                    <select id="dono" name="dono_id" class="form-control" aria-label="Dono">          
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($user->id == Auth::user()->id) selected @endif>{{ $user->name }}</option>                                          
                                        @endforeach                                    
                                    </select>  
                                </td>
                                <td><i class="fas fa-info"></i></td>
                                <td><i class="fas fa-pencil-alt"></i></td>
                                <td><i class="far fa-trash-alt"></i></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>  
                    {{ $tarefas->links() }}                  
                </div>                
            </div>
        </div>
    </div>    
</div>
<script>
    $(document).ready(function(){
        $('select').on('change', function() {
            window.location.href = "http://localhost:8000/tarefa_colaborador/"+this.value;
        });
    });
</script>
@endsection
