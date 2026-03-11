@extends('layouts.app')

@section('content')
<h1 class="mb-4"><i class="bi bi-cart"></i> Votre panier</h1>

@if($cartItems->isEmpty())
  <div class="alert alert-info">
    <i class="bi bi-cart-x"></i> Votre panier est vide.
    <a href="{{ route('consoles.index') }}" class="alert-link">Découvrez nos consoles</a>
  </div>
@else
  <div class="card shadow">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>Console</th>
              <th>Prix unitaire</th>
              <th>Quantité</th>
              <th>Sous-total</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cartItems as $item)
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    @if($item->console->image)
                      <img src="{{ asset('storage/' . $item->console->image) }}"
                         alt="{{ $item->console->name }}"
                         class="img-thumbnail me-3" style="width: 80px; height: 60px; object-fit: cover;">
                    @else
                      <div class="bg-secondary d-flex align-items-center justify-content-center me-3"
                         style="width: 80px; height: 60px;">
                        <i class="bi bi-controller text-white"></i>
                      </div>
                    @endif
                    <div>
                      <a href="{{ route('consoles.show', $item->console) }}" class="text-decoration-none fw-bold">
                        {{ $item->console->name }}
                      </a>
                      <br>
                      <small class="text-muted">{{ $item->console->category->name }}</small>
                    </div>
                  </div>
                </td>
                <td>{{ number_format($item->console->price, 2, ',', ' ') }} €</td>
                <td>
                  <form action="{{ route('cart.update', $item) }}" method="POST" class="d-flex align-items-center" style="width: 120px;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}"
                        class="btn btn-outline-secondary btn-sm" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                      <i class="bi bi-dash"></i>
                    </button>
                    <span class="mx-3 fw-bold">{{ $item->quantity }}</span>
                    <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}"
                        class="btn btn-outline-secondary btn-sm">
                      <i class="bi bi-plus"></i>
                    </button>
                  </form>
                </td>
                <td class="fw-bold">{{ number_format($item->console->price * $item->quantity, 2, ',', ' ') }} €</td>
                <td>
                  <form action="{{ route('cart.destroy', $item) }}" method="POST"
                      onsubmit="return confirm('Retirer cet article du panier ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot class="table-light">
            <tr>
              <td colspan="3" class="text-end fw-bold fs-5">Total :</td>
              <td class="fw-bold fs-5 text-success">{{ number_format($total, 2, ',', ' ') }} €</td>
              <td></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between mt-4">
    <a href="{{ route('consoles.index') }}" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left"></i> Continuer les achats
    </a>
    <a href="#" class="btn btn-success btn-lg">
      <i class="bi bi-credit-card"></i> Procéder au paiement
    </a>
  </div>
@endif
@endsection
