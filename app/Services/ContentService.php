<?php

namespace App\Services;

class ContentService
{
    protected static array $cache = [];

    public static function clearCache(): void
    {
        self::$cache = [];
    }

    /**
     * Read a JSON content file.
     */
    public static function getJson(string $name): array
    {
        if (isset(self::$cache[$name])) {
            return self::$cache[$name];
        }

        $path = resource_path("content/pages/{$name}.json");
        if (!file_exists($path)) {
            return [];
        }

        $data = json_decode(file_get_contents($path), true) ?: [];
        self::$cache[$name] = $data;
        return $data;
    }

    public static function getHome(): array
    {
        return self::getJson('home');
    }

    /**
     * Check if database products table is migrated and available.
     */
    protected static function hasProductsTable(): bool
    {
        try {
            return \Illuminate\Support\Facades\Schema::hasTable('products') && \App\Models\Product::count() > 0;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public static function getPeptideVials(): array
    {
        $json = self::getJson('peptide_vials');

        if (self::hasProductsTable()) {
            try {
                $dbProducts = \App\Models\Product::where('category', 'peptides')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();

                if ($dbProducts->isNotEmpty()) {
                    $jsonVialsBySlug = [];
                    foreach ($json['vials'] ?? [] as $jv) {
                        if (!empty($jv['slug'])) {
                            $jsonVialsBySlug[$jv['slug']] = $jv;
                        }
                    }

                    $vials = [];
                    foreach ($dbProducts as $p) {
                        $base = $jsonVialsBySlug[$p->slug] ?? [];
                        $vials[] = array_merge($base, [
                            'id' => (string) $p->id,
                            'slug' => $p->slug,
                            'name' => $p->name,
                            'dose' => $p->dose ?? ($base['dose'] ?? ''),
                            'price' => $p->price,
                            'price_pence' => $p->price_pence,
                            'purity' => $p->purity ?? ($base['purity'] ?? '≥98.0% (HPLC)'),
                            'cas' => !empty($p->cas_no) ? $p->cas_no : ($base['cas'] ?? ''),
                            'desc' => $p->description ?? ($base['desc'] ?? ''),
                            'vialSize' => $base['vialSize'] ?? '3ml',
                            'img' => $p->image ?: ($base['img'] ?? "/assets/images/photorealistic-single-glass-research-via-ATRm5m.png"),
                            'image' => $p->image ?: ($base['img'] ?? "/assets/images/photorealistic-single-glass-research-via-ATRm5m.png"),
                            'in_stock' => (bool) $p->in_stock,
                            'featured' => (bool) $p->featured,
                            'molecularFormula' => $base['molecularFormula'] ?? ($p->formula ?? ''),
                            'molecularWeight' => $base['molecularWeight'] ?? '',
                            'sequence' => $base['sequence'] ?? '',
                            'appearance' => $base['appearance'] ?? 'White lyophilised powder',
                            'storage' => $base['storage'] ?? '−20 °C long-term; 2–8 °C short-term',
                            'chemDesc' => $base['chemDesc'] ?? ($p->description ?? ''),
                        ]);
                    }
                    $json['vials'] = $vials;
                }
            } catch (\Throwable $e) {
                // Keep json fallback
            }
        }

        return $json;
    }

    public static function getSarms(): array
    {
        $json = self::getJson('sarms_products');

        if (self::hasProductsTable()) {
            try {
                $dbProducts = \App\Models\Product::where('category', 'sarms')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();

                if ($dbProducts->isNotEmpty()) {
                    $jsonBySlug = [];
                    foreach ($json['products'] ?? [] as $jp) {
                        if (!empty($jp['slug'])) {
                            $jsonBySlug[$jp['slug']] = $jp;
                        }
                    }

                    $products = [];
                    foreach ($dbProducts as $p) {
                        $base = $jsonBySlug[$p->slug] ?? [];
                        $products[] = array_merge($base, [
                            'id' => (string) $p->id,
                            'slug' => $p->slug,
                            'name' => $p->name,
                            'subtitle' => $p->subtitle ?? ($base['subtitle'] ?? ''),
                            'dose' => $p->dose ?? ($base['dose'] ?? '60ml'),
                            'concentration' => $base['concentration'] ?? ($p->dose ?? '30mg/ml'),
                            'volume' => $base['volume'] ?? '60ml',
                            'price' => $p->price,
                            'price_pence' => $p->price_pence,
                            'purity' => $p->purity ?? ($base['purity'] ?? '≥99.0% (HPLC)'),
                            'cas' => !empty($p->cas_no) ? $p->cas_no : ($base['cas'] ?? ''),
                            'desc' => $p->description ?? ($base['desc'] ?? ''),
                            'img' => $p->image ?: ($base['img'] ?? "/assets/images/sarm-mk-677-hd.jpg"),
                            'image' => $p->image ?: ($base['img'] ?? "/assets/images/sarm-mk-677-hd.jpg"),
                            'in_stock' => (bool) $p->in_stock,
                            'featured' => (bool) $p->featured,
                            'formula' => $p->formula ?? ($base['formula'] ?? ''),
                            'molecularFormula' => $base['molecularFormula'] ?? ($p->formula ?? ''),
                            'molecularWeight' => $base['molecularWeight'] ?? '',
                            'solvent' => $base['solvent'] ?? 'Propylene glycol (food grade)',
                            'appearance' => $base['appearance'] ?? 'Clear to pale yellow solution',
                            'storage' => $base['storage'] ?? 'Store at 2–8 °C, protect from light',
                            'chemDesc' => $base['chemDesc'] ?? ($p->description ?? ''),
                        ]);
                    }
                    $json['products'] = $products;
                }
            } catch (\Throwable $e) {
                // Keep json fallback
            }
        }

        return $json;
    }

    public static function getPenKits(): array
    {
        $json = self::getJson('pen_kits');

        if (self::hasProductsTable()) {
            try {
                $dbProducts = \App\Models\Product::where('category', 'pen-kits')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();

                if ($dbProducts->isNotEmpty()) {
                    $jsonBySlug = [];
                    foreach ($json['PRODUCTS'] ?? [] as $jk) {
                        if (!empty($jk['slug'])) {
                            $jsonBySlug[$jk['slug']] = $jk;
                        }
                    }

                    $kits = [];
                    foreach ($dbProducts as $p) {
                        $base = $jsonBySlug[$p->slug] ?? [];
                        $kits[] = array_merge($base, [
                            'id' => (string) $p->id,
                            'slug' => $p->slug,
                            'name' => $p->name,
                            'dose' => $p->dose ?? ($base['dose'] ?? ''),
                            'subtitle' => $p->subtitle ?? ($base['subtitle'] ?? ''),
                            'formula' => $p->formula ?? ($base['formula'] ?? ''),
                            'contents' => $p->contents ?: ($base['contents'] ?? []),
                            'tiers' => $p->tiers ?: ($base['tiers'] ?? []),
                            'price' => $p->price,
                            'price_pence' => $p->price_pence,
                            'purity' => $p->purity ?? ($base['purity'] ?? '≥99.0% (HPLC)'),
                            'cas' => !empty($p->cas_no) ? $p->cas_no : ($base['cas'] ?? ''),
                            'img' => $p->image ?: ($base['img'] ?? "/assets/images/pen-kit-retatrutide-hd.jpg"),
                            'image' => $p->image ?: ($base['img'] ?? "/assets/images/pen-kit-retatrutide-hd.jpg"),
                            'in_stock' => (bool) $p->in_stock,
                            'featured' => (bool) $p->featured,
                            'molecularFormula' => $base['molecularFormula'] ?? ($p->formula ?? ''),
                            'molecularWeight' => $base['molecularWeight'] ?? '',
                            'sequence' => $base['sequence'] ?? '',
                            'appearance' => $base['appearance'] ?? 'Lyophilised cartridge + adjustable pen delivery system',
                            'storage' => $base['storage'] ?? '−20 °C long-term; 2–8 °C reconstituted',
                            'chemDesc' => $base['chemDesc'] ?? ($p->description ?? ''),
                        ]);
                    }
                    $json['PRODUCTS'] = $kits;
                }
            } catch (\Throwable $e) {
                // Keep json fallback
            }
        }

        return $json;
    }

    public static function getCompliance(): array
    {
        return self::getJson('compliance');
    }

    public static function getLegal(string $slug): array
    {
        $map = [
            'terms-conditions' => 'terms_conditions',
            'privacy-policy' => 'privacy_policy',
            'cookie-policy' => 'cookie_policy',
            'refund-policy' => 'refund_policy',
            'shipping-policy' => 'shipping_policy',
            'acceptable-use' => 'acceptable_use',
            'disclaimer' => 'disclaimer',
        ];

        $file = $map[$slug] ?? str_replace('-', '_', $slug);
        return self::getJson($file);
    }

    /**
     * Build unified list of all products (vials, sarms, pen kits).
     */
    public static function getAllProducts(): array
    {
        if (isset(self::$cache['all_products'])) {
            return self::$cache['all_products'];
        }

        $all = [];

        // Peptide vials
        $vials = self::getPeptideVials()['vials'] ?? [];
        foreach ($vials as $item) {
            $item['category'] = 'peptides';
            $item['category_label'] = 'Peptide Vials';
            $item['category_url'] = '/peptide-vials';
            $item['price_pence'] = self::parsePence($item['price'] ?? '0');
            $item['image'] = $item['img'] ?? "/airo-assets/images/pages/peptides/{$item['slug']}";
            $item['img'] = $item['image'];
            $all[$item['slug']] = $item;
        }

        // SARMs
        $sarms = self::getSarms()['products'] ?? [];
        foreach ($sarms as $item) {
            $item['category'] = 'sarms';
            $item['category_label'] = 'SARMs';
            $item['category_url'] = '/sarms-products';
            $item['price_pence'] = self::parsePence($item['price'] ?? '0');
            $item['image'] = $item['image'] ?? ($item['img'] ?? "/assets/images/sarm-{$item['slug']}-hd.jpg");
            $item['img'] = $item['image'];
            $all[$item['slug']] = $item;
        }

        // Pen Kits
        $penKits = self::getPenKits()['PRODUCTS'] ?? [];
        foreach ($penKits as $item) {
            $slug = $item['slug'];
            if ($slug === 'retatrutide') $slug = 'retatrutide-pen-kit';
            elseif ($slug === 'wolverine') $slug = 'wolverine-pen-kit';
            elseif ($slug === 'glow') $slug = 'glow-ghk-cu-pen-kit';

            $item['slug'] = $slug;
            if (!str_contains($item['name'], 'Pen Kit')) {
                $item['name'] = trim($item['name'] . ' ' . ($item['dose'] ?? '')) . ' Pen Kit';
            }
            $item['category'] = 'pen-kits';
            $item['category_label'] = 'Pen Kits';
            $item['category_url'] = '/pen-kits';
            // Lowest tier price
            $tiers = $item['tiers'] ?? [];
            $firstTier = $tiers[0]['price'] ?? '£100';
            if (empty($item['price']) || $item['price'] === '£0.00') {
                $item['price'] = 'From ' . $firstTier;
            }
            $item['price_pence'] = self::parsePence($item['price']);
            $shot = $slug === 'retatrutide-pen-kit' ? 'pen-kit-retatrutide-hd.jpg' : ($slug === 'wolverine-pen-kit' ? 'pen-kit-wolverine-hd.jpg' : 'pen-kit-glow-hd.jpg');
            $item['image'] = $item['image'] ?? ($item['img'] ?? "/assets/images/{$shot}");
            $item['img'] = $item['image'];
            $all[$slug] = $item;
        }

        self::$cache['all_products'] = $all;
        return $all;
    }

    public static function getProduct(string $slug): ?array
    {
        $products = self::getAllProducts();
        $product = $products[$slug] ?? null;

        if ($product && self::hasProductsTable()) {
            try {
                $dbProduct = \App\Models\Product::where('slug', $slug)->first();
                if ($dbProduct) {
                    if (!empty($dbProduct->details)) {
                        $product['details'] = $dbProduct->details;
                    }
                    if (!empty($dbProduct->seo_title)) {
                        $product['seo_title'] = $dbProduct->seo_title;
                    }
                    if (!empty($dbProduct->meta_description)) {
                        $product['meta_description'] = $dbProduct->meta_description;
                    }
                    if (!empty($dbProduct->meta_keywords)) {
                        $product['meta_keywords'] = $dbProduct->meta_keywords;
                    }
                    if (!empty($dbProduct->schema_markup)) {
                        $product['schema_markup'] = $dbProduct->schema_markup;
                    }
                }
            } catch (\Throwable $e) {
                // Ignore DB error
            }
        }

        return $product;
    }

    /**
     * Get dynamic categories for navigation and catalog browsing.
     */
    public static function getCategories(): array
    {
        if (isset(self::$cache['navigation_categories'])) {
            return self::$cache['navigation_categories'];
        }

        $all = self::getAllProducts();

        $peptides = array_values(array_filter($all, fn($p) => ($p['category'] ?? '') === 'peptides'));
        $sarms = array_values(array_filter($all, fn($p) => ($p['category'] ?? '') === 'sarms'));
        $penKits = array_values(array_filter($all, fn($p) => ($p['category'] ?? '') === 'pen-kits'));

        $categories = [
            'peptides' => [
                'key' => 'peptides',
                'label' => 'Vials',
                'full_title' => 'Peptide Lyophilized Vials',
                'url' => route('peptides'),
                'route_name' => 'peptides',
                'count_label' => count($peptides) . ' Vials',
                'purity' => '≥98.0%',
                'badge' => 'HPLC Tested',
                'description' => 'Lyophilised single & blend research peptides with purity documentation.',
                'image' => '/assets/images/category-peptides.jpg',
                'products' => $peptides,
            ],
            'sarms' => [
                'key' => 'sarms',
                'label' => 'SARMs',
                'full_title' => 'SARMs Liquid Solutions',
                'url' => route('sarms'),
                'route_name' => 'sarms',
                'count_label' => count($sarms) . ' Solutions',
                'purity' => '≥99.0%',
                'badge' => '60ml Calibrated',
                'description' => 'High-purity liquid research compounds suspended in food-grade PG.',
                'image' => '/assets/images/category-sarms.jpg',
                'products' => $sarms,
            ],
            'pen-kits' => [
                'key' => 'pen-kits',
                'label' => 'Pen Kits',
                'full_title' => 'Precision Pen Systems',
                'url' => route('pen-kits'),
                'route_name' => 'pen-kits',
                'count_label' => count($penKits) . ' Kits',
                'purity' => '≥99.0%',
                'badge' => 'All-in-One',
                'description' => 'Complete precision injector pens, cartridges, and sterile diluent.',
                'image' => '/assets/images/category-pen-kits.jpg',
                'products' => $penKits,
            ],
        ];

        self::$cache['navigation_categories'] = $categories;
        return $categories;
    }

    public static function parsePence(string $str): int
    {
        $clean = preg_replace('/[^0-9.]/', '', $str);
        return (int) round(((float) $clean) * 100);
    }

    /**
     * Full list of Certificates of Analysis.
     */
    public static function getCoaData(): array
    {
        return [
            [
                'category' => 'Pen Kits',
                'items' => [
                    [
                        'name' => 'Retatrutide 40mg Pen Kit',
                        'sku' => 'RCK-RET-40',
                        'batch' => 'RET-2026-05',
                        'tested' => 'May 2026',
                        'purity' => '99.6%',
                        'coaImg' => '/assets/images/coa/coa-retatrutide.png?v=4'
                    ],
                    [
                        'name' => 'Wolverine 20mg Pen Kit (BPC-157 component)',
                        'sku' => 'RCK-WOL-20-BPC',
                        'batch' => 'BPC-2025-06',
                        'tested' => 'Jun 2025',
                        'purity' => '98.5%',
                        'coaImg' => '/assets/images/coa/coa-bpc-157.png?v=4'
                    ],
                    [
                        'name' => 'Wolverine 20mg Pen Kit (TB-500 component)',
                        'sku' => 'RCK-WOL-20-TB5',
                        'batch' => 'TB5-2026-05',
                        'tested' => 'May 2026',
                        'purity' => '99.2%',
                        'coaImg' => '/assets/images/coa/coa-tb-500.png?v=4'
                    ],
                    [
                        'name' => 'GLOW GHK-CU 70mg Pen Kit (GHK-CU component)',
                        'sku' => 'RCK-GLW-70-GHK',
                        'batch' => 'GHK-2026-005',
                        'tested' => 'May 2026',
                        'purity' => '99.6%',
                        'coaImg' => '/assets/images/coa/coa-ghk-cu.png?v=4'
                    ],
                    [
                        'name' => 'GLOW GHK-CU 70mg Pen Kit (BPC-157 component)',
                        'sku' => 'RCK-GLW-70-BPC',
                        'batch' => 'BPC-2025-06',
                        'tested' => 'Jun 2025',
                        'purity' => '98.5%',
                        'coaImg' => '/assets/images/coa/coa-bpc-157.png?v=4'
                    ],
                    [
                        'name' => 'GLOW GHK-CU 70mg Pen Kit (TB-500 component)',
                        'sku' => 'RCK-GLW-70-TB5',
                        'batch' => 'TB5-2026-05',
                        'tested' => 'May 2026',
                        'purity' => '99.2%',
                        'coaImg' => '/assets/images/coa/coa-tb-500.png?v=4'
                    ]
                ]
            ],
            [
                'category' => 'Peptides',
                'items' => [
                    [
                        'name' => 'BPC-157 10mg',
                        'sku' => 'RCP-BPC-10',
                        'batch' => 'BPC-2025-06',
                        'tested' => 'Jun 2025',
                        'purity' => '98.5%',
                        'coaImg' => '/assets/images/coa/coa-bpc-157.png?v=4'
                    ],
                    [
                        'name' => 'TB-500 10mg',
                        'sku' => 'RCP-TB5-10',
                        'batch' => 'TB5-2026-05',
                        'tested' => 'May 2026',
                        'purity' => '99.2%',
                        'coaImg' => '/assets/images/coa/coa-tb-500.png?v=4'
                    ],
                    [
                        'name' => 'Wolverine 20mg (BPC-157 component)',
                        'sku' => 'RCP-WOL-20-BPC',
                        'batch' => 'BPC-2025-06',
                        'tested' => 'Jun 2025',
                        'purity' => '98.5%',
                        'coaImg' => '/assets/images/coa/coa-bpc-157.png?v=4'
                    ],
                    [
                        'name' => 'Wolverine 20mg (TB-500 component)',
                        'sku' => 'RCP-WOL-20-TB5',
                        'batch' => 'TB5-2026-05',
                        'tested' => 'May 2026',
                        'purity' => '99.2%',
                        'coaImg' => '/assets/images/coa/coa-tb-500.png?v=4'
                    ],
                    [
                        'name' => 'Retatrutide 40mg',
                        'sku' => 'RCP-RET-40',
                        'batch' => 'RET-2026-05',
                        'tested' => 'May 2026',
                        'purity' => '99.6%',
                        'coaImg' => '/assets/images/coa/coa-retatrutide.png?v=4'
                    ],
                    [
                        'name' => 'Ipamorelin 10mg',
                        'sku' => 'RCP-IPA-10',
                        'batch' => 'IPA-2025-08',
                        'tested' => 'Aug 2025',
                        'purity' => '99.1%',
                        'coaImg' => '/assets/images/coa/coa-ipamorelin.png?v=4'
                    ],
                    [
                        'name' => 'CJC-1295 + DAC 5mg',
                        'sku' => 'RCP-CJC-05',
                        'batch' => 'CJC-2025-11',
                        'tested' => 'Nov 2025',
                        'purity' => '98.8%',
                        'coaImg' => '/assets/images/coa/coa-cjc-1295.png?v=4'
                    ],
                    [
                        'name' => 'GHK-Cu 50mg',
                        'sku' => 'RCP-GHK-50',
                        'batch' => 'GHK-2026-005',
                        'tested' => 'May 2026',
                        'purity' => '99.6%',
                        'coaImg' => '/assets/images/coa/coa-ghk-cu.png?v=4'
                    ],
                    [
                        'name' => 'GLOW GHK-Cu 70mg (GHK-Cu component)',
                        'sku' => 'RCP-GLW-70-GHK',
                        'batch' => 'GHK-2026-005',
                        'tested' => 'May 2026',
                        'purity' => '99.6%',
                        'coaImg' => '/assets/images/coa/coa-ghk-cu.png?v=4'
                    ],
                    [
                        'name' => 'GLOW GHK-Cu 70mg (BPC-157 component)',
                        'sku' => 'RCP-GLW-70-BPC',
                        'batch' => 'BPC-2025-06',
                        'tested' => 'Jun 2025',
                        'purity' => '98.5%',
                        'coaImg' => '/assets/images/coa/coa-bpc-157.png?v=4'
                    ],
                    [
                        'name' => 'GLOW GHK-Cu 70mg (TB-500 component)',
                        'sku' => 'RCP-GLW-70-TB5',
                        'batch' => 'TB5-2026-05',
                        'tested' => 'May 2026',
                        'purity' => '99.2%',
                        'coaImg' => '/assets/images/coa/coa-tb-500.png?v=4'
                    ],
                    [
                        'name' => 'Tirzepatide 10mg',
                        'sku' => 'RCP-TRZ-10',
                        'batch' => 'TRZ-2026-03',
                        'tested' => 'Mar 2026',
                        'purity' => '99.4%',
                        'coaImg' => '/assets/images/coa/coa-tirzepatide.png?v=4'
                    ],
                    [
                        'name' => 'NAD+ 500mg',
                        'sku' => 'RCP-NAD-500',
                        'batch' => 'NAD-2025-09',
                        'tested' => 'Sep 2025',
                        'purity' => '99.0%',
                        'coaImg' => '/assets/images/coa/coa-nad.png?v=4'
                    ],
                    [
                        'name' => 'Epithalon 10mg',
                        'sku' => 'RCP-EPI-10',
                        'batch' => 'EPI-2025-10',
                        'tested' => 'Oct 2025',
                        'purity' => '98.9%',
                        'coaImg' => '/assets/images/coa/coa-epithalon.png?v=4'
                    ],
                    [
                        'name' => 'SS-31 10mg',
                        'sku' => 'RCP-SS31-10',
                        'batch' => 'SS31-2025-07',
                        'tested' => 'Jul 2025',
                        'purity' => '98.7%',
                        'coaImg' => '/assets/images/coa/coa-ss-31.png?v=4'
                    ],
                    [
                        'name' => 'Bacteriostatic Water 30ml',
                        'sku' => 'RCP-BAC-30',
                        'batch' => 'BAC-2026-01',
                        'tested' => 'Jan 2026',
                        'purity' => 'USP Grade',
                        'coaImg' => '/assets/images/coa/coa-bacteriostatic-water.png?v=4'
                    ]
                ]
            ],
            [
                'category' => 'SARMs',
                'items' => [
                    [
                        'name' => 'MK-677 Ibutamoren 60ml',
                        'sku' => 'RCS-MK677-60',
                        'batch' => 'MK677-2025-12',
                        'tested' => 'Dec 2025',
                        'purity' => '99.3%',
                        'coaImg' => '/assets/images/coa/coa-mk-677.png?v=4'
                    ],
                    [
                        'name' => 'RAD-140 Testolone 60ml',
                        'sku' => 'RCS-RAD140-60',
                        'batch' => 'RAD-2026-02',
                        'tested' => 'Feb 2026',
                        'purity' => '99.5%',
                        'coaImg' => '/assets/images/coa/coa-rad-140.png?v=4'
                    ],
                    [
                        'name' => 'YK-11 Myostine 60ml',
                        'sku' => 'RCS-YK11-60',
                        'batch' => 'YK11-2025-10',
                        'tested' => 'Oct 2025',
                        'purity' => '98.9%',
                        'coaImg' => '/assets/images/coa/coa-yk-11.png?v=4'
                    ],
                    [
                        'name' => 'LGD-4033 Ligandrol 60ml',
                        'sku' => 'RCS-LGD-60',
                        'batch' => 'LGD-2026-01',
                        'tested' => 'Jan 2026',
                        'purity' => '99.1%',
                        'coaImg' => '/assets/images/coa/coa-lgd-4033.png?v=4'
                    ],
                    [
                        'name' => 'MK-2866 Ostarine 60ml',
                        'sku' => 'RCS-MK2866-60',
                        'batch' => 'OST-2025-11',
                        'tested' => 'Nov 2025',
                        'purity' => '99.4%',
                        'coaImg' => '/assets/images/coa/coa-mk-2866.png?v=4'
                    ],
                    [
                        'name' => 'GW-501516 Cardarine 60ml',
                        'sku' => 'RCS-GW501-60',
                        'batch' => 'CAR-2026-04',
                        'tested' => 'Apr 2026',
                        'purity' => '99.2%',
                        'coaImg' => '/assets/images/coa/coa-gw-501516.png?v=4'
                    ]
                ]
            ]
        ];
    }
}

