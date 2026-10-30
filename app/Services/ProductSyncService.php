<?php

namespace App\Services;

use App\Models\Product;

class ProductSyncService
{
    /**
     * Import existing JSON catalog into MySQL products table.
     */
    public static function importFromJson(): int
    {
        $all = ContentService::getAllProducts();
        $detailConfig = ContentService::getJson('product_detail')['products'] ?? [];
        $count = 0;

        foreach ($all as $slug => $item) {
            $category = $item['category'] ?? 'peptides';
            $details = $detailConfig[$slug] ?? null;

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $item['name'] ?? ucfirst($slug),
                    'category' => $category,
                    'dose' => $item['dose'] ?? null,
                    'price' => $item['price'] ?? '£0.00',
                    'price_pence' => $item['price_pence'] ?? ContentService::parsePence($item['price'] ?? '0'),
                    'purity' => $item['purity'] ?? '≥98%',
                    'subtitle' => $item['subtitle'] ?? null,
                    'formula' => $item['formula'] ?? null,
                    'cas_no' => $item['cas'] ?? $item['cas_no'] ?? null,
                    'description' => $item['desc'] ?? $item['description'] ?? null,
                    'contents' => $item['contents'] ?? null,
                    'tiers' => $item['tiers'] ?? null,
                    'details' => $details,
                    'image' => $item['image'] ?? $item['img'] ?? null,
                    'in_stock' => true,
                    'is_active' => true,
                    'sort_order' => $count++,
                ]
            );
        }

        return $count;
    }

    /**
     * Sync database product changes back to JSON files so frontend stays in sync.
     */
    public static function exportToJson(): void
    {
        // 1. Peptide vials
        $peptideProducts = Product::where('category', 'peptides')->where('is_active', true)->orderBy('sort_order')->get();
        $peptidePath = resource_path('content/pages/peptide_vials.json');
        if (file_exists($peptidePath)) {
            $data = json_decode(file_get_contents($peptidePath), true) ?: [];
            $existingMap = [];
            foreach (($data['vials'] ?? []) as $v) {
                if (!empty($v['slug'])) {
                    $existingMap[$v['slug']] = $v;
                }
            }

            $vials = [];
            foreach ($peptideProducts as $p) {
                $existing = $existingMap[$p->slug] ?? [];
                $details = $p->details ?? [];
                $vials[] = array_merge($existing, [
                    'id' => (string) $p->id,
                    'slug' => $p->slug,
                    'name' => $p->name,
                    'dose' => $p->dose ?? ($existing['dose'] ?? ''),
                    'price' => $p->price,
                    'purity' => $p->purity ?? ($existing['purity'] ?? '≥98%'),
                    'cas' => $p->cas_no ?? ($existing['cas'] ?? ''),
                    'desc' => $p->description ?? ($existing['desc'] ?? ''),
                    'vialSize' => $existing['vialSize'] ?? '3ml',
                    'img' => $p->image ?? ($existing['img'] ?? "/airo-assets/images/pages/peptides/{$p->slug}"),
                    'molecularFormula' => $p->formula ?: ($details['molecularFormula'] ?? ($existing['molecularFormula'] ?? '')),
                    'molecularWeight' => $details['molecularWeight'] ?? ($existing['molecularWeight'] ?? ''),
                    'sequence' => $details['sequence'] ?? ($existing['sequence'] ?? ''),
                    'appearance' => $details['appearance'] ?? ($existing['appearance'] ?? 'White lyophilised powder'),
                    'storage' => $details['storage'] ?? ($existing['storage'] ?? '−20 °C long-term; 2–8 °C short-term'),
                    'chemDesc' => $details['chemDesc'] ?? ($p->description ?? ($existing['chemDesc'] ?? '')),
                ]);
            }
            $data['vials'] = $vials;
            file_put_contents($peptidePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }

        // 2. SARMs
        $sarmsProducts = Product::where('category', 'sarms')->where('is_active', true)->orderBy('sort_order')->get();
        $sarmsPath = resource_path('content/pages/sarms_products.json');
        if (file_exists($sarmsPath)) {
            $data = json_decode(file_get_contents($sarmsPath), true) ?: [];
            $existingMap = [];
            foreach (($data['products'] ?? []) as $s) {
                if (!empty($s['slug'])) {
                    $existingMap[$s['slug']] = $s;
                }
            }

            $prods = [];
            foreach ($sarmsProducts as $p) {
                $existing = $existingMap[$p->slug] ?? [];
                $details = $p->details ?? [];
                $prods[] = array_merge($existing, [
                    'id' => (string) $p->id,
                    'slug' => $p->slug,
                    'name' => $p->name,
                    'subtitle' => $p->subtitle ?? ($existing['subtitle'] ?? ''),
                    'dose' => $p->dose ?? ($existing['dose'] ?? '60ml'),
                    'concentration' => $existing['concentration'] ?? ($p->dose ?? '30mg/ml'),
                    'volume' => $existing['volume'] ?? '60ml',
                    'price' => $p->price,
                    'purity' => $p->purity ?? ($existing['purity'] ?? '≥99%'),
                    'cas' => $p->cas_no ?? ($existing['cas'] ?? ''),
                    'desc' => $p->description ?? ($existing['desc'] ?? ''),
                    'img' => $p->image ?? ($existing['img'] ?? "/airo-assets/images/pages/sarms/{$p->slug}"),
                    'formula' => $p->formula ?? ($existing['formula'] ?? ''),
                    'molecularFormula' => $p->formula ?: ($details['molecularFormula'] ?? ($existing['molecularFormula'] ?? '')),
                    'molecularWeight' => $details['molecularWeight'] ?? ($existing['molecularWeight'] ?? ''),
                    'solvent' => $details['solvent'] ?? ($existing['solvent'] ?? 'Propylene glycol (food grade)'),
                    'appearance' => $details['appearance'] ?? ($existing['appearance'] ?? 'Clear to pale yellow solution'),
                    'storage' => $details['storage'] ?? ($existing['storage'] ?? 'Store at 2–8 °C, protect from light'),
                    'chemDesc' => $details['chemDesc'] ?? ($p->description ?? ($existing['chemDesc'] ?? '')),
                ]);
            }
            $data['products'] = $prods;
            file_put_contents($sarmsPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }

        // 3. Pen Kits
        $penKitProducts = Product::where('category', 'pen-kits')->where('is_active', true)->orderBy('sort_order')->get();
        $penKitPath = resource_path('content/pages/pen_kits.json');
        if (file_exists($penKitPath)) {
            $data = json_decode(file_get_contents($penKitPath), true) ?: [];
            $existingMap = [];
            foreach (($data['PRODUCTS'] ?? []) as $k) {
                if (!empty($k['slug'])) {
                    $existingMap[$k['slug']] = $k;
                }
            }

            $kits = [];
            foreach ($penKitProducts as $p) {
                $existing = $existingMap[$p->slug] ?? [];
                $details = $p->details ?? [];
                $kits[] = array_merge($existing, [
                    'id' => (string) $p->id,
                    'slug' => $p->slug,
                    'name' => $p->name,
                    'dose' => $p->dose ?? ($existing['dose'] ?? ''),
                    'subtitle' => $p->subtitle ?? ($existing['subtitle'] ?? ''),
                    'formula' => $p->formula ?? ($existing['formula'] ?? ''),
                    'contents' => $p->contents ?? ($existing['contents'] ?? []),
                    'tiers' => $p->tiers ?? ($existing['tiers'] ?? []),
                    'cas' => $p->cas_no ?? ($existing['cas'] ?? ''),
                    'purity' => $p->purity ?? ($existing['purity'] ?? '≥99%'),
                    'molecularFormula' => $p->formula ?: ($details['molecularFormula'] ?? ($existing['molecularFormula'] ?? '')),
                    'molecularWeight' => $details['molecularWeight'] ?? ($existing['molecularWeight'] ?? ''),
                    'sequence' => $details['sequence'] ?? ($existing['sequence'] ?? ''),
                    'appearance' => $details['appearance'] ?? ($existing['appearance'] ?? 'Lyophilised cartridge + adjustable pen delivery system'),
                    'storage' => $details['storage'] ?? ($existing['storage'] ?? '−20 °C long-term; 2–8 °C reconstituted'),
                    'chemDesc' => $details['chemDesc'] ?? ($p->description ?? ($existing['chemDesc'] ?? '')),
                ]);
            }
            $data['PRODUCTS'] = $kits;
            file_put_contents($penKitPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }

        // 4. Product Details
        $detailPath = resource_path('content/pages/product_detail.json');
        if (file_exists($detailPath)) {
            $data = json_decode(file_get_contents($detailPath), true) ?: [];
            $allProducts = Product::where('is_active', true)->get();
            foreach ($allProducts as $p) {
                if ($p->details) {
                    $data['products'][$p->slug] = $p->details;
                }
            }
            file_put_contents($detailPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }

        // Clear ContentService static cache
        ContentService::clearCache();
    }
}
