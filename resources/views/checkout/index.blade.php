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
    .checkout-title {
        font-family: 'Playfair Display', serif;
        color: var(--color-olive);
        font-weight: 900;
        font-size: 2.25rem;
    }
    .checkout-card {
        border-radius: 1.5rem;
        padding: 2.5rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        background-color: white;
    }
    .list-group-item-custom {
        border: none;
        border-bottom: 1px solid #eee;
        padding: 0.75rem 1rem;
    }
    .list-group-item-total {
        background-color: var(--color-background);
        border-top: 2px solid var(--color-olive);
        border-radius: 0 0 1rem 1rem;
        margin-top: 0.5rem;
    }
</style>

<div class="container py-5" style="background-color: var(--color-background); min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h1 class="text-center checkout-title mb-5">
                {{ __('Finalizar Compra') }}
            </h1>

            
            <div class="checkout-card">
                @if(session('error'))
                    <div class="alert alert-danger text-center" role="alert" style="border-radius: 0.75rem;">
                        {{ session('error') }}
                    </div>
                @endif
                
                @if(count($cart) > 0)
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        
                        
                        <div class="mb-5">
                            <h4 class="h5 fw-semibold mb-3" style="color: var(--color-text);">
                                <i class="fas fa-credit-card me-2 text-gold"></i> Método de Pago
                            </h4>
                            <select name="payment_method" id="payment_method" class="form-select form-select-lg" required style="border-radius: 0.75rem; border-color: #ddd;">
                                <option value="">Seleccione...</option>
                                <option value="card">Tarjeta de crédito/débito</option>
                                <option value="paypal">PayPal</option>
                                <option value="bank_transfer">Transferencia Bancaria</option>
                            </select>
                        </div>
                        
                        
                        <h4 class="h5 fw-semibold mb-3" style="color: var(--color-text);">
                            <i class="fas fa-receipt me-2 text-gold"></i> Resumen de Compra
                        </h4>
                        
                        <ul class="list-group mb-5 rounded-3 border">
                            @php $total = 0; @endphp
                            @foreach($cart as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-custom">
                                    <div class="d-flex flex-column">
                                        <span class="fw-medium" style="color: var(--color-text);">{{ $item['title'] }}</span>
                                        <small class="text-muted">Cantidad: {{ $item['quantity'] }}</small>
                                    </div>
                                    <span class="fw-medium">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </li>
                                @php $total += $item['price'] * $item['quantity']; @endphp
                            @endforeach
                            
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold list-group-item-custom list-group-item-total">
                                <span class="fs-5" style="color: var(--color-text);">Total a Pagar</span>
                                <span class="fs-4 text-gold">${{ number_format($total, 2) }}</span>
                            </li>
                        </ul>
                        
                        
                        <button type="submit" class="btn btn-olive w-100 btn-lg">
                            <i class="fas fa-lock me-2"></i> Finalizar compra segura
                        </button>
                    </form>
                @else
                    
                    <div class="text-center p-4">
                        <i class="fas fa-shopping-basket fa-3x mb-3" style="color: var(--color-turquoise-accent);"></i>
                        <h5 class="fw-bold mb-3" style="color: var(--color-olive);">¡Tu carrito está vacío!</h5>
                        <p class="text-muted mb-4">No hay artículos para proceder al pago.</p>
                        <a href="{{ route('books.index') }}" class="btn btn-olive rounded-pill px-4 py-2">
                            <i class="fas fa-book-open me-2"></i> Volver al Catálogo
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection