@extends('layouts.app')

@section('content')
<style>
    .container{max-width: 1400px;}
    a{color:#000;}
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tarefas') }}</div>

                    <div class="card-body">
                        @if(@isset($usuario->name))
                            Tarefas do colaborador <b>{{ $usuario->name }}</b> vinculadas ao colaborador <b>{{ Auth::user()->name }}</b>
                        @else
                            Tarefas do Colaborador <b>{{ Auth::user()->name }}</b>
                        @endif                        
                    <table class="table" id="table">
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
                        @forelse ($tarefas as $tarefa) 
                            <tr>
                                <th scope="row">{{ $tarefa->id }}</th>
                                <td>{{ $tarefa->titulo }}</td>
                                <td>{{ \Carbon\Carbon::parse($tarefa->data)->format('d/m/Y')}}</td>
                                <td>
                                    <select id="status" name="status" class="status+{{ $tarefa->id }} select-status form-control" aria-label="Status">                                        
                                        <option value="Aberta" @if ($tarefa->status == "Aberta") selected @endif>Aberta</option>
                                        <option value="Desenvolvimento" @if ($tarefa->status == "Desenvolvimento") selected @endif>Desenvolvimento</option>
                                        <option value="Concluída" @if ($tarefa->status == "Concluída") selected @endif>Concluída</option>
                                        <option value="Em atraso" @if ($tarefa->status == "Em atraso") selected @endif>Em atraso</option>
                                      </select>                                    
                                </td>
                                <input type="hidden" id="tarefa+{{ $tarefa->id }}" name="tarefa" value="{{ $tarefa->id }}" />
                                <td>
                                    <select id="dono_id" name="dono_id" class="dono_id form-control" aria-label="Dono">          
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($user->id == $tarefa->dono_id) selected @endif>{{ $user->name }}</option>                                          
                                        @endforeach                                    
                                    </select>  
                                </td>
                                <td style="text-align: center"><a href="#" onclick="openModal('{{ $tarefa->id }}')"><i class="fas fa-info"></i></a></td>
                                <td style="text-align: center"><a href="#" onclick="alterar_tarefa('{{ $tarefa->id }}')"><i class="fas fa-pencil-alt"></i></a></td>
                                <td style="text-align: center"><a href="#" onclick="deletar_tarefa('{{ $tarefa->id }}')"><i class="far fa-trash-alt"></i></a></td>
                            </tr>
                        @empty
                            <div style="float: right; margin-right: 30px;"><span style="font-size: 20px; font-weight: bold; float: left;">Lista Vazia</span><a style="font-size: 20px; float: left; margin-left: 10px;" href="/nova_tarefa">Adicionar Tarefa</a></div>                        
                        @endforelse
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
    termo = window.location.search;    
    termo = termo.substring(9,13);
    if(termo == "true"){      
        $("#mensagem_sucesso").modal();
    }
    $('#mensagem_sucesso').on('hidden.bs.modal', function () {        
        var url = window.location.protocol + "//" + window.location.host + window.location.pathname;        
        window.location.href = url;     
    });
});
</script>
<div class="modal fade" id="mensagem_sucesso" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Aviso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           Operação realizada com sucesso.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>          
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tarefa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            ID: <span id="id_tarefa"></span><br />
            Título: <span id="titulo_tarefa"></span><br />
            Data: <span id="data_tarefa"></span><br />
            Status: <span id="status_tarefa"></span><br />
            Colaborador: <span id="colaborador_tarefa"></span><br />
            Descrição: <span id="descricao_tarefa"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>          
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Erro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           Desculpe mas não foi possível atender a requisição.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>          
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
        $('.dono_id').on('change', function() {
            window.location.href = "http://localhost:8000/lista_tarefa/"+this.value+"?success=true";                          
        });                         
    });    
    $('.select-status').on('change', function() {                  
        id = $(this).attr('class');
        result = id.substring(7,9);
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                type:'POST',
                url:"{{ route('alterar_status') }}",
                data:{status: this.value, id_tarefa: result},
                dataType: "text",           
                success:function(data){                         
                    Swal.fire(
                    'Status Alterado com sucesso!',
                    )
                },
                error: function (request, status, error) {
                        $('#errorModal').modal();
                }
                });   
        });        
    function alterar_tarefa(id_tarefa){      
        let id_user = $('select[name=dono_id] option').filter(':selected').val();  
        window.location.href = "http://localhost:8000/editar_tarefa/"+id_tarefa+"/"+id_user;
    }
    function deletar_tarefa(id_tarefa){  
        Swal.fire({
            title: 'Você está certo disso?',
            text: "Tem certeza que deseja deletar?",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, tenho certeza!',
            cancelButtonText: 'Sair'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                    type:'POST',
                    url:"{{ route('deletar') }}",
                    data:{id_tarefa: id_tarefa},
                    dataType: "text",           
                    success:function(data){
                        Swal.fire({
                            title: 'Tarefa apagada com sucesso!',
                            confirmButtonText: `Ok`,
                            }).then((result) => {
                                location.reload();
                        })                                                                                          
                    },
                    error: function (request, status, error) {
                        $('#errorModal').modal();
                    }
                    });                
                }                
        })        
    }
    function openModal(id_tarefa){         
        $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });        
        $.ajax({
           type:'POST',
           url:"{{ route('modal_tarefa') }}",
           data:{id_tarefa: id_tarefa, id_colaborador: $(".dono_id option:selected" ).val()},
           dataType: "text",           
           success:function(data){ 
                data = JSON.parse(data);                
                $("#id_tarefa").text(data[0].id);
                $("#titulo_tarefa").text(data[0].titulo);
                let date = new Date(data[0].data);
                let dataFormatada = ((date.getDate() + 1)) + "/" + ((date.getMonth() + 1)) + "/" + date.getFullYear(); 
                $("#data_tarefa").text(dataFormatada);
                $("#status_tarefa").text(data[0].status);
                $("#colaborador_tarefa").text(data[0].colaborador);
                $("#descricao_tarefa").text(data[0].descricao);
                $('#exampleModalCenter').modal();
           },
           error: function (request, status, error) {
                $('#errorModal').modal();
            }
        });                
    }  
</script>
@endsection
