<nav x-data="{ open: false }" class="bg-primary shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto px-6 lg:px-12">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('pokemon.index') }}" class="text-white font-bold text-xl flex items-center gap-2">
                        <span class="text-2xl">⚡</span>
                        Pokémon Collection
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('pokemon.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-white border-b-2 {{ request()->routeIs('pokemon.*') ? 'border-accent' : 'border-transparent hover:border-accent/50' }} transition-colors duration-200">
                        🏠 Minha Coleção
                    </a>
                    <a href="{{ route('pokemon.create') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-white border-b-2 border-transparent hover:border-accent/50 transition-colors duration-200">
                        ➕ Adicionar Pokémon
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost text-white m-1">
                        <span>👤</span>
                        {{ Auth::user()->name }}
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                        <li><a href="{{ route('profile.edit') }}">⚙️ Perfil</a></li>
                        @role('super-admin')
                            <li><a href="{{ route('admin.dashboard') }}">🛡️ Painel Admin</a></li>
                        @endrole
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    🚪 Sair
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="btn btn-ghost text-white">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-primary/90">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('pokemon.index') }}" class="block px-3 py-2 text-white hover:bg-white/10 rounded-md {{ request()->routeIs('pokemon.*') ? 'bg-accent/20' : '' }}">
                🏠 Minha Coleção
            </a>
            <a href="{{ route('pokemon.create') }}" class="block px-3 py-2 text-white hover:bg-white/10 rounded-md">
                ➕ Adicionar Pokémon
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/20">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-white/70">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-white hover:bg-white/10 rounded-md">
                    ⚙️ Perfil
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-3 py-2 text-white hover:bg-white/10 rounded-md">
                        🚪 Sair
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
