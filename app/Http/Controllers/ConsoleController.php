<?php

namespace App\Http\Controllers;

use App\Models\Console;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConsoleController extends Controller
{
  public function index(Request $request)
  {
    $query = Console::with('category')->where('is_available', true);

    if ($request->has('category') && $request->category) {
      $query->where('category_id', $request->category);
    }

    if ($request->has('condition') && $request->condition) {
      $query->where('condition', $request->condition);
    }

    $consoles = $query->latest()->get();
    $categories = Category::where('slug', '!=', 'retro')->get();

    return view('consoles.index', compact('consoles', 'categories'));
  }

  public function show(Console $console)
  {
    return view('consoles.show', compact('console'));
  }

  public function create()
  {
    $categories = Category::all();
    return view('consoles.create', compact('categories'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|min:2|max:255',
      'description' => 'nullable|string',
      'price' => 'required|numeric|min:0.01',
      'condition' => 'required|in:neuf,très bon,bon,acceptable',
      'category_id' => 'required|exists:categories,id',
      'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
      $validated['image'] = $request->file('image')->store('consoles', 'public');
    }

    Console::create($validated);

    return redirect()->route('consoles.index')
      ->with('success', 'Console ajoutée avec succès !');
  }

  public function edit(Console $console)
  {
    $categories = Category::all();
    return view('consoles.edit', compact('console', 'categories'));
  }

  public function update(Request $request, Console $console)
  {
    $validated = $request->validate([
      'name' => 'required|string|min:2|max:255',
      'description' => 'nullable|string',
      'price' => 'required|numeric|min:0.01',
      'condition' => 'required|in:neuf,très bon,bon,acceptable',
      'category_id' => 'required|exists:categories,id',
      'image' => 'nullable|image|max:2048',
      'is_available' => 'boolean',
    ]);

    if ($request->hasFile('image')) {
      if ($console->image) {
        Storage::disk('public')->delete($console->image);
      }
      $validated['image'] = $request->file('image')->store('consoles', 'public');
    }

    $validated['is_available'] = $request->has('is_available');

    $console->update($validated);

    return redirect()->route('consoles.index')
      ->with('success', 'Console mise à jour avec succès !');
  }

  public function destroy(Console $console)
  {
    if ($console->image) {
      Storage::disk('public')->delete($console->image);
    }

    $console->delete();

    return redirect()->route('consoles.index')
      ->with('success', 'Console supprimée avec succès !');
  }
}
