<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;  // إضافة هذا السطر
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wishlist = $user->wishlist()->get();

        return view('wishlist.index', compact('wishlist'));
    }

    public function add(Product $product)
    {
        $user = Auth::user();

        // التحقق إذا كان المنتج موجود بالفعل في الـ wishlist
        if ($user->wishlist()->where('product_id', $product->id)->exists()) {
            return back()->with('message', 'Ce produit est déjà dans votre wishlist.');
        }

        $user->wishlist()->attach($product->id);

        return back()->with('message', 'Produit ajouté à votre wishlist !');
    }

    public function remove(Product $product)
    {
        auth()->user()->wishlist()->where('product_id', $product->id)->delete();
        return back()->with('message', 'Produit retiré de votre wishlist');
    }
    
    public function clear()
{
    auth()->user()->wishlist()->detach();

    return redirect()->back()->with('success', 'La wishlist a été vidée.');
}


}
