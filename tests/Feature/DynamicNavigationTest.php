<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Services\ContentService;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DynamicNavigationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ProductSeeder::class);
    }

    public function test_database_is_seeded_with_22_products_and_images(): void
    {
        $this->assertEquals(22, Product::count());

        $bpc = Product::where('slug', 'bpc-157')->first();
        $this->assertNotNull($bpc);
        $this->assertStringContainsString('photorealistic-single-glass', $bpc->image);

        $mk677 = Product::where('slug', 'mk-677-ibutamoren')->first();
        $this->assertNotNull($mk677);
        $this->assertStringContainsString('sarm-mk-677-hd', $mk677->image);

        $retaPen = Product::where('slug', 'retatrutide-pen-kit')->first();
        $this->assertNotNull($retaPen);
        $this->assertStringContainsString('pen-kit-retatrutide-hd', $retaPen->image);
    }

    public function test_content_service_returns_dynamic_categories(): void
    {
        $categories = ContentService::getCategories();

        $this->assertArrayHasKey('peptides', $categories);
        $this->assertArrayHasKey('sarms', $categories);
        $this->assertArrayHasKey('pen-kits', $categories);

        $this->assertCount(13, $categories['peptides']['products']);
        $this->assertCount(6, $categories['sarms']['products']);
        $this->assertCount(3, $categories['pen-kits']['products']);
    }

    public function test_navigation_renders_dynamic_categories_and_product_images(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Category triggers
        $response->assertSee('Vials');
        $response->assertSee('SARMs');
        $response->assertSee('Pen Kits');

        // Dynamic product cards inside mega navigation
        $response->assertSee('BPC-157');
        $response->assertSee('MK-677');
        $response->assertSee('Retatrutide 40mg Pen Kit');

        // Dynamic images inside navigation
        $response->assertSee('photorealistic-single-glass-research-via-ATRm5m.png');
        $response->assertSee('sarm-mk-677-hd.jpg');
        $response->assertSee('pen-kit-retatrutide-hd.jpg');
    }

    public function test_home_page_shows_dynamic_featured_compounds_grid(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response->assertSee('Featured Research Compounds');
        $response->assertSee('Live In-Stock Catalog');
    }
}

