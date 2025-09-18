<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                ⚡ Ataques Rápidos
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-sm">
                    ← Voltar ao Dashboard
                </a>
                <a href="{{ route('admin.fast-moves.create') }}" class="btn btn-primary btn-sm">
                    + Novo Ataque
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        @if(session('success'))
            <div class="alert alert-success mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Poder</th>
                            <th>Energia</th>
                            <th>Duração</th>
                            <th>DPS</th>
                            <th>EPS</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fastMoves as $move)
                            <tr>
                                <td>
                                    <div>
                                        <strong>{{ $move->name }}</strong>
                                        @if($move->name_en)
                                            <br><small class="text-gray-500">{{ $move->name_en }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-outline">{{ $move->type }}</span>
                                </td>
                                <td>{{ $move->power }}</td>
                                <td>{{ $move->energy }}</td>
                                <td>{{ $move->duration }}s</td>
                                <td>{{ $move->dps ?? '-' }}</td>
                                <td>{{ $move->eps ?? '-' }}</td>
                                <td>
                                    @if($move->is_legacy)
                                        <span class="badge badge-warning">Legado</span>
                                    @else
                                        <span class="badge badge-success">Ativo</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex space-x-1">
                                        <a href="{{ route('admin.fast-moves.show', $move) }}"
                                           class="btn btn-ghost btn-xs">Ver</a>
                                        <a href="{{ route('admin.fast-moves.edit', $move) }}"
                                           class="btn btn-primary btn-xs">Editar</a>
                                        <form action="{{ route('admin.fast-moves.destroy', $move) }}"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este ataque?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error btn-xs">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-8">
                                    <div class="text-gray-500">
                                        <div class="text-4xl mb-2">⚡</div>
                                        <p>Nenhum ataque rápido cadastrado ainda.</p>
                                        <a href="{{ route('admin.fast-moves.create') }}" class="btn btn-primary btn-sm mt-2">
                                            Adicionar Primeiro Ataque
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($fastMoves->hasPages())
                <div class="p-4 border-t">
                    {{ $fastMoves->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>