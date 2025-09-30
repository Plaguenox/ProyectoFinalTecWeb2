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
    .download-container {
        background-color: var(--color-background);
        min-height: 80vh;
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
    .download-card {
        background-color: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        padding: 2.5rem;
    }
    .download-title {
        font-family: 'Playfair Display', serif;
        color: var(--color-olive);
        font-weight: 900;
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }

    .books-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 1rem;
        overflow: hidden; 
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    .books-table thead {
        background-color: var(--color-olive);
        color: white;
    }
    .books-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 700;
    }
    .books-table tbody tr {
        border-bottom: 1px solid #eee;
        transition: background-color 0.3s;
    }
    .books-table tbody tr:hover {
        background-color: #f7f7f7;
    }
    .books-table td {
        padding: 1rem;
        color: var(--color-text);
        vertical-align: middle;
    }
    .btn-download {
        background-color: var(--color-olive);
        border-color: var(--color-olive);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    .btn-download:hover {
        background-color: #6B8E23;
        border-color: #6B8E23;
        color: white;
        box-shadow: 0 4px 8px rgba(85, 107, 47, 0.4);
    }

    .text-unavailable {
        color: #999;
        font-style: italic;
    }
    .alert-info-custom {
        background-color: #e6f7ff;
        color: #007bb5;
        padding: 1.5rem;
        border-radius: 1rem;
        text-align: center;
        font-weight: 600;
        border: 1px solid #b3e0ff;
    }
</style>

<div class="container download-container">
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-center download-title">
            <i class="fas fa-download me-2" style="color: var(--color-gold-accent);"></i> {{ __('Descargas de Libros') }}
        </h1>
        
        <div class="download-card">
            @if(count($books) > 0)
                <div class="overflow-x-auto">
                    <table class="books-table">
                        <thead>
                            <tr>
                                <th class="p-4 text-left">{{ __('Título') }}</th>
                                <th class="p-4 text-left">{{ __('Autor') }}</th>
                                <th class="p-4 text-center">{{ __('Descargar') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td class="p-4 fw-medium">{{ $book->title }}</td>
                                    <td class="p-4 text-muted">{{ $book->author }}</td>
                                    <td class="p-4 text-center" style="width: 150px;">
                                        @if($book->pivot->order_status !== 'cancelled' && $book->pdf_url)
                                            <a href="{{ asset($book->pdf_url) }}" class="btn-download" download>
                                                <i class="fas fa-file-pdf me-2"></i> Descargar PDF
                                            </a>
                                        @else
                                            <span class="text-unavailable">
                                                <i class="fas fa-times-circle me-1"></i> No disponible
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert-info-custom">
                    <i class="fas fa-book-reader fa-2x mb-2" style="color: var(--color-turquoise-accent);"></i>
                    <p class="mb-0">Aún no tienes libros comprados que sean descargables.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection