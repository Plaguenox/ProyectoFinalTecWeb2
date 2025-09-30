@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg p-4" style="border: none; border-radius: 1.5rem;">
                
                <div class="card-header bg-white border-0 text-center pt-4 pb-3">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: var(--color-olive);">
                        <i class="fas fa-redo me-2" style="color: var(--color-gold-accent);"></i> {{ __('Establecer Nueva Contraseña') }}
                    </h2>
                </div>

                
                <div class="card-body px-lg-5 pb-5">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        {{-- Campo oculto para el token --}}
                        <input type="hidden" name="token" value="{{ $token }}">

                        {{-- Email Field --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-muted">{{ __('Dirección de Correo Electrónico') }}</label>
                            
                            <input id="email" type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ $email ?? old('email') }}" 
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
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold text-muted">{{ __('Nueva Contraseña') }}</label>

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
                            <label for="password-confirm" class="form-label fw-semibold text-muted">{{ __('Confirmar Nueva Contraseña') }}</label>

                            <input id="password-confirm" type="password" 
                                   class="form-control form-control-lg" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   style="border-radius: 0.75rem;">
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-gold btn-lg shadow-sm">
                                <i class="fas fa-sync-alt me-1"></i> {{ __('Restablecer Contraseña') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection