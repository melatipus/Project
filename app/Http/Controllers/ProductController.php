<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'product' => 'required',   
            'stock' => 'required|integer',
            'normal_price' => 'required',
            'member_price' => 'required',
            'description' => 'required',
            'image' => 'required',
        ],
        [
            'required' => 'Kolom ini harus diisi',
            'integer' => 'Kolom ini harus berupa angka'
        ]);

        $image = explode('.', $request->file('image')->getClientOriginalName())[0];
        $image = $image . '-' . time() . '.' . $request->file('image')->extension();
        $request->file('image')->storeAs('uploads/products', $image);
        $image = 'uploads/products/' . $image;

        Product::create([
            'name' => $request->product,
            'stock' => $request->stock,
            'normal_price' => str_replace('.', '', $request->normal_price),
            'member_price' => str_replace('.', '', $request->member_price),
            'description' => $request->description,
            'image' => $image,
        ]);

        return redirect()->route('products.index')->with('success', 'Berhasil menambahkan produk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
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
        if ($request->file('image')) {
            Storage::delete($product->image);

            $image = explode('.', $request->file('image')->getClientOriginalName())[0];
            $image = $image . '-' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('uploads/products', $image);
            $image = 'uploads/products/' . $image;
        }

        $product->update([
            'name' => $request->product,
            'stock' => $request->stock,
            'normal_price' => str_replace('.', '', $request->normal_price),
            'member_price' => str_replace('.', '', $request->member_price),
            'description' => $request->description,
            'image' => $image,
        ]);

        return redirect()->route('products.index')->with('Berhasil mengedit produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Berhasil menghapus produk');
    }
}
