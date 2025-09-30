@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg p-4" style="border: none; border-radius: 1.5rem;">
                
                <div class="card-header bg-white border-0 text-center pt-4 pb-3">
                    <h2 class="mb-0" style="font-family: 'Playfair Display', serif; color: var(--color-olive);">
                        <i class="fas fa-envelope-open-text me-2" style="color: var(--color-gold-accent);"></i> {{ __('Verifica Tu Dirección de Correo') }}
                    </h2>
                </div>

                
                <div class="card-body px-lg-5 pb-5">
                    @if (session('resent'))
                        <div class="alert alert-success text-center mb-4 p-3" role="alert" style="border-radius: 0.5rem; background-color: #e6f7ee; color: #1e7049; border-color: #b7e3c9;">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                        </div>
                    @endif

                    <p class="text-center text-muted mb-4">
                        {{ __('Antes de continuar, por favor revisa tu correo electrónico para un enlace de verificación.') }}
                    </p>
                    
                    <p class="text-center text-muted mb-4">
                        {{ __('Si no recibiste el correo') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline fw-bold text-decoration-none" style="color: var(--color-turquoise-accent);">
                                {{ __('haz click aquí para solicitar otro') }}
                            </button>
                        </form>
                    </p>
                    <div class="text-center small mt-4">
                        <a href="{{ url('/') }}" class="text-decoration-none" style="color: var(--color-olive);">
                            Volver a la página principal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection