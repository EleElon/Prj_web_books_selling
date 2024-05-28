<?php

namespace App\Http\Controllers;



use App\Models\Product;
use App\Models\Review;

class ProductController extends Controller
{
    //
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $reviews = Review::where('product_id', $id)->get();

        return view('detailProduct', compact('product', 'reviews'));
    }
}
