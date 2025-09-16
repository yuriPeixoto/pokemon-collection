<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $pokemon->name }}
                @if($pokemon->is_shiny) ✨ @endif
                @if($pokemon->is_lucky) 🍀 @endif
                @if($pokemon->is_perfect_iv) 💯 @endif
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('pokemon.edit', $pokemon) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Editar
                </a>
                <a href="{{ route('pokemon.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Voltar para Lista
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Imagem e informações básicas -->
                        <div class="space-y-6">
                            @if($pokemon->sprite_url)
                                <div class="flex justify-center">
                                    <img src="{{ $pokemon->sprite_url }}" alt="{{ $pokemon->name }}" class="w-48 h-48">
                                </div>
                            @endif

                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Informações Básicas</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-700">Nome:</span>
                                        <span class="text-gray-900">{{ $pokemon->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-700">Número da Pokédex:</span>
                                        <span class="text-gray-900">#{{ $pokemon->pokedex_number }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-700">Tipos:</span>
                                        <span class="text-gray-900">{{ $pokemon->types_string }}</span>
                                    </div>
                                    @if($pokemon->region)
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">Região:</span>
                                            <span class="text-gray-900">{{ $pokemon->region }}</span>
                                        </div>
                                    @endif
                                    @if($pokemon->generation)
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">Geração:</span>
                                            <span class="text-gray-900">{{ $pokemon->generation }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Stats Base -->
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Stats Base</h3>
                                <div class="grid grid-cols-2 gap-2 text-sm">
                                    @if($pokemon->base_hp)
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">HP:</span>
                                            <span class="text-gray-900">{{ $pokemon->base_hp }}</span>
                                        </div>
                                    @endif
                                    @if($pokemon->base_attack)
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">Ataque:</span>
                                            <span class="text-gray-900">{{ $pokemon->base_attack }}</span>
                                        </div>
                                    @endif
                                    @if($pokemon->base_defense)
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">Defesa:</span>
                                            <span class="text-gray-900">{{ $pokemon->base_defense }}</span>
                                        </div>
                                    @endif
                                    @if($pokemon->base_special_attack)
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">Sp. Ataque:</span>
                                            <span class="text-gray-900">{{ $pokemon->base_special_attack }}</span>
                                        </div>
                                    @endif
                                    @if($pokemon->base_special_defense)
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">Sp. Defesa:</span>
                                            <span class="text-gray-900">{{ $pokemon->base_special_defense }}</span>
                                        </div>
                                    @endif
                                    @if($pokemon->base_speed)
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">Velocidade:</span>
                                            <span class="text-gray-900">{{ $pokemon->base_speed }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Dados do Pokémon GO -->
                        <div class="space-y-6">
                            <!-- Stats Pokémon GO -->
                            <div class="bg-green-50 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Stats Pokémon GO</h3>
                                <div class="space-y-2">
                                    @if($pokemon->cp)
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">CP:</span>
                                            <span class="text-gray-900 font-bold text-lg">{{ $pokemon->cp }}</span>
                                        </div>
                                    @endif
                                    @if($pokemon->hp)
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">HP:</span>
                                            <span class="text-gray-900 font-bold">{{ $pokemon->hp }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- IVs -->
                            @if($pokemon->iv_attack !== null || $pokemon->iv_defense !== null || $pokemon->iv_hp !== null)
                                <div class="bg-purple-50 rounded-lg p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Individual Values (IVs)</h3>
                                    <div class="space-y-2">
                                        <div class="grid grid-cols-3 gap-4 text-center">
                                            <div>
                                                <div class="text-2xl font-bold text-red-500">{{ $pokemon->iv_attack ?? 'N/A' }}</div>
                                                <div class="text-xs text-gray-600">Ataque</div>
                                            </div>
                                            <div>
                                                <div class="text-2xl font-bold text-blue-500">{{ $pokemon->iv_defense ?? 'N/A' }}</div>
                                                <div class="text-xs text-gray-600">Defesa</div>
                                            </div>
                                            <div>
                                                <div class="text-2xl font-bold text-green-500">{{ $pokemon->iv_hp ?? 'N/A' }}</div>
                                                <div class="text-xs text-gray-600">HP</div>
                                            </div>
                                        </div>
                                        @if($pokemon->iv_percentage)
                                            <div class="text-center mt-3">
                                                <div class="text-3xl font-bold {{ $pokemon->is_perfect_iv ? 'text-purple-600' : 'text-gray-800' }}">
                                                    {{ $pokemon->iv_percentage }}%
                                                    @if($pokemon->is_perfect_iv) 💯 @endif
                                                </div>
                                                <div class="text-sm text-gray-600">IV Total</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Características Especiais -->
                            <div class="bg-yellow-50 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Características Especiais</h3>
                                <div class="flex flex-wrap gap-2">
                                    @if($pokemon->is_shiny)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            ✨ Shiny
                                        </span>
                                    @endif
                                    @if($pokemon->is_lucky)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            🍀 Lucky
                                        </span>
                                    @endif
                                    @if($pokemon->is_shadow)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                            🌑 Shadow
                                        </span>
                                    @endif
                                    @if($pokemon->is_purified)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            🕊️ Purified
                                        </span>
                                    @endif
                                    @if($pokemon->is_perfect_iv)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                            💯 Perfect IV
                                        </span>
                                    @endif
                                    @if(!$pokemon->is_shiny && !$pokemon->is_lucky && !$pokemon->is_shadow && !$pokemon->is_purified && !$pokemon->is_perfect_iv)
                                        <span class="text-gray-500 text-sm">Nenhuma característica especial</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Ataques -->
                            @if($pokemon->fast_move || $pokemon->charge_move_1 || $pokemon->charge_move_2)
                                <div class="bg-red-50 rounded-lg p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Ataques</h3>
                                    <div class="space-y-2">
                                        @if($pokemon->fast_move)
                                            <div class="flex justify-between">
                                                <span class="font-medium text-gray-700">Ataque Rápido:</span>
                                                <span class="text-gray-900">{{ $pokemon->fast_move }}</span>
                                            </div>
                                        @endif
                                        @if($pokemon->charge_move_1)
                                            <div class="flex justify-between">
                                                <span class="font-medium text-gray-700">Ataque Carregado 1:</span>
                                                <span class="text-gray-900">{{ $pokemon->charge_move_1 }}</span>
                                            </div>
                                        @endif
                                        @if($pokemon->charge_move_2)
                                            <div class="flex justify-between">
                                                <span class="font-medium text-gray-700">Ataque Carregado 2:</span>
                                                <span class="text-gray-900">{{ $pokemon->charge_move_2 }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Informações de Captura -->
                            @if($pokemon->caught_at || $pokemon->location_caught)
                                <div class="bg-indigo-50 rounded-lg p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Informações de Captura</h3>
                                    <div class="space-y-2">
                                        @if($pokemon->caught_at)
                                            <div class="flex justify-between">
                                                <span class="font-medium text-gray-700">Data de Captura:</span>
                                                <span class="text-gray-900">{{ $pokemon->caught_at->format('d/m/Y') }}</span>
                                            </div>
                                        @endif
                                        @if($pokemon->location_caught)
                                            <div class="flex justify-between">
                                                <span class="font-medium text-gray-700">Local:</span>
                                                <span class="text-gray-900">{{ $pokemon->location_caught }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Notas -->
                            @if($pokemon->notes)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Notas</h3>
                                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pokemon->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Ações -->
                    <div class="mt-8 flex justify-end space-x-3 border-t pt-6">
                        <form action="{{ route('pokemon.destroy', $pokemon) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="return confirm('Tem certeza que deseja remover este Pokémon da sua coleção?')">
                                Excluir Pokémon
                            </button>
                        </form>
                        <a href="{{ route('pokemon.edit', $pokemon) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Editar Pokémon
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>