@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="bi bi-controller"></i> Nos Consoles</h1>
    </div>
    <div class="col-md-4 text-end">
        @auth
            @role('admin')
                <a href="{{ route('consoles.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Ajouter une console
                </a>
            @endrole
        @endauth
    </div>
</div>

<!-- Filtres -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('consoles.index') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Catégorie</label>
                <select name="category" class="form-select">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">État</label>
                <select name="condition" class="form-select">
                    <option value="">Tous les états</option>
                    <option value="neuf" {{ request('condition') == 'neuf' ? 'selected' : '' }}>Neuf</option>
                    <option value="très bon" {{ request('condition') == 'très bon' ? 'selected' : '' }}>Très bon</option>
                    <option value="bon" {{ request('condition') == 'bon' ? 'selected' : '' }}>Bon</option>
                    <option value="acceptable" {{ request('condition') == 'acceptable' ? 'selected' : '' }}>Acceptable</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-funnel"></i> Filtrer
                </button>
                <a href="{{ route('consoles.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Réinitialiser
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Liste des consoles -->
@if($consoles->isEmpty())
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Aucune console disponible pour le moment.
    </div>
@else
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach($consoles as $console)
            <div class="col">
                <div class="card h-100 console-card shadow-sm">
                    @if($console->image)
                        <img src="{{ asset('storage/' . $console->image) }}" class="card-img-top" alt="{{ $console->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-controller text-white" style="font-size: 4rem;"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-info">{{ $console->category->name }}</span>
                            <span class="badge condition-badge
                                @if($console->condition == 'neuf') bg-success
                                @elseif($console->condition == 'très bon') bg-primary
                                @elseif($console->condition == 'bon') bg-warning text-dark
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($console->condition) }}
                            </span>
                        </div>
                        <h5 class="card-title">{{ $console->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($console->description, 60) }}</p>
                        <p class="card-text fw-bold fs-5 text-success">{{ number_format($console->price, 2, ',', ' ') }} €</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-grid gap-2">
                            <a href="{{ route('consoles.show', $console) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye"></i> Voir détails
                            </a>
                            @auth
                                <form action="{{ route('cart.store', $console) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                        <i class="bi bi-cart-plus"></i> Ajouter au panier
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-box-arrow-in-right"></i> Connectez-vous pour acheter
                                </a>
                            @endauth
                            @auth
                                @role('admin')
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('consoles.edit', $console) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('consoles.destroy', $console) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette console ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endrole
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
