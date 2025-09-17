<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    🎮 Minha Coleção de Pokémon
                </h2>
                <p class="text-white/80 text-sm mt-1">Gerencie e organize sua coleção de Pokémon GO</p>
            </div>
            <a href="{{ route('pokemon.create') }}" class="btn btn-accent btn-lg">
                ➕ Adicionar Pokémon
            </a>
        </div>
    </x-slot>

    <!-- Messages -->
    @if (session('success'))
        <div class="alert alert-success shadow-lg mb-6">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error shadow-lg mb-6">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Filtros -->
    <div class="card bg-base-100 shadow-xl mb-6">
        <div class="card-body">
            <h3 class="card-title text-lg mb-4">🔍 Filtros de Busca</h3>
            <form method="GET" action="{{ route('pokemon.index') }}" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Busca por nome -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">🔤 Buscar por nome</span>
                        </label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Digite o nome do Pokémon" 
                               class="input input-bordered input-primary w-full">
                    </div>

                    <!-- Filtro por tipo -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">⚡ Tipo</span>
                        </label>
                        <select name="type" class="select select-bordered select-primary w-full">
                            <option value="">Todos os tipos</option>
                            @foreach(config('pokemon.types') as $typeKey => $typeInfo)
                                <option value="{{ $typeKey }}" {{ request('type') == $typeKey ? 'selected' : '' }}>
                                    {{ $typeInfo['emoji'] }} {{ $typeInfo['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por região -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">🗺️ Região</span>
                        </label>
                        <select name="region" class="select select-bordered select-primary w-full">
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
                <div>
                    <label class="label">
                        <span class="label-text font-medium">✨ Filtros Especiais</span>
                    </label>
                    <div class="flex flex-wrap gap-4">
                        <label class="label cursor-pointer gap-2">
                            <input type="checkbox" name="perfect_iv" value="1" {{ request('perfect_iv') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                            <span class="label-text">💯 IV Perfeito</span>
                        </label>
                        <label class="label cursor-pointer gap-2">
                            <input type="checkbox" name="shiny" value="1" {{ request('shiny') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                            <span class="label-text">✨ Shiny</span>
                        </label>
                        <label class="label cursor-pointer gap-2">
                            <input type="checkbox" name="lucky" value="1" {{ request('lucky') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                            <span class="label-text">🍀 Lucky</span>
                        </label>
                        <label class="label cursor-pointer gap-2">
                            <input type="checkbox" name="shadow" value="1" {{ request('shadow') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                            <span class="label-text">🌑 Shadow</span>
                        </label>
                        <label class="label cursor-pointer gap-2">
                            <input type="checkbox" name="purified" value="1" {{ request('purified') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                            <span class="label-text">✨ Purified</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('pokemon.index') }}" class="btn btn-ghost">
                        Limpar Filtros
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Aplicar Filtros
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista de Pokémon -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            @if($pokemon->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($pokemon as $poke)
                        <div class="card bg-base-100 shadow-lg hover:shadow-xl transition-all duration-300 border border-base-300">
                            <div class="card-body p-4">
                                <!-- Header com nome e badges -->
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="card-title text-lg">{{ $poke->name }}</h3>
                                        <div class="text-sm text-base-content/70">#{{ $poke->pokedex_number }}</div>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        @if($poke->is_shiny)
                                            <div class="badge badge-accent badge-sm">✨ Shiny</div>
                                        @endif
                                        @if($poke->is_lucky)
                                            <div class="badge badge-success badge-sm">🍀 Lucky</div>
                                        @endif
                                        @if($poke->is_perfect_iv)
                                            <div class="badge badge-secondary badge-sm">💯 Perfect</div>
                                        @endif
                                        @if($poke->is_shadow)
                                            <div class="badge badge-neutral badge-sm">🌑 Shadow</div>
                                        @endif
                                        @if($poke->is_purified)
                                            <div class="badge badge-primary badge-sm">✨ Purified</div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Sprite -->
                                @if($poke->sprite_url)
                                    <div class="flex justify-center mb-4">
                                        <div class="avatar">
                                            <div class="w-32 h-32 rounded-xl bg-base-200 p-2">
                                                <img src="{{ $poke->sprite_url }}" alt="{{ $poke->name }}" class="w-full h-full object-contain">
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Stats -->
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium">⚔️ CP:</span>
                                        <span class="badge badge-outline">{{ $poke->cp ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium">❤️ HP:</span>
                                        <span class="badge badge-outline">{{ $poke->hp ?? 'N/A' }}</span>
                                    </div>
                                    @if($poke->iv_percentage)
                                        <div class="flex justify-between items-center">
                                            <span class="font-medium">📊 IV:</span>
                                            <span class="badge {{ $poke->is_perfect_iv ? 'badge-secondary' : 'badge-outline' }}">
                                                {{ $poke->iv_percentage }}%
                                            </span>
                                        </div>
                                    @endif
                                    @if($poke->level)
                                        <div class="flex justify-between items-center">
                                            <span class="font-medium">📈 Level:</span>
                                            <span class="badge badge-outline">{{ $poke->level }}</span>
                                        </div>
                                    @endif
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium">🏷️ Tipos:</span>
                                        <div class="flex gap-1">
                                            @if($poke->types)
                                                @foreach($poke->types as $type)
                                                    @php
                                                        $typeInfo = \App\Models\Pokemon::getTypeInfo($type);
                                                    @endphp
                                                    <span class="badge badge-sm text-white" style="background-color: {{ $typeInfo['color'] }}">
                                                        {{ $typeInfo['emoji'] }} {{ $typeInfo['name'] }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    @if($poke->region)
                                        <div class="flex justify-between items-center">
                                            <span class="font-medium">🗺️ Região:</span>
                                            <span class="badge badge-outline">{{ $poke->region }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="card-actions justify-end mt-4 gap-1">
                                    <a href="{{ route('pokemon.show', $poke) }}" class="btn btn-xs btn-ghost text-primary hover:bg-primary hover:text-white">
                                        Ver
                                    </a>
                                    <a href="{{ route('pokemon.edit', $poke) }}" class="btn btn-xs btn-ghost text-secondary hover:bg-secondary hover:text-white">
                                        Editar
                                    </a>
                                    <form action="{{ route('pokemon.destroy', $poke) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-ghost text-error hover:bg-error hover:text-white"
                                                onclick="return confirm('Tem certeza que deseja remover {{ $poke->name }}?')">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    {{ $pokemon->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">😴</div>
                    <h3 class="text-2xl font-bold text-base-content mb-2">Nenhum Pokémon encontrado</h3>
                    <p class="text-base-content/70 mb-6 max-w-md mx-auto">
                        Sua coleção está vazia ou não foram encontrados Pokémon com os filtros aplicados. 
                        Comece adicionando seu primeiro Pokémon!
                    </p>
                    <a href="{{ route('pokemon.create') }}" class="btn btn-primary btn-lg">
                        ➕ Adicionar Primeiro Pokémon
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>