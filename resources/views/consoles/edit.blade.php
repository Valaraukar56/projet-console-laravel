@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning">
                <h4 class="mb-0"><i class="bi bi-pencil"></i> Modifier : {{ $console->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('consoles.update', $console) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de la console *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $console->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Catégorie *</label>
                        <select class="form-select @error('category_id') is-invalid @enderror"
                                id="category_id" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $console->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Prix (€) *</label>
                            <input type="number" step="0.01" min="0.01"
                                   class="form-control @error('price') is-invalid @enderror"
                                   id="price" name="price" value="{{ old('price', $console->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="condition" class="form-label">État *</label>
                            <select class="form-select @error('condition') is-invalid @enderror"
                                    id="condition" name="condition" required>
                                <option value="neuf" {{ old('condition', $console->condition) == 'neuf' ? 'selected' : '' }}>Neuf</option>
                                <option value="très bon" {{ old('condition', $console->condition) == 'très bon' ? 'selected' : '' }}>Très bon</option>
                                <option value="bon" {{ old('condition', $console->condition) == 'bon' ? 'selected' : '' }}>Bon</option>
                                <option value="acceptable" {{ old('condition', $console->condition) == 'acceptable' ? 'selected' : '' }}>Acceptable</option>
                            </select>
                            @error('condition')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="4">{{ old('description', $console->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        @if($console->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $console->image) }}" alt="Image actuelle" class="img-thumbnail" style="max-height: 150px;">
                                <p class="small text-muted">Image actuelle</p>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                               id="image" name="image" accept="image/*">
                        <div class="form-text">Laissez vide pour garder l'image actuelle.</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_available" name="is_available"
                               {{ old('is_available', $console->is_available) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_available">Disponible à la vente</label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle"></i> Enregistrer les modifications
                        </button>
                        <a href="{{ route('consoles.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
