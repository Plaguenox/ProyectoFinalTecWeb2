@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Título - Usando fuente Playfair Display y acento verde oliva -->
    <h1 class="mb-5 text-center" style="font-family: 'Playfair Display', serif;">
        <i class="fas fa-receipt me-2" style="color: var(--color-olive);"></i> Detalle del Pedido #{{ $order->id }}
    </h1>

    <div class="row">
        <!-- Columna 1: Información del Usuario y Datos del Pedido -->
        <div class="col-lg-6 mb-4">
            
            <!-- Tarjeta de Usuario -->
            <div class="card shadow-sm mb-4" style="border: none; border-radius: 1rem; border-left: 5px solid var(--color-turquoise-accent);">
                <div class="card-body">
                    <h5 class="card-title fw-bold" style="color: var(--color-turquoise-accent);"><i class="fas fa-user me-2"></i> Datos del Cliente</h5>
                    <hr class="text-muted mt-2 mb-3">
                    <p class="card-text mb-0">
                        <strong class="text-muted">Nombre:</strong> <span class="fw-semibold">{{ $order->user->name ?? 'N/A' }}</span><br>
                        <strong class="text-muted">Email:</strong> <span>{{ $order->user->email ?? 'N/A' }}</span>
                    </p>
                </div>
            </div>

            <!-- Tarjeta de Datos del Pedido -->
            <div class="card shadow-sm" style="border: none; border-radius: 1rem; border-left: 5px solid var(--color-gold-accent);">
                <div class="card-body">
                    <h5 class="card-title fw-bold" style="color: var(--color-gold-accent);"><i class="fas fa-info-circle me-2"></i> Información General</h5>
                    <hr class="text-muted mt-2 mb-3">
                    
                    {{-- Define la clase de badge según el estado --}}
                    @php
                        $badgeClass = 'text-bg-secondary';
                        switch (strtolower($order->status)) {
                            case 'completado':
                            case 'pagado':
                                $badgeClass = 'text-bg-success'; // Verde menta/Oliva
                                break;
                            case 'pendiente':
                            case 'en espera':
                                $badgeClass = 'text-bg-warning'; // Dorado sutil
                                break;
                            case 'enviado':
                                $badgeClass = 'text-bg-info'; // Azul Turquesa sutil
                                break;
                            case 'cancelado':
                            case 'fallido':
                                $badgeClass = 'text-bg-danger';
                                break;
                        }
                    @endphp

                    <p class="card-text mb-0">
                        <strong class="text-muted">Total:</strong> <span class="fw-bold fs-5" style="color: var(--color-soft-black);">${{ number_format($order->total, 2) }}</span><br>
                        <strong class="text-muted">Fecha:</strong> <span>{{ $order->created_at?->format('d/m/Y H:i') }}</span><br>
                        <strong class="text-muted">Estado:</strong> 
                        <span class="badge {{ $badgeClass }} p-2 ms-2">{{ $order->status }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Columna 2: Libros del Pedido -->
        <div class="col-lg-6 mb-4">
            <h5 class="fw-bold mb-3" style="color: var(--color-soft-black);">
                <i class="fas fa-book me-2" style="color: var(--color-olive);"></i> Libros Incluidos
            </h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle shadow-sm bg-white" style="border-radius: 0.75rem; overflow: hidden;">
                    <thead style="background-color: var(--color-gold-accent); color: var(--color-soft-black);">
                        <tr>
                            <th class="py-3">Título</th>
                            <th class="py-3 text-center">Cant.</th>
                            <th class="py-3 text-end">Unitario</th>
                            <th class="py-3 text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td class="fw-semibold small">{{ $item->book->title ?? 'Libro Eliminado' }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">${{ number_format($item->price, 2) }}</td>
                            <td class="text-end fw-bold">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Botón de Volver -->
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary mt-3">
        <i class="fas fa-arrow-left me-1"></i> Volver al listado
    </a>
</div>
@endsection