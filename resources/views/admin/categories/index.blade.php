@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Título - Usando fuente Playfair Display y acento verde oliva -->
    <h1 class="mb-5 text-center" style="font-family: 'Playfair Display', serif;">
        <i class="fas fa-layer-group me-2" style="color: var(--color-olive);"></i> Gestión de Categorías
    </h1>

    <!-- Tarjeta de Acciones y Mensajes -->
    <div class="card p-4 shadow-sm mb-4" style="border: none; border-radius: 0.75rem;">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Botón de Agregar (Dorado - Acción principal) -->
            <a href="{{ route('admin.categories.create') }}" class="btn btn-gold">
                <i class="fas fa-plus me-1"></i> Agregar categoría
            </a>
        </div>
        
        <!-- Mensajes de Sesión -->
        <div class="mt-3">
            @if(session('success'))
                <div class="alert alert-success border-0 rounded-3">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger border-0 rounded-3">{{ session('error') }}</div>
            @endif
        </div>
    </div>
    
    <!-- Tabla de Categorías - Estilo Limpio y Minimalista -->
    <div class="table-responsive">
        <table class="table table-hover align-middle" style="border-collapse: separate; border-spacing: 0 10px;">
            <thead class="bg-light" style="border-bottom: 2px solid var(--color-gold-accent);">
                <tr>
                    <th class="py-3" style="width: 25%;">Nombre</th>
                    <th class="py-3" style="width: 55%;">Descripción</th>
                    <th class="py-3 text-center" style="width: 20%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="shadow-sm bg-white" style="border-radius: 0.5rem; border: 1px solid #eee;">
                        <td class="fw-bold">{{ $category->name }}</td>
                        <td class="text-muted small">{{ Str::limit($category->description, 100) }}</td>
                        <td class="text-center">
                            <!-- Botón Editar (Turquesa) -->
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-turquoise btn-sm me-2" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Botón Eliminar (Rojo discreto) con Custom Modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">No se encontraron categorías.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación (si existe) -->
    {{-- Verifica si existe paginación para evitar errores si no se usa --}}
    @if(method_exists($categories, 'links'))
    <div class="d-flex justify-content-center pt-4">
        {{ $categories->links() }}
    </div>
    @endif
</div>

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 1rem;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="deleteCategoryModalLabel" style="color: var(--color-soft-black);">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body pt-0">
                <p>¿Estás seguro de que deseas eliminar la categoría: <strong id="categoryNameToDelete"></strong>?</p>
                <p class="text-danger small"><i class="fas fa-exclamation-triangle me-1"></i> Al eliminar una categoría, los libros asociados podrían quedar sin categoría.</p>
                
                <form id="deleteCategoryForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                        <!-- Botón de Eliminar (Rojo de Bootstrap para contraste final en acción destructiva) -->
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash me-1"></i> Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('deleteCategoryModal');
    
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const categoryId = button.getAttribute('data-category-id');
            const categoryName = button.getAttribute('data-category-name');
            
            // Reemplazar el placeholder de ID en la ruta (asumiendo una ruta definida con wildcard {category})
            const actionUrl = "{{ route('admin.categories.destroy', ['category' => '__CATEGORY_ID__']) }}";
            const finalActionUrl = actionUrl.replace('__CATEGORY_ID__', categoryId);
            
            const modalTitleElement = deleteModal.querySelector('#categoryNameToDelete');
            const deleteForm = deleteModal.querySelector('#deleteCategoryForm');

            if (modalTitleElement) {
                modalTitleElement.textContent = categoryName;
            }
            if (deleteForm) {
                deleteForm.setAttribute('action', finalActionUrl);
            }
        });
    }
});
</script>
@endpush
@endsection