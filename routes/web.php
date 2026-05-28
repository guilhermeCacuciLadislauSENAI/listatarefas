<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

Route::get('/', [TarefaController::class, 'index']);
Route::post('/tarefas', [TarefaController::class, 'store']);
Route::delete('/tarefas/{tarefa}', [TarefaController::class, 'destroy']);

// Nova rota para marcar/desmarcar como concluída
Route::patch('/tarefas/{tarefa}/alternar', [TarefaController::class, 'alternarConclusao']);