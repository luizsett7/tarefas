<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HomeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome()
    {
        return view('adminHome');
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
        User::find(Auth::id())->update(
            [
                'name' => $request['name'],
                'cpf' => $request['cpf'],
                'email' => $request['email'],
                'telefone' => $request['telefone'],
                'password' => Hash::make($request['password'])]
        );
        return redirect()->route('lista_tarefa');
    }

}
