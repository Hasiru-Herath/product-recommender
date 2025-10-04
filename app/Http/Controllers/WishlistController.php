<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function store($productId)
    {
        $userId = Auth::id();

        $exists = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();
        if (!$exists) {
            Wishlist::create([
                'user_id' => $userId??1,
                'product_id' => $productId
            ]);
        }

        return back()->with('success', 'Product added to wishlist!');
    }

    public function destroy($productId)
    {
        Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->delete();
        return back()->with('success', 'Product removed from wishlist!');
    }

    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('wishlist.index', compact('wishlist'));
    }
}
