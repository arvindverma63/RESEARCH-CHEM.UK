<?php

namespace App\Http\Controllers;

use App\Services\ContentService;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function show(string $slug)
    {
        $content = ContentService::getLegal($slug);
        if (empty($content)) {
            abort(404);
        }

        $titles = [
            'terms-conditions' => 'Terms & Conditions',
            'privacy-policy' => 'Privacy Policy',
            'cookie-policy' => 'Cookie Policy',
            'refund-policy' => 'Refund Policy',
            'shipping-policy' => 'Shipping Policy',
            'acceptable-use' => 'Acceptable Use Policy',
            'disclaimer' => 'Research Disclaimer',
        ];

        $pageTitle = $titles[$slug] ?? ucwords(str_replace('-', ' ', $slug));

        return view('legal', compact('content', 'slug', 'pageTitle'));
    }
}

