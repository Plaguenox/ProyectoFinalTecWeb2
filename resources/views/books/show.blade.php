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

    /* Custom buttons and style elements */
    .btn-olive {
        background-color: var(--color-olive);
        border-color: var(--color-olive);
        color: white;
        transition: all 0.3s ease;
    }
    .btn-olive:hover {
        background-color: #6B8E23; /* Slightly lighter olive */
        border-color: #6B8E23;
        color: white;
        box-shadow: 0 4px 8px rgba(85, 107, 47, 0.4);
    }
    .text-gold {
        color: var(--color-gold-accent) !important;
    }
    .book-detail-card {
        border: none;
        border-radius: 1.5rem;
    }
    .book-title-display {
        font-family: 'Playfair Display', serif;
        color: var(--color-olive);
        font-weight: 700;
        font-size: 2.5rem;
    }
    /* Style for related book cards (reusing catalog style) */
    .card-related-book {
        border: none !important;
        border-radius: 1rem !important;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    .card-related-book:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1) !important;
    }
    .btn-turquoise-outline {
        border-color: var(--color-turquoise-accent);
        color: var(--color-turquoise-accent);
        transition: all 0.3s ease;
    }
    .btn-turquoise-outline:hover {
        background-color: var(--color-turquoise-accent);
        color: var(--color-text);
    }
</style>

<div class="container py-5" style="background-color: var(--color-background);">
    
    <div class="row mb-5 card book-detail-card shadow-lg p-4 p-lg-5">
        
        
        <div class="col-md-5 d-flex justify-content-center align-items-center mb-4 mb-md-0">
            @if($book->image_path)
                <div style="max-height: 400px; max-width: 300px; padding: 1rem; background: #fdfdfd; border-radius: 1rem; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    <img src="{{ asset($book->image_path) }}" 
                         class="img-fluid rounded" 
                         style="max-height: 380px; width: auto; object-fit: contain;" 
                         alt="{{ $book->title }}"
                         onerror="this.onerror=null;this.src='https://placehold.co/250x380/F0F0F0/333333?text={{ $book->title }}';"
                    >
                </div>
            @else
                 <div style="height: 380px; width: 250px; background: #f0f0f0; border-radius: 1rem; display: flex; align-items: center; justify-content: center; color: #999; text-align: center;">
                    Sin Portada
                </div>
            @endif
        </div>
        
        
        <div class="col-md-7 d-flex flex-column justify-content-center">
            <h1 class="book-title-display mb-1">{{ $book->title }}</h1>
            
            <h4 class="text-muted mb-3" style="font-style: italic; color: var(--color-text);">Por: {{ $book->author }}</h4>
            
            <p class="mb-4 text-justify" style="color: var(--color-text); line-height: 1.8;">
                {{ $book->description }}
            </p>
            
            <div class="d-flex align-items-center mb-3">
                <span class="badge me-2 p-2" style="background-color: var(--color-turquoise-accent); color: var(--color-text); font-weight: 600;">
                    <i class="fas fa-tag me-1"></i> {{ $book->category->name ?? 'General' }}
                </span>
                <span class="text-muted" style="font-size: 0.9em;">
                    ISBN: {{ $book->isbn ?? 'N/A' }}
                </span>
            </div>
            
            
            <div class="mb-4">
                <span class="text-gold" style="font-size: 2rem; font-weight: bold;">
                    ${{ number_format($book->price, 2) }}
                </span>
                @if ($book->stock > 0)
                    <span class="ms-3 text-success fw-bold"><i class="fas fa-check-circle me-1"></i> En Stock ({{ $book->stock }})</span>
                @else
                    <span class="ms-3 text-danger fw-bold"><i class="fas fa-times-circle me-1"></i> Agotado</span>
                @endif
            </div>

            
            <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                
                <div class="d-flex align-items-center mb-3">
                    <label for="quantity" class="form-label me-3 fw-semibold text-muted mb-0">Cantidad:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $book->stock }}" 
                           class="form-control form-control-lg me-4" 
                           style="width: 100px; border-radius: 0.75rem;">
                           
                    <button type="submit" 
                            class="btn btn-olive btn-lg flex-grow-1" 
                            {{ $book->stock < 1 ? 'disabled' : '' }}>
                        <i class="fas fa-cart-plus me-2"></i> {{ $book->stock < 1 ? 'No disponible' : 'Agregar al carrito' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    
    @if(isset($relatedBooks) && count($relatedBooks) > 0)
        <hr class="my-5" style="border-top: 2px solid var(--color-olive); opacity: 0.2;">
        
        <h3 class="h4 fw-bold mb-4 text-center" style="font-family: 'Playfair Display', serif; color: var(--color-olive);">
            Descubre Títulos Similares
        </h3>
        
        <div class="row g-4 justify-content-center">
            @foreach($relatedBooks as $related)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 d-flex">
                    <div class="card card-related-book h-100 bg-white text-center">
                        
                        
                        <div class="d-flex justify-content-center align-items-center p-3" style="height: 180px; background: #fdfdfd; border-radius: 1rem 1rem 0 0;">
                            <img src="{{ asset($related->image_path) }}" 
                                 class="img-fluid" 
                                 style="max-height: 150px; max-width: 100%; object-fit: contain; border-radius: 0.5rem;" 
                                 alt="{{ $related->title }}"
                                 onerror="this.onerror=null;this.src='https://placehold.co/100x150/F0F0F0/333333?text=Sin+Imagen';"
                            >
                        </div>
                        
                        
                        <div class="card-body d-flex flex-column p-3">
                            <h6 class="card-title mb-2 book-title" style="font-size: 0.9em; font-weight: 600;">{{ $related->title }}</h6>
                            <span class="text-gold fw-bold mb-3" style="font-size: 1em;">${{ number_format($related->price, 2) }}</span>
                            <a href="{{ route('books.show', $related->id) }}" class="btn btn-turquoise-outline btn-sm mt-auto rounded-pill">
                                Ver
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection