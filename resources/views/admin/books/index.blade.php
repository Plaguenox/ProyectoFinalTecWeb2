@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Título - Usando fuente Playfair Display y acento verde oliva para la administración -->
    <h1 class="mb-5 text-center" style="font-family: 'Playfair Display', serif;">
        <i class="fas fa-warehouse me-2" style="color: var(--color-olive);"></i> Gestión de Catálogo
    </h1>

    <!-- Sección de Filtros y Acciones -->
    <div class="card p-4 shadow-sm mb-4" style="border: none; border-radius: 0.75rem;">
        <form method="GET" action="{{ route('admin.books.index') }}" class="row g-3 align-items-end">
            
            <div class="col-md-4">
                <label for="search" class="form-label fw-semibold">Búsqueda</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Título, autor o ISBN" value="{{ request('search') }}">
            </div>
            
            <div class="col-md-3">
                <label for="category" class="form-label fw-semibold">Categoría</label>
                <select name="category" id="category" class="form-select">
                    <option value="">Todas</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-2">
                <label for="stock" class="form-label fw-semibold">Stock</label>
                <select name="stock" id="stock" class="form-select">
                    <option value="">Todos</option>
                    <option value="low" {{ request('stock') == 'low' ? 'selected' : '' }}>Bajo (<=5)</option>
                    <option value="out" {{ request('stock') == 'out' ? 'selected' : '' }}>Sin stock</option>
                </select>
            </div>
            
            <div class="col-md-3 d-flex justify-content-end">
                <!-- Botón de Filtrar (Turquesa - Acento de acción) -->
                <button type="submit" class="btn btn-turquoise me-2"><i class="fas fa-filter me-1"></i> Filtrar</button>
                <!-- Botón de Agregar (Dorado - Acción principal) -->
                <a href="{{ route('admin.books.create') }}" class="btn btn-gold"><i class="fas fa-plus me-1"></i> Agregar libro</a>
            </div>
        </form>
    </div>

    
    <div class="table-responsive">
        <table class="table table-hover align-middle" style="border-collapse: separate; border-spacing: 0 10px;">
            <thead class="bg-light" style="border-bottom: 2px solid var(--color-gold-accent);">
                <tr>
                    <th class="py-3">Título</th>
                    <th class="py-3">Autor</th>
                    <th class="py-3">Categoría</th>
                    <th class="py-3 text-end">Precio</th>
                    <th class="py-3 text-center">Stock</th>
                    <th class="py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr class="shadow-sm bg-white" style="border-radius: 0.5rem; border: 1px solid #eee;">
                        <td class="fw-bold">{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td><span class="badge rounded-pill" style="background-color: var(--color-olive); color: white;">{{ $book->category->name ?? 'Sin categoría' }}</span></td>
                        <td class="text-end">${{ number_format($book->price, 2) }}</td>
                        <td class="text-center">
                            @if($book->stock == 0)
                                <span class="badge bg-danger rounded-pill"><i class="fas fa-exclamation-circle me-1"></i> Agotado</span>
                            @elseif($book->stock <= 5)
                                <span class="badge rounded-pill" style="background-color: var(--color-gold-accent); color: var(--color-soft-black);">{{ $book->stock }} - Bajo</span>
                            @else
                                <span class="badge bg-success rounded-pill">{{ $book->stock }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-turquoise btn-sm me-2" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-book-id="{{ $book->id }}" data-book-title="{{ $book->title }}" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No se encontraron libros que coincidan con los criterios.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    
    <div class="d-flex justify-content-center pt-4">
        {{ $books->appends(request()->query())->links() }}
    </div>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 1rem;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="deleteModalLabel" style="color: var(--color-soft-black);">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body pt-0">
                <p>¿Estás seguro de que deseas eliminar el libro: <strong id="bookTitleToDelete"></strong>?</p>
                <p class="text-danger small"><i class="fas fa-exclamation-triangle me-1"></i> Esta acción es irreversible.</p>
                
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                        
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash me-1"></i> Eliminar Permanentemente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            
            const button = event.relatedTarget;
            const bookId = button.getAttribute('data-book-id');
            const bookTitle = button.getAttribute('data-book-title');
            const actionUrl = "{{ route('admin.books.destroy', ['book' => '__BOOK_ID__']) }}";
            const finalActionUrl = actionUrl.replace('__BOOK_ID__', bookId);
            const modalTitleElement = deleteModal.querySelector('#bookTitleToDelete');
            const deleteForm = deleteModal.querySelector('#deleteForm');

            if (modalTitleElement) {
                modalTitleElement.textContent = bookTitle;
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