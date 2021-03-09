<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HomeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Mail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function editar_cadastro()
    { 
        try {
            if (Auth::check()) {
                $user = User::find(Auth::id());
                return view('auth.editar_cadastro')->with('user',$user);
            }else{
                return view('auth.login');
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            return view('excecao')->with('excecao',$ex->getMessage());          
        }
    }

    public function update_cadastro(HomeRequest $request)
    {
        try {
            if (Auth::check()) {
                User::find(Auth::id())->update(
                    [
                        'name' => $request['name'],
                        'cpf' => $request['cpf'],
                        'email' => $request['email'],
                        'telefone' => $request['telefone'],
                        'password' => Hash::make($request['password'])]
                );
                return redirect()->route('lista_tarefa');
            }else{
                return view('auth.login');
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            return view('excecao')->with('excecao',$ex->getMessage());          
        }
    }

    public function recuperar()
    {
        return view('recuperar_senha');
    }

    public function enviar_email(Request $request)
    {
        try {
            $user = DB::table('users')->where('cpf', "$request->cpf")->first();
            if($user){               
                $senha_temporaria = "654321";
                $data = array('senha_temporaria'=>"654321");
                $senha = Hash::make($senha_temporaria);
                User::where('cpf', $request->cpf)
                ->update(['password' => $senha]);
                Mail::send(['text'=>'email'], $data, function($message) {
                    $message->to('luizsett7@gmail.com', 'Tutorials Point')->subject
                        ('Laravel Basic Testing Mail');
                    $message->from('luizsett7@gmail.com','Virat Gandhi');
                });
            }else{
                return view('excecao')->with('excecao',"Usuário não existe"); 
            }       
        } catch(\Illuminate\Database\QueryException $ex){ 
            return view('excecao')->with('excecao',$ex->getMessage());          
        }
    }
}
