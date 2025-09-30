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
    .btn-olive {
        background-color: var(--color-olive);
        border-color: var(--color-olive);
        color: white;
        transition: all 0.3s ease;
        border-radius: 0.75rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
    }
    .btn-olive:hover {
        background-color: #6B8E23; 
        border-color: #6B8E23;
        color: white;
        box-shadow: 0 4px 8px rgba(85, 107, 47, 0.4);
    }
    .text-gold {
        color: var(--color-gold-accent) !important;
    }
    .cart-table {
        border-collapse: separate;
        border-spacing: 0 10px; 
    }
    .cart-table th {
        border-bottom: 2px solid var(--color-olive);
        color: var(--color-olive);
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        padding: 10px 0;
    }
    .cart-table td {
        background-color: white;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        vertical-align: middle;
        padding: 1rem;
    }
    .item-image {
        width: 60px;
        height: 80px;
        object-fit: contain;
        border-radius: 0.5rem;
    }
    
    .btn-remove {
        color: #dc3545; 
        border: 1px solid #dc3545;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    .btn-remove:hover {
        background-color: #dc3545;
        color: white;
    }
</style>

<div class="container py-5" style="background-color: var(--color-background); min-height: 80vh;">
    
    <h1 class="mb-5 text-center" style="font-family: 'Playfair Display', serif; color: var(--color-olive); font-weight: 900;">
        {{ __('Carrito de Compras') }}
    </h1>

    
    <div style="max-width: 900px; margin: 0 auto;">
        @if(session('success'))
            <div class="alert alert-success text-center" role="alert" style="border-radius: 0.75rem;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center" role="alert" style="border-radius: 0.75rem;">
                {{ session('error') }}
            </div>
        @endif
    </div>

    @if(count($cart) > 0)
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form action="{{ route('cart.update') }}" method="POST">
                    @csrf
                    <div class="table-responsive mb-4">
                        <table class="table align-middle cart-table">
                            <thead class="bg-transparent">
                                <tr>
                                    <th class="text-start" style="width: 40%;">Artículo</th>
                                    <th class="text-center">Precio</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-end">Subtotal</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cart as $item)
                                    <tr style="border-radius: 1rem;">
                                        
                                        <td>
                                            <div class="d-flex align-items-center">
                                                
                                                <img src="{{ asset($item['image_path'] ?? 'https://placehold.co/60x80/F0F0F0/333333?text=Libro') }}" 
                                                     class="item-image me-3" 
                                                     alt="{{ $item['title'] }}"
                                                     onerror="this.onerror=null;this.src='https://placehold.co/60x80/F0F0F0/333333?text=Libro';"
                                                >
                                                <div>
                                                    <h6 class="mb-0 fw-bold" style="color: var(--color-olive); font-size: 1em;">{{ $item['title'] }}</h6>
                                                    <small class="text-muted">{{ $item['author'] ?? 'Autor Desconocido' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        
                                        <td class="text-center">${{ number_format($item['price'], 2) }}</td>
                                        
                                        
                                        <td class="text-center" style="max-width: 120px;">
                                            <input type="number" 
                                                   name="quantity[{{ $item['id'] }}]" 
                                                   value="{{ $item['quantity'] }}" 
                                                   min="1" 
                                                   max="{{ $item['stock'] ?? 99 }}" 
                                                   class="form-control form-control-sm text-center mx-auto" 
                                                   style="width: 70px; border-radius: 0.5rem;"
                                            >
                                        </td>
                                        
                                        
                                        <td class="text-end fw-bold" style="color: var(--color-olive); font-size: 1.1em;">
                                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </td>
                                        
                                        
                                        <td class="text-center">
                                            <div class="d-flex flex-column flex-sm-row justify-content-center">
                                                <button type="submit" name="action" value="update" class="btn btn-sm btn-outline-secondary me-0 me-sm-2 mb-2 mb-sm-0 rounded-pill">
                                                     <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-remove rounded-pill">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @php $total += $item['price'] * $item['quantity']; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>

                
                <div class="d-flex justify-content-between align-items-center bg-white p-4 shadow-sm" style="border-radius: 1rem;">
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i> Continuar Comprando
                    </a>
                    
                    <div class="d-flex align-items-center">
                        <span class="fw-bold fs-5 me-4" style="color: var(--color-text);">Total del Carrito:</span>
                        <span class="text-gold fs-3 fw-bold">${{ number_format($total, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn btn-olive">
                        <i class="fas fa-credit-card me-2"></i> Proceder al pago
                    </a>
                </div>
            </div>
        </div>
    @else
        
        <div class="text-center p-5 bg-white shadow-lg" style="border-radius: 1.5rem; max-width: 600px; margin: 0 auto;">
            <i class="fas fa-shopping-basket fa-4x mb-3" style="color: var(--color-turquoise-accent);"></i>
            <h4 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: var(--color-olive);">¡Tu rincón mágico está vacío!</h4>
            <p class="text-muted mb-4">Parece que aún no has agregado ningún tesoro literario a tu carrito.</p>
            <a href="{{ route('books.index') }}" class="btn btn-olive rounded-pill px-4 py-2">
                <i class="fas fa-book-open me-2"></i> Explorar el Catálogo
            </a>
        </div>
    @endif
</div>
@endsection