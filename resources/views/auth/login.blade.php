@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg p-4" style="border: none; border-radius: 1.5rem;">
                
                <div class="card-header bg-white border-0 text-center pt-4 pb-3">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: var(--color-olive);">
                        <i class="fas fa-user-lock me-2" style="color: var(--color-gold-accent);"></i> {{ __('Iniciar Sesión') }}
                    </h2>
                </div>

                
                <div class="card-body px-lg-5 pb-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email Field --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-muted">{{ __('Correo electrónico') }}</label>
                            
                            <input id="email" type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email" 
                                   autofocus
                                   style="border-radius: 0.75rem;">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Password Field --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-muted">{{ __('Contraseña') }}</label>

                            <input id="password" type="password" 
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password"
                                   style="border-radius: 0.75rem;">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            {{-- Remember Me Checkbox --}}
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small text-muted" for="remember">
                                    {{ __('Recordarme') }}
                                </label>
                            </div>

                            {{-- Forgot Password Link --}}
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-decoration-none small" href="{{ route('password.request') }}" style="color: var(--color-turquoise-accent);">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-gold btn-lg shadow-sm">
                                <i class="fas fa-sign-in-alt me-1"></i> {{ __('Entrar') }}
                            </button>
                        </div>

                        {{-- Register Link --}}
                        <div class="text-center mt-3 small">
                            ¿Aún no tienes cuenta? 
                            <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: var(--color-olive);">
                                ¡Regístrate aquí!
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
