<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            🛡️ Painel Administrativo
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        <!-- Welcome Card -->
        <div class="mb-8">
            <div class="bg-primary text-white rounded-lg shadow-lg p-6">
                <h1 class="text-2xl font-bold mb-2">Bem-vindo, Super Admin!</h1>
                <p class="opacity-90">Gerencie os ataques dos Pokémon e mantenha o sistema atualizado.</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800">Ataques Rápidos</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $stats['total_fast_moves'] }}</p>
                        <p class="text-sm text-gray-600">{{ $stats['legacy_fast_moves'] }} legados</p>
                    </div>
                    <div class="text-4xl">⚡</div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800">Ataques Carregados</h3>
                        <p class="text-3xl font-bold text-purple-600">{{ $stats['total_charge_moves'] }}</p>
                        <p class="text-sm text-gray-600">{{ $stats['legacy_charge_moves'] }} legados</p>
                    </div>
                    <div class="text-4xl">💥</div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800">Pokémon Cadastrados</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $stats['total_pokemon'] }}</p>
                        <p class="text-sm text-gray-600">{{ $stats['total_users'] }} usuários</p>
                    </div>
                    <div class="text-4xl">🎯</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">⚡ Ataques Rápidos</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.fast-moves.index') }}"
                       class="btn btn-outline btn-primary w-full">
                        Ver Todos os Ataques
                    </a>
                    <a href="{{ route('admin.fast-moves.create') }}"
                       class="btn btn-primary w-full">
                        Adicionar Novo Ataque
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">💥 Ataques Carregados</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.charge-moves.index') }}"
                       class="btn btn-outline btn-secondary w-full">
                        Ver Todos os Ataques
                    </a>
                    <a href="{{ route('admin.charge-moves.create') }}"
                       class="btn btn-secondary w-full">
                        Adicionar Novo Ataque
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>