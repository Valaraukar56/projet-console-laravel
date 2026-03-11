<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Console;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ConsoleTest extends TestCase
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

    #[Test]
    public function test_it_can_create_a_console()
    {
        $category = $this->createCategory();

        $console = Console::create([
            'name' => 'PlayStation 5',
            'description' => 'Dernière console Sony',
            'price' => 499.99,
            'condition' => 'neuf',
            'category_id' => $category->id,
            'is_available' => true,
        ]);

        $this->assertDatabaseHas('consoles', [
            'name' => 'PlayStation 5',
        ]);
    }

    #[Test]
    public function test_it_can_delete_a_console()
    {
        $category = $this->createCategory();

        $console = Console::create([
            'name' => 'Xbox Series X',
            'price' => 499.99,
            'condition' => 'neuf',
            'category_id' => $category->id,
            'is_available' => true,
        ]);

        $consoleId = $console->id;
        $console->delete();

        $this->assertDatabaseMissing('consoles', ['id' => $consoleId]);
    }

    #[Test]
    public function test_it_belongs_to_a_category()
    {
        $category = $this->createCategory();

        $console = Console::create([
            'name' => 'Nintendo Switch',
            'price' => 299.99,
            'condition' => 'bon',
            'category_id' => $category->id,
            'is_available' => true,
        ]);

        $this->assertEquals('PlayStation', $console->category->name);
    }

    #[Test]
    public function test_it_casts_price_to_decimal()
    {
        $category = $this->createCategory();

        $console = Console::create([
            'name' => 'Test Console',
            'price' => 299.99,
            'condition' => 'neuf',
            'category_id' => $category->id,
            'is_available' => true,
        ]);

        $this->assertEquals('299.99', $console->price);
    }

    #[Test]
    public function test_it_casts_is_available_to_boolean()
    {
        $category = $this->createCategory();

        $console = Console::create([
            'name' => 'Test Console',
            'price' => 99.99,
            'condition' => 'acceptable',
            'category_id' => $category->id,
            'is_available' => true,
        ]);

        $this->assertIsBool($console->is_available);
        $this->assertTrue($console->is_available);
    }

    #[Test]
    public function test_consoles_page_is_accessible()
    {
        $response = $this->get('/consoles');

        $response->assertStatus(200);
    }

    #[Test]
    public function test_it_fails_to_create_console_without_name()
    {
        $category = $this->createCategory();

        $this->expectException(\Illuminate\Database\QueryException::class);

        Console::create([
            'price' => 299.99,
            'condition' => 'neuf',
            'category_id' => $category->id,
            'is_available' => true,
        ]);
    }

    #[Test]
    public function test_it_fails_to_create_console_without_price()
    {
        $category = $this->createCategory();

        $this->expectException(\Illuminate\Database\QueryException::class);

        Console::create([
            'name' => 'Test Console',
            'condition' => 'neuf',
            'category_id' => $category->id,
            'is_available' => true,
        ]);
    }
}
