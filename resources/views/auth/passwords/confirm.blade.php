@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg p-4" style="border: none; border-radius: 1.5rem;">
                
                <div class="card-header bg-white border-0 text-center pt-4 pb-3">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: var(--color-olive);">
                        <i class="fas fa-lock me-2" style="color: var(--color-gold-accent);"></i> {{ __('Confirmar Contraseña') }}
                    </h2>
                </div>

                
                <div class="card-body px-lg-5 pb-5">
                    <p class="text-center text-muted mb-4">
                        {{ __('Por favor, confirma tu contraseña antes de continuar.') }}
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

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

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-gold btn-lg shadow-sm">
                                <i class="fas fa-check me-1"></i> {{ __('Confirmar') }}
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-decoration-none small" href="{{ route('password.request') }}" style="color: var(--color-turquoise-accent);">
                                    {{ __('¿Olvidaste tu Contraseña?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection