@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg p-4" style="border: none; border-radius: 1.5rem;">
                
                <div class="card-header bg-white border-0 text-center pt-4 pb-3">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: var(--color-olive);">
                        <i class="fas fa-magic me-2" style="color: var(--color-turquoise-accent);"></i> {{ __('Crear una Cuenta Mágica') }}
                    </h2>
                </div>

                
                <div class="card-body px-lg-5 pb-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Name Field --}}
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-muted">{{ __('Nombre') }}</label>
                            <input id="name" type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autocomplete="name" 
                                   autofocus
                                   style="border-radius: 0.75rem;">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Email Field --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-muted">{{ __('Correo electrónico') }}</label>
                            <input id="email" type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email" 
                                   style="border-radius: 0.75rem;">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Password Field --}}
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold text-muted">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" 
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password"
                                   style="border-radius: 0.75rem;">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Confirm Password Field --}}
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-semibold text-muted">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" 
                                   class="form-control form-control-lg" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   style="border-radius: 0.75rem;">
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-olive btn-lg shadow-sm">
                                <i class="fas fa-book-reader me-1"></i> {{ __('Registrarse') }}
                            </button>
                        </div>

                        {{-- Login Link --}}
                        <div class="text-center mt-3 small">
                            ¿Ya tienes cuenta? 
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: var(--color-turquoise-accent);">
                                Inicia sesión aquí.
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection