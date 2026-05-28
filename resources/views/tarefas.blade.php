<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Tarefas - listatarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="bg-dark text-white py-4 mb-4 shadow">
        <div class="container text-center">
            <h1 class="fw-bold m-0">⚡ TaskFlow</h1>
            <p class="text-muted small mb-0">Seu gerenciador pessoal de alta performance</p>
        </div>
    </div>

    <div class="container" style="max-width: 700px;">
        
        <div class="row g-3 mb-4 text-center">
            <div class="col-4">
                <div class="card border-0 shadow-sm bg-white p-3">
                    <span class="text-muted d-block small fw-bold">TOTAL</span>
                    <span class="fs-3 fw-bold text-dark">{{ $total }}</span>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-0 shadow-sm bg-white p-3">
                    <span class="text-muted d-block small fw-bold">PENDENTES</span>
                    <span class="fs-3 fw-bold text-warning">{{ $pendentes }}</span>
                </div>
            </div>
            <div class="col-4">
                <div class="card border-0 shadow-sm bg-white p-3">
                    <span class="text-muted d-block small fw-bold">CONCLUÍDAS</span>
                    <span class="fs-3 fw-bold text-success">{{ $concluidas }}</span>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-3 mb-4">
            <div class="d-flex justify-content-between mb-1">
                <span class="small text-muted fw-bold">Progresso Geral</span>
                <span class="small text-primary fw-bold">{{ $progresso }}%</span>
            </div>
            <div class="progress" style="height: 12px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                     role="progressbar" 
                     style="width: {{ $progresso }}%;" 
                     aria-valuenow="{{ $progresso }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 mb-4">
            <h5 class="fw-bold mb-3">O que você vai fazer hoje?</h5>
            
            <form action="/tarefas" method="POST" class="d-flex mb-3">
                @csrf
                <input type="text" name="titulo" class="form-control me-2" placeholder="Nova tarefa..." required>
                <button type="submit" class="btn btn-primary px-4">Adicionar</button>
            </form>

            <hr class="text-muted opacity-25">

            <form action="/" method="GET" class="d-flex">
                <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm me-2" placeholder="Buscar tarefa por nome...">
                @if($search)
                    <a href="/" class="btn btn-outline-secondary btn-sm me-2">Limpar</a>
                @endif
                <button type="submit" class="btn btn-secondary btn-sm px-3">Buscar</button>
            </form>
        </div>

        <div class="card border-0 shadow-sm p-3">
            <h6 class="fw-bold text-secondary mb-3">Minhas Atividades</h6>
            <ul class="list-group list-group-flush">
                @forelse($tarefas as $tarefa)
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-bottom px-0 py-3">
                        <span class="fs-5 {{ $tarefa->concluida ? 'text-decoration-line-through text-muted fst-italic' : 'text-dark' }}">
                            {{ $tarefa->titulo }}
                        </span>
                        
                        <div class="d-flex gap-2">
                            <form action="/tarefas/{{ $tarefa->id }}/alternar" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn {{ $tarefa->concluida ? 'btn-outline-secondary' : 'btn-success' }} btn-sm px-3">
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
                    <li class="list-group-item text-center text-muted border-0 py-4">
                        Nenhuma tarefa encontrada.
                    </li>
                @endforelse
            </ul>
        </div>

    </div>
</body>
</html>