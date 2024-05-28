<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $reviews = Review::where('product_id', $id)->get();

        return view('detailProduct', compact('product', 'reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rate' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
            'product_id' => 'required|integer|exists:products,product_id',
        ]);

        Review::create([
            'rate' => $request->rate,
            'comment' => $request->comment,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('product.show', $request->product_id);
    }
}
