<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-base-content mb-2">🔑 Fazer Login</h2>
        <p class="text-base-content/70">Entre para acessar sua coleção</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-info mb-4">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('status') }}</span>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div class="form-control">
            <label class="label" for="email">
                <span class="label-text font-medium">📧 Email</span>
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="input input-bordered input-primary w-full" 
                   placeholder="seu@email.com" required autofocus autocomplete="username">
            @error('email')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-control">
            <label class="label" for="password">
                <span class="label-text font-medium">🔒 Senha</span>
            </label>
            <input id="password" type="password" name="password" 
                   class="input input-bordered input-primary w-full" 
                   placeholder="Digite sua senha" required autocomplete="current-password">
            @error('password')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-control">
            <label class="label cursor-pointer justify-start gap-2">
                <input id="remember_me" type="checkbox" name="remember" class="checkbox checkbox-primary">
                <span class="label-text">🧠 Lembrar de mim</span>
            </label>
        </div>

        <div class="form-control mt-6">
            <button type="submit" class="btn btn-primary btn-block">
                🚀 Entrar na Coleção
            </button>
        </div>

        <div class="divider">OU</div>

        <div class="text-center space-y-2">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                   class="link link-primary text-sm">
                    🤔 Esqueceu sua senha?
                </a>
            @endif
            
            @if (Route::has('register'))
                <div>
                    <span class="text-sm text-base-content/70">Não tem uma conta? </span>
                    <a href="{{ route('register') }}" class="link link-secondary font-medium">
                        ✨ Criar conta grátis
                    </a>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>
