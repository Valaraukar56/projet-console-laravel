<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\CartItem;
use App\Models\Console;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class CartItemTest extends TestCase
{
  use RefreshDatabase;

  private function createCategory(): Category
  {
    return Category::create([
      'name' => 'PlayStation',
      'slug' => 'playstation',
      'description' => 'Consoles PlayStation',
      'image' => null,
    ]);
  }

  private function createConsole(Category $category): Console
  {
    return Console::create([
      'name' => 'PlayStation 5',
      'price' => 499.99,
      'condition' => 'neuf',
      'category_id' => $category->id,
      'is_available' => true,
    ]);
  }

  #[Test]
  public function test_cart_page_is_visible()
  {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/cart');

    $response->assertStatus(200);
  }

  #[Test]
  public function test_it_can_create_a_cart_item()
  {
    $user = User::factory()->create();
    $category = $this->createCategory();
    $console = $this->createConsole($category);

    $cartItem = CartItem::create([
      'user_id' => $user->id,
      'console_id' => $console->id,
      'quantity' => 1,
    ]);

    $this->assertDatabaseHas('cart_items', [
      'user_id' => $user->id,
      'console_id' => $console->id,
      'quantity' => 1,
    ]);
  }

  #[Test]
  public function test_it_can_delete_a_cart_item()
  {
    $user = User::factory()->create();
    $category = $this->createCategory();
    $console = $this->createConsole($category);

    $cartItem = CartItem::create([
      'user_id' => $user->id,
      'console_id' => $console->id,
      'quantity' => 1,
    ]);

    $cartItemId = $cartItem->id;
    $cartItem->delete();

    $this->assertNull(CartItem::find($cartItemId));
  }

  #[Test]
  public function test_it_fails_to_create_cart_item_without_user_id()
  {
    $category = $this->createCategory();
    $console = $this->createConsole($category);

    $this->expectException(\Illuminate\Database\QueryException::class);

    CartItem::create([
      'console_id' => $console->id,
      'quantity' => 1,
    ]);
  }

  #[Test]
  public function test_it_fails_to_create_cart_item_without_console_id()
  {
    $user = User::factory()->create();

    $this->expectException(\Illuminate\Database\QueryException::class);

    CartItem::create([
      'user_id' => $user->id,
      'quantity' => 1,
    ]);
  }

  #[Test]
  public function test_cart_is_not_accessible_without_auth()
  {
    $response = $this->get('/cart');

    $response->assertRedirect('/login');
  }
}
