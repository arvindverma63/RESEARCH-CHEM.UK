<?php

namespace App\Http\Controllers;

use App\Services\ContentService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function peptides()
    {
        $content = ContentService::getPeptideVials();
        return view('peptides', compact('content'));
    }

    public function sarms()
    {
        $content = ContentService::getSarms();
        return view('sarms', compact('content'));
    }

    public function penKits()
    {
        $content = ContentService::getPenKits();
        // Normalize slugs
        if (isset($content['PRODUCTS'])) {
            foreach ($content['PRODUCTS'] as &$prod) {
                if ($prod['slug'] === 'retatrutide') $prod['slug'] = 'retatrutide-pen-kit';
                elseif ($prod['slug'] === 'wolverine') $prod['slug'] = 'wolverine-pen-kit';
                elseif ($prod['slug'] === 'glow') $prod['slug'] = 'glow-ghk-cu-pen-kit';
            }
        }
        return view('pen-kits', compact('content'));
    }

    public function show(string $id, Request $request)
    {
        $isAdmin = auth()->check() && (auth()->user()->is_admin ?? false);
        $allowDraft = $isAdmin || $request->boolean('preview');
        $product = ContentService::getProduct($id, $allowDraft);
        if (!$product) {
            abort(404);
        }

        $detailConfig = ContentService::getJson('product_detail');
        $hasCustomDetail = file_exists(resource_path("views/products/details/{$id}.blade.php"));

        return view('products.show', compact('product', 'id', 'detailConfig', 'hasCustomDetail'));
    }
}

