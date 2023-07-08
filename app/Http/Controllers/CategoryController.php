<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products()->paginate(6);
        return view('categories.show', compact('products', 'category'));
    }
}
