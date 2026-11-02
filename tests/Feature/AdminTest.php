<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use App\Services\ProductSyncService;
use Database\Seeders\OrderAndLeadSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin Tester',
            'email' => 'admin_test@research-chem.uk',
            'password' => Hash::make('secret123'),
            'is_admin' => true,
        ]);

        ProductSyncService::importFromJson();
        $this->seed(OrderAndLeadSeeder::class);
    }

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_login_page_renders(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Management Portal');
        $response->assertSee('admin@research-chem.uk');
    }

    public function test_admin_can_login_and_view_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Customer Orders');
        $response->assertSee('Leads');
    }

    public function test_admin_can_view_products_list(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/products');
        $response->assertStatus(200);
        $response->assertSee('All Research Compounds');
        $response->assertSee('BPC-157');
    }

    public function test_admin_can_toggle_product_stock(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        $initialStock = $product->in_stock;

        $response = $this->actingAs($this->admin)->post("/admin/products/{$product->id}/toggle-stock");
        $response->assertRedirect();

        $product->refresh();
        $this->assertNotEquals($initialStock, $product->in_stock);

        // Toggle back to restore
        $this->actingAs($this->admin)->post("/admin/products/{$product->id}/toggle-stock");
    }

    public function test_admin_edit_page_renders_datasheet_fields(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        $response = $this->actingAs($this->admin)->get("/admin/products/{$product->id}/edit");
        $response->assertStatus(200);
        $response->assertSee('Chemical Data Sheet &amp; Laboratory Specifications', false);
        $response->assertSee('CAS Registry No.');
        $response->assertSee('Molecular Formula');
        $response->assertSee('Molecular Weight');
        $response->assertSee('Full Amino Acid Sequence');
    }

    public function test_admin_can_update_product_chemical_datasheet(): void
    {
        $product = Product::where('slug', 'bpc-157')->first();
        $this->assertNotNull($product);

        $response = $this->actingAs($this->admin)->put("/admin/products/{$product->id}", [
            'name' => 'BPC-157',
            'slug' => 'bpc-157',
            'category' => 'peptides',
            'price' => '£24.95',
            'purity' => '≥99.5% (HPLC)',
            'cas_no' => '137525-51-0',
            'formula' => 'C62H98N16O22',
            'molecular_weight' => '1419.55 g/mol',
            'chem_desc' => 'Updated experimental peptide profile for laboratory research.',
            'sequence' => 'Gly-Glu-Pro-Pro-Pro-Gly-Lys-Pro-Ala-Asp-Asp-Ala-Gly-Leu-Val',
            'appearance' => 'Ultra-pure white lyophilised cake',
            'storage' => '-20 °C long-term desiccated',
        ]);

        $response->assertRedirect("/admin/products/{$product->id}/edit");
        $response->assertSessionHas('success');

        $product->refresh();
        $this->assertEquals('≥99.5% (HPLC)', $product->purity);
        $this->assertEquals('137525-51-0', $product->cas_no);
        $this->assertEquals('C62H98N16O22', $product->formula);
        $this->assertEquals('Updated experimental peptide profile for laboratory research.', $product->details['chemDesc']);
        $this->assertEquals('1419.55 g/mol', $product->details['molecularWeight']);
        $this->assertEquals('Ultra-pure white lyophilised cake', $product->details['appearance']);
        $this->assertEquals('-20 °C long-term desiccated', $product->details['storage']);

        // Check that the storefront page reflects the updated chemical datasheet
        $storefront = $this->get('/peptide-vials');
        $storefront->assertStatus(200);
        $storefront->assertSee('Ultra-pure white lyophilised cake');
        $storefront->assertSee('Updated experimental peptide profile for laboratory research.');

        // Restore original BPC-157 datasheet for subsequent test runs
        $this->actingAs($this->admin)->put("/admin/products/{$product->id}", [
            'name' => 'BPC-157',
            'slug' => 'bpc-157',
            'category' => 'peptides',
            'price' => '£24.95',
            'purity' => '≥98.0% (HPLC)',
            'cas_no' => '137525-51-0',
            'formula' => 'C62H98N16O22',
            'molecular_weight' => '1419.55 g/mol',
            'chem_desc' => 'Pentadecapeptide fragment of human Body Protection Compound. Sequence: GEPPPGKPADDAGLV. Stable gastric pentadecapeptide; resistant to enzymatic hydrolysis in gastric juice.',
            'sequence' => 'Gly-Glu-Pro-Pro-Pro-Gly-Lys-Pro-Ala-Asp-Asp-Ala-Gly-Leu-Val',
            'appearance' => 'White lyophilised powder',
            'storage' => '−20 °C long-term; 2–8 °C short-term',
        ]);
    }

    public function test_admin_edit_page_renders_seo_and_schema_fields(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        $response = $this->actingAs($this->admin)->get("/admin/products/{$product->id}/edit");
        $response->assertStatus(200);
        $response->assertSee('(SEO) &amp; Schema Structured Data', false);
        $response->assertSee('SEO Meta Title');
        $response->assertSee('Meta Description');
        $response->assertSee('Meta Keywords');
        $response->assertSee('Schema.org Structured Data (JSON-LD)', false);
        $response->assertSee('Upload Schema JSON File');
        $response->assertSee('Google Search Result Preview');
    }

    public function test_admin_can_update_product_seo_and_schema(): void
    {
        $product = Product::where('slug', 'bpc-157')->first();
        $this->assertNotNull($product);

        $customSchema = json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => 'Custom BPC-157 Lab Grade',
            'sku' => 'BPC-157-CUSTOM',
        ], JSON_PRETTY_PRINT);

        $response = $this->actingAs($this->admin)->put("/admin/products/{$product->id}", [
            'name' => 'BPC-157',
            'slug' => 'bpc-157',
            'category' => 'peptides',
            'price' => '£24.95',
            'seo_title' => 'Buy BPC-157 10mg UK | HPLC Verified Lab Grade | ResearchChem.uk',
            'meta_description' => 'High purity laboratory-grade BPC-157 10mg peptide vial. UK third-party HPLC tested with full analytical COA report.',
            'meta_keywords' => 'bpc 157, peptides uk, buy bpc157 laboratory',
            'schema_markup' => $customSchema,
        ]);

        $response->assertRedirect("/admin/products/{$product->id}/edit");
        $response->assertSessionHas('success');

        $product->refresh();
        $this->assertEquals('Buy BPC-157 10mg UK | HPLC Verified Lab Grade | ResearchChem.uk', $product->seo_title);
        $this->assertEquals('High purity laboratory-grade BPC-157 10mg peptide vial. UK third-party HPLC tested with full analytical COA report.', $product->meta_description);
        $this->assertEquals('bpc 157, peptides uk, buy bpc157 laboratory', $product->meta_keywords);
        $this->assertEquals($customSchema, $product->schema_markup);

        // Storefront product page should render the custom SEO title, description, keywords, and custom schema
        $storefront = $this->get('/products/bpc-157');
        $storefront->assertStatus(200);
        $storefront->assertSee('<title>Buy BPC-157 10mg UK | HPLC Verified Lab Grade | ResearchChem.uk</title>', false);
        $storefront->assertSee('High purity laboratory-grade BPC-157 10mg peptide vial. UK third-party HPLC tested with full analytical COA report.');
        $storefront->assertSee('<meta name="keywords" content="bpc 157, peptides uk, buy bpc157 laboratory">', false);
        $storefront->assertSee('Custom BPC-157 Lab Grade');
        $storefront->assertSee('BPC-157-CUSTOM');
    }

    public function test_admin_can_upload_schema_file(): void
    {
        $product = Product::where('slug', 'bpc-157')->first();
        $this->assertNotNull($product);

        $fileContent = json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => 'Uploaded Schema Test',
            'sku' => 'UPLOADED-SCHEMA-01',
        ]);

        $fakeFile = UploadedFile::fake()->createWithContent('bpc-schema.json', $fileContent);

        $response = $this->actingAs($this->admin)->put("/admin/products/{$product->id}", [
            'name' => 'BPC-157',
            'slug' => 'bpc-157',
            'category' => 'peptides',
            'price' => '£24.95',
            'schema_file' => $fakeFile,
        ]);

        $response->assertRedirect("/admin/products/{$product->id}/edit");

        $product->refresh();
        $this->assertStringContainsString('UPLOADED-SCHEMA-01', $product->schema_markup);
        $this->assertStringContainsString('Uploaded Schema Test', $product->schema_markup);
    }

    public function test_admin_can_view_orders_list(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/orders');
        $response->assertStatus(200);
        $response->assertSee('Orders Management');
        $response->assertSee('Order Ref / Date');
    }

    public function test_admin_can_view_order_details_and_update_status(): void
    {
        $order = Order::first();
        $this->assertNotNull($order);

        $response = $this->actingAs($this->admin)->get("/admin/orders/{$order->id}");
        $response->assertStatus(200);
        $response->assertSee($order->ref);
        $response->assertSee($order->customer_name);

        // Update status to processing
        $updateResp = $this->actingAs($this->admin)->post("/admin/orders/{$order->id}/status", [
            'status' => 'processing',
            'admin_notes' => 'Payment received via bank transfer.',
        ]);
        $updateResp->assertRedirect();

        $order->refresh();
        $this->assertEquals('processing', $order->status);
        $this->assertEquals('Payment received via bank transfer.', $order->admin_notes);
    }

    public function test_admin_can_view_leads_and_update_status(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/leads');
        $response->assertStatus(200);
        $response->assertSee('Leads &amp; Inquiries', false);

        $lead = ContactMessage::first();
        $this->assertNotNull($lead);

        $showResp = $this->actingAs($this->admin)->get("/admin/leads/{$lead->id}");
        $showResp->assertStatus(200);
        $showResp->assertSee($lead->email);

        $updateResp = $this->actingAs($this->admin)->post("/admin/leads/{$lead->id}/status", [
            'status' => 'replied',
            'admin_notes' => 'Sent wholesale pricing quote.',
        ]);
        $updateResp->assertRedirect();

        $lead->refresh();
        $this->assertEquals('replied', $lead->status);
    }

    public function test_admin_products_table_has_pagination_and_per_page_filter(): void
    {
        // Default pagination: 10 per page
        $response = $this->actingAs($this->admin)->get('/admin/products');
        $response->assertStatus(200);
        $response->assertSee('Showing');
        $response->assertSee('Rows per page');
        $response->assertSee('page=2');

        // Request custom per_page
        $response20 = $this->actingAs($this->admin)->get('/admin/products?per_page=20');
        $response20->assertStatus(200);
        $response20->assertSee('Showing');
        $response20->assertSee('to <strong class="font-bold text-slate-900">20</strong> of', false);

        // Page 2 navigation
        $responsePage2 = $this->actingAs($this->admin)->get('/admin/products?page=2');
        $responsePage2->assertStatus(200);
        $responsePage2->assertSee('Showing');
        $responsePage2->assertSee('to <strong class="font-bold text-slate-900">20</strong> of', false);
    }
}
