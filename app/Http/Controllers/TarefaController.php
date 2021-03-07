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
        $users = User::all();
        $tarefas = DB::table('tarefas')->where('dono_id', Auth::user()->id)->simplePaginate(5);
        return view('tarefas.lista_tarefa')->with('tarefas', $tarefas)->with('users',$users);
    }

    public function modal_tarefa(Request $request)
    {

        $tarefa = DB::table('tarefas')->where('id', $request->id_tarefa)->get();    
        return $tarefa;
    }

    public function tarefa_colaborador(Request $request, $id)
    {
        $users = User::all();  
        $id_user = $request->route('id');
        $tarefas = DB::table('tarefas')->where('dono_id', $id)->simplePaginate(5);
        return view('tarefas.tarefa_colaborador')->with('tarefas', $tarefas)->with('users',$users)->with('id_user',$id_user);
    }

    public function nova_tarefa(){
        $users = User::all();
        return view('tarefas.nova_tarefa')->with('users', $users);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
