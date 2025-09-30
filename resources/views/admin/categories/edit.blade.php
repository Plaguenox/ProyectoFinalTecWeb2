@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Título - Usando fuente Playfair Display y acento verde oliva -->
    <h1 class="mb-4 text-center" style="font-family: 'Playfair Display', serif;">
        <i class="fas fa-edit me-2" style="color: var(--color-olive);"></i> Editar Categoría: "{{ $category->name }}"
    </h1>
    
    <!-- Tarjeta Minimalista para el Formulario -->
    <div class="card p-4 mx-auto shadow-lg" style="max-width: 600px; border: none; border-radius: 1rem;">
        <div class="card-body">
            <!-- Bloque de Errores - Estilo limpio -->
            @if($errors->any())
                <div class="alert alert-danger border-0 rounded-3 mb-4">
                    <h5 class="alert-heading fw-bold"><i class="fas fa-exclamation-triangle me-2"></i> Errores de Validación</h5>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">Nombre de la Categoría</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>
                
                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">Descripción (Opcional)</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                <!-- Botones de Acción -->
                <div class="d-flex justify-content-end pt-3 border-top">
                    <!-- Botón Principal (Dorado) -->
                    <button type="submit" class="btn btn-gold me-3">
                        <i class="fas fa-sync-alt me-1"></i> Actualizar categoría
                    </button>
                    <!-- Botón Secundario (Limpieza visual) -->
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection