<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ContentService;
use App\Services\ProductSyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            if ($request->status === 'in_stock') {
                $query->where('in_stock', true);
            } elseif ($request->status === 'out_of_stock') {
                $query->where('in_stock', false);
            }
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('slug', 'like', "%{$q}%")
                    ->orWhere('cas_no', 'like', "%{$q}%")
                    ->orWhere('dose', 'like', "%{$q}%");
            });
        }

        $sort = $request->get('sort', 'sort_order');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $products = $query->paginate(25)->withQueryString();

        $counts = [
            'all' => Product::count(),
            'peptides' => Product::where('category', 'peptides')->count(),
            'sarms' => Product::where('category', 'sarms')->count(),
            'pen-kits' => Product::where('category', 'pen-kits')->count(),
        ];

        return view('admin.products.index', compact('products', 'counts'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug'],
            'category' => ['required', 'in:peptides,sarms,pen-kits'],
            'dose' => ['nullable', 'string', 'max:100'],
            'price' => ['required', 'string'],
            'purity' => ['nullable', 'string', 'max:50'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'formula' => ['nullable', 'string', 'max:255'],
            'cas_no' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'contents_raw' => ['nullable', 'string'],
            'chem_desc' => ['nullable', 'string'],
            'molecular_weight' => ['nullable', 'string', 'max:100'],
            'sequence' => ['nullable', 'string'],
            'solvent' => ['nullable', 'string', 'max:255'],
            'appearance' => ['nullable', 'string', 'max:255'],
            'storage' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'schema_markup' => ['nullable', 'string'],
            'schema_file' => ['nullable', 'file', 'mimes:json,txt', 'max:2048'],
            'in_stock' => ['nullable', 'boolean'],
            'featured' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle File Upload if provided
        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $file = $request->file('image_file');
            $uploadDir = public_path('assets/images/uploads');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $cleanSlug = $validated['slug'];
            $filename = $cleanSlug . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $validated['image'] = "/assets/images/uploads/{$filename}";
        }

        // Handle Schema JSON/TXT File Upload
        if ($request->hasFile('schema_file') && $request->file('schema_file')->isValid()) {
            $schemaRaw = file_get_contents($request->file('schema_file')->getRealPath());
            if ($schemaRaw !== false) {
                $validated['schema_markup'] = trim($schemaRaw);
            }
        }

        $cleanPrice = $validated['price'];
        if (!str_starts_with($cleanPrice, '£')) {
            $cleanPrice = '£' . ltrim($cleanPrice, '$€ ');
        }
        $validated['price'] = $cleanPrice;
        $validated['price_pence'] = ContentService::parsePence($cleanPrice);

        // Kit contents array
        if (!empty($request->contents_raw)) {
            $lines = array_filter(array_map('trim', explode("\n", $request->contents_raw)));
            $validated['contents'] = array_values($lines);
        }

        // Tiers if pen-kits
        if ($validated['category'] === 'pen-kits' && $request->filled('tiers')) {
            $validated['tiers'] = $request->tiers;
        }

        // Chemical Data Sheet & Laboratory Specifications
        $details = [];
        if ($request->filled('chem_desc')) $details['chemDesc'] = $request->chem_desc;
        if ($request->filled('molecular_weight')) $details['molecularWeight'] = $request->molecular_weight;
        if ($request->filled('sequence')) $details['sequence'] = $request->sequence;
        if ($request->filled('solvent')) $details['solvent'] = $request->solvent;
        if ($request->filled('appearance')) $details['appearance'] = $request->appearance;
        if ($request->filled('storage')) $details['storage'] = $request->storage;
        if ($request->filled('formula')) $details['molecularFormula'] = $request->formula;
        $validated['details'] = $details;

        $validated['in_stock'] = $request->boolean('in_stock', true);
        $validated['featured'] = $request->boolean('featured', false);
        $validated['is_active'] = true;

        $product = Product::create($validated);

        // Sync with frontend JSON
        ProductSyncService::exportToJson();

        return redirect()->route('admin.products.index')
            ->with('success', "Product '{$product->name}' created successfully!");
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:products,slug,' . $product->id],
            'category' => ['required', 'in:peptides,sarms,pen-kits'],
            'dose' => ['nullable', 'string', 'max:100'],
            'price' => ['required', 'string'],
            'purity' => ['nullable', 'string', 'max:50'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'formula' => ['nullable', 'string', 'max:255'],
            'cas_no' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'contents_raw' => ['nullable', 'string'],
            'chem_desc' => ['nullable', 'string'],
            'molecular_weight' => ['nullable', 'string', 'max:100'],
            'sequence' => ['nullable', 'string'],
            'solvent' => ['nullable', 'string', 'max:255'],
            'appearance' => ['nullable', 'string', 'max:255'],
            'storage' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'schema_markup' => ['nullable', 'string'],
            'schema_file' => ['nullable', 'file', 'mimes:json,txt', 'max:2048'],
            'in_stock' => ['nullable', 'boolean'],
            'featured' => ['nullable', 'boolean'],
        ]);

        // Handle File Upload if provided
        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $file = $request->file('image_file');
            $uploadDir = public_path('assets/images/uploads');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $cleanSlug = $validated['slug'];
            $filename = $cleanSlug . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $validated['image'] = "/assets/images/uploads/{$filename}";
        }

        // Handle Schema JSON/TXT File Upload
        if ($request->hasFile('schema_file') && $request->file('schema_file')->isValid()) {
            $schemaRaw = file_get_contents($request->file('schema_file')->getRealPath());
            if ($schemaRaw !== false) {
                $validated['schema_markup'] = trim($schemaRaw);
            }
        } elseif (empty($validated['image'])) {
            $validated['image'] = $product->image;
        }

        $cleanPrice = $validated['price'];
        if (!str_starts_with($cleanPrice, '£')) {
            $cleanPrice = '£' . ltrim($cleanPrice, '$€ ');
        }
        $validated['price'] = $cleanPrice;
        $validated['price_pence'] = ContentService::parsePence($cleanPrice);

        if ($request->has('contents_raw')) {
            $lines = array_filter(array_map('trim', explode("\n", $request->contents_raw)));
            $validated['contents'] = array_values($lines);
        }

        // Pen kit tiers
        if ($request->filled('tiers_price')) {
            $tiers = [];
            foreach ($request->tiers_price as $qty => $price) {
                $each = $request->tiers_each[$qty] ?? '';
                $tiers[] = [
                    'id' => (string) $qty,
                    'qty' => $qty == 1 ? '1 Kit' : "{$qty} Kits",
                    'price' => $price,
                    'each' => $each,
                    'highlight' => ($qty == 1),
                ];
            }
            $validated['tiers'] = $tiers;
        }

        // Chemical Data Sheet & Laboratory Specifications
        $details = $product->details ?: [];
        if ($request->has('chem_desc')) $details['chemDesc'] = $request->chem_desc;
        if ($request->has('molecular_weight')) $details['molecularWeight'] = $request->molecular_weight;
        if ($request->has('sequence')) $details['sequence'] = $request->sequence;
        if ($request->has('solvent')) $details['solvent'] = $request->solvent;
        if ($request->has('appearance')) $details['appearance'] = $request->appearance;
        if ($request->has('storage')) $details['storage'] = $request->storage;
        if ($request->has('formula')) $details['molecularFormula'] = $request->formula;
        if ($request->filled('detail_halflife')) $details['half_life'] = $request->detail_halflife;
        if ($request->filled('detail_reconstitution')) $details['reconstitution'] = $request->detail_reconstitution;
        $validated['details'] = $details;

        $validated['in_stock'] = $request->boolean('in_stock');
        $validated['featured'] = $request->boolean('featured');

        $product->update($validated);

        // Sync with frontend JSON
        ProductSyncService::exportToJson();

        return redirect()->route('admin.products.edit', $product)
            ->with('success', "Product '{$product->name}' updated successfully!");
    }

    public function toggleStock(Product $product)
    {
        $product->in_stock = !$product->in_stock;
        $product->save();

        ProductSyncService::exportToJson();

        $status = $product->in_stock ? 'In Stock' : 'Out of Stock';
        return back()->with('success', "'{$product->name}' status changed to {$status}.");
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();

        ProductSyncService::exportToJson();

        return redirect()->route('admin.products.index')
            ->with('success', "Product '{$name}' deleted successfully.");
    }
}

