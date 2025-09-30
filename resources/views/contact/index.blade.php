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
    .contact-container {
        background-color: var(--color-background);
        min-height: 80vh;
    }
    .contact-card {
        border-radius: 1.5rem;
        padding: 2.5rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        background-color: white;
    }
    .contact-title {
        font-family: 'Playfair Display', serif;
        color: var(--color-olive);
        font-weight: 900;
        font-size: 2.25rem;
    }
    .form-group label {
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 0.5rem;
        display: block;
    }
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #ddd;
        border-radius: 0.75rem;
        transition: border-color 0.3s;
        background-color: #f9f9f9;
        color: var(--color-text);
    }
    .form-group input:focus,
    .form-group textarea:focus {
        border-color: var(--color-turquoise-accent);
        box-shadow: 0 0 0 0.2rem rgba(64, 224, 208, 0.25);
        outline: none;
        background-color: white;
    }
    .space-y-6 > div {
        margin-bottom: 1.5rem; 
    }
    .btn-turquoise {
        background-color: var(--color-turquoise-accent);
        border-color: var(--color-turquoise-accent);
        color: var(--color-text);
        font-weight: 700;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }
    .btn-turquoise:hover {
        background-color: #36C8C1; 
        border-color: #36C8C1;
        color: var(--color-text);
        box-shadow: 0 4px 8px rgba(64, 224, 208, 0.4);
    }
    .alert-success {
        background-color: #e6ffe6;
        color: var(--color-olive);
        padding: 1rem;
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        border: 1px solid #cceeff;
    }
    .alert-danger {
        background-color: #ffe6e6;
        color: #990000;
        padding: 1rem;
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        border: 1px solid #ffcccc;
    }

</style>

<div class="container contact-container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h1 class="text-center contact-title mb-5">
                <i class="fas fa-envelope me-2" style="color: var(--color-turquoise-accent);"></i> {{ __('Contacta al Rincón Mágico') }}
            </h1>

            
            <div class="contact-card">
                @if(session('success'))
                    <div class="alert-success text-center">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert-danger text-center">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    </div>
                @endif
                
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <p class="text-muted text-center mb-4">
                        ¿Tienes preguntas sobre un libro, tu pedido o simplemente quieres charlar? ¡Escríbenos!
                    </p>

                    <div class="form-group">
                        <label for="name">{{ __('Nombre') }}</label>
                        <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">{{ __('Correo electrónico') }}</label>
                        <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">{{ __('Asunto') }}</label>
                        <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}">
                        @error('subject')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="message">{{ __('Mensaje') }}</label>
                        <textarea name="message" id="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>
                        @error('message')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-turquoise w-100 mt-4">
                        <i class="fas fa-paper-plane me-2"></i> Enviar mensaje
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection