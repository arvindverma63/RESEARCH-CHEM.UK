<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaController extends Controller
{
    protected static ?array $manifest = null;

    protected function getManifest(): array
    {
        if (self::$manifest !== null) {
            return self::$manifest;
        }

        $path = storage_path('app/airo-media.json');
        if (!file_exists($path)) {
            $path = public_path('airo-media.json');
        }

        if (file_exists($path)) {
            self::$manifest = json_decode(file_get_contents($path), true) ?: [];
        } else {
            self::$manifest = [];
        }

        return self::$manifest;
    }

    /**
     * Resolves /airo-assets/{type}/{path}
     */
    public function resolve(string $type, string $path)
    {
        $manifest = $this->getManifest();
        $slotKey = trim($path, '/');

        // Strip trailing surface variants (/light or /dark)
        if (str_ends_with($slotKey, '/light')) {
            $slotKey = substr($slotKey, 0, -6);
        } elseif (str_ends_with($slotKey, '/dark')) {
            $slotKey = substr($slotKey, 0, -5);
        }

        // 1. Curated explicit local mappings
        $explicit = [
            // Home categories
            'pages/home/category-peptides' => public_path('assets/images/category-peptides.jpg'),
            'pages/home/category-sarms' => public_path('assets/images/category-sarms.jpg'),
            'pages/home/category-pen-kits' => public_path('assets/images/category-pen-kits.jpg'),

            // Peptides (100% direct file mapping)
            'pages/peptides/bpc-157' => public_path('assets/images/photorealistic-single-glass-research-via-ATRm5m.png'),
            'pages/peptides/tb-500' => public_path('assets/images/photorealistic-single-glass-research-via-Hen6Mo.png'),
            'pages/peptides/wolverine' => public_path('assets/images/photorealistic-single-glass-research-via-ZiTlLS.png'),
            'pages/peptides/retatrutide' => public_path('assets/images/change-the-label-on-this-research-chemic-LRmlHu.png'),
            'pages/peptides/ipamoralin' => public_path('assets/images/photorealistic-single-glass-research-via-IOX3m4.png'),
            'pages/peptides/ipamorelin' => public_path('assets/images/photorealistic-single-glass-research-via-IOX3m4.png'),
            'pages/peptides/cjc-1295-dac' => public_path('assets/images/photorealistic-single-glass-research-via-W-sigu.png'),
            'pages/peptides/ghk-cu-50mg' => public_path('assets/images/photorealistic-single-glass-research-via-RnFJa3.png'),
            'pages/peptides/ghk-cu' => public_path('assets/images/photorealistic-single-glass-research-via-RnFJa3.png'),
            'pages/peptides/glow-ghk-cu-70mg' => public_path('assets/images/photorealistic-single-glass-research-via-Mm3Pbt.png'),
            'pages/peptides/glow-ghk-cu' => public_path('assets/images/photorealistic-single-glass-research-via-Mm3Pbt.png'),
            'pages/peptides/nad-plus' => public_path('assets/images/photorealistic-single-glass-research-via-oJuqSo.png'),
            'pages/peptides/nad' => public_path('assets/images/photorealistic-single-glass-research-via-oJuqSo.png'),
            'pages/peptides/tirzepatide' => public_path('assets/images/photorealistic-single-glass-research-via-iuUQZJ.png'),
            'pages/peptides/epithalon' => public_path('assets/images/photorealistic-single-glass-research-via-PkNjP6.png'),
            'pages/peptides/ss-31' => public_path('assets/images/photorealistic-single-glass-research-via-6bplOH.png'),
            'pages/peptides/bacteriostatic-water' => public_path('assets/images/photorealistic-single-glass-research-via-ZdRy7k.png'),

            // SARMs (100% direct bottle shots - HD 1024x1024)
            'pages/sarms/mk-677-ibutamoren' => public_path('assets/images/sarm-mk-677-hd.jpg'),
            'pages/sarms/mk-677' => public_path('assets/images/sarm-mk-677-hd.jpg'),
            'pages/sarms/rad-140-testolone' => public_path('assets/images/sarm-rad-140-hd.jpg'),
            'pages/sarms/rad-140' => public_path('assets/images/sarm-rad-140-hd.jpg'),
            'pages/sarms/yk-11-myostine' => public_path('assets/images/sarm-yk-11-hd.jpg'),
            'pages/sarms/yk-11' => public_path('assets/images/sarm-yk-11-hd.jpg'),
            'pages/sarms/lgd-4033-ligandrol' => public_path('assets/images/sarm-lgd-4033-hd.jpg'),
            'pages/sarms/lgd-4033' => public_path('assets/images/sarm-lgd-4033-hd.jpg'),
            'pages/sarms/mk-2866-ostarine' => public_path('assets/images/sarm-mk-2866-hd.jpg'),
            'pages/sarms/mk-2866' => public_path('assets/images/sarm-mk-2866-hd.jpg'),
            'pages/sarms/gw-501516-cardarine' => public_path('assets/images/sarm-gw-501516-hd.jpg'),
            'pages/sarms/gw-501516' => public_path('assets/images/sarm-gw-501516-hd.jpg'),

            // Pen Kits (100% direct kit shots - HD 1200x896)
            'pages/pen-kits/shot-162840' => public_path('assets/images/pen-kit-retatrutide-hd.jpg'),
            'pages/pen-kits/shot-155333' => public_path('assets/images/pen-kit-wolverine-hd.jpg'),
            'pages/pen-kits/shot-161643' => public_path('assets/images/pen-kit-glow-hd.jpg'),
            'pages/pen-kits/retatrutide-pen-kit' => public_path('assets/images/pen-kit-retatrutide-hd.jpg'),
            'pages/pen-kits/retatrutide' => public_path('assets/images/pen-kit-retatrutide-hd.jpg'),
            'pages/pen-kits/wolverine-pen-kit' => public_path('assets/images/pen-kit-wolverine-hd.jpg'),
            'pages/pen-kits/wolverine' => public_path('assets/images/pen-kit-wolverine-hd.jpg'),
            'pages/pen-kits/glow-ghk-cu-pen-kit' => public_path('assets/images/pen-kit-glow-hd.jpg'),
            'pages/pen-kits/glow' => public_path('assets/images/pen-kit-glow-hd.jpg'),
            'pages/pen-kits/featured-product' => public_path('assets/images/pen-kit-retatrutide-hd.jpg'),

            // Certificates of Analysis (COA - 100% genuine live certificates)
            'pages/sarms/coa-bpc-157' => public_path('assets/images/coa/coa-bpc-157.png'),
            'pages/peptides/coa-bpc-157' => public_path('assets/images/coa/coa-bpc-157.png'),
            'pages/peptides/coa-tb-500' => public_path('assets/images/coa/coa-tb-500.png'),
            'pages/peptides/coa-retatrutide' => public_path('assets/images/coa/coa-retatrutide.png'),
            'pages/peptides/coa-ipamorelin' => public_path('assets/images/coa/coa-ipamorelin.png'),
            'pages/peptides/coa-cjc-1295' => public_path('assets/images/coa/coa-cjc-1295.png'),
            'pages/peptides/coa-ghk-cu' => public_path('assets/images/coa/coa-ghk-cu.png'),
            'pages/peptides/coa-tirzepatide' => public_path('assets/images/coa/coa-tirzepatide.png'),
            'pages/peptides/coa-nad' => public_path('assets/images/coa/coa-nad.png'),
            'pages/peptides/coa-epithalon' => public_path('assets/images/coa/coa-epithalon.png'),
            'pages/peptides/coa-ss-31' => public_path('assets/images/coa/coa-ss-31.png'),
            'pages/peptides/coa-bacteriostatic-water' => public_path('assets/images/coa/coa-bacteriostatic-water.png'),
            'pages/sarms/coa-mk-677' => public_path('assets/images/coa/coa-mk-677.png'),
            'pages/sarms/coa-rad-140' => public_path('assets/images/coa/coa-rad-140.png'),
            'pages/sarms/coa-yk-11' => public_path('assets/images/coa/coa-yk-11.png'),
            'pages/sarms/coa-lgd-4033' => public_path('assets/images/coa/coa-lgd-4033.png'),
            'pages/sarms/coa-mk-2866' => public_path('assets/images/coa/coa-mk-2866.png'),
            'pages/sarms/coa-gw-501516' => public_path('assets/images/coa/coa-gw-501516.png'),
        ];

        if ($type === 'images' && isset($explicit[$slotKey])) {
            $dest = $explicit[$slotKey];
            if (file_exists($dest)) {
                $etag = '"' . md5_file($dest) . '"';
                if (request()->header('If-None-Match') === $etag) {
                    return response('', 304, [
                        'Cache-Control' => 'public, max-age=2592000, immutable',
                        'ETag' => $etag,
                    ]);
                }
                return response()->file($dest, [
                    'Cache-Control' => 'public, max-age=2592000, immutable',
                    'ETag' => $etag,
                ]);
            }
        }

        // 2. If requesting an image slot (manifest lookup)
        if ($type === 'images' && isset($manifest[$slotKey])) {
            $slot = $manifest[$slotKey];

            // A) Check currentUrl if it resolves locally
            if (!empty($slot['currentUrl'])) {
                $file = $this->findLocalFile($slot['currentUrl']);
                if ($file) {
                    $etag = '"' . md5_file($file) . '"';
                    if (request()->header('If-None-Match') === $etag) {
                        return response('', 304, [
                            'Cache-Control' => 'public, max-age=2592000, immutable',
                            'ETag' => $etag,
                        ]);
                    }
                    return response()->file($file, [
                        'Cache-Control' => 'public, max-age=2592000, immutable',
                        'ETag' => $etag,
                    ]);
                }
            }

            // B) Check aiGeneratedUrls for local file
            foreach ($slot['aiGeneratedUrls'] ?? [] as $genUrl) {
                $file = $this->findLocalFile($genUrl);
                if ($file) {
                    $etag = '"' . md5_file($file) . '"';
                    if (request()->header('If-None-Match') === $etag) {
                        return response('', 304, [
                            'Cache-Control' => 'public, max-age=2592000, immutable',
                            'ETag' => $etag,
                        ]);
                    }
                    return response()->file($file, [
                        'Cache-Control' => 'public, max-age=2592000, immutable',
                        'ETag' => $etag,
                    ]);
                }
            }

            // C) Check alternatives for local file
            foreach ($slot['alternatives'] ?? [] as $altUrl) {
                $file = $this->findLocalFile($altUrl);
                if ($file) {
                    return response()->file($file, ['Cache-Control' => 'no-cache, private, max-age=0']);
                }
            }

            // D) Check if currentUrl is remote
            if (!empty($slot['currentUrl']) && (str_starts_with($slot['currentUrl'], 'http://') || str_starts_with($slot['currentUrl'], 'https://'))) {
                return redirect()->away($slot['currentUrl'], 302);
            }

            // E) Check alternatives for remote URL
            foreach ($slot['alternatives'] ?? [] as $altUrl) {
                if (str_starts_with($altUrl, 'http://') || str_starts_with($altUrl, 'https://')) {
                    return redirect()->away($altUrl, 302);
                }
            }
        }

        // 3. If requesting an upload file or direct path
        $found = $this->findLocalFile($path);
        if ($found) {
            return response()->file($found, ['Cache-Control' => 'no-cache, private, max-age=0']);
        }

        // 4. Default fallback: og-image.png
        $og = public_path('og-image.png');
        if (file_exists($og)) {
            return response()->file($og, ['Cache-Control' => 'no-cache, private, max-age=0']);
        }

        abort(404);
    }

    protected function findLocalFile(string $urlOrPath): ?string
    {
        $filename = basename(parse_url($urlOrPath, PHP_URL_PATH));
        if (!$filename) {
            return null;
        }

        $searchDirs = [
            public_path('assets/images'),
            public_path('assets/media'),
            public_path('assets/uploads'),
            public_path('assets'),
            public_path(),
        ];

        // Direct filename match
        foreach ($searchDirs as $dir) {
            $candidate = $dir . DIRECTORY_SEPARATOR . $filename;
            if (file_exists($candidate) && is_file($candidate)) {
                return $candidate;
            }
        }

        // Substring / prefix match for hashed filenames
        $nameNoExt = pathinfo($filename, PATHINFO_FILENAME);
        if (strlen($nameNoExt) >= 4) {
            foreach ($searchDirs as $dir) {
                if (!is_dir($dir)) continue;
                $files = scandir($dir);
                foreach ($files as $f) {
                    if ($f === '.' || $f === '..') continue;
                    if (str_contains($f, $nameNoExt)) {
                        $candidate = $dir . DIRECTORY_SEPARATOR . $f;
                        if (is_file($candidate)) {
                            return $candidate;
                        }
                    }
                }
            }
        }

        return null;
    }
}
