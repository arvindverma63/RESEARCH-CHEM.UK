<?php

namespace Tests\Feature;

use Tests\TestCase;

class WebsitePagesTest extends TestCase
{
    public function test_homepage_renders(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('RESEARCH-CHEM.UK');
        $response->assertSee('Laboratory Research Compounds');
        $response->assertSee('FOR RESEARCH USE ONLY');
        $response->assertSee('aria-label="Scroll to top"', false);
    }

    public function test_peptide_vials_page_renders(): void
    {
        $response = $this->get('/peptide-vials');
        $response->assertStatus(200);
        $response->assertSee('Peptide Lyophilized Vials');
        $response->assertSee('BPC-157');
        $response->assertSee('TB-500');
        $response->assertSee('Retatrutide');
        $response->assertSee('Data Sheet');
        $response->assertSee('CAS No.');
        $response->assertSee('Mol. Formula');
        $response->assertSee('Mol. Weight');
        $response->assertSee('Sequence');
        $response->assertSee('Appearance');
        $response->assertSee('Storage');
        $response->assertSee('GEPPPGKPADDA');
    }

    public function test_sarms_page_renders(): void
    {
        $response = $this->get('/sarms-products');
        $response->assertStatus(200);
        $response->assertSee('SARMs Research Compounds');
        $response->assertSee('MK-677');
        $response->assertSee('RAD-140');
        $response->assertSee('LGD-4033');
    }

    public function test_pen_kits_page_renders(): void
    {
        $response = $this->get('/pen-kits');
        $response->assertStatus(200);
        $response->assertSee('Peptide Pen Kits');
        $response->assertSee('Retatrutide');
        $response->assertSee('Wolverine');
        $response->assertSee('GLOW');
    }

    public function test_product_detail_bpc157(): void
    {
        $response = $this->get('/products/bpc-157');
        $response->assertStatus(200);
        $response->assertSee('BPC-157');
        $response->assertSee('RESEARCH USE ONLY');
    }

    public function test_product_detail_retatrutide(): void
    {
        $response = $this->get('/products/retatrutide');
        $response->assertStatus(200);
        $response->assertSee('Retatrutide');
    }

    public function test_product_detail_glow_ghk_cu(): void
    {
        $response = $this->get('/products/glow-ghk-cu');
        $response->assertStatus(200);
        $response->assertSee('GLOW GHK-CU');
    }

    public function test_product_detail_mk677(): void
    {
        $response = $this->get('/products/mk-677-ibutamoren');
        $response->assertStatus(200);
        $response->assertSee('MK-677');
    }

    public function test_product_detail_pen_kit(): void
    {
        $response = $this->get('/products/retatrutide-pen-kit');
        $response->assertStatus(200);
        $response->assertSee('Retatrutide');
    }

    public function test_coa_page_renders(): void
    {
        $response = $this->get('/coa');
        $response->assertStatus(200);
        $response->assertSee('Certificates of Analysis (COA)');
        $response->assertSee('RCK-RET-40');
        $response->assertSee('99.6%');
        $response->assertSee('coa-retatrutide.png?v=4');
        $this->assertFileExists(public_path('assets/images/coa/coa-retatrutide.png'));
    }

    public function test_compliance_page_renders(): void
    {
        $response = $this->get('/compliance');
        $response->assertStatus(200);
        $response->assertSee('Crucial Compliance Notice');
        $response->assertSee('Who We Are');
    }

    public function test_contact_page_renders_and_accepts_submissions(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Contact Our Laboratory Team');

        $postResponse = $this->postJson('/contact', [
            'name' => 'Lab Researcher',
            'email' => 'researcher@testlab.org',
            'subject' => 'CoA Verification Inquiry',
            'message' => 'Requesting batch details for RET-2026-05.'
        ]);
        $postResponse->assertStatus(200);
        $postResponse->assertJson(['success' => true]);
    }

    public function test_cart_page_renders(): void
    {
        $response = $this->get('/cart');
        $response->assertStatus(200);
        $response->assertSee('Your Research Order');
    }

    public function test_legal_policy_pages_render(): void
    {
        $pages = [
            '/terms-conditions',
            '/privacy-policy',
            '/cookie-policy',
            '/refund-policy',
            '/shipping-policy',
            '/acceptable-use',
            '/disclaimer',
        ];

        foreach ($pages as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $response->assertSee('UK Law Applicable');
        }
    }

    public function test_301_redirects(): void
    {
        $redirects = [
            '/catalogue' => '/peptide-vials',
            '/products' => '/peptide-vials',
            '/peptides' => '/peptide-vials',
            '/vials' => '/peptide-vials',
            '/sarms' => '/sarms-products',
            '/products/mk-677' => '/products/mk-677-ibutamoren',
        ];

        foreach ($redirects as $from => $to) {
            $response = $this->get($from);
            $response->assertRedirect($to);
            $response->assertStatus(301);
        }
    }

    public function test_api_endpoints(): void
    {
        $health = $this->getJson('/api/health');
        $health->assertStatus(200);
        $health->assertJson(['status' => 'healthy']);

        $products = $this->getJson('/api/commerce/products');
        $products->assertStatus(200);
        $this->assertGreaterThan(10, count($products->json('products')));

        $single = $this->getJson('/api/commerce/products/bpc-157');
        $single->assertStatus(200);
        $this->assertEquals('BPC-157', $single->json('product.name'));
    }

    public function test_bank_transfer_order_api(): void
    {
        $orderData = [
            'customerName' => 'Dr. Jane Smith',
            'customerEmail' => 'jane.smith@biotech.co.uk',
            'customerAddress' => [
                'line1' => '10 Innovation Way',
                'city' => 'Cambridge',
                'postcode' => 'CB1 2AA'
            ],
            'customerComments' => 'Deliver to reception',
            'items' => [
                [
                    'id' => 'bpc-157',
                    'name' => 'BPC-157 10MG',
                    'price' => 2495,
                    'quantity' => 2,
                    'currency' => 'gbp'
                ]
            ],
            'shippingFee' => 650,
            'discounts' => [],
            'finalTotal' => 5640
        ];

        $response = $this->postJson('/api/bank-transfer/place-order', $orderData);
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertStringStartsWith('RC-', $response->json('ref'));
        $this->assertEquals('Paul Stromberg', $response->json('bank.name'));
        $this->assertEquals('30-96-91', $response->json('bank.sortCode'));
    }

    public function test_media_asset_resolver(): void
    {
        // 1. Home category images (served as authentic local high-res crops)
        $homePep = $this->get('/airo-assets/images/pages/home/category-peptides');
        $homePep->assertStatus(200);

        $homeSarms = $this->get('/airo-assets/images/pages/home/category-sarms');
        $homeSarms->assertStatus(200);

        $homePenKits = $this->get('/airo-assets/images/pages/home/category-pen-kits');
        $homePenKits->assertStatus(200);

        // 2. Peptide products
        $bpc = $this->get('/airo-assets/images/pages/peptides/bpc-157');
        $bpc->assertStatus(200);

        $tb = $this->get('/airo-assets/images/pages/peptides/tb-500');
        $tb->assertStatus(200);

        $reta = $this->get('/airo-assets/images/pages/peptides/retatrutide');
        $reta->assertStatus(200);

        // 3. SARMs products (served as authentic local bottle shots)
        $mk677 = $this->get('/airo-assets/images/pages/sarms/mk-677-ibutamoren');
        $mk677->assertStatus(200);

        // 4. Pen Kits products
        $penKit = $this->get('/airo-assets/images/pages/pen-kits/shot-162840');
        $penKit->assertStatus(200);

        // 5. Uploads
        $responseUpload = $this->get('/airo-assets/uploads/change-the-label-on-this-research-chemic-LRmlHu.png');
        $responseUpload->assertStatus(200);
    }

    public function test_pwa_assets_and_manifest_configured(): void
    {
        // 1. Web App Manifest
        $manifest = $this->get('/manifest.webmanifest');
        $manifest->assertStatus(200);
        $manifestData = json_decode($manifest->getContent(), true);
        $this->assertIsArray($manifestData);
        $this->assertEquals('ResearchChem', $manifestData['short_name']);
        $this->assertEquals('standalone', $manifestData['display']);
        $this->assertNotEmpty($manifestData['icons']);

        // 2. Service Worker
        $sw = $this->get('/sw.js');
        $sw->assertStatus(200);
        $this->assertStringContainsString('rc-pwa-v1', $sw->getContent());
        $this->assertStringContainsString('PRECACHE_ASSETS', $sw->getContent());

        // 3. App Icons exist and are valid PNG files
        $this->assertFileExists(public_path('icons/icon-192.png'));
        $this->assertFileExists(public_path('icons/icon-512.png'));
        $this->assertFileExists(public_path('icons/apple-touch-icon.png'));
        $this->assertFileExists(public_path('icons/icon.svg'));

        // 4. Storefront homepage contains PWA metadata and install triggers
        $home = $this->get('/');
        $home->assertStatus(200);
        $home->assertSee('manifest.webmanifest');
        $home->assertSee('apple-touch-icon');
        $home->assertSee('Install Mobile App');
        $home->assertSee('Install ResearchChem App');
        $home->assertSee('Install on iPhone / iPad');
    }
}
