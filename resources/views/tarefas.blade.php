<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas - listatarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 650px;">
        <div class="card shadow-sm p-4">
            <h2 class="text-center text-primary mb-4">Minhas Tarefas</h2>
            
            <form action="/tarefas" method="POST" class="d-flex mb-4">
                @csrf
                <input type="text" name="titulo" class="form-control me-2" placeholder="Digite uma nova tarefa..." required>
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </form>

            <ul class="list-group">
                @forelse($tarefas as $tarefa)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="{{ $tarefa->concluida ? 'text-decoration-line-through text-muted' : '' }}">
                            {{ $tarefa->titulo }}
                        </span>
                        
                        <div class="d-flex gap-2">
                            <form action="/tarefas/{{ $tarefa->id }}/alternar" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn {{ $tarefa->concluida ? 'btn-secondary' : 'btn-success' }} btn-sm">
                                    {{ $tarefa->concluida ? 'Reabrir' : 'Concluir' }}
                                </button>
                            </form>

                            <form action="/tarefas/{{ $tarefa->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-center text-muted">Nenhuma tarefa cadastrada no momento.</li>
                @endforelse
            </ul>
        </div>
    </div>
</body>
</html>