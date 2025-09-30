@extends('layouts.app')

@section('content')
<div class="container py-5">
     
    <h1 class="mb-4 text-center" style="font-family: 'Playfair Display', serif;">
        <i class="fas fa-edit me-2" style="color: var(--color-olive);"></i> Editar Libro: "{{ $book->title }}"
    </h1>
    
    
    <div class="card p-4 mx-auto shadow-lg" style="max-width: 800px; border: none; border-radius: 1rem;">
        <div class="card-body">
             
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
            
            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                 
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label fw-semibold">Título</label>
                         
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="author" class="form-label fw-semibold">Autor</label>
                        <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Descripción</label>
                     
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $book->description) }}</textarea>
                </div>
                
                 
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="price" class="form-label fw-semibold">Precio ($)</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $book->price) }}" step="0.01" min="0" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="stock" class="form-label fw-semibold">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $book->stock) }}" min="0" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="category_id" class="form-label fw-semibold">Categoría</label>
                        
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="isbn" class="form-label fw-semibold">ISBN</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
                    </div>
                </div>

                 
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="image" class="form-label fw-semibold">Imagen (Cubierta)</label>
                        @if($book->image_path)
                            <div class="mb-2 p-2 border rounded-3 bg-light d-inline-block">
                                <span class="fw-bold me-2">Actual:</span>
                                 
                                <img src="{{ asset($book->image_path) }}" alt="Imagen actual" style="max-width:80px; height: auto; border-radius: 0.5rem;">
                            </div>
                        @endif
                        <input type="file" name="image" id="image" class="form-control mt-2">
                        <small class="text-muted">Dejar vacío para mantener la imagen actual.</small>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="pdf_url" class="form-label fw-semibold">URL de Muestra PDF (opcional)</label>
                        <input type="text" name="pdf_url" id="pdf_url" class="form-control" value="{{ old('pdf_url', $book->pdf_url) }}">
                    </div>
                </div>

                
                <div class="d-flex justify-content-end pt-3 border-top">
                     
                    <button type="submit" class="btn btn-gold me-3">
                        <i class="fas fa-sync-alt me-1"></i> Actualizar libro
                    </button>
                     
                    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection