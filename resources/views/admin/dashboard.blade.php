@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Título - Usando fuente Playfair Display y acento verde oliva -->
    <h1 class="mb-5 text-center" style="font-family: 'Playfair Display', serif;">
        <i class="fas fa-tachometer-alt me-2" style="color: var(--color-olive);"></i> Panel de Administración
    </h1>

    <!-- Botones de Gestión (Minimalista y con colores de acento) -->
    <div class="mb-5 d-flex flex-wrap gap-3 justify-content-center">
        <a href="{{ route('admin.books.index') }}" class="btn btn-gold shadow-sm px-4">
            <i class="fas fa-book me-1"></i> Gestionar Libros
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-turquoise shadow-sm px-4">
            <i class="fas fa-tags me-1"></i> Gestionar Categorías
        </a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary shadow-sm px-4">
            <i class="fas fa-users me-1"></i> Gestionar Usuarios
        </a>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary shadow-sm px-4">
            <i class="fas fa-shopping-cart me-1"></i> Gestionar Pedidos
        </a>
    </div>

    <!-- Sección de Estadísticas (Cards) -->
    <div class="row mb-5 g-4">
        {{-- Card Libros --}}
        <div class="col-md-6 col-lg-3">
            <div class="card text-center p-3 shadow-lg h-100" style="border: none; border-radius: 1rem;">
                <div class="card-body">
                    <i class="fas fa-book mb-3" style="font-size: 2.5rem; color: var(--color-olive);"></i>
                    <h5 class="card-title fw-semibold text-muted">Total de Libros</h5>
                    <p class="card-text display-6 fw-bold" style="color: var(--color-olive);">{{ $total_books }}</p>
                </div>
            </div>
        </div>
        
        {{-- Card Categorías --}}
        <div class="col-md-6 col-lg-3">
            <div class="card text-center p-3 shadow-lg h-100" style="border: none; border-radius: 1rem;">
                <div class="card-body">
                    <i class="fas fa-tags mb-3" style="font-size: 2.5rem; color: var(--color-turquoise-accent);"></i>
                    <h5 class="card-title fw-semibold text-muted">Categorías</h5>
                    <p class="card-text display-6 fw-bold" style="color: var(--color-turquoise-accent);">{{ $total_categories }}</p>
                </div>
            </div>
        </div>

        {{-- Card Usuarios --}}
        <div class="col-md-6 col-lg-3">
            <div class="card text-center p-3 shadow-lg h-100" style="border: none; border-radius: 1rem;">
                <div class="card-body">
                    <i class="fas fa-users mb-3" style="font-size: 2.5rem; color: var(--color-gold-accent);"></i>
                    <h5 class="card-title fw-semibold text-muted">Usuarios Registrados</h5>
                    <p class="card-text display-6 fw-bold" style="color: var(--color-gold-accent);">{{ $total_users }}</p>
                </div>
            </div>
        </div>

        {{-- Card Pedidos --}}
        <div class="col-md-6 col-lg-3">
            <div class="card text-center p-3 shadow-lg h-100" style="border: none; border-radius: 1rem;">
                <div class="card-body">
                    <i class="fas fa-shopping-cart mb-3" style="font-size: 2.5rem; color: var(--color-soft-black);"></i>
                    <h5 class="card-title fw-semibold text-muted">Pedidos Totales</h5>
                    <p class="card-text display-6 fw-bold" style="color: var(--color-soft-black);">{{ $total_orders }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contenedor para Tablas -->
    <div class="row g-5">
        
        <!-- Últimos Pedidos -->
        <div class="col-lg-7">
            <h4 class="fw-bold mb-4" style="color: var(--color-soft-black);">
                <i class="fas fa-history me-2" style="color: var(--color-turquoise-accent);"></i> Últimos Pedidos
            </h4>
            <div class="card p-4 shadow-sm" style="border: none; border-radius: 1rem;">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" style="border-collapse: separate; border-spacing: 0 10px;">
                        <thead class="bg-light" style="border-bottom: 2px solid var(--color-gold-accent);">
                            <tr>
                                <th class="py-3">ID</th>
                                <th class="py-3">Usuario</th>
                                <th class="py-3">Fecha</th>
                                <th class="py-3">Total</th>
                                <th class="py-3">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_orders as $order)
                                {{-- Define la clase de badge según el estado --}}
                                @php
                                    $badgeClass = 'text-bg-secondary';
                                    switch (strtolower($order->status)) {
                                        case 'completado':
                                        case 'pagado':
                                            $badgeClass = 'text-bg-success';
                                            break;
                                        case 'pendiente':
                                        case 'en espera':
                                            $badgeClass = 'text-bg-warning';
                                            break;
                                        case 'enviado':
                                            $badgeClass = 'text-bg-info';
                                            break;
                                        case 'cancelado':
                                        case 'fallido':
                                            $badgeClass = 'text-bg-danger';
                                            break;
                                    }
                                @endphp
                                <tr class="shadow-sm bg-white" style="border-radius: 0.5rem; border: 1px solid #eee;">
                                    <td class="small fw-bold">{{ $order->id }}</td>
                                    <td>{{ $order->user->name ?? $order->user_id }}</td>
                                    <td class="small text-muted">{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '-' }}</td>
                                    <td class="fw-semibold">${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <span class="badge {{ $badgeClass }} p-2">{{ ucfirst($order->status) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Libros con Poco Stock -->
        <div class="col-lg-5">
            <h4 class="fw-bold mb-4" style="color: var(--color-soft-black);">
                <i class="fas fa-exclamation-triangle me-2" style="color: var(--color-gold-accent);"></i> Libros con Poco Stock
            </h4>
            <div class="card p-4 shadow-sm" style="border: none; border-radius: 1rem;">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" style="border-collapse: separate; border-spacing: 0 10px;">
                        <thead class="bg-light" style="border-bottom: 2px solid var(--color-gold-accent);">
                            <tr>
                                <th class="py-3">Título</th>
                                <th class="py-3 text-center">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($low_stock_books as $book)
                                <tr class="shadow-sm bg-white" style="border-radius: 0.5rem; border: 1px solid #eee;">
                                    <td class="fw-semibold">{{ $book->title }}</td>
                                    <td class="text-center fw-bold text-danger">{{ $book->stock }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-3 text-muted">No hay libros con stock bajo.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection