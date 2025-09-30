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

    /* Custom button styles for the store */
    .btn-turquoise {
        background-color: var(--color-turquoise-accent);
        border-color: var(--color-turquoise-accent);
        color: var(--color-text);
        transition: all 0.3s ease;
    }
    .btn-turquoise:hover {
        background-color: #36c3b6; /* Slightly darker turquoise */
        border-color: #36c3b6;
        color: var(--color-text);
        box-shadow: 0 4px 8px rgba(64, 224, 208, 0.4);
    }
    .card-book {
        border: none !important;
        border-radius: 1rem !important;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card-book:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
    }
    .book-title {
        font-family: 'Playfair Display', serif;
        color: var(--color-olive);
        font-weight: 700;
        min-height: 2.2em; /* Ensure consistent height for titles */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limit to 2 lines */
        -webkit-box-orient: vertical;
    }
    .book-price {
        color: var(--color-gold-accent) !important;
        font-size: 1.25rem;
        font-weight: 700;
    }
</style>

<div class="container py-5" style="background-color: var(--color-background);">
    
    <h1 class="mb-5 text-center" style="font-family: 'Playfair Display', serif; color: var(--color-olive); font-weight: 900;">
        {{ __('Catálogo de Libros') }}
    </h1>

    
    <div class="row g-4 justify-content-center">
        @foreach($books as $book)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <div class="card card-book h-100 shadow-lg bg-white">
                    
                    @if($book->image_path)
                        <div class="d-flex justify-content-center align-items-center p-3" style="height: 240px; background: #fdfdfd; border-radius: 1rem 1rem 0 0;">
                            
                            <img src="{{ asset($book->image_path) }}" 
                                 class="img-fluid" 
                                 style="max-height: 200px; max-width: 100%; object-fit: contain; border-radius: 0.5rem;" 
                                 alt="{{ $book->title }}"
                                 onerror="this.onerror=null;this.src='https://placehold.co/130x180/F0F0F0/333333?text=Sin+Imagen';"
                            >
                        </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column align-items-center text-center p-4">
                        <h5 class="book-title mb-2" title="{{ $book->title }}">
                            {{ $book->title }}
                        </h5>
                        
                        <p class="card-text text-muted mb-3" style="font-size: 0.9em; font-style: italic;">
                            {{ $book->author }}
                        </p>
                        
                        <span class="book-price mb-3">
                            ${{ number_format($book->price, 2) }}
                        </span>
                        
                        
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-turquoise btn-sm mt-auto w-100 rounded-pill fw-bold">
                            Ver detalles
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    
    <div class="d-flex justify-content-center mt-5">
        {{ $books->links() }}
    </div>
</div>
@endsection