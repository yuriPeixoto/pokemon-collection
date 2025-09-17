<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-base-content mb-2">✨ Criar Conta</h2>
        <p class="text-base-content/70">Junte-se à comunidade de treinadores!</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div class="form-control">
            <label class="label" for="name">
                <span class="label-text font-medium">👤 Nome</span>
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" 
                   class="input input-bordered input-primary w-full" 
                   placeholder="Seu nome de treinador" required autofocus autocomplete="name">
            @error('name')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="form-control">
            <label class="label" for="email">
                <span class="label-text font-medium">📧 Email</span>
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="input input-bordered input-primary w-full" 
                   placeholder="seu@email.com" required autocomplete="username">
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
                   placeholder="Mínimo 8 caracteres" required autocomplete="new-password">
            @error('password')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-control">
            <label class="label" for="password_confirmation">
                <span class="label-text font-medium">🔒 Confirmar Senha</span>
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" 
                   class="input input-bordered input-primary w-full" 
                   placeholder="Digite a senha novamente" required autocomplete="new-password">
            @error('password_confirmation')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
            @enderror
        </div>

        <div class="form-control mt-6">
            <button type="submit" class="btn btn-secondary btn-block">
                🎯 Criar Minha Conta
            </button>
        </div>

        <div class="divider">OU</div>

        <div class="text-center">
            <span class="text-sm text-base-content/70">Já tem uma conta? </span>
            <a href="{{ route('login') }}" class="link link-primary font-medium">
                🔑 Fazer Login
            </a>
        </div>
    </form>
</x-guest-layout>
