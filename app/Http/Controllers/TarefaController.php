<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index() 
    {
        $tarefas = Tarefa::all();
        return view('tarefas', compact('tarefas'));
    }

    public function store(Request $request) 
    {
        $request->validate(['titulo' => 'required|max:255']);
        Tarefa::create(['titulo' => $request->titulo]);
        return redirect('/');
    }

    public function destroy(Tarefa $tarefa) 
    {
        $tarefa->delete();
        return redirect('/');
    }

    // Nova função para atualizar o status no banco de dados
    public function alternarConclusao(Tarefa $tarefa) 
    {
        $tarefa->concluida = !$tarefa->concluida;
        $tarefa->save();
        
        return redirect('/');
    }
}