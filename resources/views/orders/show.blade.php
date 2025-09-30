@extends('layouts.app')

@section('content')
<style>
    :root {
        --color-gold-accent: #D4AF37;
        --color-turquoise-accent: #40E0D0;
        --color-olive: #556B2F;
        --color-background: #FAFAFA;
        --color-text: #333333;
        --color-red-cancel: #D64545;
        --color-green-success: #4CAF50;
        --color-blue-pending: #2196F3;
    }
    .orders-container {
        background-color: var(--color-background);
        min-height: 80vh;
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
    .orders-card {
        background-color: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        padding: 2.5rem;
    }
    .orders-title {
        font-family: 'Playfair Display', serif;
        color: var(--color-olive);
        font-weight: 900;
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }
    .order-subtitle {
        font-family: 'Playfair Display', serif;
        color: var(--color-olive);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .orders-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 1rem;
        overflow: hidden; 
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    .orders-table thead {
        background-color: var(--color-olive);
        color: white;
    }
    .orders-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 700;
    }
    .orders-table tbody tr {
        border-bottom: 1px solid #eee;
        transition: background-color 0.3s;
    }
    .orders-table tbody tr:hover {
        background-color: #f7f7f7;
    }
    .orders-table td {
        padding: 1rem;
        color: var(--color-text);
        vertical-align: middle;
    }
    .status-badge {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        border-radius: 0.5rem;
        font-weight: 700;
        font-size: 0.85rem;
    }
    .status-badge.completed {
        background-color: var(--color-green-success);
        color: white;
    }
    .status-badge.pending, .status-badge.processing {
        background-color: var(--color-blue-pending);
        color: white;
    }
    .status-badge.cancelled {
        background-color: var(--color-red-cancel);
        color: white;
    }
    .status-badge.shipped {
        background-color: var(--color-gold-accent);
        color: var(--color-text);
    }
    .total-amount {
        font-weight: 700;
        color: var(--color-gold-accent);
    }
    .total-row {
        background-color: #fff8e1; 
        font-weight: 700;
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
        font-size: 0.875rem;
    }
    .btn-download:hover {
        background-color: #6B8E23;
        border-color: #6B8E23;
        box-shadow: 0 4px 8px rgba(85, 107, 47, 0.4);
    }
    .btn-back-orders {
        background-color: var(--color-turquoise-accent);
        border-color: var(--color-turquoise-accent);
        color: var(--color-text);
        padding: 0.7rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    .btn-back-orders:hover {
        background-color: #36C8C1; 
        border-color: #36C8C1;
        box-shadow: 0 4px 8px rgba(64, 224, 208, 0.4);
    }
    .text-unavailable {
        color: #999;
        font-style: italic;
        font-size: 0.875rem;
    }
</style>

<div class="container orders-container">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-center orders-title">
            <i class="fas fa-receipt me-2" style="color: var(--color-gold-accent);"></i> {{ __('Detalle del Pedido #') }}{{ $order->id }}
        </h1>
        
        <div class="orders-card">
            <div class="mb-5 border-bottom pb-3">
                <div class="row g-3">
                    <div class="col-md-4">
                        <strong class="text-muted d-block mb-1">{{ __('Fecha de Pedido') }}:</strong>
                        <span class="fw-bold text-dark">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="col-md-4">
                        <strong class="text-muted d-block mb-1">{{ __('Total Pagado') }}:</strong>
                        <span class="fw-bold total-amount fs-4">${{ number_format($order->total, 2) }}</span>
                    </div>
                    <div class="col-md-4">
                        <strong class="text-muted d-block mb-1">{{ __('Estado Actual') }}:</strong>
                        <span class="status-badge {{ strtolower($order->status) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <h4 class="order-subtitle">{{ __('Libros Comprados') }}</h4>
            <div class="table-responsive mb-5">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th class="p-4">{{ __('Título') }}</th>
                            <th class="p-4 text-center">{{ __('Cantidad') }}</th>
                            <th class="p-4 text-end">{{ __('Precio Unitario') }}</th>
                            <th class="p-4 text-end">{{ __('Subtotal') }}</th>
                            <th class="p-4 text-center">{{ __('Descarga') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach($order->items as $item)
                            <tr>
                                <td class="p-4 fw-medium">{{ $item->book->title ?? 'Libro eliminado' }}</td>
                                <td class="p-4 text-center">{{ $item->quantity }}</td>
                                <td class="p-4 text-end">${{ number_format($item->price, 2) }}</td>
                                <td class="p-4 text-end">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                <td class="p-4 text-center">
                                    @if($order->status !== 'cancelled' && $item->book && $item->book->pdf_url)
                                        <a href="{{ asset($item->book->pdf_url) }}" class="btn-download" download>
                                            <i class="fas fa-file-pdf me-1"></i> PDF
                                        </a>
                                    @else
                                        <span class="text-unavailable">
                                            <i class="fas fa-times-circle me-1"></i> No disponible
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @php $subtotal += $item->price * $item->quantity; @endphp
                        @endforeach
                        {{-- Add a summary row for visual emphasis --}}
                        <tr class="total-row">
                            <td colspan="3" class="p-4 text-end text-uppercase">{{ __('Total de la Orden') }}:</td>
                            <td class="p-4 text-end total-amount">${{ number_format($subtotal, 2) }}</td>
                            <td class="p-4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-start">
                <a href="{{ route('orders.index') }}" class="btn-back-orders">
                    <i class="fas fa-arrow-left me-2"></i> {{ __('Volver a mis pedidos') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection