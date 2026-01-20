@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        @if($console->image)
            <img src="{{ asset('storage/' . $console->image) }}" class="img-fluid rounded shadow" alt="{{ $console->name }}">
        @else
            <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="height: 400px;">
                <i class="bi bi-controller text-white" style="font-size: 8rem;"></i>
            </div>
        @endif
    </div>
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('consoles.index') }}">Consoles</a></li>
                <li class="breadcrumb-item"><a href="{{ route('consoles.index', ['category' => $console->category_id]) }}">{{ $console->category->name }}</a></li>
                <li class="breadcrumb-item active">{{ $console->name }}</li>
            </ol>
        </nav>

        <h1>{{ $console->name }}</h1>

        <div class="mb-3">
            <span class="badge bg-info fs-6">{{ $console->category->name }}</span>
            <span class="badge fs-6
                @if($console->condition == 'neuf') bg-success
                @elseif($console->condition == 'très bon') bg-primary
                @elseif($console->condition == 'bon') bg-warning text-dark
                @else bg-secondary
                @endif">
                État : {{ ucfirst($console->condition) }}
            </span>
        </div>

        <p class="fs-2 fw-bold text-success">{{ number_format($console->price, 2, ',', ' ') }} €</p>

        <div class="card mb-4">
            <div class="card-header">
                <i class="bi bi-info-circle"></i> Description
            </div>
            <div class="card-body">
                <p>{{ $console->description ?: 'Aucune description disponible.' }}</p>
            </div>
        </div>

        @if($console->is_available)
            @auth
                <form action="{{ route('cart.store', $console) }}" method="POST" class="mb-3">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-cart-plus"></i> Ajouter au panier
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary btn-lg w-100 mb-3">
                    <i class="bi bi-box-arrow-in-right"></i> Connectez-vous pour acheter
                </a>
            @endauth
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> Cette console n'est plus disponible.
            </div>
        @endif

        @auth
            @role('admin')
                <div class="d-flex gap-2">
                    <a href="{{ route('consoles.edit', $console) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <form action="{{ route('consoles.destroy', $console) }}" method="POST"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette console ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            @endrole
        @endauth

        <hr>
        <a href="{{ route('consoles.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection
