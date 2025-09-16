<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Minha Coleção de Pokémon') }}
            </h2>
            <a href="{{ route('pokemon.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Adicionar Pokémon
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <!-- Filtros -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="GET" action="{{ route('pokemon.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Busca por nome -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700">Buscar por nome</label>
                                <input type="text" id="search" name="search" value="{{ request('search') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Digite o nome do Pokémon">
                            </div>

                            <!-- Filtro por tipo -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Tipo</label>
                                <select id="type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Todos os tipos</option>
                                    <option value="normal" {{ request('type') == 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="fire" {{ request('type') == 'fire' ? 'selected' : '' }}>Fire</option>
                                    <option value="water" {{ request('type') == 'water' ? 'selected' : '' }}>Water</option>
                                    <option value="electric" {{ request('type') == 'electric' ? 'selected' : '' }}>Electric</option>
                                    <option value="grass" {{ request('type') == 'grass' ? 'selected' : '' }}>Grass</option>
                                    <option value="ice" {{ request('type') == 'ice' ? 'selected' : '' }}>Ice</option>
                                    <option value="fighting" {{ request('type') == 'fighting' ? 'selected' : '' }}>Fighting</option>
                                    <option value="poison" {{ request('type') == 'poison' ? 'selected' : '' }}>Poison</option>
                                    <option value="ground" {{ request('type') == 'ground' ? 'selected' : '' }}>Ground</option>
                                    <option value="flying" {{ request('type') == 'flying' ? 'selected' : '' }}>Flying</option>
                                    <option value="psychic" {{ request('type') == 'psychic' ? 'selected' : '' }}>Psychic</option>
                                    <option value="bug" {{ request('type') == 'bug' ? 'selected' : '' }}>Bug</option>
                                    <option value="rock" {{ request('type') == 'rock' ? 'selected' : '' }}>Rock</option>
                                    <option value="ghost" {{ request('type') == 'ghost' ? 'selected' : '' }}>Ghost</option>
                                    <option value="dragon" {{ request('type') == 'dragon' ? 'selected' : '' }}>Dragon</option>
                                    <option value="dark" {{ request('type') == 'dark' ? 'selected' : '' }}>Dark</option>
                                    <option value="steel" {{ request('type') == 'steel' ? 'selected' : '' }}>Steel</option>
                                    <option value="fairy" {{ request('type') == 'fairy' ? 'selected' : '' }}>Fairy</option>
                                </select>
                            </div>

                            <!-- Filtro por região -->
                            <div>
                                <label for="region" class="block text-sm font-medium text-gray-700">Região</label>
                                <select id="region" name="region" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Todas as regiões</option>
                                    <option value="Kanto" {{ request('region') == 'Kanto' ? 'selected' : '' }}>Kanto</option>
                                    <option value="Johto" {{ request('region') == 'Johto' ? 'selected' : '' }}>Johto</option>
                                    <option value="Hoenn" {{ request('region') == 'Hoenn' ? 'selected' : '' }}>Hoenn</option>
                                    <option value="Sinnoh" {{ request('region') == 'Sinnoh' ? 'selected' : '' }}>Sinnoh</option>
                                    <option value="Unova" {{ request('region') == 'Unova' ? 'selected' : '' }}>Unova</option>
                                    <option value="Kalos" {{ request('region') == 'Kalos' ? 'selected' : '' }}>Kalos</option>
                                    <option value="Alola" {{ request('region') == 'Alola' ? 'selected' : '' }}>Alola</option>
                                    <option value="Galar" {{ request('region') == 'Galar' ? 'selected' : '' }}>Galar</option>
                                    <option value="Paldea" {{ request('region') == 'Paldea' ? 'selected' : '' }}>Paldea</option>
                                </select>
                            </div>
                        </div>

                        <!-- Filtros especiais -->
                        <div class="flex flex-wrap gap-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="perfect_iv" value="1" {{ request('perfect_iv') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">IV Perfeito</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="shiny" value="1" {{ request('shiny') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Shiny</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="lucky" value="1" {{ request('lucky') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Lucky</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="shadow" value="1" {{ request('shadow') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Shadow</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="purified" value="1" {{ request('purified') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Purified</span>
                            </label>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('pokemon.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Limpar Filtros
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Filtrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lista de Pokémon -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($pokemon->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($pokemon as $poke)
                                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $poke->name }}</h3>
                                        <div class="flex space-x-1">
                                            @if($poke->is_shiny)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">✨</span>
                                            @endif
                                            @if($poke->is_lucky)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">🍀</span>
                                            @endif
                                            @if($poke->is_perfect_iv)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">💯</span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($poke->sprite_url)
                                        <div class="flex justify-center mb-3">
                                            <img src="{{ $poke->sprite_url }}" alt="{{ $poke->name }}" class="w-24 h-24">
                                        </div>
                                    @endif

                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="font-medium">CP:</span>
                                            <span>{{ $poke->cp ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="font-medium">HP:</span>
                                            <span>{{ $poke->hp ?? 'N/A' }}</span>
                                        </div>
                                        @if($poke->iv_percentage)
                                            <div class="flex justify-between">
                                                <span class="font-medium">IV:</span>
                                                <span class="font-semibold {{ $poke->is_perfect_iv ? 'text-purple-600' : 'text-gray-600' }}">
                                                    {{ $poke->iv_percentage }}%
                                                </span>
                                            </div>
                                        @endif
                                        <div class="flex justify-between">
                                            <span class="font-medium">Tipos:</span>
                                            <span>{{ $poke->types_string }}</span>
                                        </div>
                                        @if($poke->region)
                                            <div class="flex justify-between">
                                                <span class="font-medium">Região:</span>
                                                <span>{{ $poke->region }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-4 flex justify-end space-x-2">
                                        <a href="{{ route('pokemon.show', $poke) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                            Ver
                                        </a>
                                        <a href="{{ route('pokemon.edit', $poke) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                            Editar
                                        </a>
                                        <form action="{{ route('pokemon.destroy', $poke) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium"
                                                    onclick="return confirm('Tem certeza que deseja remover este Pokémon?')">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $pokemon->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum Pokémon encontrado</h3>
                            <p class="text-gray-500 mb-4">Comece adicionando seu primeiro Pokémon à coleção!</p>
                            <a href="{{ route('pokemon.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Adicionar Primeiro Pokémon
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>