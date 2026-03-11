@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow">
      <div class="card-header bg-success text-white">
        <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Ajouter une console</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('consoles.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label for="name" class="form-label">Nom de la console *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                 id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie *</label>
            <select class="form-select @error('category_id') is-invalid @enderror"
                id="category_id" name="category_id" required>
              <option value="">Sélectionnez une catégorie</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                   id="price" name="price" value="{{ old('price') }}" required>
              @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label for="condition" class="form-label">État *</label>
              <select class="form-select @error('condition') is-invalid @enderror"
                  id="condition" name="condition" required>
                <option value="neuf" {{ old('condition') == 'neuf' ? 'selected' : '' }}>Neuf</option>
                <option value="très bon" {{ old('condition') == 'très bon' ? 'selected' : '' }}>Très bon</option>
                <option value="bon" {{ old('condition', 'bon') == 'bon' ? 'selected' : '' }}>Bon</option>
                <option value="acceptable" {{ old('condition') == 'acceptable' ? 'selected' : '' }}>Acceptable</option>
              </select>
              @error('condition')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror"
                  id="description" name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror"
                 id="image" name="image" accept="image/*">
            @error('image')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-check-circle"></i> Créer la console
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
