@extends('layouts.app')

@section('content')
<style>
    :root {
        --color-gold-accent: #D4AF37;
        --color-turquoise-accent: #40E0D0;
        --color-olive: #556B2F;
        --color-background: #FAFAFA;
        --color-text: #333333;
    }
    .profile-container {
        background-color: var(--color-background);
        min-height: 80vh;
        padding-top: 4rem;
        padding-bottom: 4rem;
    }
    .profile-card {
        background-color: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        padding: 2.5rem;
    }
    .profile-title {
        font-family: 'Playfair Display', serif;
        color: var(--color-olive);
        font-weight: 900;
        font-size: 2.5rem;
        margin-bottom: 2.5rem;
    }
    .form-label {
        color: var(--color-olive);
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #ccc;
        border-radius: 0.75rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-control:focus {
        border-color: var(--color-turquoise-accent);
        box-shadow: 0 0 0 0.2rem rgba(64, 224, 208, 0.25);
        outline: none;
    }
    .btn-update {
        background-color: var(--color-turquoise-accent);
        border: none;
        color: var(--color-text);
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 700;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-update:hover {
        background-color: #36C8C1; 
        box-shadow: 0 4px 8px rgba(64, 224, 208, 0.4);
        color: var(--color-text);
    }
    .alert {
        padding: 1rem 1.5rem;
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }
    .alert-success {
        background-color: #e6f7f0;
        color: #3c763d;
        border: 1px solid #d0e9c6;
    }
    .alert-danger {
        background-color: #f2dede;
        color: #a94442;
        border: 1px solid #ebccd1;
    }
</style>

<div class="container profile-container">
    <div class="max-w-md mx-auto px-4">
        <h1 class="text-center profile-title">
            <i class="fas fa-user-circle me-2" style="color: var(--color-gold-accent);"></i> {{ __('Mi Perfil') }}
        </h1>
        
        <div class="profile-card">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">{{ __('Nombre') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">{{ __('Correo electrónico') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                </div>
                <hr class="my-5 border-gray-200">
                <p class="text-muted mb-3">{{ __('Deja los campos de contraseña vacíos si no deseas cambiarlos.') }}</p>
                <div class="mb-4">
                    <label for="password" class="form-label">{{ __('Nueva contraseña (opcional)') }}</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="form-label">{{ __('Confirmar nueva contraseña') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
                
                <button type="submit" class="btn-update w-100">
                    <i class="fas fa-save me-2"></i> {{ __('Actualizar perfil') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection