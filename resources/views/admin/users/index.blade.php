@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Título - Usando fuente Playfair Display y acento verde oliva -->
    <h1 class="mb-5 text-center" style="font-family: 'Playfair Display', serif;">
        <i class="fas fa-users me-2" style="color: var(--color-olive);"></i> Gestión de Usuarios
    </h1>

    <!-- Tarjeta que envuelve la tabla para un look limpio -->
    <div class="card p-4 shadow-lg" style="border: none; border-radius: 1rem;">
        <div class="table-responsive">
            <!-- Tabla de Usuarios - Estilo Limpio y Minimalista -->
            <table class="table table-hover align-middle" style="border-collapse: separate; border-spacing: 0 10px;">
                <thead class="bg-light" style="border-bottom: 2px solid var(--color-gold-accent);">
                    <tr>
                        <th class="py-3" style="width: 10%;">ID</th>
                        <th class="py-3" style="width: 30%;">Nombre</th>
                        <th class="py-3" style="width: 40%;">Email</th>
                        <th class="py-3" style="width: 20%;">Fecha de registro</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="shadow-sm bg-white" style="border-radius: 0.5rem; border: 1px solid #eee;">
                            <td class="fw-bold small">{{ $user->id }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="small text-muted">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No se encontraron usuarios.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Paginación -->
    @if(method_exists($users, 'links'))
    <div class="d-flex justify-content-center pt-4">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection