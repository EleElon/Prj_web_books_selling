<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CrudProductController extends Controller
{

    public function listproduct()
    {
        if (Auth::check()) {
            $products = Product::all();
            return view('crud_product.list-product', ['product' => $products]);
        }

        return redirect()->route('user.list')->with('success', 'Bạn không được phép truy cập');
    }

    public function addproduct()
    {
        return view('crud_product.add-product');
    }

    public function postProduct(Request $request)
    {
        $request->validate([
            'masach' => 'required',
            'name' => 'required',
            'idLoai' => 'required',
            'author' => 'required',
            'publish' => 'required',
            'Gia' => 'required',
            'mota' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);

            $product = new Product();
            $product->product_id = $request->input('masach');
            $product->product_name = $request->input('name');
            $product->category = $request->input('idLoai');
            $product->author = $request->input('author');
            $product->publish = $request->input('publish');
            $product->price = $request->input('Gia');
            $product->description = $request->input('mota');
            $product->image = $imageName; // Bạn đã lấy giá trị imageName ở trên


            $product->save();

            // echo "ok";
            return redirect()->route('product.list')->with('success', 'Sản phẩm đã được thêm thành công');
        }
    }

    public function deleteProduct(Request $request)
    {
        $product_id = $request->get('id');
        $product = Product::destroy($product_id);

        //echo "ok";
        return redirect()->route('product.list')->with('success', 'Sản phẩm đã được xóa thành công');
    }




    public function editProduct($id)
    {
        $product = Product::find($id);
        return view('crud_product.update-product', ['product' => $product]);
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'masach' => 'required',
            'name' => 'required',
            'idLoai' => 'required',
            'author' => 'required',
            'publish' => 'required',
            'Gia' => 'required',
            'mota' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Không yêu cầu image bắt buộc
        ]);
    
        $product = Product::findOrFail($id);
        $product->product_id = $request->input('masach');
        $product->product_name = $request->input('name');
        $product->category = $request->input('idLoai');
        $product->author = $request->input('author');
        $product->publish = $request->input('publish');
        $product->price = $request->input('Gia');
        $product->description = $request->input('mota');
        
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }
    
        $product->save();
    
        return redirect()->route('product.list')->with('success', 'Sản phẩm đã được cập nhật thành công');
    }
    
}
