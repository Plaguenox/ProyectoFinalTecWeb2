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
    .btn-details {
        background-color: var(--color-turquoise-accent);
        border-color: var(--color-turquoise-accent);
        color: var(--color-text);
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    .btn-details:hover {
        background-color: #36C8C1; 
        border-color: #36C8C1;
        color: var(--color-text);
        box-shadow: 0 4px 8px rgba(64, 224, 208, 0.4);
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
    .alert-info-custom {
        background-color: #e6f7ff;
        color: #007bb5;
        padding: 1.5rem;
        border-radius: 1rem;
        text-align: center;
        font-weight: 600;
        border: 1px solid #b3e0ff;
    }
    .pagination {
        display: flex;
        justify-content: center;
        padding: 1rem 0;
    }
</style>

<div class="container orders-container">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-center orders-title">
            <i class="fas fa-receipt me-2" style="color: var(--color-gold-accent);"></i> {{ __('Mis Pedidos') }}
        </h1>
        
        <div class="orders-card">
            @if(session('success'))
                {{-- Note: For consistency, you might want to replace the standard Bootstrap alert with a custom-styled alert here --}}
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if(count($orders) > 0)
                <div class="table-responsive mb-4">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th class="p-4 text-left">{{ __('ID') }}</th>
                                <th class="p-4 text-left">{{ __('Fecha') }}</th>
                                <th class="p-4 text-left">{{ __('Total') }}</th>
                                <th class="p-4 text-left">{{ __('Estado') }}</th>
                                <th class="p-4 text-center">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="p-4 text-muted">#{{ $order->id }}</td>
                                    <td class="p-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="p-4 total-amount">${{ number_format($order->total, 2) }}</td>
                                    <td class="p-4">
                                        {{-- The status is converted to lowercase for the CSS class lookup --}}
                                        <span class="status-badge {{ strtolower($order->status) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn-details">
                                            <i class="fas fa-eye me-1"></i> Ver detalles
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4 pagination">
                    {{-- Assuming $orders is a paginated collection --}}
                    {{ $orders->links() ?? '' }}
                </div>
            @else
                <div class="alert-info-custom">
                    <i class="fas fa-box-open fa-2x mb-2" style="color: var(--color-turquoise-accent);"></i>
                    <p class="mb-0">Aún no has realizado ningún pedido.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection