<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }

        $product = Product::create($validated);

        return view('products.index', ['products' => Product::all()])->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $recentlyViewed = session()->get('recently_viewed', []);
        array_unshift($recentlyViewed, $product->id);
        $recentlyViewed = array_unique(array_slice($recentlyViewed, 0, 5));
        session()->put('recently_viewed', $recentlyViewed);

        // Recommendations
        $recommendations = Product::where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('category', $product->category)
                    ->orWhereBetween('price', [$product->price * 0.8, $product->price * 1.2])
                    ->orWhere('tags', 'LIKE', '%' . $product->tags . '%');
            })
            ->limit(4)
            ->get();
        Log::info('Recommendations: ' . $recommendations->pluck('id'));
        return view('products.show', compact('product', 'recommendations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'tags' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
