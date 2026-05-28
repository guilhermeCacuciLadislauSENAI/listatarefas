<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index(Request $request) 
    {
        // Captura o termo de busca, se houver
        $search = $request->query('search');
        
        if ($search) {
            $tarefas = Tarefa::where('titulo', 'like', "%{$search}%")->get();
        } else {
            $tarefas = Tarefa::latest()->get(); // Traz as mais recentes primeiro
        }

        // Cálculos para o Dashboard (independente da busca)
        $total = Tarefa::count();
        $concluidas = Tarefa::where('concluida', true)->count();
        $pendentes = $total - $concluidas;
        
        // Evita divisão por zero
        $progresso = $total > 0 ? round(($concluidas / $total) * 100) : 0;

        return view('tarefas', compact('tarefas', 'total', 'concluidas', 'pendentes', 'progresso', 'search'));
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

    public function alternarConclusao(Tarefa $tarefa) 
    {
        $tarefa->concluida = !$tarefa->concluida;
        $tarefa->save();
        
        return redirect('/');
    }
}