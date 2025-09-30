@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Título - Usando fuente Playfair Display y acento verde oliva -->
    <h1 class="mb-5 text-center" style="font-family: 'Playfair Display', serif;">
        <i class="fas fa-box-open me-2" style="color: var(--color-olive);"></i> Gestión de Pedidos
    </h1>

    <!-- Tarjeta que envuelve la tabla para un look limpio -->
    <div class="card p-4 shadow-lg" style="border: none; border-radius: 1rem;">
        <div class="table-responsive">
            <!-- Tabla de Pedidos - Estilo Limpio y Minimalista -->
            <table class="table table-hover align-middle" style="border-collapse: separate; border-spacing: 0 10px;">
                <thead class="bg-light" style="border-bottom: 2px solid var(--color-gold-accent);">
                    <tr>
                        <th class="py-3" style="width: 5%;">ID</th>
                        <th class="py-3" style="width: 20%;">Usuario</th>
                        <th class="py-3" style="width: 15%;">Total</th>
                        <th class="py-3" style="width: 20%;">Estado</th>
                        <th class="py-3" style="width: 20%;">Fecha</th>
                        <th class="py-3 text-center" style="width: 20%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
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
                        <tr class="shadow-sm bg-white" style="border-radius: 0.5rem; border: 1px solid #eee;">
                            <td class="fw-bold">{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'Usuario Eliminado' }}</td>
                            <td class="fw-semibold" style="color: var(--color-soft-black);">${{ number_format($order->total, 2) }}</td>
                            <td>
                                <span class="badge {{ $badgeClass }} p-2">{{ $order->status }}</span>
                            </td>
                            {{-- Aplicando el operador null-safe (?->) para el formato de fecha --}}
                            <td class="small text-muted">{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <!-- Botón Ver (Turquesa - Acción de visualización) -->
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-turquoise btn-sm" title="Ver Detalles">
                                    <i class="fas fa-eye me-1"></i> Ver
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No se encontraron pedidos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Paginación -->
    @if(method_exists($orders, 'links'))
    <div class="d-flex justify-content-center pt-4">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection