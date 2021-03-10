<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TarefaRequest;
use App\Models\User;
use App\Models\Tarefa;
use Illuminate\Support\Facades\DB;
use Auth;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        try {
            if (Auth::check()) {
                $users = User::all();            
                $tarefas = DB::table('tarefas')->where('dono_id', Auth::user()->id)->simplePaginate(5);            
                return view('tarefas.lista_tarefa')->with('tarefas', $tarefas)->with('users',$users);
            }else{
                return view('auth.login');
            }       
        } catch(\Illuminate\Database\QueryException $ex){ 
            return view('excecao')->with('excecao',$ex->getMessage());          
        }
    }

    public function modal_tarefa(Request $request)
    {
        try {
            if (Auth::check()) {
                $colaborador = $request->id_colaborador;
                $tarefa = DB::table('tarefas')
                ->join('users', 'users.id' , '=', 'tarefas.dono_id')
                ->select('tarefas.id', 'tarefas.titulo',  'tarefas.data', 'tarefas.status', 'users.id as user_id',  'users.name as colaborador')
                ->where('users.id', '=', $colaborador)
                ->get();
                return $tarefa;
            }else{
                return view('auth.login');
            }       
        } catch(\Illuminate\Database\QueryException $ex){ 
            return view('excecao')->with('excecao',$ex->getMessage());          
        }
    }

    public function deletar(Request $request){
        try {
            if (Auth::check()) {
                $tarefa = Tarefa::find($request->id_tarefa);
                $tarefa->delete();
            }else{
                return view('auth.login');
            }       
        } catch(\Illuminate\Database\QueryException $ex){ 
            return view('excecao')->with('excecao',$ex->getMessage());          
        }
    }

    public function tarefa_colaborador(Request $request, $id)
    {
        try {
            if (Auth::check()) {
                $users = User::all();  
                $id_user = $request->route('id');
                $tarefas = DB::table('tarefas')->where('dono_id', $id)->simplePaginate(5);
                return view('tarefas.tarefa_colaborador')->with('tarefas', $tarefas)->with('users',$users)->with('id_user',$id_user);
            }else{
                return view('auth.login');
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            return view('excecao')->with('excecao',$ex->getMessage());          
        }
    }

    public function editar_tarefa(Request $request, $id)
    { 
        try {
            if (Auth::check()) {
                $users = User::all();  
                $id_user = $request->route('id_user');
                $tarefa = Tarefa::find($request->route('id'));
                return view('tarefas.editar_tarefa')->with('tarefa', $tarefa)->with('users',$users)->with('id_user',$id_user);
            }else{
                return view('auth.login');
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            return view('excecao')->with('excecao',$ex->getMessage());          
        }
    }

    public function nova_tarefa(){
        if (Auth::check()) {
            $users = User::all();
            return view('tarefas.nova_tarefa')->with('users', $users);
        }else{
            return view('auth.login');
        }
    }

    public function alterar_status(Request $request){
        try {
            if (Auth::check()) {
                Tarefa::where('id', $request->id_tarefa)
                ->update(['status' => $request->status]);
                return view('tarefas.lista_tarefa');
            }else{
                return view('auth.login');
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            return view('excecao')->with('excecao',$ex->getMessage());          
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TarefaRequest $request)
    {
        Tarefa::create($request->all());
        return redirect()->route('lista_tarefa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TarefaRequest $request, $id)
    {
        Tarefa::find($id)->update($request->all());
        return redirect()->route('lista_tarefa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}