<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Console;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $cartItems = CartItem::with('console')
      ->where('user_id', Auth::id())
      ->get();

    $total = $cartItems->sum(function ($item) {
      return $item->console->price * $item->quantity;
    });

    return view('cart.index', compact('cartItems', 'total'));
  }

  public function store(Request $request, Console $console)
  {
    if (!$console->is_available) {
      return redirect()->back()
        ->with('error', 'Cette console n\'est plus disponible.');
    }

    $cartItem = CartItem::where('user_id', Auth::id())
      ->where('console_id', $console->id)
      ->first();

    if ($cartItem) {
      $cartItem->increment('quantity');
    } else {
      CartItem::create([
        'user_id' => Auth::id(),
        'console_id' => $console->id,
        'quantity' => 1,
      ]);
    }

    return redirect()->back()
      ->with('success', 'Console ajoutée au panier !');
  }

  public function update(Request $request, CartItem $cartItem)
  {
    if ($cartItem->user_id !== Auth::id()) {
      abort(403);
    }

    $validated = $request->validate([
      'quantity' => 'required|integer|min:1',
    ]);

    $cartItem->update($validated);

    return redirect()->route('cart.index')
      ->with('success', 'Panier mis à jour !');
  }

  public function destroy(CartItem $cartItem)
  {
    if ($cartItem->user_id !== Auth::id()) {
      abort(403);
    }

    $cartItem->delete();

    return redirect()->route('cart.index')
      ->with('success', 'Article retiré du panier !');
  }
}
