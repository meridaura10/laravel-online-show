<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(6);
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = $product->categories()->get();
   
        return view('products.show', compact('product', 'categories'));
    }
    
    


}